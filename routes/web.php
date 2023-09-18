<?php

use App\Http\Controllers\adminController;
use App\Http\Controllers\noteController;
use App\Http\Controllers\userController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name("welcome");

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [userController::class,"dashboard"])->name('dashboard');

    //UserCrudRoutes

    ////Logout
    Route::get('/logout', [userController::class,"logout"])->name("logout");

    //NotesCrudRoutes

    ////Create
    Route::post('/create-note',[noteController::class,"note_create"])->name("note.create");

    ////Edit
    Route::get('/edit-note',[noteController::class,"note_edit"])->name('note.edit');

    ////Update
    Route::post('/update-note',[noteController::class,"note_update"])->name('note.update');

    ////Delete
    Route::delete('/delete-note',[noteController::class,"note_delete"])->name('note.delete');

    //AdminCrudRoutes

    Route::get('/admin/index',[adminController::class,"index"])->name('admin.index');
});
