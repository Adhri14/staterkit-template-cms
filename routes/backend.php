<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LogAdminController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'backend', 'middleware' => ['auth']], function() {
    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/product/trash', [ProductController::class, 'trash'])->name('product.trash');
    Route::get('/product/trash/count', [ProductController::class, 'countTrash'])->name('product.countTrash');
    Route::post('/product/destroy-all', [ProductController::class, 'destroyAll'])->name('product.destroy-all');
    Route::post('/product/{product}/delete', [ProductController::class, 'delete'])->name('product.delete');
    Route::post('/product/{product}/destroy', [ProductController::class, 'destroy'])->name('product.forceDelete');
    Route::post('/product/{product}/restore', [ProductController::class, 'restore'])->name('product.restore');
    Route::resource('/product', ProductController::class);

    //Transaction
    Route::get('/transaction/trash', [TransactionController::class, 'trash'])->name('transaction.trash');
    Route::get('/transaction/trash/count', [TransactionController::class, 'countTrash'])->name('transaction.countTrash');
    Route::post('/transaction/destroy-all', [TransactionController::class, 'destroyAll'])->name('transaction.destroy-all');
    Route::post('/transaction/{transaction}/delete', [TransactionController::class, 'delete'])->name('transaction.delete');
    Route::post('/transaction/{transaction}/destroy', [TransactionController::class, 'destroy'])->name('transaction.forceDelete');
    Route::post('/transaction/{transaction}/restore', [TransactionController::class, 'restore'])->name('transaction.restore');
    Route::get('/transaction/export', [TransactionController::class, 'export'])->name('transaction.export');
    Route::resource('/transaction', TransactionController::class);

    //Log Admin
    Route::get('/log-admin/trash', [LogAdminController::class, 'trash'])->name('log-admin.trash');
    Route::get('/log-admin/trash/count', [LogAdminController::class, 'countTrash'])->name('log-admin.countTrash');
    Route::post('/log-admin/destroy-all', [LogAdminController::class, 'destroyAll'])->name('log-admin.destroy-all');
    Route::post('/log-admin/{log_admin}/delete', [LogAdminController::class, 'delete'])->name('log-admin.delete');
    Route::post('/log-admin/{log_admin}/destroy', [LogAdminController::class, 'destroy'])->name('log-admin.forceDelete');
    Route::post('/log-admin/{log_admin}/restore', [LogAdminController::class, 'restore'])->name('log-admin.restore');
    Route::resource('/log-admin', LogAdminController::class);

    //User
    Route::get('/user/trash', [App\Http\Controllers\Admin\UserController::class, 'trash'])->name('user.trash');
    Route::get('/user/trash/count', [App\Http\Controllers\Admin\UserController::class, 'countTrash'])->name('user.countTrash');
    // Route::get('/user/{user}/point-history', [App\Http\Controllers\Admin\UserController::class, 'pointHistory'])->name('user.pointHistory');
    Route::get('/user/export', [App\Http\Controllers\Admin\UserController::class, 'export'])->name('user.export');
    // Route::post('/user/destroy-all', [App\Http\Controllers\Admin\UserController::class, 'destroyAll'])->name('user.destroy-all');
    Route::post('/user/{user}/delete', [App\Http\Controllers\Admin\UserController::class, 'delete'])->name('user.delete');
    Route::post('/user/{user}/destroy', [App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('user.forceDelete');
    // Route::post('/user/{user}/destroy', [App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('user.forceDelete');
    // Route::post('/user/{user}/update-point', [App\Http\Controllers\Admin\UserController::class, 'updatePoint'])->name('user.updatePoint');
    // Route::post('/user/{id}/update-verification', [App\Http\Controllers\Admin\UserController::class, 'updateStatusVerification'])->name('user.updateVerification');
    Route::resource('/user', UserController::class);
});

Route::group(['prefix' => 'backend'], function() {
    Route::get('/login', [App\Http\Controllers\AuthAdmin\AuthAdminController::class, 'create'])->name('admin.login');
    Route::post('/login', [App\Http\Controllers\AuthAdmin\AuthAdminController::class, 'store'])->name('admin.login');

    Route::post('logout', [App\Http\Controllers\AuthAdmin\AuthAdminController::class, 'destroy'])->name('admin.logout');
});