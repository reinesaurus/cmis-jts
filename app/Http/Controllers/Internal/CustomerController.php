<?php

namespace App\Http\Controllers\Internal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Customer;
use App\Models\CustomerType;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $customers = Customer::with(['user', 'membershipTier'])->where('status', 'ACTIVE')
            ->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'LIKE', '%' . $request->search . '%')
                    ->orWhere('email', 'LIKE', '%' . $request->search . '%');
            })
            ->withCount('transactions')
            ->get();

        return view('internal.customers.index', compact('customers'));
    }

    public function export()
    {
        $customers = Customer::all();

        return response()->streamDownload(function () use ($customers) {

            $file = fopen('php://output', 'w');

            fputcsv($file, ['ID', 'Name', 'Email', 'Phone']);

            foreach ($customers as $c) {
                fputcsv($file, [
                    $c->customer_code,
                    $c->customer_name,
                    $c->email,
                    $c->phone_number
                ]);
            }

            fclose($file);
        }, 'customers.csv');
    }

    public function show($id)
    {
        $customer = Customer::findOrFail($id);

        $totalTransactions = Transaction::where(
            'customer_id',
            $customer->customer_id
        )->count();

        return view('internal.customers.show', compact(
            'customer',
            'totalTransactions'
        ));
    }

    public function create()
    {
        $customerTypes = CustomerType::all();

        return view('internal.customers.create', [
            'customerTypes' => $customerTypes
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required',
            'customer_type_id' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6'
        ]);

        DB::transaction(function () use ($request) {
            $user = User::create([
                'name' => $request->customer_name,
                'email' => $request->email,
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make($request->password),
                'role' => 'CUSTOMER',
                'remember_token' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);

            $customer = Customer::create([
                'user_id' => $user->id,
                'customer_type_id' => $request->customer_type_id,
                'phone_number' => $request->phone_number,
                'notes' => $request->notes,
                'membership_tier_id' => 1,
                'status' => 'ACTIVE',
                'points_balance' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);

            $customer->update([
                'customer_code' => 'CU' . $customer->id,
            ]);
        });

        return redirect('/internal/customers')->with('success', 'Customer created successfully');
    }

    public function edit($id)
    {
        $customer = Customer::findOrFail($id);
        $customerTypes = CustomerType::all();
        return view('internal.customers.edit', compact('customer', 'customerTypes'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'customer_name' => 'required',
            'email' => 'required|email',
            'customer_type_id' => 'required'
        ]);

        DB::transaction(function () use ($request, $id) {

            $customer = Customer::findOrFail($id);

            $user = User::findOrFail($customer->user_id);

            $dataUpdateUser = [
                'name' => $request->customer_name,
                'email' => $request->email,
            ];

            if ($request->password) {
                $dataUpdateUser['password'] = Hash::make($request->password);
            }

            $user->update($dataUpdateUser);

            $dataUpdateCustomer = [
                'phone_number' => $request->phone_number,
                'customer_type_id' => $request->customer_type_id,
                'notes' => $request->notes,
                'status' => $request->status
            ];

            $customer->update($dataUpdateCustomer);
        });

        if ($request->status == 'ACTIVE') {
            return redirect('/internal/customers/' . $id)
                ->with('success', 'Customer updated successfully');
        } else {
            return redirect('/internal/customers')
                ->with('success', 'Customer updated successfully');
        }
    }
}
