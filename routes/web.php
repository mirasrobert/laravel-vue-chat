<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\MessageController;

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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('chat/{id?}', [ChatController::class, 'index'])->middleware('auth');

// Get authenticated user
Route::get('/api/user', function () {
    return response()->json(auth()->user());
})->middleware('auth');

// Get All Messages
Route::get('/api/messages/{chatRoomId?}', [MessageController::class, 'index'])->middleware('auth');

// Send a event and save message
Route::post('/api/send', [ChatController::class, 'send'])->middleware('auth');
