<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\genra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Yajra\DataTables\Facades\DataTables;

class GenraContoller extends Controller
{
    public function __construct(){
        // $this->middleware('permission:genra_read')->only('index');
        // $this->middleware('permission:genra_create')->only('create');
        // $this->middleware('permission:genra_update')->only('update');
        // $this->middleware('permission:genra_delete')->only('delete');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $genra = genra::all() ;
        return view('admin.genra.index',compact('genra'));

    }




    public function bulckDelete(Request $request){
        $data = $request['buclkDelete'][0] ;


        $numbers = explode(',', $data);
        $genra = genra::whereIn('id',$numbers)->get();
        foreach($genra as $row){
            $row->delete() ;
        }
        notify()->success(Lang::get('admin.delete_success'));
        return redirect()->route('admin.genra.index');
    }


    public function destroy(string $id)
    {
       $genra =  genra::find($id);
       $genra->delete() ;
       notify()->success(Lang::get('admin.delete_success'));
        return redirect()->route('admin.genra.index');
    }


    public function data(){
        $genra = genra::all() ;
        return DataTables::of($genra)
        ->addColumn('action', 'admin.genra.dataTable.action')
             ->addColumn('checkbox', 'admin.genra.dataTable.checkbox')

           ->editColumn('created_at',function($genra){
               return $genra->created_at->format('d-m-y');
           })
           ->editColumn('updated_at',function($genra){
               return $genra->created_at->format('d-m-y');
           })
       ->toJson();
    }
}
