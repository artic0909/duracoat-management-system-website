<?php

use App\Http\Controllers\ViewerController;
use Illuminate\Support\Facades\Route;


Route::get('/viewer/login', [ViewerController::class, 'loginView'])->name('viewer.login');
Route::post('/viewer/login', [ViewerController::class, 'login'])->name('viewer.login.verify');


// Guard Routes (Manager Guard) =============================================================================================================>
Route::middleware(['auth:viewer'])->prefix('viewer')->group(function () {
    Route::get('/dashboard', [ViewerController::class, 'dashboardView'])->name('viewer.dashboard');
    Route::get('/logout', [ViewerController::class, 'logout'])->name('viewer.logout');

    // Paint Management Routes (Manager Guard) =============================================================================================================>
    Route::get('/paint-manage', [ViewerController::class, 'paintManageView'])->name('viewer.paint-manage');
    Route::post('/paint-manage', [ViewerController::class, 'paintManageStore'])->name('viewer.paint-manage.store');
    Route::put('/paint-manage/{id}', [ViewerController::class, 'paintManageUpdate'])->name('viewer.paint-manage.update');
    Route::delete('/paint-manage/{id}', [ViewerController::class, 'paintManageDelete'])->name('viewer.paint-manage.delete');
    
    Route::get('/used-paint', [ViewerController::class, 'usedPaints'])->name('viewer.used-paints');

    // Clients Management Routes (Manager Guard) =============================================================================================================>
    Route::get('/client-manage', [ViewerController::class, 'clientManageView'])->name('viewer.client-material-manage');
    Route::post('/client-manage', [ViewerController::class, 'clientManageStore'])->name('viewer.client-material-manage.store');
    Route::put('/client-manage/{id}', [ViewerController::class, 'clientManageUpdate'])->name('viewer.client-material-manage.update');
    Route::delete('/client-manage/{id}', [ViewerController::class, 'clientManageDelete'])->name('viewer.client-material-manage.delete');

    // Orders & Jobcards Management Routes (Manager Guard) =============================================================================================================>
    Route::get('/order-create', [ViewerController::class, 'orderCreateView'])->name('viewer.orders-and-jobcards');
    Route::post('/order-create', [ViewerController::class, 'orderCreateStore'])->name('viewer.orders-and-jobcards.store');
    Route::put('/order-create/{id}', [ViewerController::class, 'orderCreateUpdate'])->name('viewer.orders-and-jobcards.update');
    Route::delete('/order-create/{id}', [ViewerController::class, 'orderCreateDelete'])->name('viewer.orders-and-jobcards.delete');

    // Jobcards Routes
    Route::get('/add-jobcards/{order_id}', [ViewerController::class, 'addJobcardView'])->name('viewer.add-jobcards');
    Route::post('/add-jobcards/{order_id}', [ViewerController::class, 'addJobcardStore'])->name('viewer.add-jobcards.store');
    Route::delete('/add-jobcards/{id}', [ViewerController::class, 'addJobcardDelete'])->name('viewer.add-jobcards.delete');
    
    Route::get('/edit-jobcards/{id}', [ViewerController::class, 'editJobcardView'])->name('viewer.edit-jobcards');
    Route::put('/edit-jobcards/{id}', [ViewerController::class, 'updateJobcard'])->name('viewer.edit-jobcards.update');

    Route::get('/view-created-jobcards/{order_id}', [ViewerController::class, 'viewCreatedJobcards'])->name('viewer.view-created-jobcards');
    Route::post('/update-jobcard/pretreatment/{id}', [ViewerController::class, 'updatePretreatment'])->name('viewer.update.pretreatment');
    Route::post('/update-jobcard/powderapplied/{id}', [ViewerController::class, 'updatePowderApplied'])->name('viewer.update.powderapplied');
    Route::post('/update-jobcard/delivered/{id}', [ViewerController::class, 'updateDelivered'])->name('viewer.update.delivered');

    // Test Routes
    Route::get('/jobcard-test/{id}', [ViewerController::class, 'jobcardTestsView'])->name('viewer.jobcard-test');
    Route::post('/jobcard-test/{id}', [ViewerController::class, 'jobcardTestStoreAndEdit'])->name('viewer.jobcard-test.store');

    // Download Routes
    Route::get('/jobcard/pdf/{id}', [ViewerController::class, 'downloadJobCardInPDF'])->name('viewer.jobcard.pdf');
    Route::get('/jobcard-test/download/{id}', [ViewerController::class, 'downloadJobcardTestResultsInPDF'])->name('viewer.jobcard-test.download');

    // All Jobcards Routes
    Route::get('/all-jobcards', [ViewerController::class, 'allJobcardsView'])->name('viewer.all-jobcards');
    Route::get('/rejected-jobcards', [ViewerController::class, 'allRejectedJobcardsView'])->name('viewer.rejected-jobcards');

    // Material Out Routes
    Route::get('/material-out', [ViewerController::class, 'materialOutView'])->name('viewer.material-out');

    // Stock Manage Routes
    Route::get('/stocks-manage', [ViewerController::class, 'stockManageView'])->name('viewer.stocks-manage');
    Route::put('/stocks-manage/{id}', [ViewerController::class, 'stockUpdate'])->name('viewer.stocks-manage.update');

    // Profile Routes
    Route::get('/profile', [ViewerController::class, 'profileView'])->name('viewer.profile');
    Route::put('/profile', [ViewerController::class, 'profileUpdate'])->name('viewer.profile.update');


});
