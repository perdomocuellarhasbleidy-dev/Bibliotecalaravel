<?php

namespace App\Http\Controllers;

use App\Models\Multa;
use App\Models\Prestamo;
use Illuminate\Http\Request;

class MultaController extends Controller
{
    public function index(Request $request)
    {
        return redirect()->route('dashboard', array_merge(
            ['modulo' => 'multas'],
            $request->query()
        ));
    }

    public function store(Request $request)
    {
        $datos = $request->validate([
            'idprestamo' => 'required|integer|exists:prestamo,idprestamo',
            'motivo' => 'required|string|max:255',
            'fecha' => 'required|date',
            'valor' => 'required|numeric|min:0',
        ]);

        Multa::create($datos);

        return redirect()
            ->route('dashboard', ['modulo' => 'multas'])
            ->with('success', '¡Multa registrada con éxito!');
    }

    public function update(Request $request, Multa $multa)
    {
        $datos = $request->validate([
            'idprestamo' => 'required|integer|exists:prestamo,idprestamo',
            'motivo' => 'required|string|max:255',
            'fecha' => 'required|date',
            'valor' => 'required|numeric|min:0',
        ]);

        $multa->update($datos);

        return redirect()
            ->route('dashboard', ['modulo' => 'multas'])
            ->with('success', '¡Multa actualizada con éxito!');
    }

    public function destroy(Multa $multa)
    {
        $multa->delete();

        return redirect()
            ->route('dashboard', ['modulo' => 'multas'])
            ->with('success', '¡Multa eliminada con éxito!');
    }
}
