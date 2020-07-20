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

//SIMULASI CONTROLLER
Route::get('/home', 'simulasiController@index')->name('home');
Route::post('/home/create', 'simulasiController@simulate')->name('simulasi-create');

//ABOUT CONTROLLER
Route::get('/About', 'AboutController@index')->name('About');