<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\usersDataTable;
use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use App\Models\user as User;
use Database\Factories\usersFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Yajra\DataTables\Contracts\DataTable;
use Yajra\DataTables\Facades\DataTables;

class UserContoller extends Controller
{
    public function __construct(){
        // $this->middleware('permission:users_read')->only('index');
        // $this->middleware('permission:users_create')->only('create');
        // $this->middleware('permission:users_update')->only('update');
        // $this->middleware('permission:users_delete')->only('delete');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $User = User::whereHasRole('Admin','user');
        $roles = Role::all() ;
        return view('admin.users.index',compact('User','roles'));
        //return $userDataTable->render('admin.users.index');
    }

    public function data(){
        $users = User::all();


        return DataTables::of($users)
         ->addColumn('action', 'admin.users.dataTable.action')
              ->addColumn('checkbox', 'admin.users.dataTable.checkbox')
              ->addColumn('role', function($user){
                return $user->roles->first()->name;
              })
            ->editColumn('created_at',function($user){
                return $user->created_at->format('d-m-y');
            })
            ->editColumn('updated_at',function($user){
                return $user->created_at->format('d-m-y');
            })
        ->toJson();


    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $fakeDataName  = fake()->name() ;
        $fakeDataemail  = fake()->email() ;
        $fakeDataPassword  = rand(100000,10000000000) ;
        $roles = Role::all() ;

        return view('admin.users.create',compact('fakeDataName','fakeDataemail','fakeDataPassword','roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'name'=>'required|unique:users',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:6|max:10|confirmed'
        ]);



        $name =$request->name ;
        $email =$request->email ;
        $password = bcrypt($request->password) ;
        $roleId = $request->role ;




       $user =  User::create([
        'name' =>$name ,
        'email' =>$email ,
        'password' =>$password ,
        ]);

        $roleName =  Role::find($roleId)->name ;
        $user->addRole($roleName);
        notify()->success(Lang::get('admin.add_success'));
        return redirect()->route('admin.users.index');
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
        $User = User::find($id);
        $roles = Role::all() ;
        return view('admin.users.edit',compact('User','roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'=>'required|unique:users,name,'.$id,
            'email'=>'required|email|unique:users,email,'.$id,
        ]);

         $role =$request->role ;

        $user =  User::find($id);
        $user->name = $request->name ;
        $user->email = $request->email ;
        $user->save() ;

        $user->roles()->detach();
        $user->addRole($role) ;


        notify()->success(Lang::get('admin.edit_success'));
        return redirect()->route('admin.users.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function bulckDelete(Request $request){
        $data = $request['buclkDelete'][0] ;
        $numbers = explode(',', $data);
        $user = User::whereIn('id',$numbers)->get();
        foreach($user as $row){
            $row->roles()->detach();
            $row->delete() ;
        }
        notify()->success(Lang::get('admin.delete_success'));
        return redirect()->route('admin.users.index');
    }


    public function destroy(string $id)
    {
       $user =  User::find($id);
       $user->roles()->detach();
       $user->delete() ;
       notify()->success(Lang::get('admin.delete_success'));
        return redirect()->route('admin.users.index');
    }

}
