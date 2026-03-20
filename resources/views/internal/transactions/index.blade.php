@extends('layouts.internal')

@section('content')

<div class="page-header">
    <div>
        <h1 class="page-title">Transactions</h1>
        <p class="page-subtitle">Manage customer transactions</p>
    </div>

    <a href="{{ route('internal.transactions.create') }}" class="btn-primary">
        + Add Transaction
    </a>
</div>

<div class="card">

    <div class="table-container">
        <table class="table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Customer</th>
                    <th>Total</th>
                    <th>Points</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($transactions as $trx)
                <tr>
                    <td>{{ $trx->transaction_date }}</td>
                    <td>{{ $trx->customer->customer_name }}</td>
                    <td>{{ $trx->total_purchased }}</td>
                    <td>{{ $trx->points_earned }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4">No data</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

@endsection