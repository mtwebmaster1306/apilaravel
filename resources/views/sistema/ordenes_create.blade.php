@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Compra de licencia</h1>
@stop

@section('content')
<div class="container">
    <h1>Detalles:</h1>
    @php
    // Obtener la fecha actual y sumarle 30 días
    $fecha_actual = now();
    $fecha_30_dias = $fecha_actual->addDays(30)->format('Y-m-d'); // Formato 'Y-m-d' para el input
@endphp

<form action="{{ route('ordenes.store') }}" method="POST">
    @csrf

    <!-- Otros campos del formulario -->
    <div class="form-group">
        <label for="url_dominio">URL del Dominio:</label>
        <input type="text" id="url_dominio" class="form-control" value="{{ $dominio->url_dominio }}" readonly>
    </div>
    
    <div class="form-group">
        <label for="name_cliente">Nombre del Cliente:</label>
        <input type="text" id="name_cliente" class="form-control" value="{{ $cliente->user->name }}" readonly>
    </div>

    <div class="form-group">
        <label for="fecha_vencimiento">Fecha de Vencimiento:</label>
        <input type="hidden" name="fecha_vencimiento" id="fecha_vencimiento" value="{{ $fecha_30_dias }}">
        <span>{{ $fecha_30_dias }}</span> <!-- Para mostrar la fecha, opcional -->
    </div>
    <div class="form-group">
        <label for="fecha_vencimiento">Valor:</label>
        <span>$30.000</span>
    </div>

    <input type="hidden" name="id_dominio" value="{{ $id_dominio }}">
    <input type="hidden" name="id_cliente" value="{{ $cliente->id }}">

    <button type="submit" class="btn btn-primary">Crear Orden</button>
</form>
</div>
@endsection
