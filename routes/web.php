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

use Illuminate\Support\Facades\Route;

define('SESSION_UID',                  'SESSION_UID');
define('SESSION_EMAIL',                'SESSION_EMAIL');

Route::get('/', function() {

    $uid = session()->get(SESSION_UID);

    if(!isset($uid) && $uid == null)
        return redirect("/login");
    else
        return redirect("/index");

});


Route::get('/login', function (){
    return view('login');
});

Route::get('/register', function (){
    return view('register');
});

Route::get('/error', function() {
   return view('error');
});

Route::get('/logout',                                        'UserController@logout');
Route::get('/index',                                         'DataController@index');
Route::post('/get-data',                                     'DataController@getData');
Route::post('/signin',                                       'UserController@login');
Route::post('/signup',                                       'UserController@register');
Route::post('/set-data',                                     'DataController@setData');



