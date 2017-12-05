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

Route::get("/help", ["as" => "help", "uses" => "Help\HelpController@showHelpView", "middleware" => "auth"]);

/* PRODUCTS */

Route::group(['middleware' => 'auth'], function () {

    Route::get("/products", ["as" => "products", "uses" => "Product\SearchController@showSearchForm"]);

    Route::get("/product", ["as" => "product.create", "uses" => "Product\ProductController@create"]);

    Route::put("/product", ["uses" => "Product\ProductController@store"]);

    Route::get("/product/{product}", ["as" => "product.edit", "uses" => "Product\ProductController@edit"]);

    Route::patch("/product/{product}", ["uses" => "Product\ProductController@update"]);

    Route::delete("/product/{product}/delete", [
        "as" => "product.delete", "uses" => "Product\ProductController@destroy"
    ]);

});

/* STORE */

Route::group(['middleware' => 'auth'], function () {

    Route::get("/store", ["as" => "store", "uses" => "Store\SearchController@showSearchForm"]);

    Route::get("/stock/refill", ["as" => "store.refill", "uses" => "Store\StockController@showRefillForm"]);

    Route::put("/stock/refill", ["uses" => "Store\StockController@refill"]);

    Route::delete("/stock/restock", ["as" => "store.restock", "uses" => "Store\StockController@restock"]);

});