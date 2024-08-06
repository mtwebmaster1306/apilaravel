<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Domain;

class LicenseController extends Controller
{
    public function validateUserLicense(Request $request)
    {
        $userEmail = $request->input('email');
        $licenseKey = $request->input('license_key');

        // Obtener el usuario por email
        $user = User::where('email', $userEmail)->first();
        if (!$user) {
            return response()->json(['valid' => false, 'message' => 'User not found'], 404);
        }

        // Obtener el cliente asociado al usuario
        $cliente = $user->cliente;
        if (!$cliente) {
            return response()->json(['valid' => false, 'message' => 'Client not found'], 404);
        }

        // Buscar el dominio con la licencia y verificar si está activa
        $domain = Domain::where('licencia', $licenseKey)
                         ->where('id_cliente', $cliente->id)
                         ->where('estado', 'Activo')
                         ->first();

        if (!$domain) {
            return response()->json(['valid' => false, 'message' => 'Invalid or inactive license'], 400);
        }

        return response()->json(['valid' => true, 'message' => 'License is valid']);
    }
}
