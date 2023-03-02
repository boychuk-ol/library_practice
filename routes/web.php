<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\AuthorController;
use App\Models\Book;
use App\Enums\RolesEnum;

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

Route::get('/books', [BookController::class, 'getAllBooks'])->name('books');
Route::get('/books/{id}', [BookController::class, 'getBook'])->name('getbook');

Route::get('/addbook', [BookController::class, 'addBook'])->name('addbook')->middleware('can:add');
Route::post('/addbook', [BookController::class, 'create'])->name('addbookpost')->middleware('can:add');
Route::get('/deletebook/{id}', [BookController::class, 'delete'])->name('deletebook')->middleware('can:delete');

Route::get('/export', [BookController::class, 'exportGet'])->name('exportbooks')->middleware('can:exportbooks');
Route::get('/exportbooks', [BookController::class, 'exportCsv'])->name('exportbooksCsv')->middleware('can:exportbooks');

Route::get('/addfavourites/{id}', [BookController::class, 'addFavourites'])->name('addfavourites')->middleware('can:manageFavs');
Route::get('/deletefavourites/{id}', [BookController::class, 'deleteFavourites'])->name('deletefavourites')->middleware('can:manageFavs');
Route::get('/getfavourites', [BookController::class, 'getFavourites'])->name('getfavourites')->middleware('can:manageFavs');

Route::get('/addauthor', [AuthorController::class, 'addAuthor'])->name('addauthor')->middleware('can:add');
Route::post('/addauthor', [AuthorController::class, 'create'])->name('addauthorpost')->middleware('can:add');

Route::get('/addgenre', [GenreController::class, 'addGenre'])->name('addgenre')->middleware('can:add');
Route::post('/addgenre', [GenreController::class, 'create'])->name('addgenrepost')->middleware('can:add');

Route::get('/register', [RegisterController::class, 'create'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('registerpost');

Route::get('/login', [LoginController::class, 'create'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('loginpost');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/myaccount', [UserController::class, 'myAccount'])->name('myaccount');

Bouncer::allow(RolesEnum::ADMIN->value)->to('add');
Bouncer::allow(RolesEnum::ADMIN->value)->to('delete');
Bouncer::allow(RolesEnum::ADMIN->value)->to('exportbooks');

Bouncer::allow(RolesEnum::ADMIN->value)->to('manageFavs');
Bouncer::allow(RolesEnum::USER->value)->to('manageFavs');
