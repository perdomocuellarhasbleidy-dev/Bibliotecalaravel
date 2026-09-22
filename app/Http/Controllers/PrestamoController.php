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
            'foto_beneficiario' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Verificar si el libro ya está ocupado o tiene préstamo activo/pendiente
        $estaOcupado = Prestamo::where('idlibro', $datos['idlibro'])
            ->whereIn('estado', ['Activo', 'Pendiente', 'Vencido'])
            ->exists();

        if ($estaOcupado) {
            return back()->with('error', 'El libro seleccionado ya no está disponible para préstamo.');
        }

        if ($request->hasFile('foto_beneficiario')) {
            $fotoPath = $request->file('foto_beneficiario')->store('beneficiarios', 'public');
            $usuarioObj = \App\Models\Usuario::find($usuarioSession['id_usuario']);
            if ($usuarioObj) {
                $usuarioObj->foto = $fotoPath;
                $usuarioObj->save();
            }
            $usuarioSession['foto'] = $fotoPath;
            session(['usuario' => $usuarioSession]);
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

    public function store(Request $request)
    {
        $datos = $request->validate([
            'idlibro' => 'required|exists:libro,idlibro',
            'id_usuario' => 'required|exists:usuario,id_usuario',
            'fecha_prestamo' => 'nullable|date',
            'foto_beneficiario' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $estaOcupado = Prestamo::where('idlibro', $datos['idlibro'])
            ->whereIn('estado', ['Activo', 'Pendiente', 'Vencido'])
            ->exists();

        if ($estaOcupado) {
            return back()->with('error', 'El libro seleccionado ya no está disponible para préstamo.');
        }

        if ($request->hasFile('foto_beneficiario')) {
            $fotoPath = $request->file('foto_beneficiario')->store('beneficiarios', 'public');
            \App\Models\Usuario::where('id_usuario', $datos['id_usuario'])->update(['foto' => $fotoPath]);
        }

        Prestamo::create([
            'idlibro' => $datos['idlibro'],
            'id_usuario' => $datos['id_usuario'],
            'fecha_prestamo' => $datos['fecha_prestamo'] ?? now()->toDateString(),
            'estado' => 'Activo',
        ]);

        return back()->with('success', '¡Préstamo registrado con éxito!');
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
