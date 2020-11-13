<?php

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
    return 'Server is Runing...';
});
Route::get('/login', function(){
    return response()->json('Unauthorized', 401);
})->name('login');


// Visualizando Mailables no Navegador

Route::get('mailable', function () {
    $invoice = App\Models\Trip\TripOrder::find(1);
    return new App\Mail\OrderPlacedMail($invoice);
});
Route::get('mailabletest', function () {
    $invoice = App\Models\Trip\TripOrder::find(1);
    return new App\Mail\OrderPlacedMail($invoice);
});
