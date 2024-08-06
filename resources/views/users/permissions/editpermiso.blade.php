@extends('adminlte::page')

@section('title', 'Edición de permiso')

@section('content_header')

    <h1>Editar Permiso</h1>
@stop

@section('content')
@include('sweetalert::alert')
    <div class="container-fluid">
        <div class="row">
            <div id="errorBox"></div>
            <div class="col-3">
                <form method="POST" action="{{route('users.permissions.update', $permission->id)}}">
                    @method('patch')
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <h5>Actualizar Permiso</h5>
                            </div>
                        </div>
                   
                    <div class="card-body">

                        <div class="form-group">
                            <label class="form-label">Nombre <span class="text-danger"></span></label>
                            <input type="text" class="form-control" name="name" placeholder="Ingresa el permiso" value="{{$permission->name}}">
                            @if($errors->has('name'))
                            <span class="text-danger">{{$errors->first('name')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </div>
                    
                </form>
            </div>
     
        </div>
    </div>
@stop

