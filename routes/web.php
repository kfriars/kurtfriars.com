<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', 'HomeController@home')->name('public.home');
Route::get('/packages', 'HomeController@packages')->name('public.packages');
Route::get('/cv', 'HomeController@cv')->name('public.cv');
Route::get('/cv/{token}', 'HomeController@downloadCv')->name('cv.download');

Route::post('/prospects', 'ProspectsController@store')->name('prospect.store');
