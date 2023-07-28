<?php

use App\Http\Controllers\JobController;
use App\Http\Controllers\SeckillController;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\ClickhouseController;
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

Route::get('clickhouse/test', [ClickhouseController::class,'test'])->name('clickhouse.test');
Route::get('seckill/test', [SeckillController::class,'test'])->name('clickhouse.test'); //秒杀
Route::get('job/start', [JobController::class,'start'])->name('job.start');


