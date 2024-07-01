<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\setting;
use DragonCode\Support\Facades\Filesystem\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Storage;

class settingContoller extends Controller
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

        $setting = setting::get()->first();

       
        return view('admin.setting.index',compact('setting'));
    }


    public function update(Request $request, string $id)
    {
       $request->validate([
            'email'=>'required',
            'keyword'=>'required',
            'desc'=>'required',
        ]);
        $settings = setting::get()->first() ;
        $settings->email = $request->email ;
        $settings->keyword = $request->keyword ;
        $settings->desc = $request->desc ;

        if($request->image){
             Storage::disk('local')->delete('public/uploads/'.$settings->image);
            $request->image->store('public/uploads');
            $settings->image = $request->image->hashName() ;
        }
        $settings->save() ;

        notify()->success(Lang::get('admin.updated_success'));
        return redirect()->route('admin.setting.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
