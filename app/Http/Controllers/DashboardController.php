<?php

namespace App\Http\Controllers;

use App\Models\Autor;
use App\Models\Devolucion;
use App\Models\Libro;
use App\Models\Multa;
use App\Models\Prestamo;
use App\Models\Usuario;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $usuario = session('usuario');

        if ($usuario['rol'] === 'bibliotecario') {
            $datos = [
                'totalLibros' => Libro::count(),
                'totalBeneficiarios' => Usuario::where('id_rol', 2)->count(),
                'totalPrestamos' => Prestamo::whereIn('estado', ['Activo', 'Pendiente', 'Vencido'])->count(),
                'totalMultas' => Multa::count(),
            ];

            if ($request->input('modulo') === 'libros') {
                $buscar = trim($request->input('buscar', ''));
                $categoria = trim($request->input('categoria', ''));

                $datos['modulo'] = 'libros';
                $datos['buscar'] = $buscar;
                $datos['categoria'] = $categoria;
                $datos['libros'] = Libro::with('autor')
                    ->withCount([
                        'prestamos as prestamos_activos_count' => function ($query) {
                            $query->whereIn('estado', ['Activo', 'Pendiente', 'Vencido']);
                        },
                    ])
                    ->when($buscar, function ($query) use ($buscar) {
                        $query->where(function ($query) use ($buscar) {
                            $query->where('titulo', 'like', "%{$buscar}%")
                                ->orWhere('categoria', 'like', "%{$buscar}%")
                                ->orWhereHas('autor', function ($autor) use ($buscar) {
                                    $autor->where('nombre', 'like', "%{$buscar}%");
                                });
                        });
                    })
                    ->when($categoria, fn ($query) => $query->where('categoria', $categoria))
                    ->orderBy('titulo')
                    ->paginate(4)
                    ->withQueryString();
                $datos['categorias'] = Libro::whereNotNull('categoria')
                    ->where('categoria', '<>', '')
                    ->distinct()
                    ->orderBy('categoria')
                    ->pluck('categoria');
                $datos['autores'] = Autor::orderBy('nombre')->get();
            }

            if ($request->input('modulo') === 'prestamos') {
                $buscarPrestamos = trim($request->input('buscar', ''));

                $datos['modulo'] = 'prestamos';
                $datos['buscarPrestamos'] = $buscarPrestamos;
                $datos['prestamos'] = Prestamo::with(['libro', 'usuario', 'devolucion'])
                    ->when($buscarPrestamos, function ($query) use ($buscarPrestamos) {
                        $query->where(function ($query) use ($buscarPrestamos) {
                            $query->where('estado', 'like', "%{$buscarPrestamos}%")
                                ->orWhere('fecha_prestamo', 'like', "%{$buscarPrestamos}%")
                                ->orWhereHas('libro', function ($libro) use ($buscarPrestamos) {
                                    $libro->where('titulo', 'like', "%{$buscarPrestamos}%");
                                })
                                ->orWhereHas('usuario', function ($usuario) use ($buscarPrestamos) {
                                    $usuario->where('nombre', 'like', "%{$buscarPrestamos}%")
                                        ->orWhere('documento', 'like', "%{$buscarPrestamos}%");
                                });
                        });
                    })
                    ->orderByDesc('idprestamo')
                    ->paginate(6)
                    ->withQueryString();
                $datos['totalPrestamos'] = Prestamo::count();
                $datos['activos'] = Prestamo::where('estado', 'Activo')->count();
                $datos['devueltos'] = Prestamo::whereIn('estado', ['Devuelto', 'Devueltos'])->count();
                $datos['rechazados'] = Prestamo::whereIn('estado', ['Rechazado', 'Rechazados'])->count();
            }

            if ($request->input('modulo') === 'devoluciones') {
                $buscarDevoluciones = trim($request->input('buscar', ''));

                $datos['modulo'] = 'devoluciones';
                $datos['buscarDevoluciones'] = $buscarDevoluciones;
                $datos['devoluciones'] = Devolucion::with(['prestamo', 'libro', 'usuario'])
                    ->when($buscarDevoluciones, function ($query) use ($buscarDevoluciones) {
                        $query->where(function ($query) use ($buscarDevoluciones) {
                            $query->where('estado', 'like', "%{$buscarDevoluciones}%")
                                ->orWhere('fecha_devolucion', 'like', "%{$buscarDevoluciones}%")
                                ->orWhereHas('libro', function ($libro) use ($buscarDevoluciones) {
                                    $libro->where('titulo', 'like', "%{$buscarDevoluciones}%");
                                })
                                ->orWhereHas('usuario', function ($usuario) use ($buscarDevoluciones) {
                                    $usuario->where('nombre', 'like', "%{$buscarDevoluciones}%")
                                        ->orWhere('documento', 'like', "%{$buscarDevoluciones}%");
                                });
                        });
                    })
                    ->orderByDesc('iddevolucion')
                    ->paginate(5)
                    ->withQueryString();
                $datos['totalDevoluciones'] = Devolucion::count();
                $datos['prestamosDisponibles'] = Prestamo::with(['libro', 'usuario'])
                    ->whereIn('estado', ['Activo', 'Pendiente', 'Vencido'])
                    ->whereDoesntHave('devolucion')
                    ->orderByDesc('idprestamo')
                    ->get();
                $datos['prestamosParaEditar'] = Prestamo::with(['libro', 'usuario'])
                    ->orderByDesc('idprestamo')
                    ->get();
            }

            if ($request->input('modulo') === 'multas') {
                $buscarMultas = trim($request->input('buscar', ''));

                $datos['modulo'] = 'multas';
                $datos['buscarMultas'] = $buscarMultas;
                $datos['multas'] = Multa::with('prestamo.libro', 'prestamo.usuario')
                    ->when($buscarMultas, function ($query) use ($buscarMultas) {
                        $query->where(function ($query) use ($buscarMultas) {
                            $query->where('motivo', 'like', "%{$buscarMultas}%")
                                ->orWhere('fecha', 'like', "%{$buscarMultas}%")
                                ->orWhere('valor', 'like', "%{$buscarMultas}%")
                                ->orWhereHas('prestamo.libro', function ($libro) use ($buscarMultas) {
                                    $libro->where('titulo', 'like', "%{$buscarMultas}%");
                                })
                                ->orWhereHas('prestamo.usuario', function ($usuario) use ($buscarMultas) {
                                    $usuario->where('nombre', 'like', "%{$buscarMultas}%")
                                        ->orWhere('documento', 'like', "%{$buscarMultas}%");
                                });
                        });
                    })
                    ->orderByDesc('idmulta')
                    ->paginate(5)
                    ->withQueryString();
                $datos['totalMultas'] = Multa::count();
                $datos['prestamosParaMulta'] = Prestamo::with(['libro', 'usuario'])
                    ->orderByDesc('idprestamo')
                    ->get();
            }

            if ($request->input('modulo') === 'reportes') {
                return redirect()->route('reportes.index', $request->query());
            }

            return view('dashboard.inicio', $datos);
        }

        $prestamos = Prestamo::with(
            'libro.autor'
        )
            ->where(
                'id_usuario',
                $usuario['id_usuario']
            )
            ->orderByDesc('idprestamo')
            ->get();

        $multas = Multa::whereHas(
            'prestamo',
            function ($query) use ($usuario) {
                $query->where(
                    'id_usuario',
                    $usuario['id_usuario']
                );
            }
        )->count();

        return view(
            'dashboard.usuario',
            compact(
                'prestamos',
                'multas'
            )
        );
    }
}