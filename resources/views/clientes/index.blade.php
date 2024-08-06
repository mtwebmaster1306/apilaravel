@extends('adminlte::page')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Listado de Clientes</h1>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Teléfono</th>
                            <th>Email</th>
                            <th>Dirección</th>
                            <!-- Agrega más columnas según tus necesidades -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($clientes as $cliente)
                            <tr>
                                <td>{{ $cliente->nombre }}</td>
                                <td>{{ $cliente->telefono }}</td>
                                <td>{{ $cliente->email }}</td>
                                <td>{{ $cliente->direccion }}</td>
                                <!-- Agrega más columnas según tus necesidades -->
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
