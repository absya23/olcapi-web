<?php

use Illuminate\Support\Facades\DB;
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
    return view('welcome');
});


Route::get('/product', function () {
    return DB::table('product')->get();
});

Route::get('/userorder', function(){
    return DB::table('user')->join('order','user.id_user','=','order.id_user')->join('status','order.id_status','=','status.id_status') ->select('user.*', 'status.description')->get();
});