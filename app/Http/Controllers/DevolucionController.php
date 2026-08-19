<?php

namespace App\Http\Controllers;

use App\Models\Devolucion;
use App\Models\Prestamo;
use Illuminate\Http\Request;

class DevolucionController extends Controller
{
    public function index(Request $request)
    {
        return redirect()->route('dashboard', array_merge(
            ['modulo' => 'devoluciones'],
            $request->query()
        ));
    }

    public function store(Request $request)
    {
        $datos = $request->validate([
            'idprestamo' => 'required|integer|exists:prestamo,idprestamo',
            'fecha_devolucion' => 'required|date',
            'estado' => 'required|string|max:30',
        ]);

        $prestamo = Prestamo::findOrFail($datos['idprestamo']);

        if ($prestamo->devolucion()->exists()) {
            return redirect()
                ->route('dashboard', ['modulo' => 'devoluciones'])
                ->with('error', 'Este préstamo ya tiene una devolución registrada.');
        }

        Devolucion::create([
            'idprestamo' => $prestamo->idprestamo,
            'idlibro' => $prestamo->idlibro,
            'id_usuario' => $prestamo->id_usuario,
            'fecha_devolucion' => $datos['fecha_devolucion'],
            'estado' => $datos['estado'],
        ]);

        $prestamo->update(['estado' => 'Devuelto']);

        return redirect()
            ->route('dashboard', ['modulo' => 'devoluciones'])
            ->with('success', '¡Devolución registrada con éxito!');
    }

    public function update(Request $request, Devolucion $devolucion)
    {
        $datos = $request->validate([
            'idprestamo' => 'required|integer|exists:prestamo,idprestamo',
            'fecha_devolucion' => 'required|date',
            'estado' => 'required|string|max:30',
        ]);

        $prestamo = Prestamo::findOrFail($datos['idprestamo']);

        $devolucion->update([
            'idprestamo' => $prestamo->idprestamo,
            'idlibro' => $prestamo->idlibro,
            'id_usuario' => $prestamo->id_usuario,
            'fecha_devolucion' => $datos['fecha_devolucion'],
            'estado' => $datos['estado'],
        ]);

        $prestamo->update(['estado' => 'Devuelto']);

        return redirect()
            ->route('dashboard', ['modulo' => 'devoluciones'])
            ->with('success', '¡Devolución actualizada con éxito!');
    }

    public function destroy(Devolucion $devolucion)
    {
        $prestamo = $devolucion->prestamo;
        $devolucion->delete();

        if ($prestamo) {
            $prestamo->update(['estado' => 'Activo']);
        }

        return redirect()
            ->route('dashboard', ['modulo' => 'devoluciones'])
            ->with('success', '¡Devolución eliminada con éxito!');
    }
}
