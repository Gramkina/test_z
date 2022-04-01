<?php

use App\Http\Controllers\StatementController;
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
    return redirect()->route('login');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('statement', StatementController::class)->middleware(['auth', 'verified'])->only([
        'index', 'create', 'store', 'show'
    ]);
    Route::get('/statement/{statement}/download/{file}', [StatementController::class, 'downloadFile']);
});

require __DIR__.'/auth.php';
