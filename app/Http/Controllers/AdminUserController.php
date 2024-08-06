<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminUserController extends Controller
{
    public function showRegistrationForm()
    {
        return view('admin.register'); // Tu vista del formulario de registro para administradores
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $user = User::create([
            'name' => $request->input('name'),
            'apellido' => $request->input('apellido'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        Cliente::create([
            'id_user' => $user->id,
            'direccion' => $request->input('direccion'),
            'telefono' => $request->input('telefono'),
        ]);

        return redirect()->route('todos.index')->with('success', 'Usuario registrado con éxito');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'apellido' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'direccion' => ['required', 'string', 'max:255'],
            'telefono' => ['nullable', 'string', 'max:15'],
        ]);
    }
}
