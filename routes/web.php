<?php

use App\Http\Controllers\PurchaseController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/login', function (){
    return redirect('/');
});

Route::get('/', function (){
    return Inertia::render('Homepage/Index');
});

Route::post('purchase/store', [PurchaseController::class, 'store'])->name('purchase.store');
Route::get('purchase/uploads/{upload}', [PurchaseController::class, 'showUploadShortUrl'])->name('purchase.upload');
