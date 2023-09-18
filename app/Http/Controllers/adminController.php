<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Services\DataTable;

class adminController extends Controller
{
    //

    public function index(Request $request){
        if ($request->ajax()){
            $data = User::select('*');

            return  DataTables::of($data)->addIndexColumn()->make(true);
        }
        return view('front.admin.index');
    }
}
