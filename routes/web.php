<?php

use App\Livewire\Payment\ListPayment;
use App\Livewire\Salarie\ListSalaries;
use App\Livewire\Sinf\ListSinfs;
use App\Livewire\Student\ListStudents;
use App\Livewire\Teacher\ListTeachers;
use App\Livewire\Users\ListUsers;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/manage-sudents' , ListStudents::class)->name('student.index');
    Route::get('/manage-teacher' , ListTeachers::class)->name('teacher.index');
    Route::get('/manage-user' , ListUsers::class)->name('user.index');
    Route::get('/manage-senf' , ListSinfs::class)->name('senf.index');
    Route::get('/manage-payment' , ListPayment::class)->name('payment.index');
    Route::get('/manage-salarie' , ListSalaries::class)->name('salarie.index');
});
require __DIR__.'/auth.php';
