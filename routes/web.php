<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VaccinationController;
use App\Http\Controllers\PatientController;

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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home/vaccination/applicants', [App\Http\Controllers\HomeController::class, 'allApplications'])->name('allApplications');


Route::get('/vaccination/signup', [VaccinationController::class, 'create']);
Route::post('/vaccination/signup', [VaccinationController::class, 'store']);

Route::get('/vaccination/certificate/{id}', [VaccinationController::class, 'show'])->name('certificate');
