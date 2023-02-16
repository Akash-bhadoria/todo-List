<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\todoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::get('get-task', [todoController::class, 'getTask'])->name('get_task');
Route::post('add-task', [todoController::class, 'addTask'])->name('add_task');
Route::post('delete-task', [todoController::class, 'deleteTask'])->name('delete_task');
Route::post('complete-task', [todoController::class, 'completeTask'])->name('complete_task');
Route::post('not-complete-task', [todoController::class, 'notCompleteTask'])->name('not_complete_task');
