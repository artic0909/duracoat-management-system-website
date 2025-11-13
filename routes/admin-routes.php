<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;


Route::get('/admin/login', [AdminController::class, 'loginView'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.verify');


// Guard Routes (Manager Guard) =============================================================================================================>
Route::middleware(['auth:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboardView'])->name('admin.dashboard');
    Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');

    // Paint Management Routes (Manager Guard) =============================================================================================================>
    Route::get('/paint-manage', [AdminController::class, 'paintManageView'])->name('admin.paint-manage');
    Route::post('/paint-manage', [AdminController::class, 'paintManageStore'])->name('admin.paint-manage.store');
    Route::put('/paint-manage/{id}', [AdminController::class, 'paintManageUpdate'])->name('admin.paint-manage.update');
    Route::delete('/paint-manage/{id}', [AdminController::class, 'paintManageDelete'])->name('admin.paint-manage.delete');

    Route::get('/used-paint', [AdminController::class, 'usedPaints'])->name('admin.used-paints');

    // Clients Management Routes (Manager Guard) =============================================================================================================>
    Route::get('/client-manage', [AdminController::class, 'clientManageView'])->name('admin.client-material-manage');
    Route::post('/client-manage', [AdminController::class, 'clientManageStore'])->name('admin.client-material-manage.store');
    Route::put('/client-manage/{id}', [AdminController::class, 'clientManageUpdate'])->name('admin.client-material-manage.update');
    Route::delete('/client-manage/{id}', [AdminController::class, 'clientManageDelete'])->name('admin.client-material-manage.delete');

    // Orders & Jobcards Management Routes (Manager Guard) =============================================================================================================>
    Route::get('/order-create', [AdminController::class, 'orderCreateView'])->name('admin.orders-and-jobcards');
    Route::post('/order-create', [AdminController::class, 'orderCreateStore'])->name('admin.orders-and-jobcards.store');
    Route::put('/order-create/{id}', [AdminController::class, 'orderCreateUpdate'])->name('admin.orders-and-jobcards.update');
    Route::delete('/order-create/{id}', [AdminController::class, 'orderCreateDelete'])->name('admin.orders-and-jobcards.delete');

    // Jobcards Routes
    Route::get('/add-jobcards/{order_id}', [AdminController::class, 'addJobcardView'])->name('admin.add-jobcards');
    Route::post('/add-jobcards/{order_id}', [AdminController::class, 'addJobcardStore'])->name('admin.add-jobcards.store');
    Route::delete('/add-jobcards/{id}', [AdminController::class, 'addJobcardDelete'])->name('admin.add-jobcards.delete');

    Route::get('/edit-jobcards/{id}', [AdminController::class, 'editJobcardView'])->name('admin.edit-jobcards');
    Route::put('/edit-jobcards/{id}', [AdminController::class, 'updateJobcard'])->name('admin.edit-jobcards.update');

    Route::get('/view-created-jobcards/{order_id}', [AdminController::class, 'viewCreatedJobcards'])->name('admin.view-created-jobcards');
    Route::post('/update-jobcard/pretreatment/{id}', [AdminController::class, 'updatePretreatment'])->name('admin.update.pretreatment');
    Route::post('/update-jobcard/powderapplied/{id}', [AdminController::class, 'updatePowderApplied'])->name('admin.update.powderapplied');
    Route::post('/update-jobcard/delivered/{id}', [AdminController::class, 'updateDelivered'])->name('admin.update.delivered');

    // Test Routes
    Route::get('/jobcard-test/{id}', [AdminController::class, 'jobcardTestsView'])->name('admin.jobcard-test');
    Route::post('/jobcard-test/{id}', [AdminController::class, 'jobcardTestStoreAndEdit'])->name('admin.jobcard-test.store');

    // Download Routes
    Route::get('/jobcard/pdf/{id}', [AdminController::class, 'downloadJobCardInPDF'])->name('admin.jobcard.pdf');
    Route::get('/jobcard-test/download/{id}', [AdminController::class, 'downloadJobcardTestResultsInPDF'])->name('admin.jobcard-test.download');

    // All Jobcards Routes
    Route::get('/all-jobcards', [AdminController::class, 'allJobcardsView'])->name('admin.all-jobcards');
    Route::get('/rejected-jobcards', [AdminController::class, 'allRejectedJobcardsView'])->name('admin.rejected-jobcards');

    // Material Out Routes
    Route::get('/material-out', [AdminController::class, 'materialOutView'])->name('admin.material-out');

    // Stock Manage Routes
    Route::get('/stocks-manage', [AdminController::class, 'stockManageView'])->name('admin.stocks-manage');
    Route::put('/stocks-manage/{id}', [AdminController::class, 'stockUpdate'])->name('admin.stocks-manage.update');

    // Profile Routes
    Route::get('/profile', [AdminController::class, 'profileView'])->name('admin.profile');
    Route::put('/profile', [AdminController::class, 'profileUpdate'])->name('admin.profile.update');

    // Exports Routes
    Route::get('/export/paints', [AdminController::class, 'exportPaintsToExcel'])->name('admin.export.paints');
    Route::get('/export/jobcards', [AdminController::class, 'exportJobcardsToExcel'])->name('admin.export.jobcards');
    Route::get('/export/orders', [AdminController::class, 'exportOrdersToExcel'])->name('admin.export.orders');
    Route::get('/export/client-materials/in', [AdminController::class, 'exportClientAndMaterialsInToExcel'])->name('admin.export.client.in');
    Route::get('/export/client-materials/out', [AdminController::class, 'exportClientAndMaterialsOutToExcel'])->name('admin.export.client.out');
});
