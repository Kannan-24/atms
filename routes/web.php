<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AccountSettingsController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\BusController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\BusRouteController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ParentsController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\BatchesController;
use App\Http\Controllers\ClassesController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\StopController;
use App\Http\Controllers\UserstopController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

// Dashboard Route
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Authenticated User Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/update-photo', [ProfileController::class, 'updateProfilePhoto'])->name('profile.update.photo');

    // Account Settings Routes
    Route::get('/account-settings', [AccountSettingsController::class, 'index'])->name('account.settings');
    Route::patch('/account-settings/password', [AccountSettingsController::class, 'updatePassword'])->name('account.update.password');
    Route::delete('/account-settings/delete', [AccountSettingsController::class, 'destroy'])->name('account.destroy');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('batches', BatchesController::class);
    Route::resource('classes', ClassesController::class);
    Route::resource('departments', DepartmentController::class);
    Route::resource('students', StudentController::class);
    Route::resource('faculty', FacultyController::class);
    Route::resource('parents', ParentsController::class);
    Route::resource('buses', BusController::class);
    Route::resource('drivers', DriverController::class);
    Route::resource('busroutes', RouteController::class);
    Route::resource('stops', StopController::class);
    Route::resource('userstops', UserstopController::class);
    Route::post('/faculty/import', [FacultyController::class, 'import'])->name('faculty.import');

});






// Include Authentication Routes
require __DIR__ . '/auth.php';
