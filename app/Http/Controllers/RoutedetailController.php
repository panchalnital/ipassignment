<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\RoutedetailsImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Routedetails;
use DB;


class RoutedetailController extends Controller
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function index()
    {
        $routerdetails = Routedetails::paginate(4);
  
        return view('routerdetails', compact('routerdetails'));
    }
        
       
    /**
    * @return \Illuminate\Support\Collection
    */
    public function import() 
    {
        Excel::import(new RoutedetailsImport,request()->file('file'));
        return back();
    }

    public function update(Request $request)
    {
        if ($request->ajax()) {
            Routedetails::find($request->pk)->update([
                $request->name => $request->value
            ]);
            return response()->json(['success' => true]);
        }
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Models\Post  $post
    * @return \Illuminate\Http\Response
    */

    public function delete(Request $request)
    {
        $id = $request->id;
        Routedetails::where('id', $id)->delete();
        return redirect('/routerdetails')->with('status', 'data delete successfully.');

    }
}
