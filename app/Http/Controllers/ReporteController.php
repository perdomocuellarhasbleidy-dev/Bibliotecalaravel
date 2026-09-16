<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReporteController extends Controller
{
    public function index(Request $request)
    {
        return redirect()->route('dashboard', array_merge(['modulo' => 'reportes'], $request->all()));
      }
}