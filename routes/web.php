<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\TwitchController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\GamesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TrendingController;
use App\Http\Controllers\ExplorarController;
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

//Route::get('/', InicioController::class); 
// Route::get('/', function() {
//     return view('welcome');
// });

// home
Route::get('/', HomeController::class)->name('home');

// explorar

Route::middleware(['auth:sanctum', 'verified'])->get('/explorar', ExplorarController::class)->name('explorar');

// users
Route::middleware(['auth:sanctum', 'verified'])->get('/explorar/users', function () {
    return Inertia::render('Users/Index', [
        'users' => User::all()
        ]  // enviamos estos datos, que deben recibirse en la vista como props
);
})->name('users.index'); //debe  coincidir con el nombre que le damos en AppLayout

// twitch
Route::get('/twitch', [TwitchController::class, 'store'])->name('querys.twitch');

// search
Route::post('/busqueda', SearchController::class)->name('querys.search');

// games
Route::get('/games/{slug}', GamesController::class)->name('querys.games'); 

// trending 
//Route::get('/trending', TrendingController::class)->name('querys.trending');
