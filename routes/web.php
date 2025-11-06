<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('index');
})->name('home');




// Test Start

Route::get('/manager-dashboard8', function () {
    return view('manager.all-jobcards');
})->name('manager.all-jobcards');

Route::get('/manager-dashboard4', function () {
    return view('manager.material-out');
})->name('manager.material-out');

Route::get('/manager-dashboard5', function () {
    return view('manager.stock-manage');
})->name('manager.stocks-manage');

Route::get('/manager-dashboard6', function () {
    return view('manager.dashboard');
})->name('manager.jobcards');

Route::get('/manager-dashboard9', function () {
    return view('manager.test-results');
})->name('manager.test-results');

Route::get('/manager-dashboard10', function () {
    return view('manager.profile');
})->name('manager.profile');
// Test End









Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('profile.edit');
    Volt::route('settings/password', 'settings.password')->name('user-password.edit');
    Volt::route('settings/appearance', 'settings.appearance')->name('appearance.edit');

    Volt::route('settings/two-factor', 'settings.two-factor')
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');
});
