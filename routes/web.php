<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/l', [AuthController::class, 'login'])->name('login.auth');
Route::post('/r', [AuthController::class, 'register'])->name('register.auth');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/home', [HomeController::class, 'index'])->middleware('auth')->name('home');

Route::get('/cart',[CartController::class, 'index'])->name('cart');
Route::post('/cu', [CartController::class, 'updateCart'])->name('cart.update');

Route::get('/xd', function(){
    return view('test');
})->name('xd');

Route::post('/ic', [ItemController::class, 'createItem'])->name('items.create');
Route::post('/id', [ItemController::class, 'deleteItem'])->name('items.delete');
Route::post('/iu', [ItemController::class, 'updateItem'])->name('items.update');
Route::post('/ig', [ItemController::class, 'getItem'])->name('items.get');
Route::get('/igall', [ItemController::class, 'getAllItems'])->name('items.getall');


Route::post('/uc', [UserController::class, 'createUser'])->name('users.create');
Route::post('/ud', [UserController::class, 'deleteUser'])->name('users.delete');
Route::post('/uu', [UserController::class, 'updateUser'])->name('users.update');
Route::post('/ug', [UserController::class, 'getUser'])->name('users.get');


Route::post('/cc', [ChatController::class, 'createChat'])->name('chats.create');
Route::post('/cd', [ChatController::class, 'deleteChat'])->name('chats.delete');
Route::post('/cg', [ChatController::class, 'getChat'])->name('chats.get');

