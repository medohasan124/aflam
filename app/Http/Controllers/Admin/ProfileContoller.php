<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Storage;

class ProfileContoller extends Controller
{

    public function __construct(){
        // $this->middleware('permission:settings')->only('index');
        // $this->middleware('permission:users_create')->only('create');
        // $this->middleware('permission:users_update')->only('update');
        // $this->middleware('permission:users_delete')->only('delete');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

         $profile = auth()->user();



        return view('admin.profile.index',compact('profile'));
    }


    public function update(Request $request, string $id)
    {
        $request->validate([
             'email'=>'required|unique:users,email,'.$id,
             'name'=>'required',

         ]);


         $user = User::find($id)->get()->first() ;
         $user->name = $request->name ;
         $user->email = $request->email ;

         if($request->image){
            Storage::disk('local')->delete('public/uploads/'.$request->image);
           $request->image->store('public/uploads');
           $user->image = $request->image->hashName() ;
       }

         $user->save() ;


         notify()->success(Lang::get('admin.updated_success'));
         return redirect()->route('admin.profile.index');

    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
