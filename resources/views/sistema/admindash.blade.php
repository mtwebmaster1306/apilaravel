@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dominios</h1>
@stop

@section('content')

         {{-- Minimal --}}
<x-adminlte-modal id="modalMin" title="Agregar nuevo dominio">
{{-- Example button to open modal --}}
<form action="{{ route('dominios.store') }}" method="post">
    @csrf

    {{-- Name field --}}
    <div class="input-group mb-3">
        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
               value="{{ old('name') }}" placeholder="{{ __('adminlte::adminlte.full_name') }}" autofocus>

        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-user {{ config('adminlte.classes_auth_icon', '') }}"></span>
            </div>
        </div>

        @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="input-group mb-3">
   
        <input  type="text" name="apellido" placeholder="Apellido" class="form-control" value="{{ old('apellido') }}" required>
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-envelope"></span>
            </div>
        </div>
    </div>

    {{-- Email field --}}
    <div class="input-group mb-3">
        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
               value="{{ old('email') }}" placeholder="{{ __('adminlte::adminlte.email') }}">

        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-envelope {{ config('adminlte.classes_auth_icon', '') }}"></span>
            </div>
        </div>

        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    {{--nuevos campos --}}
    <div class="input-group mb-3">
   
        <input id="direccion" type="text" name="direccion" placeholder="Dirección" class="form-control" value="{{ old('direccion') }}" required>
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-envelope"></span>
            </div>
        </div>
    </div>

    <!-- Campo de Teléfono -->
    <div class="input-group mb-3">

        <input id="telefono" type="text" class="form-control" placeholder="Teléfono" name="telefono" value="{{ old('telefono') }}">
        <div class="input-group-text">
            <span class="fas fa-envelope"></span>
        </div>
    </div>

    {{-- Password field --}}
    <div class="input-group mb-3">
        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
               placeholder="{{ __('adminlte::adminlte.password') }}">

        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-lock {{ config('adminlte.classes_auth_icon', '') }}"></span>
            </div>
        </div>

        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    {{-- Confirm password field --}}
    <div class="input-group mb-3">
        <input type="password" name="password_confirmation"
               class="form-control @error('password_confirmation') is-invalid @enderror"
               placeholder="{{ __('adminlte::adminlte.retype_password') }}">

        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-lock {{ config('adminlte.classes_auth_icon', '') }}"></span>
            </div>
        </div>

        @error('password_confirmation')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    {{-- Register button --}}
    <button type="submit" class="btn btn-block {{ config('adminlte.classes_auth_btn', 'btn-flat btn-primary') }}">
        <span class="fas fa-user-plus"></span>
        {{ __('adminlte::adminlte.register') }}
    </button>

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
