<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class userController extends Controller
{
    //

    public function dashboard(){
        $notes = Note::where('user_id',Auth::user()->id)->orderByDesc('created_at')->get();
        return view('front.index',compact('notes'));
    }

    public function logout(){
        auth('web')->logout();

        return redirect()->route('welcome');
    }
}
