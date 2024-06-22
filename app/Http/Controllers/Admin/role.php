<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\RolesDataTable;
use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role as ModelsRole;
use Database\Factories\rolesFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

class role extends Controller
{
    public function __construct(){
        // $this->middleware('permission:roles_read')->only('index');
        // $this->middleware('permission:roles_create')->only('create');
        // $this->middleware('permission:roles_update')->only('update');
        // $this->middleware('permission:roles_delete')->only('delete');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(RolesDataTable $roleDataTable)
    {


        return $roleDataTable->render('admin.role.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $fakeData  = fake()->name() ;

        return view('admin.role.create',compact('fakeData'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'name'=>'required|unique:roles',
            'role'=>'required'
        ]);

        $name =$request->name ;

       $role =  ModelsRole::create(['name' =>$name]);


        $permissons =$request->role ;
        foreach($permissons as $row){
            $permisson = $name . "-" . $row  ;

           $per =  Permission::create(['name'=>$permisson]);
           $role->givePermission($per);
        }
        notify()->success(Lang::get('admin.add_success'));
        return redirect()->route('admin.roles.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {


    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $ModelsRole = ModelsRole::find($id);
        return view('admin.role.edit',compact('ModelsRole'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'=>'required|unique:roles,name,'.$id,
            'role'=>'required'
        ]);
        $name =$request->name ;
       $role =  ModelsRole::find($id);
       $role->name = $request->name ;
       $role->save() ;
       $role->permissions()->delete();
      $permissons =$request->role ;
        foreach($permissons as $row){
            $permisson = $name . "_" . $row  ;

           $per =  Permission::create(['name'=>$permisson]);
           $role->givePermission($per);
        }
        notify()->success(Lang::get('admin.edit_success'));
        return redirect()->route('admin.roles.index');

    }

    /**
     * Remove the specified resource from storage.
     */


    public function bulckDelete(Request $request){
        $data = $request['buclkDelete'][0] ;

        
        $numbers = explode(',', $data);
        $role = ModelsRole::whereIn('id',$numbers)->get();
        foreach($role as $row){
            $row->permissions()->delete();
            $row->delete() ;
        }
        notify()->success(Lang::get('admin.delete_success'));
        return redirect()->route('admin.roles.index');
    }


    public function destroy(string $id)
    {
       $role =  ModelsRole::find($id);
       $role->permissions()->delete();
       $role->delete() ;
       notify()->success(Lang::get('admin.delete_success'));
        return redirect()->route('admin.roles.index');
    }


    public function data(){
        $role = fake()->name() ;
    }
}
