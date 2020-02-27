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





