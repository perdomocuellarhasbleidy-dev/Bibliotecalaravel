<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function index(Request $request)
    {
        $busqueda = trim($request->input('buscar', ''));

        $usuarios = Usuario::with('rol')
            ->when($busqueda !== '', function ($query) use ($busqueda) {
                $query->where(function ($query) use ($busqueda) {
                    $query->where('nombre', 'like', "%{$busqueda}%")
                        ->orWhere('documento', 'like', "%{$busqueda}%")
                        ->orWhere('telefono', 'like', "%{$busqueda}%")
                        ->orWhere('email', 'like', "%{$busqueda}%");
                });
            })
            ->paginate(5)
            ->withQueryString();

        return view('usuarios.index', compact('usuarios'));
    }

    public function create()
    {
        return view('auth.registro');
    }

    public function createAdmin()
    {
        return view('usuarios.create');
    }

    public function storeAdmin(Request $request)
    {
        $datos = $request->validate([
            'nombre' => 'required|string|max:255',
            'documento' => 'required|string|unique:usuario,documento',
            'telefono' => 'nullable|string|max:50',
            'correo' => 'required|email|unique:usuario,email',
            'password' => 'required|string|min:6',
        ], [
            'documento.unique' => 'El número de documento ya está registrado.',
            'correo.unique' => 'El correo electrónico ya está registrado.',
            'password.min' => 'La contraseña debe tener al menos 6 caracteres.',
        ]);

        $rolUsuario = Rol::where('descripcion', 'usuario')->first();

        Usuario::create([
            'nombre' => $datos['nombre'],
            'documento' => $datos['documento'],
            'telefono' => $datos['telefono'] ?? null,
            'email' => $datos['correo'],
            'contraseña' => Hash::make($datos['password']),
            'id_rol' => $rolUsuario?->id_rol ?? 2,
        ]);

        return redirect()
            ->route('usuarios.index')
            ->with('success', '¡Beneficiario registrado con éxito!');
    }

    public function store(Request $request)
    {
        $datos = $request->validate([
            'nombre' => 'required|string|max:255',
            'documento' => 'required|string|unique:usuario,documento',
            'telefono' => 'nullable|string|max:50',
            'correo' => 'required|email|unique:usuario,email',
            'password' => 'required|string|min:6|confirmed',
            'terminos' => 'accepted',
        ], [
            'terminos.accepted' => 'Debes aceptar los términos y condiciones para registrarte.',
            'documento.unique' => 'El número de documento ya está registrado.',
            'correo.unique' => 'El correo electrónico ya está registrado.',
            'password.confirmed' => 'La confirmación de contraseña no coincide.',
            'password.min' => 'La contraseña debe tener al menos 6 caracteres.',
        ]);

        $rolUsuario = Rol::where('descripcion', 'usuario')->first();
        $idRol = $rolUsuario ? $rolUsuario->id_rol : 2;

        Usuario::create([
            'nombre' => $datos['nombre'],
            'documento' => $datos['documento'],
            'telefono' => $datos['telefono'] ?? null,
            'email' => $datos['correo'],
            'contraseña' => Hash::make($datos['password']),
            'id_rol' => $idRol,
        ]);

        return redirect()->route('login')->with('account_created', true);
    }

    public function edit(Usuario $usuario)
    {
        return view('usuarios.edit', compact('usuario'));
    }

    public function update(Request $request, Usuario $usuario)
    {
        $datos = $request->validate([
            'nombre' => 'required|string|max:255',
            'documento' => 'required|string|unique:usuario,documento,' . $usuario->id_usuario . ',id_usuario',
            'telefono' => 'nullable|string|max:50',
            'correo' => 'required|email|unique:usuario,email,' . $usuario->id_usuario . ',id_usuario',
            'password' => 'nullable|string|min:6',
        ], [
            'documento.unique' => 'El número de documento ya está registrado.',
            'correo.unique' => 'El correo electrónico ya está registrado.',
            'password.min' => 'La contraseña debe tener al menos 6 caracteres.',
        ]);

        $usuario->nombre = $datos['nombre'];
        $usuario->documento = $datos['documento'];
        $usuario->telefono = $datos['telefono'] ?? null;
        $usuario->email = $datos['correo'];

        if (!empty($datos['password'])) {
            $usuario->contraseña = Hash::make($datos['password']);
        }

        $usuario->save();

        return redirect()
            ->route('usuarios.index')
            ->with('success', '¡Beneficiario actualizado con éxito!');
    }

    public function destroy(Usuario $usuario)
    {
        if ($usuario->prestamos()->exists() || $usuario->devoluciones()->exists()) {
            return redirect()
                ->route('usuarios.index')
                ->with('error', 'No se puede eliminar un beneficiario con préstamos o devoluciones.');
        }

        $usuario->delete();

        return redirect()
            ->route('usuarios.index')
            ->with('success', '¡Beneficiario eliminado con éxito!');
    }
}