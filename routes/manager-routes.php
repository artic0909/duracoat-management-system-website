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

    Route::get('/used-paint', [ManagerController::class, 'usedPaints'])->name('manager.used-paints');

    // Clients Management Routes (Manager Guard) =============================================================================================================>
    Route::get('/client-manage', [ManagerController::class, 'clientManageView'])->name('manager.client-material-manage');
    Route::post('/client-manage', [ManagerController::class, 'clientManageStore'])->name('manager.client-material-manage.store');
    Route::put('/client-manage/{id}', [ManagerController::class, 'clientManageUpdate'])->name('manager.client-material-manage.update');
    Route::delete('/client-manage/{id}', [ManagerController::class, 'clientManageDelete'])->name('manager.client-material-manage.delete');

    // Orders & Jobcards Management Routes (Manager Guard) =============================================================================================================>
    Route::get('/order-create', [ManagerController::class, 'orderCreateView'])->name('manager.orders-and-jobcards');
    Route::post('/order-create', [ManagerController::class, 'orderCreateStore'])->name('manager.orders-and-jobcards.store');
    Route::put('/order-create/{id}', [ManagerController::class, 'orderCreateUpdate'])->name('manager.orders-and-jobcards.update');
    Route::delete('/order-create/{id}', [ManagerController::class, 'orderCreateDelete'])->name('manager.orders-and-jobcards.delete');

    // Jobcards Routes
    Route::get('/add-jobcards/{order_id}', [ManagerController::class, 'addJobcardView'])->name('manager.add-jobcards');
    Route::post('/add-jobcards/{order_id}', [ManagerController::class, 'addJobcardStore'])->name('manager.add-jobcards.store');
    Route::delete('/add-jobcards/{id}', [ManagerController::class, 'addJobcardDelete'])->name('manager.add-jobcards.delete');

    Route::get('/edit-jobcards/{id}', [ManagerController::class, 'editJobcardView'])->name('manager.edit-jobcards');
    Route::put('/edit-jobcards/{id}', [ManagerController::class, 'updateJobcard'])->name('manager.edit-jobcards.update');

    Route::get('/view-created-jobcards/{order_id}', [ManagerController::class, 'viewCreatedJobcards'])->name('manager.view-created-jobcards');
    Route::post('/update-jobcard/pretreatment/{id}', [ManagerController::class, 'updatePretreatment'])->name('manager.update.pretreatment');
    Route::post('/update-jobcard/powderapplied/{id}', [ManagerController::class, 'updatePowderApplied'])->name('manager.update.powderapplied');
    Route::post('/update-jobcard/delivered/{id}', [ManagerController::class, 'updateDelivered'])->name('manager.update.delivered');
    Route::post('/update-jobcard/delivered-statement/{id}', [ManagerController::class, 'updateDeliveryStatement'])->name('manager.update.delivered-statement');

    // Test Routes
    Route::get('/jobcard-test/{id}', [ManagerController::class, 'jobcardTestsView'])->name('manager.jobcard-test');
    Route::post('/jobcard-test/{id}', [ManagerController::class, 'jobcardTestStoreAndEdit'])->name('manager.jobcard-test.store');

    // Download Routes
    Route::get('/jobcard/pdf/{id}', [ManagerController::class, 'downloadJobCardInPDF'])->name('manager.jobcard.pdf');
    Route::get('/jobcard-test/download/{id}', [ManagerController::class, 'downloadJobcardTestResultsInPDF'])->name('manager.jobcard-test.download');
    Route::get('/jobcard/view/{id}', [ManagerController::class, 'viewJobCard'])->name('manager.jobcard.view');

    // All Jobcards Routes
    Route::get('/all-jobcards', [ManagerController::class, 'allJobcardsView'])->name('manager.all-jobcards');

    // Material Out Routes
    Route::get('/material-out', [ManagerController::class, 'materialOutView'])->name('manager.material-out');

    // Stock Manage Routes
    Route::get('/stocks-manage', [ManagerController::class, 'stockManageView'])->name('manager.stocks-manage');
    Route::put('/stocks-manage/{id}', [ManagerController::class, 'stockUpdate'])->name('manager.stocks-manage.update');

    // Profile Routes
    Route::get('/profile', [ManagerController::class, 'profileView'])->name('manager.profile');
    Route::put('/profile', [ManagerController::class, 'profileUpdate'])->name('manager.profile.update');

    // Exports Routes
    Route::get('/export/paints', [ManagerController::class, 'exportPaintsToExcel'])->name('manager.export.paints');
    Route::get('/export/jobcards', [ManagerController::class, 'exportJobcardsToExcel'])->name('manager.export.jobcards');
    Route::get('/export/orders', [ManagerController::class, 'exportOrdersToExcel'])->name('manager.export.orders');
    Route::get('/export/client-materials/in', [ManagerController::class, 'exportClientAndMaterialsInToExcel'])->name('manager.export.client.in');
    Route::get('/export/client-materials/out', [ManagerController::class, 'exportClientAndMaterialsOutToExcel'])->name('manager.export.client.out');
});
