<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use Illuminate\Http\Request;

class TodosController extends Controller
{
    public function index()
    {
        $clientes = Cliente::with(['user', 'dominios'])->get();  // Obtener todos los clientes con sus dominios relacionados

        return view('sistema.todos', compact('clientes'));
    }
}
