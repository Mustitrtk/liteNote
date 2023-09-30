<?php

namespace App\Service\Concrete;

use App\Http\Requests\CreateNoteValidationRequest;
use App\Http\Requests\UpdateNoteRequest;
use App\Models\Note;
use App\Service\Abstract\CrudRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteCrudRepository implements CrudRepository
{
    protected $note;
   public function __construct(Note $note)
   {
       $this->note=$note;
   }

    public function __create(CreateNoteValidationRequest $request)
    {
        // TODO: Implement __create() method.
        $request->validated();
        $result = $this->note->create([
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

    public function __edit(Request $request)
    {
        // TODO: Implement __edit() method.
        $note = $this->note->whereId($request->id)->FirstOrFail();
        return response()->json(['data' => $note]);
    }

    public function __update(UpdateNoteRequest $request)
    {
        // TODO: Implement __update() method.
        $result = $this->note->findOrFail($request->yid);

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

    public function __delete($id)
    {
        // TODO: Implement __delete() method.
        $note = $this->note->findorFail($id);
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
