<?php

use App\Livewire\Payment\EditPaymentt;
use App\Livewire\Payment\ListPayment;
use App\Livewire\Salarie\editSalarie;
use App\Livewire\Salarie\ListSalaries;
use App\Livewire\Sinf\CreateSinf;
use App\Livewire\Sinf\editsinf;
use App\Livewire\Sinf\ListSinfs;
use App\Livewire\Student\CreateStudent;
use App\Livewire\Student\editstudent;
use App\Livewire\Student\ListStudents;
use App\Livewire\Teacher\CreateTeacher;
use App\Livewire\Teacher\editTeacher;
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
    Route::get('/edit-students/{record}' , editstudent::class)->name('student.edit');
    Route::get('/student-create' , CreateStudent::class)->name('student.create');
    Route::get('/manage-teacher' , ListTeachers::class)->name('teacher.index');
    // Route::get('/teacher-create' , CreateTeacher::class)->name('teacher.create');
    Route::get('/edit-teacher/{record}' , editTeacher::class)->name('teacher.edit');
    Route::get('/manage-user' , ListUsers::class)->name('user.index');
    Route::get('/manage-senf' , ListSinfs::class)->name('senf.index');
    Route::get('/sinf-create' , CreateSinf::class)->name('senf.create');
    Route::get('/edit-senf' , editsinf::class)->name('senf.edit');
    Route::get('/manage-payment' , ListPayment::class)->name('payment.index');
    // Route::get('/payment-create' , CreatePayment::class)->name('payment.create');
    Route::get('/edit-payment/{record}' , EditPaymentt::class)->name('payment.edit');
    Route::get('/manage-salarie' , ListSalaries::class)->name('salarie.index');
    Route::get('/edit-salarie' , editSalarie::class)->name('salarie.edit');
});
require __DIR__.'/auth.php';
