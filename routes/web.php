<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\ClientCategoryController as AdminClientCategoryController;
use App\Http\Controllers\Admin\ClientController as AdminClientController;
use App\Http\Controllers\Admin\TeamController as AdminTeamController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(["middleware" => "auth"], function () {
    Route::group(["prefix" => "admin/", "as" => "admin."], function () {
        Route::get("dashboard/", [AdminDashboardController::class, "dashboard"])->name("dashboard");

        Route::group(["prefix" => "user/", "as" => "user."], function () {
            Route::get("", [AdminUserController::class, "index"])->name("index");
            Route::get("create", [AdminUserController::class, "create"])->name("create");
            Route::post("store", [AdminUserController::class, "store"])->name("store");
            Route::get("edit/{id}", [AdminUserController::class, "edit"])->name("edit");
            Route::put("update/{id}", [AdminUserController::class, "update"])->name("update");
        });


        Route::group(["prefix"=>"product/", "as"=>"product."], function(){
            Route::get("", [AdminProductController::class, "index"])->name("index");
            Route::get("create/", [AdminProductController::class, "create"])->name("create");
            Route::post("store/", [AdminProductController::class, "store"])->name("store");
            Route::get("edit/{id}", [AdminProductController::class, "edit"])->name("edit");
            Route::put("update/{id}", [AdminProductController::class, "update"])->name("update");
        });

        Route::group(["prefix"=>"client/", "as"=>"client."], function(){
            Route::get("",[AdminClientController::class, "index"])->name("index");
            Route::get("create",[AdminClientController::class, "create"])->name("create");
            Route::post("store",[AdminClientController::class,"store"])->name("store");
            Route::get("edit/{id}",[AdminClientController::class,"edit"])->name("edit");
            Route::put("update/{id}",[AdminClientController::class,"update"])->name("update");
            
            Route::group(["prefix"=>"category/", "as"=>"category."], function(){
                Route::get("", [AdminClientCategoryController::class, "index"])->name("index");
                Route::get("create",[AdminClientCategoryController::class, "create"])->name("create");
                Route::post("store", [AdminClientCategoryController::class, "store"])->name("store");
                Route::get("edit/{id}", [AdminClientCategoryController::class, "edit"])->name("edit");
                Route::put("update/{id}", [AdminClientCategoryController::class, "update"])->name("update");
            });
        });

        Route::group(["prefix"=>"team/", "as"=>"team."],function(){
            Route::get("", [AdminTeamController::class, "index"])->name("index");
            Route::get("create", [AdminTeamController::class, "create"])->name("create");
            Route::post("store", [AdminTeamController::class, "store"])->name("store");
            Route::get("edit/{id}", [AdminTeamController::class, "edit"])->name("edit");
            Route::put("update/{id}", [AdminTeamController::class, "update"])->name("update");
        });
    });
});
