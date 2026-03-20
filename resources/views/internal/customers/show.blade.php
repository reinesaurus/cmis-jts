@extends('layouts.internal')

@push('styles')
@endpush

@section('content')

<div class="page-header">

    <a href="{{ route('internal.customers') }}" class="back-link">
        ← Back
    </a>

    <div>
        <h1 class="page-title">Customer Details</h1>
        <p class="page-subtitle">Detail information</p>
    </div>
</div>

<div class="card detail-card">

    <div class="card detail-card">

    <div class="detail-row">
        <span>Customer Code</span>
        <strong>{{ $customer->customer_code }}</strong>
    </div>

    <div class="detail-row">
        <span>Name</span>
        <strong>{{ $customer->user->name }}</strong>
    </div>

    <div class="detail-row">
        <span>Customer Type</span>
        <strong>{{ $customer->customer_type_name }}</strong>
    </div>

    <div class="detail-row">
        <span>Email</span>
        <strong>{{ $customer->user->email }}</strong>
    </div>

    <div class="detail-row">
        <span>Phone</span>
        <strong>{{ $customer->phone_number }}</strong>
    </div>

    <div class="detail-row">
        <span>Membership Tier</span>
        <strong>{{ $customer->membershipTier->tier_name ?? '-' }}</strong>
    </div>

    <div class="detail-row">
        <span>Points</span>
        <strong>{{ $customer->points_balance }}</strong>
    </div>

    <div class="detail-row">
        <span>Status</span>
        <strong>{{ $customer->status }}</strong>
    </div>

</div>

@endsection