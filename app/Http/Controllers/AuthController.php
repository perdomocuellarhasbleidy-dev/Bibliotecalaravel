<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $datos = $request->validate([
            'documento' => 'required|string',
            'password' => 'required|string',
        ]);

        $usuario = Usuario::with('rol')
            ->where('documento', $datos['documento'])
            ->first();

        if (!$usuario) {
            return back()
                ->withInput()
                ->with('error', 'El documento no está registrado.');
        }

        $clave = (string) $usuario->getRawOriginal('contraseña');
        $correcta = false;

        /*
         * Tus datos originales tienen contraseñas en texto plano.
         * Verificamos primero si es texto plano ('unknown' algorithm).
         */
        if (Hash::info($clave)['algoName'] === 'unknown') {
            if (hash_equals($clave, $datos['password'])) {
                $usuario->contraseña = Hash::make($datos['password']);
                $usuario->save();
                $correcta = true;
            }
        } else {
            // Es un hash válido, usamos Hash::check
            $correcta = Hash::check($datos['password'], $clave);
        }

        if (!$correcta) {
            return back()
                ->withInput()
                ->with('error', 'Contraseña incorrecta.');
        }

        $request->session()->regenerate();

        $request->session()->put('usuario', [
            'id_usuario' => $usuario->id_usuario,
            'nombre' => $usuario->nombre,
            'documento' => $usuario->documento,
            'telefono' => $usuario->telefono,
            'email' => $usuario->email,
            'id_rol' => $usuario->id_rol,
            'rol' => strtolower(
                $usuario->rol->descripcion
            ),
        ]);

        return redirect()->route('dashboard');
    }

    public function logout(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('login')
            ->with('success', 'Sesión cerrada correctamente.');
    }
}