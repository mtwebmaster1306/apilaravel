<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClienteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $Clientes = Cliente::with('user')->get();
        return view('sistema.index', compact('Clientes')); // Asegúrate de que la vista existe
    }

    public function create()
    {
        return view('Clientes.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_user' => ['required', 'exists:users,id'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:Clientes'],
            'address' => ['required', 'string'],
        ]);

        Cliente::create($validated);
        return redirect()->route('clientes.index')->with('success', 'Cliente creado exitosamente.');
    }

    public function show(Cliente $cliente) // Asegúrate de que el parámetro esté en minúsculas
    {
        $cliente = Cliente::with('dominios')->findOrFail($cliente->id);
        return view('sistema.show', compact('cliente'));
    }

    public function edit(Cliente $Cliente)
    {
        return view('Clientes.edit', compact('Cliente'));
    }

    public function update(Request $request, Cliente $Cliente)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:Clientes,email,' . $Cliente->id],
            'address' => ['required', 'string'],
        ]);

        $Cliente->update($validated);
        return redirect()->route('clientes.index')->with('success', 'Cliente actualizado exitosamente.');
    }

    public function destroy(Cliente $Cliente)
    {
        $Cliente->delete();
        return redirect()->route('clientes.index')->with('success', 'Cliente eliminado exitosamente.');
    }
}
