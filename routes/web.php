<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\DocumentFieldController;
use App\Http\Controllers\DocumentTypeController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the 'web' middleware group. Make something great!
|
*/

Route::get('/', fn() => redirect(route('auth.get.login')));

Route::controller(AuthController::class)->group(function () {
    # auth
    Route::prefix('auth')->group(function () {
        Route::get('login', 'getLogin')->name('auth.get.login');
        Route::post('login', 'postLogin')->name('auth.post.login');
        Route::post('logout', 'postLogout')->name('auth.post.logout');
    });
});

Route::middleware('isLogin')->group(function () {
    Route::prefix('dashboard')->controller(DashboardController::class)->group(function () {
        Route::get('index', 'index')->name('dashboard.index');
        Route::get('load-revenue-data', 'loadRevenueData')->name('dashboard.load-revenue-data');
    });

    Route::prefix('user')->controller(UserController::class)->group(function () {
        Route::get('index', 'index')->name('user.index');
        Route::get('list', 'list')->name('user.list');
        Route::get('create', 'create')->name('user.create');
        Route::post('store', 'store')->name('user.store');
        Route::get('edit', 'edit')->name('user.edit');
        Route::patch('update', 'update')->name('user.update');
        Route::delete('destroy', 'destroy')->name('user.destroy');
    });

    Route::prefix('admin')->controller(AdminController::class)->group(function () {
        Route::get('index', 'index')->name('admin.index');
        Route::get('list', 'list')->name('admin.list');
        Route::get('create', 'create')->name('admin.create');
        Route::post('store', 'store')->name('admin.store');
        Route::get('edit', 'edit')->name('admin.edit');
        Route::patch('update', 'update')->name('admin.update');
        Route::delete('destroy', 'destroy')->name('admin.destroy');
    });

    Route::prefix('document')->group(function () {
        Route::prefix('field')->controller(DocumentFieldController::class)->group(function () {
            Route::get('index', 'index')->name('document.field.index');
            Route::get('list', 'list')->name('document.field.list');
            Route::get('create', 'create')->name('document.field.create');
            Route::post('store', 'store')->name('document.field.store');
            Route::get('edit', 'edit')->name('document.field.edit');
            Route::patch('update', 'update')->name('document.field.update');
            Route::delete('destroy', 'destroy')->name('document.field.destroy');
        });

        Route::prefix('type')->controller(DocumentTypeController::class)->group(function () {
            Route::get('index', 'index')->name('document.type.index');
            Route::get('list', 'list')->name('document.type.list');
            Route::get('create', 'create')->name('document.type.create');
            Route::post('store', 'store')->name('document.type.store');
            Route::get('edit', 'edit')->name('document.type.edit');
            Route::patch('update', 'update')->name('document.type.update');
            Route::delete('destroy', 'destroy')->name('document.type.destroy');
        });

        Route::controller(DocumentController::class)->group(function () {
            Route::get('index', 'index')->name('document.index');
            Route::get('list', 'list')->name('document.list');
            Route::get('create', 'create')->name('document.create');
            Route::post('store', 'store')->name('document.store');
            Route::get('edit', 'edit')->name('document.edit');
            Route::patch('update', 'update')->name('document.update');
            Route::delete('destroy', 'destroy')->name('document.destroy');
        });
    });

    Route::prefix('package')->controller(PackageController::class)->group(function () {
        Route::get('index', 'index')->name('package.index');
        Route::get('list', 'list')->name('package.list');
        Route::get('create', 'create')->name('package.create');
        Route::post('store', 'store')->name('package.store');
        Route::get('edit', 'edit')->name('package.edit');
        Route::patch('update', 'update')->name('package.update');
        Route::delete('destroy', 'destroy')->name('package.destroy');
    });
});
