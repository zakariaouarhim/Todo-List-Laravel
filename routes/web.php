<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\TodoController;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});

Route::group(['middleware' => ['web']], function () {
    Route::redirect('/signUp', 'signUp');

    Route::get('register', [TodoController::class, 'register'])->name('register');
    Route::get('signUp', [TodoController::class, 'signUp'])->name('signUp');
    Route::get('index', [TodoController::class, 'index'])->name('index');
    /////////////////////////////////////
    Route::get('/', [TodoController::class, 'signUp'])->name('signUp');
    Route::post('submit', [TodoController::class, 'submit']);
    Route::get('delete/{id}', [TodoController::class, 'delete'])->name('delete');

    Route::post('addUser', [TodoController::class, 'addUser'])->name('addUser');

    Route::post('login', [TodoController::class, 'login'])->name('login');
});
////////////////////////////////////




