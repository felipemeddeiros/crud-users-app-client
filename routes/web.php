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

Route::get('/', 'LoginController@index')->name('beginning');
Route::post('/login', "LoginController@login")->name('login');


Route::post('/logout', "LoginController@logout")->name('logout')->middleware('check.login');
Route::resource('users', 'UserController')->middleware('check.login');