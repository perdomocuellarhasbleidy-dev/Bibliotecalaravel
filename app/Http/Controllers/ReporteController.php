<?php

namespace App\Http\Controllers;

use App\Models\Devolucion;
use App\Models\Libro;
use App\Models\Multa;
use App\Models\Prestamo;
use App\Models\Usuario;
use Illuminate\Http\Request;

class ReporteController extends Controller
{
    public function index(Request $request)
    {
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

        $prestamosReporte = (clone $prestamos)
            ->with(['libro', 'usuario'])
            ->orderByDesc('idprestamo')
            ->paginate(10)
            ->withQueryString();

        $devolucionesReporte = (clone $devoluciones)
            ->with(['prestamo', 'libro', 'usuario'])
            ->orderByDesc('iddevolucion')
            ->paginate(5, ['*'], 'devoluciones_page')
            ->withQueryString();

        $multasConsulta = (clone $multas)
            ->with('prestamo.libro', 'prestamo.usuario')
            ->orderByDesc('idmulta');

        $multasReporte = $imprimir
            ? $multasConsulta->get()
            : $multasConsulta->paginate(5, ['*'], 'multas_page')->withQueryString();

        $librosReporte = Libro::with('autor')
            ->orderBy('titulo')
            ->paginate(10, ['*'], 'libros_page')
            ->withQueryString();

        $beneficiariosConsulta = Usuario::where('id_rol', 2)
            ->orderBy('nombre')
            ;

        $beneficiariosReporte = $imprimir
            ? $beneficiariosConsulta->get()
            : $beneficiariosConsulta->paginate(10, ['*'], 'beneficiarios_page')->withQueryString();

        return view('reportes.dashboard', [
            'fechaInicio' => $fechaInicio,
            'fechaFin' => $fechaFin,
            'tipo' => $tipo,
            'imprimir' => $imprimir,
            'totalBeneficiarios' => Usuario::where('id_rol', 2)->count(),
            'totalLibros' => Libro::count(),
            'totalPrestamos' => (clone $prestamos)->count(),
            'totalDevoluciones' => (clone $devoluciones)->count(),
            'totalMultas' => (clone $multas)->count(),
            'valorMultas' => (clone $multas)->sum('valor'),
            'prestamosReporte' => $prestamosReporte,
            'devolucionesReporte' => $devolucionesReporte,
            'multasReporte' => $multasReporte,
            'librosReporte' => $librosReporte,
            'beneficiariosReporte' => $beneficiariosReporte,
        ]);
    }
}