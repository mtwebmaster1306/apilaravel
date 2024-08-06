<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\Domain;
use App\Models\Orden;
use Illuminate\Http\Request;

class OrdenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ordenes = Orden::all();
        return view('sistema.ordenes', compact('ordenes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $id_dominio = $request->input('id_dominio');
        $dominio = Domain::find($id_dominio);
        $cliente = auth()->user()->cliente; // Obtener el cliente del usuario autenticado
        return view('sistema.ordenes_create', compact('id_dominio', 'dominio', 'cliente'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

        return redirect()->route('ordenes.index')
                         ->with('success', 'Orden creada exitosamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function mostrarOrdenes()
    {
        $ordenes = Orden::all();
        return view('sistema.ordenes', compact('ordenes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}