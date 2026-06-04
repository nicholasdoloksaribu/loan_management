<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);


Route::middleware('auth:admin')->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/', function () {
        Route::resource('users', UserController::class);
    });


    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::resource('currencies', CurrencyController::class);
    Route::resource('users', UserController::class);
    Route::resource('customers', CustomerController::class);
    Route::resource('loans', LoanController::class);
    Route::resource('payments', PaymentController::class);

    Route::get('/api/customers/{id}', [LoanController::class, 'getCustomer']);
    Route::get('/api/currencies/{id}', [LoanController::class, 'getCurrency']);
    Route::get('/api/loans/{id}', [PaymentController::class, 'getLoan']);

    Route::get('/reports/loan-list', [ReportController::class, 'loanList'])->name('reports.loan-list');
    Route::get('/reports/payment-list', [ReportController::class, 'paymentList'])->name('reports.payment-list');
    Route::get('/reports/outstanding-list', [ReportController::class, 'outstandingList'])->name('reports.outstanding-list');

    Route::get('/reports/loan-list/pdf', [ReportController::class, 'loanListPdf'])->name('reports.loan-list.pdf');
    Route::get('/reports/payment-list/pdf', [ReportController::class, 'paymentListPdf'])->name('reports.payment-list.pdf');
    Route::get('/reports/outstanding-list/pdf', [ReportController::class, 'outstandingListPdf'])->name('reports.outstanding-list.pdf');
});
