<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Contracts\DataTable;
use Yajra\DataTables\Facades\DataTables;
use Spatie\Permission\Models\Role;
class RolesController extends Controller
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
            return $this->getRoles();
        }
        return view('users.roles.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $permissions = Permission::get();
        return view('users.roles.create ')->with(['Permissions' => $permissions]);
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    private function getRoles(){
        $data = Role::withCount(['users','permissions'])->get();
        return DataTables::of($data)
                ->addColumn('users_count', function($row){
                    return $row->users_count;
                })
                ->addColumn('permissions_count', function($row){
                    return $row->permissions_count;
                })
                ->addColumn('action',function($row){
                    $action = "";
                    $action.= "<a class='btn btn-xs btn-warning' id='btnEdit' href='".route('users.roles.edit', $row->id)."'><i class='fas fa-edit'></i></a>";
                    $action.= "<button class='btn btn-xs btn-outline-danger' id='btnDel' data-id='".$row->id."'><i class='fas fa-trash'></i></button>";
                    return $action;
                })
                ->make('true');  
    }
}
