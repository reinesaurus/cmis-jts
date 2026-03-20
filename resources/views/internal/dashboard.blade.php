@extends('layouts.internal')

@section('content')

<h2 class="page-title">Dashboard</h2>

<h3>Data overview</h3>

<div class="stats-grid">

    <div class="stat-card">
        <p>Total Customers</p>
        <h2>{{ $totalCustomers }}</h2>
    </div>

    <div class="stat-card">
        <p>Customer Transactions Today</p>
        <h2>{{ $todayTransactions }}</h2>
    </div>

    <div class="stat-card">
        <p>Redeem Pending</p>
        <h2>{{ $pendingRedeem }}</h2>
    </div>

    <div class="stat-card">
        <p>Rewards Redeemed</p>
        <h2>{{ $redeemedRewards }}</h2>
    </div>

</div>


<h3 style="margin-top:30px;">Quick Actions</h3>

<div class="quick-actions">

<a href="/internal/transactions/create" class="btn-primary">
Add Customer Transaction
</a>

<a href="/internal/customers/create" class="btn-secondary">
Add New Customer
</a>

</div>

@endsection