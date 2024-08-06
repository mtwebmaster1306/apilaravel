@extends('adminlte::page')

@section('title', 'Roles')

@section('content_header')

    <h1>Roles</h1>
@stop

@section('content')
@include('sweetalert::alert')
    <div class="container-fluid">
        <div id="errorBox"></div>
           
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <h5>Todos los permisos</h5>
                </div>
                <a class="float-right btn btn-primary btn-xs m-0" href="{{route('users.roles.create')}}"><i class="fas fa-plus"></i>Agregar</a>   
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="tblData" class="table table-boardeed table-striped dataTable dtr-inline ">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Usuarios</th>
                                <th>Permisos</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
        <div class="row">
           
        </div>
    </div>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script>
            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
        $(document).ready(function(){
        var table = $('#tblData').DataTable({
            reponsive:true, processing:true, serverSide:true, autoWidth:false,
            ajax:"{{route('users.roles.index')}}",
            columns:[
                {data:'id', name:'id'},
                {data:'name', name:'name'},
                {data:'permissions_count', name:'permissions_count'},
                {data:'action', name:'action'}, 
            ],
            order:[[0, "desc"]]
        });
        $('body').on('click', '#btnDel',function(){
            //confirmacion
            var id = $(this).data('id');
            if(confirm('Borrar registro '+id+'?')==true)
        {
            var route = "{{route('users.permissions.destroy', ':id')}}"
            route = route.replace(':id', id);
            $.ajax({
                url:route,
                type:"delete",
                success:function(res){
                    $("#tblData").DataTable().ajax.reload();
                },
                error:function(res){
                     $('#errorBox').html('<div class="alert alert-danger"'+response.message+'</div>');   
                }
            });
        }else{
            //algo
        }
        });
    });
    
    </script>
@stop
@section('plugins.Datatables', true)