<?php

use App\Http\Controllers\ManagerController;
use Illuminate\Support\Facades\Route;


Route::get('/manager/login', [ManagerController::class, 'loginView'])->name('manager.login');
Route::post('/manager/login', [ManagerController::class, 'login'])->name('manager.login.verify');


// Guard Routes (Manager Guard) =============================================================================================================>
Route::middleware(['auth:manager'])->prefix('manager')->group(function () {
    Route::get('/dashboard', [ManagerController::class, 'dashboardView'])->name('manager.dashboard');
    Route::get('/logout', [ManagerController::class, 'logout'])->name('manager.logout');

    // Paint Management Routes (Manager Guard) =============================================================================================================>
    Route::get('/paint-manage', [ManagerController::class, 'paintManageView'])->name('manager.paint-manage');
    Route::post('/paint-manage', [ManagerController::class, 'paintManageStore'])->name('manager.paint-manage.store');
    Route::put('/paint-manage/{id}', [ManagerController::class, 'paintManageUpdate'])->name('manager.paint-manage.update');
    Route::delete('/paint-manage/{id}', [ManagerController::class, 'paintManageDelete'])->name('manager.paint-manage.delete');
});
