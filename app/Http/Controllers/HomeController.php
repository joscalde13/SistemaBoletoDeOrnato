<?php

namespace App\Http\Controllers;

use App\Models\ConfiguracionMunicipal;

class HomeController extends Controller
{
    /**
     * Página principal pública del sistema.
     */
    public function index()
    {
        $config = ConfiguracionMunicipal::obtener();

        return view('public.home', compact('config'));
    }
}
