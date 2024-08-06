@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dominios</h1>
@stop

@section('content')

         {{-- Minimal --}}
<x-adminlte-modal id="modalMin" title="Agregar nuevo dominio">
{{-- Example button to open modal --}}
<form action="{{ route('dominios.store') }}" method="POST">
    @csrf
    <div class="card-head">
        <div class="row">
            <div class="col">
                <!-- Columna para ingresar el dominio -->
                <input type="text" class="form-control" placeholder="Agregar dominio" id="dominio" name="url_dominio">
                <input type="hidden" name="id_cliente" value="{{ auth()->user()->cliente->id }}">

                <!-- Columna para el botón "Agregar" -->
                <div class="form-group">
                    <label>&nbsp;</label><br>
                    <button type="submit" class="btn btn-success form-control" id="btnAgregar">Agregar</button>
                </div>
            </div>
     
        </div>

    </div>
</form>
</x-adminlte-modal>


    

    <div class="card">
        <div class="card-head d-flex flex-row-reverse">       
      
            <button type="button" label="Open Modal" data-toggle="modal" data-target="#modalMin" class="mt-3  mr-3  btn btn-primary">Agregar</button>
        </div>
        <div class="card-body">
            {{-- Setup data for datatables --}}
            @php
                $heads = [
                    ['label' => 'Id', 'no-export' => true, 'width' => 10],
                    ['label' => 'Dominio', 'no-export' => true, 'width' => 10],
                    ['label' => 'Licencia', 'no-export' => true, 'width' => 20],
                    ['label' => 'Fecha de expiración', 'no-export' => true, 'width' => 10],
                    ['label' => 'Estado', 'no-export' => true, 'width' => 10],
                ];

                $btnEdit = '';
                $btnDelete = '<button type="submit" class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete">
                  <i class="fa fa-lg fa-fw fa-trash"></i>
              </button>';
                $btnDetails = '<button class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details">
                   <i class="fa fa-lg fa-fw fa-eye"></i>
               </button>';

               $config = [
                   'languaje'=>[
                        'url'=>'//cdn.datatables.net/plug-ins/2.0.8/i18n/es-CL.json',
                   ]
                ];
            @endphp

            {{-- Minimal example / fill data using the component slot --}}
            <x-adminlte-datatable id="table1" :heads="$heads" :config="$config" >
                @php
                // Obtener el cliente de la sesión actual
                $cliente = Auth::user()->cliente; // Suponiendo que 'cliente' es la relación en tu modelo de usuario
            @endphp
            
            @if($cliente)
                @foreach ($cliente->dominios as $dominio)
                    <tr>
                        <td>{{ $dominio->id }}</td>
                        <td>{{ $dominio->url_dominio }}</td>
                        <td>{{ $dominio->licencia }}</td>
                        <td>{{ $dominio->fecha_exp }}</td>
                        <td>
                            @if($dominio->estado == 'Inactivo')
                                <form action="{{ route('ordenes.create') }}" method="GET">
                                    <input type="hidden" name="id_dominio" value="{{ $dominio->id }}">
                                    <button type="submit" class="btn btn-primary">Comprar Licencia</button>
                                </form>
                            @else
                                <button class="btn btn-success">Licencia activa</button>
                            @endif
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="6">No hay dominios asociados a este cliente.</td>
                </tr>
            @endif
            </x-adminlte-datatable>
        </div>
    </div>
    @if(session('success'))
    <x-adminlte-alert id="alertSuccess" theme="success" title="Éxito">
        {{ session('success') }}
    </x-adminlte-alert>
@endif
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
<script>
         $(document).ready(function() {
        setTimeout(function() {
            $('#alertSuccess').fadeOut('fast');
        }, 1500); // 2000 milisegundos = 2 segundos
    });
</script>
@stop
