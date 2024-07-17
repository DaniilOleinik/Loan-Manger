<?php

use App\Livewire\LoanDashboard;
use App\Livewire\LoanDashboardStatistic;
use App\Livewire\Login;
use App\Livewire\Registration;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
   if (Auth::check()) {
       return redirect()->to('/loan/dashboard');
   }

   return redirect()->to('/login');
});

Route::get('/registration', Registration::class)->name('registration');
Route::get('/login', Login::class)->name('login');

Route::middleware('auth')->group(function () {
    Route::get('/loan/dashboard', LoanDashboard::class)->name('loan.dashboard');
    Route::get('/loan/dashboard/statistic', LoanDashboardStatistic::class)->name('loan.dashboard.statistic');
});
