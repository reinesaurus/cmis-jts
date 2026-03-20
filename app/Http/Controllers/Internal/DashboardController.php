<?php

namespace App\Http\Controllers\Internal;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Transaction;
use App\Models\RedemptionRequest;
    

class DashboardController extends Controller
{
    public function index()
    {
        $totalCustomers = Customer::count();

        $todayTransactions = Transaction::whereDate(
            'created_at', today()
        )->count();

        $pendingRedeem = RedemptionRequest::where(
            'status', 'PENDING'
        )->count();

        $redeemedRewards = RedemptionRequest::where(
            'status', 'APPROVED'
        )->count();

        return view('internal.dashboard', compact(
            'totalCustomers',
            'todayTransactions',
            'pendingRedeem',
            'redeemedRewards'
        ));
    }
}