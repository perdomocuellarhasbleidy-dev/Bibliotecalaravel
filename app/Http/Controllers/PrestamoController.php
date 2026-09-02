<?php

namespace App\Http\Controllers;

use App\Models\Prestamo;
use Illuminate\Http\Request;

class PrestamoController extends Controller
{
    public function index(Request $request)
    {
        return redirect()->route('dashboard', array_merge(
            ['modulo' => 'prestamos'],
            $request->query()
        ));
    }

    public function solicitar(Request $request)
    {
        $usuarioSession = session('usuario');
        if (!$usuarioSession || empty($usuarioSession['id_usuario'])) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para solicitar un préstamo.');
        }

        $datos = $request->validate([
            'idlibro' => 'required|exists:libro,idlibro',
        ]);

        // Verificar si el libro ya está ocupado o tiene préstamo activo/pendiente
        $estaOcupado = Prestamo::where('idlibro', $datos['idlibro'])
            ->whereIn('estado', ['Activo', 'Pendiente', 'Vencido'])
            ->exists();

        if ($estaOcupado) {
            return back()->with('error', 'El libro seleccionado ya no está disponible para préstamo.');
        }

        // Crear registro de solicitud de préstamo con estado Pendiente
        Prestamo::create([
            'idlibro' => $datos['idlibro'],
            'id_usuario' => $usuarioSession['id_usuario'],
            'fecha_prestamo' => now()->toDateString(),
            'estado' => 'Pendiente',
        ]);

        return back()->with('success', '¡Solicitud enviada con éxito! El bibliotecario debe revisar y aceptar tu préstamo.');
    }

    public function updateEstado(Request $request, Prestamo $prestamo)
    {
        $datos = $request->validate([
            'estado' => 'required|string',
        ]);

        $prestamo->update([
            'estado' => $datos['estado'],
        ]);

        return back()->with('success', "¡Estado del préstamo actualizado a '{$datos['estado']}' exitosamente!");
    }

    public function destroy(Prestamo $prestamo)
    {
        $prestamo->delete();

        return redirect()
            ->route('dashboard', ['modulo' => 'prestamos'])
            ->with('success', '¡Préstamo eliminado con éxito!');
    }
}
