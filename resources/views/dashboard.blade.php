@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Información General</h1>
@stop

@section('content')
    <p>Indicación basica de los registros actuales</p>
<div class="d-flex justify-content-center ">
    <div class="container row">
        <div class="col">
            {{-- Contador de Dominios Totales --}} 
            @php
                $totalDominios = auth()->user()->cliente->dominios()->count();
            @endphp
            <x-adminlte-info-box title="Dominios Totales" :text="$totalDominios" icon="fa fa-globe text-light" style="color:white; background:#ff4c24;"/>
        </div>
        <div class="col">
            {{-- Contador de Órdenes --}}
            @php
                $totalOrdenes = auth()->user()->cliente->ordenes()->count();
            @endphp
            <x-adminlte-info-box title="Ordenes" :text="$totalOrdenes" icon="fa fa-address-card text-light" style="color:white; background:#ff4c24;"/>
        </div>
        <div class="col">
            {{-- Contador de Dominios Inactivos --}}
            @php
                $dominiosInactivos = auth()->user()->cliente->dominios()->where('estado', 'Inactivo')->count();
            @endphp
            <x-adminlte-info-box title="Dominios inactivos" :text="$dominiosInactivos" icon="fa fa-globe text-light" style="color:white; background:#ff4c24;"/>
        </div>
    </div>
</div>
@stop

