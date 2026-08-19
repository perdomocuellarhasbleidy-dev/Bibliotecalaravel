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

    public function destroy(Prestamo $prestamo)
    {
        $prestamo->delete();

        return redirect()
            ->route('dashboard', ['modulo' => 'prestamos'])
            ->with('success', '¡Préstamo eliminado con éxito!');
    }
}
