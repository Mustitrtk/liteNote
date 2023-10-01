<?php

namespace App\Service\Abstract;

use App\Http\Requests\CreateNoteValidationRequest;
use App\Http\Requests\UpdateNoteRequest;
use Illuminate\Http\Request;

interface CrudRepository
{
    public function __create(CreateNoteValidationRequest $request);
    public function __edit(Request $request);
    public function __update(UpdateNoteRequest $request);
    public function __delete(Request $request);
}
