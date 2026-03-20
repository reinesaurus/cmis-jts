<?php

namespace App\Http\Controllers\Internal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Customer;
use App\Models\Transaction;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $query = Customer::query();

        if ($request->search) {
            $query->where('customer_name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
        }

        $customers = Customer::with(['membershipTier'])
            ->withCount('transactions') // 🔥 ini total transaksi
            ->paginate(10);

        return view('internal.customers.index', compact('customers'));
    }

    public function export()
    {
        $customers = Customer::all();

        return response()->streamDownload(function() use ($customers){

        $file = fopen('php://output','w');

        fputcsv($file,['ID','Name','Email','Phone']);

        foreach($customers as $c){
            fputcsv($file,[
                $c->customer_code,
                $c->customer_name,
                $c->email,
                $c->phone_number
            ]);
            }

            fclose($file);

        },'customers.csv');
    }

    public function show($id)
    {
        $customer = Customer::findOrFail($id);

        $totalTransactions = Transaction::where(
            'customer_id', $customer->customer_id
        )->count();

        return view('internal.customers.show', compact(
            'customer',
            'totalTransactions'
        ));
    }
    
    public function create()
    {
        return view('internal.customers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
        'customer_name' => 'required',
        'customer_type_id' => 'required',
        'email' => 'required|email|unique:customers',
        'password' => 'required|confirmed|min:6'
        ]);

        Customer::create([
        'customer_name' => $request->customer_name,
        'customer_type_id' => $request->customer_type_id,
        'email' => $request->email,
        'password_hash' => Hash::make($request->password),
        'phone_number' => $request->phone_number,
        'notes' => $request->notes,
        'status' => 'ACTIVE',
        'points_balance' => 0
        ]);


        return redirect('/internal/customers')
        ->with('success','Customer created successfully');

    }

    public function edit($id)
    {
        $customer = Customer::findOrFail($id);
        return view('internal.customers.edit', compact('customer'));
    }

    public function update(Request $request, $id)
    {
        $customer = Customer::findOrFail($id);

        $request->validate([
            'customer_name' => 'required',
            'email' => 'required|email',
            'customer_type_id' => 'required'
        ]);

        $data = [
            'customer_name' => $request->customer_name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'customer_type_id' => $request->customer_type_id,
            'notes' => $request->notes
        ];

        if ($request->password) {
            $data['password_hash'] = Hash::make($request->password);
        }

        $customer->update($data);

        return redirect('/internal/customers/'.$customer->customer_id)
        ->with('success','Customer updated successfully');
    }
}