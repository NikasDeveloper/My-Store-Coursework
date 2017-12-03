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

Route::get("/", ["as" => "home", "uses" => "HomeController@index"]);

Route::get("/login", ["as" => "login", "uses" => "Auth\LoginController@showLoginForm"]);

Route::post("/login", ["uses" => "Auth\LoginController@login"]);

Route::post("/logout", ["as" => "logout", "uses" => "Auth\LoginController@logout"]);