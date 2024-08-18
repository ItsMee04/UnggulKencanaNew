<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Employee\EmployeeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
})->middleware('checkLogin');

Route::get('login', [AuthController::class, 'index'])->name('login')->middleware('checkLogin');
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index']);

    Route::get('employee', [EmployeeController::class, 'index']);
    Route::post('employee', [EmployeeController::class, 'store']);
    Route::post('employee/{id}', [EmployeeController::class, 'update']);
    Route::get('delete-employee/{id}', [EmployeeController::class, 'delete']);

    Route::get('logout', [AuthController::class, 'logout']);
});
