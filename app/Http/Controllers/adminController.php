<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Services\DataTable;

class adminController extends Controller
{
    //

    public function index(Request $request){
        if ($request->ajax()){
            $data = User::select('*');

            return  DataTables::of($data)
                ->addColumn('action','front.actions.userAction')
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('front.admin.index');
    }

    public function user_create(Request $request){

        $result = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ]);

        if ($result) {
            return response()->json([
                'message' => "Veri basari ile kaydadildi ",
                "code" => 200
            ]);
        } else {
            return response()->json([
                'message' => "Internal Server Error",
                "code" => 500
            ]);

        }
    }

    public function user_edit(Request $request){
        $user = User::findOrFail($request->id);
        return response()->json(['data'=>$user]);
    }

    public function user_edit_action(Request $request){
        $user = User::findOrFail($request->id);

        if (isset($user)){
            $user->name = $request->name;
            $user->email=$request->email;
            $user->password=$request->password;

            $user->save();
        }

        if ($user) {
            return response()->json([
                'message' => "Veri basari ile Güncellendi ",
                "code" => 200
            ]);
        } else {
            return response()->json([
                'message' => "Internal Server Error",
                "code" => 500
            ]);

        }
    }
}
