<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Internal\DashboardController;
use App\Http\Controllers\Internal\CustomerController;
use App\Http\Controllers\Internal\TransactionController;

//Login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);


//Customer FRONT//
Route::prefix('customer')->group(function () {

    Route::get('/home', function () {
        return view('customer.home');
    });

    Route::get('/rewards', function () {
        return view('customer.rewards');
    });

    Route::get('/redeem', function () {
        return view('customer.redeem');
    });

    Route::get('/profile', function () {
        return view('customer.profile');
    });

});


//Internal FRONT//
Route::middleware(['auth'])->prefix('internal')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('internal.dashboard');

    // Transactions
    Route::prefix('transactions')->group(function () {

        Route::get('/', [TransactionController::class, 'index'])
            ->name('internal.transactions');

        Route::get('/create', [TransactionController::class, 'create'])
            ->name('internal.transactions.create'); // 🔥 INI YANG KURANG

        Route::post('/', [TransactionController::class, 'store'])
            ->name('internal.transactions.store');

    });

    //Customers
    Route::prefix('customers')->group(function () {

        Route::get('/', [CustomerController::class,'index'])
            ->name('internal.customers');

        Route::get('/create', [CustomerController::class,'create'])
            ->name('internal.customers.create');

        Route::post('/', [CustomerController::class,'store'])
            ->name('internal.customers.store');

        Route::get('/export', [CustomerController::class,'export'])
            ->name('internal.customers.export');

        Route::get('/{id}', [CustomerController::class,'show'])
            ->name('internal.customers.show'); 

        Route::get('/{id}/edit', [CustomerController::class,'edit'])
            ->name('internal.customers.edit');

        Route::post('/{id}', [CustomerController::class,'update'])
            ->name('internal.customers.update');
    });


    //Rewards
    Route::get('/rewards', function () {
        return view('internal.rewards.index');
    })->name('internal.rewards');


    //Redemption
    Route::get('/redemption', function () {
        return view('internal.redemption.index');
    })->name('internal.redemption');

});


//Log out
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
});