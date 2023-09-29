<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateNoteValidationRequest;
use App\Http\Requests\UpdateNoteRequest;
use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class noteController extends Controller
{
    //

    public function note_create(CreateNoteValidationRequest $request)
    {
        $request->validated();
        $result = Note::create([
            'user_id' => Auth::user()->id,
            'title' => $request->title,
            'theme' => $request->theme,
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

    public function note_edit(Request $request){
        $note = Note::whereId($request->id)->FirstOrFail();
        return response()->json(['data' => $note]);
    }

    public function note_update(UpdateNoteRequest $request){
        $result = Note::findOrFail($request->yid);

        if(isset($result)){
            $result->title = $request->ytitle;
            $result->theme = $request->ytheme;

            $result->save();
        }

        if ($result) {
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

    public function note_delete(Request $request){
        $note = Note::findorFail($request->id);
        if (isset($note)){
            $note->delete();
            return response()->json([
                'message' => "Not başarıyla silindi",
                "code" => 200
            ]);
        }

        else{
            return response()->json([
                'message' => "Internal Server Error",
                "code" => 500
            ]);
        }
    }
}
