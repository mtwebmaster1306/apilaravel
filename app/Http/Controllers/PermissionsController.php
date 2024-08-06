<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\DataTables;

class PermissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if($request->ajax())
        {
            return $this->getPermissions();
        }
        return view('users.permissions.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'name' => 'required|unique:permissions,name' 
        ]);
        $permission= Permission::create(["name" => strtolower($request->name)]);
        if($permission){
            toast('Permiso guardado', 'Aprobado'); 
            return view('users.permissions.index');
        }
        Alert::error('Error al guardar!!', 'Intenta de nuevo');


        return back()->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        //
        return view('users.permissions.editpermiso')->with((['permission'=>$permission]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission)
    {
        //
        $this->validate($request, [
            "name" => 'required|unique:permissions,name,'.$permission->id
        ]);
        if($permission->update($request->only('name'))){
            toast('Permiso Actualizado.','Correctamente');
            return view('users.permissions.index');
        }
        toast('Error al actualizar.','Intenta nuevamente');
        return back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Permission $permission)
    {
        //
        if($request->ajax() && $permission->delete()){
            return response(["message"=>"Permiso borrado correctamente"], 200);
        }
        return response(["message"=>"Error al borrar el registro, intentalo nuevamente"], 200);            
    }

    private function getPermissions(){

        $data = Permission::get();
        return DataTables::of($data)
        ->addColumn('chkBox', function($row){
            if($row->name=="dashboard")
            {
                return "<input type='checkbox' name='permission[{{$row->name}}]' value='{{row->name}}'  checked>";
            }else{
            return "<input type='checkbox' name='permission[{{$row->name}}]' value='{{permission->name}}' class='permission'>";
            }
        })        
        ->addColumn('action', function($row){
            $action = "";
            $action.= "<a class='btn btn-xs btn-warning' id='btnEdit' href='".route('users.permissions.edit', $row->id)."'><i class='fas fa-edit'></i></a>";
            $action.= "<button class='btn btn-xs btn-outline-danger' id='btnDel' data-id='".$row->id."'><i class='fas fa-trash'></i></button>";
            return $action;
        })->rawColumns(['chkBox', 'action'])->make(true);

    }
}
