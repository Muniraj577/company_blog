<?php

use App\Http\Controllers\Admin\AboutController as AdminAboutController;
use App\Http\Controllers\Admin\ClientCategoryController as AdminClientCategoryController;
use App\Http\Controllers\Admin\ClientController as AdminClientController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\ServiceCategoryController as AdminServiceCategoryController;
use App\Http\Controllers\Admin\ServiceController as AdminServiceController;
use App\Http\Controllers\Admin\TeamController as AdminTeamController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\CompanyDataController as AdminCompanyDataController;
use App\Http\Controllers\Admin\SocialController as AdminSocialController;
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

        Route::group(["prefix" => "product/", "as" => "product."], function () {
            Route::get("", [AdminProductController::class, "index"])->name("index");
            Route::get("create/", [AdminProductController::class, "create"])->name("create");
            Route::post("store/", [AdminProductController::class, "store"])->name("store");
            Route::get("edit/{id}", [AdminProductController::class, "edit"])->name("edit");
            Route::put("update/{id}", [AdminProductController::class, "update"])->name("update");
        });

        Route::group(["prefix" => "client/", "as" => "client."], function () {
            Route::get("", [AdminClientController::class, "index"])->name("index");
            Route::get("create", [AdminClientController::class, "create"])->name("create");
            Route::post("store", [AdminClientController::class, "store"])->name("store");
            Route::get("edit/{id}", [AdminClientController::class, "edit"])->name("edit");
            Route::put("update/{id}", [AdminClientController::class, "update"])->name("update");

            Route::group(["prefix" => "category/", "as" => "category."], function () {
                Route::get("", [AdminClientCategoryController::class, "index"])->name("index");
                Route::get("create", [AdminClientCategoryController::class, "create"])->name("create");
                Route::post("store", [AdminClientCategoryController::class, "store"])->name("store");
                Route::get("edit/{id}", [AdminClientCategoryController::class, "edit"])->name("edit");
                Route::put("update/{id}", [AdminClientCategoryController::class, "update"])->name("update");
            });
        });

        Route::group(["prefix" => "service/", "as" => "service."], function () {
            Route::get("", [AdminServiceController::class, "index"])->name("index");
            Route::get("create/", [AdminServiceController::class, "create"])->name("create");
            Route::post("store/", [AdminServiceController::class, "store"])->name("store");
            Route::get("edit/{id}", [AdminServiceController::class, "edit"])->name("edit");
            Route::put("update/{id}", [AdminServiceController::class, "update"])->name("update");

            Route::group(["prefix" => "category/", "as" => "category."], function () {
                Route::get("", [AdminServiceCategoryController::class, "index"])->name("index");
                Route::get("create/", [AdminServiceCategoryController::class, "create"])->name("create");
                Route::post("store/", [AdminServiceCategoryController::class, "store"])->name("store");
                Route::get("edit/{id}", [AdminServiceCategoryController::class, "edit"])->name("edit");
                Route::put("update/{id}", [AdminServiceCategoryController::class, "update"])->name("update");
            });
        });

        Route::group(["prefix" => "team/", "as" => "team."], function () {
            Route::get("", [AdminTeamController::class, "index"])->name("index");
            Route::get("create", [AdminTeamController::class, "create"])->name("create");
            Route::post("store", [AdminTeamController::class, "store"])->name("store");
            Route::get("edit/{id}", [AdminTeamController::class, "edit"])->name("edit");
            Route::put("update/{id}", [AdminTeamController::class, "update"])->name("update");
        });

        Route::group(["prefix" => "about/", "as" => "about."], function () {
            Route::get("", [AdminAboutController::class, "index"])->name("index");
            Route::get("create/", [AdminAboutController::class, "create"])->name("create");
            Route::post("store/", [AdminAboutController::class, "store"])->name("store");
            Route::get("edit/{id}", [AdminAboutController::class, "edit"])->name("edit");
            Route::put("update/{id}", [AdminAboutController::class, "update"])->name("update");
            Route::post("update-status", [AdminAboutController::class, "updateStatus"])->name("updateStatus");
        });

        Route::group(['prefix' => 'company-information/', 'as' => 'general.'], function () {
            Route::get('', [AdminCompanyDataController::class, 'index'])->name('index');
            Route::post('store', [AdminCompanyDataController::class, 'store'])->name('store');
            Route::post('update/{id}', [AdminCompanyDataController::class, 'update'])->name('update');
            Route::delete('delete/{id}', [AdminCompanyDataController::class, 'destroy'])->name('destroy');
        });

        Route::group(["prefix"=>"social/", "as"=>"social."], function(){
            Route::get("", [AdminSocialController::class, "index"])->name("index");
            Route::get("create/", [AdminSocialController::class, "create"])->name("create");
            Route::post("store/", [AdminSocialController::class, "store"])->name("store");
            Route::get("edit/", [AdminSocialController::class, "edit"])->name("edit");
            Route::put("update/", [AdminSocialController::class, "update"])->name("update");
        });

    });
});
