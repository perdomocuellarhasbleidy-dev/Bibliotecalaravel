<?php

namespace App\Http\Controllers;

use App\Models\Autor;
use App\Models\Devolucion;
use App\Models\Libro;
use App\Models\Multa;
use App\Models\Prestamo;
use App\Models\Usuario;

class DashboardController extends Controller
{
    public function index()
    {
        $usuario = session('usuario');

        if ($usuario['rol'] === 'bibliotecario') {
            return view('dashboard.inicio', [
                'totalLibros' => Libro::count(),
                'totalBeneficiarios' => Usuario::where('id_rol', 2)->count(),
                'totalPrestamos' => Prestamo::whereIn('estado', ['Activo', 'Pendiente', 'Vencido'])->count(),
                'totalMultas' => Multa::count(),
            ]);
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