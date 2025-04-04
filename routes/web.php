<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KorolichUserController;
use App\Http\Controllers\ServicesManagerController;
use App\Http\Controllers\XmlToCsvController;
use App\Http\Controllers\ServicesListController;




Route::resource('korolich_users', KorolichUserController::class);
Route::post('/korolich_users/store', [KorolichUserController::class, 'store'])->name('korolich_users.store');

Route::get('/korolich_users', [KorolichUserController::class, 'index'])->name('korolich_users.index');
Route::get('/korolich_users/create', [KorolichUserController::class, 'create'])->name('korolich_users.create');
Route::post('/korolich_users', [KorolichUserController::class, 'store'])->name('korolich_users.store');
Route::delete('/korolich_users/{user}', [KorolichUserController::class, 'destroy'])->name('korolich_users.destroy');

Route::get('korolich_users/{user}/edit', [KorolichUserController::class, 'edit'])->name('korolich_users.edit');
Route::post('korolich_users/{user}', [KorolichUserController::class, 'update'])->name('korolich_users.update');

Route::get('/export-xml', [XmlToCsvController::class, 'export']);

//TZ2
//список 
Route::resource('service_manager', ServicesManagerController::class);
Route::get('/services', [ServicesManagerController::class, 'index'])->name('service_manager.index');
Route::delete('/service_manager/{service}', [ServicesManagerController::class, 'destroy'])->name('service_manager.destroy');

Route::get('/services-list', [ServicesListController::class, 'index'])->name('services_list.index');
Route::get('/services-list/create', [ServicesListController::class, 'create'])->name('services_list.create');
Route::post('/services-list', [ServicesListController::class, 'store'])->name('services_list.store');
Route::delete('/services-list/{id}', [ServicesListController::class, 'destroy'])->name('services_list.destroy');
