<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\UsersManagerController;
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
});

Route::get('/', [UsersController::class, 'index'])->name('users.index');
Route::put('/users/update', [UsersController::class, 'update'])->name('users.update');
Route::get('/users/export', [UsersController::class, 'export'])->name('users.export');
Route::post('/users/import', [UsersController::class, 'import'])->name('users.import');
Route::get('/usersManager', [UsersManagerController::class, 'index'])->name('usersManager.index');
Route::post('/usersManager/createUser', [UsersManagerController::class, 'createUser'])->name('usersManager.createUser');
Route::put('/usersManager/updateUser', [UsersManagerController::class, 'updateUser'])->name('usersManager.updateUser');
Route::delete('/usersManager/deleteUser', [UsersManagerController::class, 'deleteUser'])->name('usersManager.deleteUser');
