<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CityController;
use App\Http\Middleware\CheckAge;
use Illuminate\Routing\Route as RoutingRoute;
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



Route::view('/cms/admin', 'cms.parent');


Route::prefix('cms/admin')->group(function(){
    Route::get('login', [AuthController::class, 'showLogin'])->name('auth.login-view');
    Route::post('login',[AuthController::class, 'login'])->name('auth.login');
});


Route::prefix('cms/admin')->middleware('auth:admin')->group(function(){
    Route::view('/', 'cms.parent');
    Route::view('/index', 'cms.temp.index');
    Route::resource('cities',CityController::class);

    Route::resource('categories' , CategoryController::class);
});



// Route::get('age', function(){
//     echo 'Show News - Age Is Accepted' ;
// })->middleware('age');

// Route::get('age', function(){
//     echo 'Show News - Age Is Accepted' ;
// })->middleware(CheckAge::class);

// Route::prefix('mw')->middleware(['','']) عبارة عن قروب مدلوير


Route::prefix('mw')->middleware('age:12')->group(function(){
    Route::get('check1',function(){
        echo 'Check 1 PASSED';
    });
    Route::get('check2',function(){
        echo 'Check 2 PASSED';
    })->withoutMiddleware('age'); // مستتنى من القروب الي عُمم عليه 

});