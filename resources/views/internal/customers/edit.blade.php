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

    <form id="editCustomerForm" method="POST" action="/internal/customers/{{ $customer->id }}">
        @csrf

        <div class="form-grid">

            <!-- NAME -->
            <div>
                <label>Customer Name *</label>
                <input type="text" name="customer_name" value="{{ $customer->user->name }}">
            </div>

            <!-- EMAIL -->
            <div>
                <label>Email</label>
                <input type="email" name="email" value="{{ $customer->user->email }}">
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
                    @foreach ($customerTypes as $type)
                        <option value="{{ $type->id }}" @if ($type->id == $customer->customer_type_id) selected @endif>
                            {{ $type->type_name }}</option>
                    @endforeach
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('editCustomerForm');
            const submitBtn = form.querySelector('.btn-primary');

            // 1. Ambil data awal form saat halaman pertama kali dibuka
            const initialData = new FormData(form);
            const initialState = {};
            for (let [key, value] of initialData.entries()) {
                initialState[key] = value;
            }

            // Fungsi untuk cek apakah ada perubahan
            function hasChanged() {
                const currentData = new FormData(form);
                for (let [key, value] of currentData.entries()) {
                    // Kita abaikan pengecekan password jika kosong (karena opsional)
                    if (key === 'password' || key === 'password_confirmation') {
                        if (value !== "") return true;
                        continue;
                    }

                    if (initialState[key] !== value) {
                        return true; // Ada perbedaan!
                    }
                }
                return false; // Identik
            }

            // 2. Tambahkan event listener untuk mematikan/menghidupkan tombol (Opsional tapi User Friendly)
            form.addEventListener('input', () => {
                if (hasChanged()) {
                    submitBtn.disabled = false;
                    submitBtn.style.opacity = "1";
                } else {
                    submitBtn.disabled = true;
                    submitBtn.style.opacity = "0.5";
                }
            });

            // 3. Validasi saat Submit
            form.addEventListener('submit', function(e) {
                if (!hasChanged()) {
                    e.preventDefault();
                    alert("Tidak ada perubahan data yang dideteksi.");
                }
            });

            // Set kondisi awal tombol saat load
            submitBtn.disabled = true;
            submitBtn.style.opacity = "0.5";
        });
    </script>
@endsection
