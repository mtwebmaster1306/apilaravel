<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Domain;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DominioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Obtener todos los dominios junto con el cliente relacionado
        $dominios = Domain::with('cliente')->get();

        // Pasar los datos a la vista
        return view('sistema.dominio', compact('dominios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validación de los datos del formulario
        $request->validate([
            'id_cliente' => 'required|exists:clientes,id',  // Asegura que id_cliente exista en la tabla clientes
            'url_dominio' => 'required|string',
            // Otros campos si los hay
        ]);
    
        // Generar la licencia aleatoria de 45 caracteres
        $licencia = Str::random(45);
    
        // Crear el dominio con estado por defecto "Inactivo"
        $dominio = Domain::create([
            'id_cliente' => $request->id_cliente,
            'url_dominio' => $request->url_dominio,
            'licencia' => $licencia,
            'estado' => 'Inactivo',
            // Otros campos si los hay
        ]);
    
        // Redireccionar a alguna vista o ruta después de crear el dominio
        return redirect()->route('dominios.index')->with('success', 'Dominio creado exitosamente.');
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
