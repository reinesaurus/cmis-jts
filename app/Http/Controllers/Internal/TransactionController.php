<?php

namespace App\Http\Controllers\Internal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with('customer')
            ->orderBy('transaction_date', 'desc')
            ->paginate(10);

        return view('internal.transactions.index', compact('transactions'));
    }

    public function create()
    {
        $customers = Customer::orderBy('customer_name')->get();

        return view('internal.transactions.create', compact('customers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,customer_id',
            'transaction_date' => 'required|date',
            'total_purchased' => 'required|numeric|min:0',
            'notes' => 'nullable|string'
        ]);

        // sementara points = 0 
        $points = 0;

        Transaction::create([
            'customer_id' => $request->customer_id,
            'transaction_date' => $request->transaction_date,
            'total_purchased' => $request->total_purchased,
            'points_earned' => $points,
            'created_by' => Auth::id(),
            'notes' => $request->notes,
        ]);

        return redirect()
            ->route('internal.transactions')
            ->with('success', 'Transaction berhasil dibuat');
    }
}