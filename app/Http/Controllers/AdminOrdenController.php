<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Domain;
use App\Models\Orden;
use Illuminate\Http\Request;

class AdminOrdenController extends Controller
{
    // Métodos para la administración de órdenes
    public function index()
    {
        $ordenes = Orden::all();
        return view('admin.ordenes.index', compact('ordenes'));
    }

    public function create(Request $request)
    {
        // Lógica para crear una nueva orden
        // Similar a tu método original 'create'
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_cliente' => 'required|exists:clientes,id',
        ]);

        Orden::create([
            'id_cliente' => $request->id_cliente,
            'id_dominio' => $request->id_dominio,
            'estado' => 'Activo',
        ]);

        $dominio = Domain::find($request->id_dominio);
        $dominio->estado = 'Activo';
        $dominio->fecha_exp = $request->fecha_vencimiento;
        $dominio->save();
        // Actualiza el estado del dominio, etc.
        
        return redirect()->route('clientes.show', ['cliente' => $request->id_cliente])
                     ->with('success', 'Dominio agregado exitosamente.');
    }

    // Otros métodos como show, edit, update, destroy según sea necesario
}
