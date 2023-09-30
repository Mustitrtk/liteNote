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
    Route::post('/create-note',[noteController::class,"__create"])->name("note.create");

    ////Edit
    Route::get('/edit-note',[noteController::class,"__edit"])->name('note.edit');

    ////Update
    Route::post('/update-note',[noteController::class,"__update"])->name('note.update');

    ////Delete
    Route::delete('/delete-note',[noteController::class,"__delete"])->name('note.delete');

    //AdminCrudRoutes

    Route::get('/admin/index',[adminController::class,"index"])->name('admin.index');

    ////User Create
    Route::post('/create_user',[adminController::class,"user_create"])->name('user.create');

    ////User Edit
    Route::get('/edit_user',[adminController::class,"user_edit"])->name('user.edit');

    ////User Edit Action
    Route::post('/edit_user_action',[adminController::class,"user_edit_action"])->name('user.edit.action');
});
