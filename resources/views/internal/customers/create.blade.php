@extends('layouts.internal')

@push('styles')
@endpush

@section('content')

<div class="page-header">

    <a href="{{ route('internal.customers') }}" class="back-link">
        ← Back
    </a>

    <div>
        <h1 class="page-title">New Customer Data</h1>
        <p class="page-subtitle">Input new customer data for membership management</p>
    </div>
</div>

<form method="POST" action="/internal/customers" class="form-container">

    @csrf

    <div class="form-grid">

        <div class="form-group">
            <label class="form-label">
                Customer Name <span class="required">*</span>
            </label>

            <input 
            type="text"
            name="customer_name"
            placeholder="Enter customer name"
            value="{{ old('customer_name') }}"
            required
            >

            @error('customer_name')
            <p class="form-error">{{ $message }}</p>
            @enderror

        </div>

        <div class="form-group">
            <label class="form-label">
                Customer Type <span class="required">*</span>
            </label>

            <select name="customer_type_id" required>
                <option value="">Select Type</option>
                @foreach ($customerTypes as $type)
                    <option value="{{ $type->id }}">{{ $type->type_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label class="form-label">
                Email <span class="required">*</span>
            </label>

            <input
            type="email"
            name="email"
            placeholder="customer@email.com"
            value="{{ old('email') }}"
            required
            >

            @error('email')
            <p class="form-error">{{ $message }}</p>
            @enderror

        </div>

        <div class="form-group">
            <label class="form-label">
                Phone Number
            </label>

            <input
            type="text"
            name="phone_number"
            placeholder="08xxxxxxxxxx"
            value="{{ old('phone_number') }}"
            >

        </div>

        <div class="form-group">
            <label class="form-label">
                Password <span class="required">*</span>
            </label>

            <input
            type="password"
            name="password"
            placeholder="Enter password"
            required
            >

        </div>

        <div class="form-group">
            <label class="form-label">
                Confirm Password <span class="required">*</span>
            </label>

            <input
            type="password"
            name="password_confirmation"
            placeholder="Confirm password"
            required
            >

        </div>

        <div class="form-group full-width">
            <label class="form-label">Notes</label>

            <textarea
            name="notes"
            placeholder="Additional notes about customer"
            ></textarea>

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