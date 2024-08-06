<?php


namespace App\Http\Controllers; 

use Illuminate\Support\Str;
use App\Models\Domain;
use Illuminate\Http\Request;

class DominioAdminController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'url_dominio' => ['required', 'string', 'max:255'],
            'id_cliente' => ['required', 'exists:clientes,id'],
        ]);

        $licencia = Str::random(45);

        Domain::create([
            'id_cliente' => $request->id_cliente,
            'url_dominio' => $request->url_dominio,
            'licencia' => $licencia,
            'estado' => 'Inactivo',
            // otros campos que necesites
        ]);

        return redirect()->route('clientes.show', $validated['id_cliente'])->with('success', 'Dominio agregado exitosamente.');
    }
    public function edit($id)
    {
        $dominio = Domain::findOrFail($id);
        return response()->json($dominio);
    }
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'url_dominio' => ['required', 'string', 'max:255'],
        ]);

        $dominio = Domain::findOrFail($id);
        $dominio->update($validated);

        return redirect()->route('clientes.show', $dominio->id_cliente)->with('success', 'Dominio actualizado exitosamente.');
    }
}
