<?php

use App\Http\Controllers\SiginController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });


Route::prefix('cms/admin')->group(function(){
    Route::view('/','cms.parent');
Route::view('/index','cms.temp.index');
    Route::resource('sigines',SiginController::class);
});
