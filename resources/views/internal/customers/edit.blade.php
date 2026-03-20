@extends('layouts.internal')

@push('styles')
@endpush

@section('content')

<div class="page-header">

    <a href="{{ route('internal.customers') }}" class="back-link">
        ← Back
    </a>

    <div>
        <h1 class="page-title">Edit Customer</h1>
        <p class="page-subtitle">Update customer data</p>
    </div>

</div>

<form method="POST" action="/internal/customers/{{ $customer->customer_id }}">
    @csrf
    @method('PUT')

   <div class="form-grid">

    <!-- NAME -->
    <div>
        <label>Customer Name *</label>
        <input type="text" name="customer_name" value="{{ $customer->customer_name }}">
    </div>

    <!-- EMAIL -->
    <div>
        <label>Email</label>
        <input type="email" name="email" value="{{ $customer->email }}">
    </div>

    <!-- PHONE -->
    <div>
        <label>Phone</label>
        <input type="text" name="phone_number" value="{{ $customer->phone_number }}">
    </div>

    <!-- TYPE -->
    <div>
        <label>Customer Type</label>
        <select name="customer_type_id">
                <option value="1">Personal</option>
                <option value="2">Business</option>
                <option value="3">Partner</option>
        </select>
    </div>

    <!-- PASSWORD -->
    <div>
        <label>Password (optional)</label>
        <input type="password" name="password">
    </div>

    <!-- CONFIRM -->
    <div>
        <label>Confirm Password</label>
        <input type="password" name="password_confirmation">
    </div>

    <!-- STATUS -->
    <div>
        <label>Status</label>
        <select name="status">
            <option value="ACTIVE" {{ $customer->status == 'ACTIVE' ? 'selected' : '' }}>Active</option>
            <option value="INACTIVE" {{ $customer->status == 'INACTIVE' ? 'selected' : '' }}>Inactive</option>
        </select>
    </div>

    <!-- NOTES -->
    <div class="full-width">
        <label>Notes</label>
        <textarea name="notes">{{ $customer->notes }}</textarea>
    </div>

</div>
    <div class="form-actions">

        <a href="#" class="btn-cancel">Cancel</a>
        
        <button type="submit" class="btn-primary">
            Save Data
        </button>
    </div>

</form>

@endsection