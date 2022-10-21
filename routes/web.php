<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\UnitController;
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
Route::get('/', [LoginController::class,"index"])->name("login")->middleware("guest");
Route::post('/login', [LoginController::class,"authenticate"]);
Route::post("/logout", [LoginController::class, "logout"]);

Route::resource("tenants",  TenantController::class)->middleware("auth");
Route::resource("units",  UnitController::class)->middleware("auth");