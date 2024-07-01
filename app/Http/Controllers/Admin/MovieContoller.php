<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Yajra\DataTables\Facades\DataTables;

class MovieContoller extends Controller
{
    public function __construct(){
        // $this->middleware('permission:movie_read')->only('index');
        // $this->middleware('permission:movie_create')->only('create');
        // $this->middleware('permission:movie_update')->only('update');
        // $this->middleware('permission:movie_delete')->only('delete');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $movie = movie::all() ;
        return view('admin.movies.index',compact('movie'));
    }




    public function bulckDelete(Request $request){

        $data = $request['buclkDelete'][0] ;
        $numbers = explode(',', $data);
        $movie = movie::whereIn('id',$numbers)->get();
        foreach($movie as $row){
            $row->delete() ;
        }
        notify()->success(Lang::get('admin.delete_success'));
        return redirect()->route('admin.movie.index');
    }


    public function destroy(int $id)
    {
       $movie =  movie::find($id);
       $movie->delete() ;
       notify()->success(Lang::get('admin.delete_success'));
        return redirect()->route('admin.movie.index');
    }


    public function data(){
        $movie = movie::all() ;
        return DataTables::of($movie)
        ->addColumn('action', 'admin.movies.dataTable.action')
             ->addColumn('checkbox', 'admin.movies.dataTable.checkbox')

           ->editColumn('created_at',function($movie){
               return $movie->created_at->format('d-m-y');
           })
           ->editColumn('updated_at',function($movie){
               return $movie->created_at->format('d-m-y');
           })
       ->toJson();
    }
}
