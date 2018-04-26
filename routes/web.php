<?php

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

Auth::routes();

Route::middleware(['auth'])->group(function() {
    Route::view('/', function() {
        echo url()->current();
    });

    Route::get('/sx', function () {
        echo 'sx';
    });

    Route::get('/home', 'HomeController@index');
});

Route::post('request-new-vcode', function() {
    return app()->make(App\Services\IndentifyingCodeService::class)->newIndentifyingCode(99, 43, 3)['image'];
});