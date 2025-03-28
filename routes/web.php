<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KorolichUserController;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\XmlToCsvController;



Route::get('/check-database', function () {
    try {
        // Проверяем подключение к базе данных
        DB::connection()->getPdo();
        return 'Подключение к базе данных успешно!';
    } catch (\Exception $e) {
        // Если ошибка, выводим сообщение
        return 'Ошибка подключения к базе данных: ' . $e->getMessage();
    }
});

Route::resource('korolich_users', KorolichUserController::class);

Route::post('/korolich_users/store', [KorolichUserController::class, 'store'])->name('korolich_users.store');

Route::get('/korolich_users', [KorolichUserController::class, 'index'])->name('korolich_users.index');
Route::get('/korolich_users/create', [KorolichUserController::class, 'create'])->name('korolich_users.create');
Route::post('/korolich_users', [KorolichUserController::class, 'store'])->name('korolich_users.store');
Route::delete('/korolich_users/{user}', [KorolichUserController::class, 'destroy'])->name('korolich_users.destroy');

Route::get('korolich_users/{user}/edit', [KorolichUserController::class, 'edit'])->name('korolich_users.edit');
Route::put('korolich_users/{user}', [KorolichUserController::class, 'update'])->name('korolich_users.update');

Route::get('/export-xml', [XmlToCsvController::class, 'export']);
