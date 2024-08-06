@extends('adminlte::page')
@section('content')

<x-adminlte-modal id="modalMin" title="Agregar nuevo dominio">
    <form action="{{ route('admin.dominios.store') }}" method="POST">
        @csrf
        <div class="card-head">
            <div class="row">
                <div class="col">
                    <input type="text" class="form-control" placeholder="Agregar dominio" id="dominio" name="url_dominio">
                    <input type="hidden" name="id_cliente" value="{{ $cliente->id }}">
                    <div class="form-group">
                        <label>&nbsp;</label><br>
                        <button type="submit" class="btn btn-success form-control" id="btnAgregar">Agregar</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</x-adminlte-modal>

<x-adminlte-modal id="modalMin2" title="Editar dominio">
    <form id="editDominioForm" action="" method="POST">
        @csrf
        @method('PUT')
        <div class="card-head">
            <div class="row">
                <div class="col">
                    <input type="text" class="form-control" placeholder="Actualizar dominio" id="edit_dominio" name="url_dominio">
                    <input type="hidden" id="edit_dominio_id" name="dominio_id">
                    <input type="hidden" id="edit_cliente_id" name="id_cliente" value="{{ $cliente->id }}">
                    <div class="form-group">
                        <label>&nbsp;</label><br>
                        <button type="submit" class="btn btn-success form-control" id="btnActualizar">Actualizar</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</x-adminlte-modal>

<!-- Modal para crear una orden -->
<x-adminlte-modal id="modalOrden" title="Crear Orden">
    <div class="container">
        <h1>Detalles:</h1>
        <form id="ordenForm" action="{{ route('admin.ordenes.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="url_dominio">URL del Dominio:</label>
                <input type="text" id="url_dominio" class="form-control" readonly>
            </div>
            <div class="form-group">
                <label for="name_cliente">Nombre del Cliente:</label>
                <input type="text" id="name_cliente" class="form-control" readonly>
            </div>
            <div class="form-group">
                <label for="tipo_pago">Tipo de Pago:</label>
                <select class="form-control" id="tipo_pago" onchange="actualizarFechaVencimiento()">
                    <option value="mensual">Mensual (30 días)</option>
                    <option value="anual">Anual</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="fecha_vencimiento">Fecha de Vencimiento:</label>
                <span id="fecha_vencimiento_span"></span>
                <input type="hidden" name="fecha_vencimiento" id="fecha_vencimiento">
            </div>
            <div class="form-group">
                <label for="valor">Valor:</label>
                <span>$30.000</span>
            </div>
            <input type="hidden" name="id_dominio" id="orden_dominio_id">
            <input type="hidden" name="id_cliente" value="{{ $cliente->id }}">
            <button type="submit" class="btn btn-primary">Crear Orden</button>
        </form>
    </div>
</x-adminlte-modal>


<div class="container">
    <h1>Detalles del Cliente</h1>

    <div class="card mb-3">
        <div class="card-header">
            Información del Cliente
        </div>
        <div class="card-body">
            <p><strong>Nombre:</strong> {{ $cliente->user->name }}</p>
            <p><strong>Email:</strong> {{ $cliente->user->email }}</p>
            <p><strong>Dirección:</strong> {{ $cliente->telefono }}</p>
        </div>
    </div>

    <h2>Dominios</h2>
    <table class="table">
        <button type="button" label="Open Modal" data-toggle="modal" data-target="#modalMin" class="mt-3 mr-3 btn btn-primary">Agregar</button>
        <thead>
            <tr>
                <th>ID</th>
                <th>URL del Dominio</th>
                <th>Licencia</th>
                <th>Fecha de Expiración</th>
                <th>Estado</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cliente->dominios as $dominio)
                <tr>
                    <td>{{ $dominio->id }}</td>
                    <td>{{ $dominio->url_dominio }}</td>
                    <td>{{ $dominio->licencia }}</td>
                    <td>{{ $dominio->fecha_exp }}</td>
                    <td>
                        @if ($dominio->estado == 'Inactivo')
                            <button type="button" class="btn btn-primary" onclick="openModal('{{ $dominio->url_dominio }}', '{{ $cliente->user->name }}', '{{ $dominio->id }}')">Licencia Inactiva</button>
                        @else
                            <button class="btn btn-success" disabled>Licencia Activa</button>
                        @endif
                    </td>
                    
                    <td>
                        <button type="button" class="btn btn-success" onclick="editDominio({{ $dominio->id }})" data-toggle="modal" data-target="#modalMin2">Editar</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
function editDominio(id) {
    fetch(`/admin/dominios/${id}/edit`)
        .then(response => response.json())
        .then(data => {
            document.getElementById('edit_dominio').value = data.url_dominio;
            document.getElementById('edit_dominio_id').value = data.id;
            document.getElementById('edit_cliente_id').value = data.id_cliente;
            document.getElementById('editDominioForm').action = `/admin/dominios/${data.id}`;
        })
        .catch(error => console.error('Error:', error));
}

function openModal(urlDominio, nombreCliente, idDominio) {
    // Rellenar los campos del formulario
    document.getElementById('url_dominio').value = urlDominio;
    document.getElementById('name_cliente').value = nombreCliente;
    document.getElementById('orden_dominio_id').value = idDominio;

    // Calcular fecha de vencimiento
    let fechaActual = new Date();
    let fecha30Dias = new Date(fechaActual.getTime() + (30 * 24 * 60 * 60 * 1000)); // Suma 30 días
    let fechaVencimiento = fecha30Dias.getFullYear() + '-' + (fecha30Dias.getMonth() + 1) + '-' + fecha30Dias.getDate();

    document.getElementById('fecha_vencimiento').value = fechaVencimiento;
    document.getElementById('fecha_vencimiento_span').textContent = fechaVencimiento;

    // Mostrar el modal
    $('#modalOrden').modal('show');
}
function actualizarFechaVencimiento() {
    let tipoPago = document.getElementById('tipo_pago').value;

    let fechaActual = new Date();
    let fechaVencimiento;

    if (tipoPago === 'mensual') {
        let fecha30Dias = new Date(fechaActual.getTime() + (30 * 24 * 60 * 60 * 1000));
        fechaVencimiento = fecha30Dias.getFullYear() + '-' + (fecha30Dias.getMonth() + 1) + '-' + fecha30Dias.getDate();
    } else if (tipoPago === 'anual') {
        let fecha1Anio = new Date(fechaActual.getTime());
        fecha1Anio.setFullYear(fechaActual.getFullYear() + 1);
        fechaVencimiento = fecha1Anio.getFullYear() + '-' + (fecha1Anio.getMonth() + 1) + '-' + fecha1Anio.getDate();
    }

    document.getElementById('fecha_vencimiento').value = fechaVencimiento;
    document.getElementById('fecha_vencimiento_span').textContent = fechaVencimiento;
}

</script>
@endsection
