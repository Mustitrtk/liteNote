<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateNoteValidationRequest;
use App\Http\Requests\UpdateNoteRequest;
use App\Models\Note;
use App\Service\Concrete\NoteCrudRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class noteController extends NoteCrudRepository
{
    //
}
