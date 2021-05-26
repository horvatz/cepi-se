<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VaccinationController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AppointmentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/admin', [HomeController::class, 'index'])->name('admin');

Route::get('/admin/vaccination/applicants', [HomeController::class, 'allApplications'])->name('allApplications');
Route::get('/admin/vaccination/appointment/{id}', [AppointmentController::class, 'create'])->name('appointmentCreate')->middleware('auth');
Route::post('/admin/vaccination/appointment', [AppointmentController::class, 'store'])->name('appointmentStore')->middleware('auth');

Route::get('/admin/appointment/', [AppointmentController::class, 'index'])->name('allAppointments')->middleware('auth');
Route::get('/admin/appointment/{id}', [AppointmentController::class, 'show'])->name('singleAppointment');
Route::get('/admin/appointment/complete/{id}', [AppointmentController::class, 'complete'])->name('completeAppointment')->middleware('auth');
Route::get('/admin/appointment/delete/{id}', [AppointmentController::class, 'destroy'])->name('deleteAppointment')->middleware('auth');


Route::get('/admin/vaccination/people', [HomeController::class, 'allVaccinated'])->name('allVaccinated');


Route::get('/vaccination/signup', [VaccinationController::class, 'create']);
Route::post('/vaccination/signup', [VaccinationController::class, 'store']);

Route::get('/vaccination/certificate/{id}', [VaccinationController::class, 'show'])->name('certificate');
