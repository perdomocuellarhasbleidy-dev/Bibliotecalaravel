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
                    ->paginate(12)
                    ->withQueryString();

                $todosLibros = Libro::withCount([
                    'prestamos as prestamos_activos_count' => function ($query) {
                        $query->whereIn('estado', ['Activo', 'Pendiente', 'Vencido']);
                    },
                ])->get();

                $datos['totalLibrosEncontrados'] = $datos['libros']->total();
                $datos['librosDisponibles'] = $todosLibros->where('prestamos_activos_count', 0)->count();
                $datos['librosPrestados'] = $todosLibros->where('prestamos_activos_count', '>', 0)->count();

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
                $datos['pendientes'] = Prestamo::where('estado', 'Pendiente')->count();
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
                $fechaInicio = $request->input('fecha_inicio');
                $fechaFin = $request->input('fecha_fin');
                $tipo = $request->input('tipo', 'resumen');
                $imprimir = $request->boolean('imprimir');

                $prestamos = Prestamo::query()
                    ->when($fechaInicio, fn ($query) => $query->whereDate('fecha_prestamo', '>=', $fechaInicio))
                    ->when($fechaFin, fn ($query) => $query->whereDate('fecha_prestamo', '<=', $fechaFin));

                $devoluciones = Devolucion::query()
                    ->when($fechaInicio, fn ($query) => $query->whereDate('fecha_devolucion', '>=', $fechaInicio))
                    ->when($fechaFin, fn ($query) => $query->whereDate('fecha_devolucion', '<=', $fechaFin));

                $multas = Multa::query()
                    ->when($fechaInicio, fn ($query) => $query->whereDate('fecha', '>=', $fechaInicio))
                    ->when($fechaFin, fn ($query) => $query->whereDate('fecha', '<=', $fechaFin));

                $datos['modulo'] = 'reportes';
                $datos['fechaInicio'] = $fechaInicio;
                $datos['fechaFin'] = $fechaFin;
                $datos['tipo'] = $tipo;
                $datos['imprimir'] = $imprimir;

                $datos['totalBeneficiarios'] = Usuario::where('id_rol', 2)->count();
                $datos['totalLibros'] = Libro::count();
                $datos['totalPrestamos'] = (clone $prestamos)->count();
                $datos['totalDevoluciones'] = (clone $devoluciones)->count();
                $datos['totalMultas'] = (clone $multas)->count();
                $datos['valorMultas'] = (clone $multas)->sum('valor');

                $datos['prestamosReporte'] = (clone $prestamos)
                    ->with(['libro', 'usuario'])
                    ->orderByDesc('idprestamo')
                    ->paginate(10)
                    ->withQueryString();

                $datos['devolucionesReporte'] = (clone $devoluciones)
                    ->with(['prestamo', 'libro', 'usuario'])
                    ->orderByDesc('iddevolucion')
                    ->paginate(5, ['*'], 'devoluciones_page')
                    ->withQueryString();

                $multasConsulta = (clone $multas)
                    ->with('prestamo.libro', 'prestamo.usuario')
                    ->orderByDesc('idmulta');

                $datos['multasReporte'] = $imprimir
                    ? $multasConsulta->get()
                    : $multasConsulta->paginate(5, ['*'], 'multas_page')->withQueryString();

                $datos['librosReporte'] = Libro::with('autor')
                    ->orderBy('titulo')
                    ->paginate(10, ['*'], 'libros_page')
                    ->withQueryString();

                $beneficiariosConsulta = Usuario::where('id_rol', 2)->orderBy('nombre');

                $datos['beneficiariosReporte'] = $imprimir
                    ? $beneficiariosConsulta->get()
                    : $beneficiariosConsulta->paginate(10, ['*'], 'beneficiarios_page')->withQueryString();
            }

            return view('dashboard.inicio', $datos);
        }

        $modulo = $request->input('modulo', 'inicio');
        $buscar = trim($request->input('buscar', ''));
        $categoria = trim($request->input('categoria', ''));

        $allPrestamos = Prestamo::with(
            'libro.autor'
        )
            ->where(
                'id_usuario',
                $usuario['id_usuario']
            )
            ->orderByDesc('idprestamo')
            ->get();

        $prestamos = Prestamo::with(
            'libro.autor'
        )
            ->where(
                'id_usuario',
                $usuario['id_usuario']
            )
            ->orderByDesc('idprestamo')
            ->paginate(3)
            ->withQueryString();

        $multas_query = Multa::whereHas(
            'prestamo',
            function ($query) use ($usuario) {
                $query->where(
                    'id_usuario',
                    $usuario['id_usuario']
                );
            }
        );

        $multas_todas = $multas_query->get();
        $multas = $multas_todas->count();
        $valorMultas = $multas_todas->sum('valor');
        $multas_paginadas = $multas_query->orderByDesc('idmulta')->paginate(3)->withQueryString();

        $totalPrestamos = $allPrestamos->count();
        $activos = $allPrestamos->where('estado', 'Activo')->count();
        $devueltos = $allPrestamos->whereIn('estado', ['Devuelto', 'Devueltos'])->count();
        $vencidos = $allPrestamos->where('estado', 'Vencido')->count();
        $pendientes = $allPrestamos->where('estado', 'Pendiente')->count();
        $rechazados = $allPrestamos->whereIn('estado', ['Rechazado', 'Rechazados'])->count();

        $librosQuery = Libro::with('autor')
            ->withCount([
                'prestamos as prestamos_activos_count' => function ($query) {
                    $query->whereIn('estado', ['Activo', 'Pendiente', 'Vencido']);
                },
            ])
            ->when($buscar, function ($query) use ($buscar) {
                $query->where(function ($q) use ($buscar) {
                    $q->where('titulo', 'like', "%{$buscar}%")
                        ->orWhere('categoria', 'like', "%{$buscar}%")
                        ->orWhere('año_publicacion', 'like', "%{$buscar}%")
                        ->orWhereHas('autor', function ($autor) use ($buscar) {
                            $autor->where('nombre', 'like', "%{$buscar}%");
                        });
                });
            })
            ->when($categoria, fn ($q) => $q->where('categoria', $categoria))
            ->orderBy('titulo');

        $allLibros = $librosQuery->get();
        $totalLibrosEncontrados = $allLibros->count();
        $librosDisponibles = $allLibros->where('prestamos_activos_count', 0)->count();
        $librosPrestados = $allLibros->where('prestamos_activos_count', '>', 0)->count();

        $libros = $librosQuery->paginate(6)->withQueryString();

        $categorias = Libro::whereNotNull('categoria')
            ->where('categoria', '<>', '')
            ->distinct()
            ->orderBy('categoria')
            ->pluck('categoria');

        $usuarioData = Usuario::find($usuario['id_usuario']);

        return view(
            'dashboard.usuario',
            compact(
                'usuarioData',
                'prestamos',
                'totalPrestamos',
                'multas',
                'valorMultas',
                'multas_paginadas',
                'activos',
                'devueltos',
                'vencidos',
                'pendientes',
                'rechazados',
                'modulo',
                'buscar',
                'categoria',
                'libros',
                'totalLibrosEncontrados',
                'librosDisponibles',
                'librosPrestados',
                'categorias'
            )
        );
    }
}