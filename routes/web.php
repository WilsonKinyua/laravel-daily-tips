<?php

use App\Http\Controllers\UploadController;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;
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
    return view('welcome');
})->middleware(['password.confirm']);

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


Route::get('/email', function() {
    Mail::to('wilsonkinyuam@gmail.com')->send(new WelcomeMail());
    return new WelcomeMail();
});

Route::get('/article',[ArticleController::class, 'index']);

// uploading files

Route::post('/uploads',[UploadController::class, 'store']);
