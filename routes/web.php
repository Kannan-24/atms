<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AccountSettingsController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\BusController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ParentsController;
use App\Http\Controllers\BatchesController;
use App\Http\Controllers\ClassesController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\StopController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AttendanceController;
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

    Route::get('/departments/import', [DepartmentController::class, 'importForm'])->name('departments.import.form');
    Route::post('/departments/import', [DepartmentController::class, 'import'])->name('departments.import');
    Route::resource('departments', DepartmentController::class);

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
    Route::get('/students/import', [StudentController::class, 'showImportForm'])->name('students.import.form');
    Route::post('/students/import', [StudentController::class, 'import'])->name('students.import');
    Route::resource('students', StudentController::class);
    Route::get('/students/{student}/assign-stops', [StudentController::class, 'assignStops'])->name('students.assignStops');
    Route::put('/students/{student}/assign-stops', [StudentController::class, 'updateAssignedStop'])->name('students.assignStops.update');
    Route::get('/students/{student}/edit-stop', [StudentController::class, 'editStop'])->name('students.editStop');
    Route::post('/students/{student}/update-stop', [StudentController::class, 'updateAssignedStop'])->name('students.updateStop');

    Route::get('/locations/{busId}', [BusController::class, 'locations'])->name('locations');
    Route::get('/track-buses', [BusController::class, 'trackBuses'])->name('track-buses.index');
    Route::get('/track-bus/{bus}', [BusController::class, 'track'])->name('trackBus.track');


    // Route Stops
    Route::get('/busroutes/{route}/assignStops', [RouteController::class, 'assignStops'])->name('busroutes.assignStops');
    Route::post('/busroutes/{route}/storeAssignedStops', [RouteController::class, 'storeAssignedStops'])->name('busroutes.storeAssignedStops');

    // Batch Routes
    Route::get('/batches/import', [BatchesController::class, 'importForm'])->name('batches.import.form');
    Route::post('/batches/import', [BatchesController::class, 'import'])->name('batches.import');

    Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance.index');
    Route::get('/attendance/{bus_id}', [AttendanceController::class, 'show'])->name('attendance.show');


    Route::resource('batches', BatchesController::class);
    Route::resource('classes', ClassesController::class);
    Route::resource('parents', ParentsController::class);
    Route::resource('buses', BusController::class);
    Route::resource('busroutes', RouteController::class);
    Route::resource('stops', StopController::class);
    Route::resource('reports', ReportController::class);
});


// Include Authentication Routes
require __DIR__ . '/auth.php';
