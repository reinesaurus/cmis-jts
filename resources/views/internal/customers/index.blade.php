@extends('layouts.internal')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/internal/customers.css') }}">
@endpush

@section('content')

<div class="page-header">
    <div>
        <h1 class="page-title">Customers</h1>
        <p class="page-subtitle">
            Customers who are eligible for membership reward
        </p>
    </div>

    <a href="/internal/customers/create" class="btn-primary">
        + Add Customer
    </a>
</div>

    <!-- SEARCH -->
    <div style="toolbar">
        <form method="GET" class="search-bar">
            <input type="text" name="search" placeholder="Search customer...">
            <button class="btn-secondary" type="submit">Search</button>
        </form>
    </div>

<div class="card">

    <!-- TABLE -->
    <div class="table-container">
        <table class="table">
    <thead>
        <tr>
            <th>Code</th>
            <th>Name</th>
            <th>Type</th>
            <th>Contact</th>
            <th>Tier</th>
            <th>Transactions</th>
            <th>Points</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($customers as $c)
        <tr>
            <td>{{ $c->customer_code }}</td>

            <td>{{ $c->customer_name }}</td>

            <td>{{ $c->customer_type_name }}</td>

            <td>
                {{ $c->email }}<br>
                <small>{{ $c->phone_number }}</small>
            </td>

            <td>
                {{ $c->membershipTier->name ?? '-' }}
            </td>

            <td>{{ $c->transactions_count }}</td>

            <td>{{ $c->points_balance }}</td>

            <td class="table-actions">
                <a href="{{ route('internal.customers.show', $c->customer_id) }}" class="link">View</a>
                <a href="{{ route('internal.customers.edit', $c->customer_id) }}" class="link">Edit</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
    </div>

</div>

@endsection