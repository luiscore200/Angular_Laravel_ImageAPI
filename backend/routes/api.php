<?php

use App\Http\Controllers\ImageModelController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::post('/create',[ImageModelController::class,'create']);
Route::get('/index',[ImageModelController::class,'index']);
Route::get('/getInfo/{id}',[ImageModelController::class,'getInfo']);
Route::put('/update/{id}',[ImageModelController::class,'update']);
Route::delete('/delete/{id}',[ImageModelController::class,'delete']);
Route::get('/show/{id}',[ImageModelController::class,'show']);

