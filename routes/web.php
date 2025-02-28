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
    Route::resource('parents', ParentsController::class);
    Route::resource('buses', BusController::class);
    Route::resource('busroutes', RouteController::class);
    Route::resource('stops', StopController::class);

    //driver routes
    Route::resource('drivers', DriverController::class);
    Route::get('/buses/{bus}/assign-driver', [BusController::class, 'assignDriverForm'])->name('buses.assigndriverform');
    Route::post('/buses/{bus}/assign-driver', [BusController::class, 'assignDriver'])->name('buses.assignDriver');
    Route::patch('/buses/update-driver-validity/{busDriver}', [BusController::class, 'updateDriverValidity'])->name('buses.updateDriverValidity');
    Route::delete('/buses/remove-driver/{busDriver}', [BusController::class, 'removeDriver'])->name('buses.removeDriver');
    Route::get('/drivers/assign/{driver}', [DriverController::class, 'assign'])->name('drivers.assingdriver');

    // Faculty Routes
    Route::resource('faculty', FacultyController::class);
    Route::get('/buses/{bus}/assign-faculty', [BusController::class, 'assignFacultyForm'])->name('buses.assignfacultyform');
    Route::post('/buses/{bus}/assign-faculty', [BusController::class, 'assignFaculty'])->name('buses.assignFaculty');
    Route::get('/faculties/assign/{faculty}', [FacultyController::class, 'facultyAssign'])->name('faculty.assignFaculty');
    Route::delete('/buses/{facultyIncharge}/remove', [BusController::class, 'removeFacultyIncharge'])->name('buses.removeFacultyIncharge');

    // student routes
    Route::resource('students', StudentController::class);
    Route::get('/students/{student}/assign-stops', [StudentController::class, 'assignStops'])->name('students.assignStops');
    Route::put('/students/{student}/assign-stops', [StudentController::class, 'updateAssignedStop'])->name('students.assignStops.update');
    Route::get('/students/{student}/edit-stop', [StudentController::class, 'editStop'])->name('students.editStop');
    Route::post('/students/{student}/update-stop', [StudentController::class, 'updateAssignedStop'])->name('students.updateStop');

    Route::get('/locations/{busId}', [BusController::class, 'locations'])->name('locations');
    Route::get('/track-buses', [BusController::class, 'trackBuses'])->name('track-buses.index');
});

// Include Authentication Routes
require __DIR__ . '/auth.php';
