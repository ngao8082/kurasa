<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WelcomeController;

//use \App\Http\Controllers\studentController;
use App\Http\Controllers\SupermarketController;
use Illuminate\Support\Facades\Route;

use \App\Http\Controllers\Admin\RoleController;
use \App\Http\Controllers\Admin\PermissionController;
use \App\Http\Controllers\Admin\PermissionGroupController;

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
Route::get('supermarket/create', 'SupermarketController@create')->name('supermarket.create');
Route::get('supermarket/employee', 'SupermarketController@addemployee')->name('supermarket.employee');
Route::post('supermarket/employeeupload', 'SupermarketController@uploadEmployees')->name('supermarket.employeefile');
Route::post('supermarket/supplierupload', 'SupermarketController@uploadSupplier')->name('supermarket.supplierfile');
Route::get('supermarket/edit/{id}', 'SupermarketController@edit')->name('supermarket.edit');
Route::put('supermarket//edit/{id}', 'SupermarketController@update')->name('supermarket.update');
Route::get('/', [WelcomeController::class, 'index'])->name('welcome');
Route::get('supermarket/edit/{id}', [SupermarketController::class, 'edit'])->name('supermarket.edit');
Route::put('supermarket/edit/{id}', [SupermarketController::class, 'update'])->name('supermarket.update');
Route::get('/home', [SupermarketController::class, 'index'])->name('home')->middleware(['auth', 'verified']);
Route::get('/home', 'SupermarketController@index')->name('home')->middleware(['auth', 'verified']);
Route::delete('/home/{id}', 'SupermarketController@destory')->name('remove')->middleware(['auth', 'verified']);
Route::post('supermarket/create', 'SupermarketController@store')->name('supermarket.store')->middleware(['auth', 'verified']);

Auth::routes([
    'verify' => true,
]);
Route::post('supermarket/create', [SupermarketController::class, 'store'])->name('supermarket.store')->middleware(['auth', 'verified']);
Route::get('/home', [SupermarketController::class, 'index'])->name('home')->middleware(['auth', 'verified']);
Route::delete('/home/{id}', [SupermarketController::class, 'destroy'])->name('remove')->middleware(['auth', 'verified']);
Route::match(['get', 'put'], '/users/{token}/welcome', [WelcomeController::class, 'setPassword'])->name('users.welcome');
Route::get('supermarket/create', [SupermarketController::class, 'create'])->name('supermarket.create');
Route::get('supermarket/employee', [SupermarketController::class, 'addemployee'])->name('supermarket.employee');
Route::get('supermarket/supplier', [SupermarketController::class, 'addsupplier'])->name('supermarket.supplier');
Route::post('supermarket/employeeupload', [SupermarketController::class,'uploadEmployees'])->name('supermarket.employeefile');
Route::post('supermarket/supplierupload', [SupermarketController::class,'uploadSupplier'])->name('supermarket.supplierfile');
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/users/{user}/delete', [UserController::class, 'delete'])->name('users.delete');
    Route::resource('users', UserController::class)->except('show', 'edit', 'update');
});

Route::resource('users', UserController::class)->only('show', 'edit', 'update')->middleware('auth');

Route::namespace('App\Http\Controllers\Admin')->middleware(['auth', 'verified'])->name('admin.')->prefix('setup/')->group(function () {
    Route::get('/roles/{role}/delete', [RoleController::class, 'delete'])->name('roles.delete');
    Route::resource('roles', RoleController::class);

    Route::resource('permissionGroups', PermissionGroupController::class)->except('index', 'show', 'destroy');

    Route::get('/permissions/{permission}/delete', [PermissionController::class, 'delete'])->name('permissions.delete');
    Route::resource('permissions', PermissionController::class);
    Route::get('/audits', 'AuditController@auditing')->name('auditing.index');
});
