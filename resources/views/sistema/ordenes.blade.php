@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Ordenes</h1>
@stop

@section('content')

    <div class="card">

        <div class="card-body">
            {{-- Setup data for datatables --}}
            @php
                $heads = [
                    ['label' => 'ID', 'no-export' => true, 'width' => 10],
                    ['label' => 'Dominio', 'no-export' => true, 'width' => 10],
                    ['label' => 'Estado', 'no-export' => true, 'width' => 10],
                    ['label' => 'Licencia valida hasta:', 'no-export' => true, 'width' => 10],
  
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
                $cliente = Auth::user()->cliente;
            @endphp
            
            @if($cliente)
                @foreach ($ordenes->where('id_cliente', $cliente->id) as $orden)

                    <tr>
                        <td>{{ $orden->id }}</td>
                        <td>{{ $orden->dominio->url_dominio }}</td>
                        <td>{{ $orden->estado }}</td>
                        <td>{{ $orden->dominio->fecha_exp }}</td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="5">No hay órdenes asociadas a este cliente.</td>
                </tr>
            @endif
            </x-adminlte-datatable>
        </div>
    </div>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
<script>
            $(document).ready(function(){
                $('.formEliminar').submit(function(e){
                    e.preventDefault();
                    Swal.fire({
        title: "Estas seguro?",
        text: "Se va ha eliminar un registro!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Sí, eliminar!"
        }).then((result) => {
            if(result.isConfirmed){
                this.submit();
            }
        });
    })
});
</script>
@stop
