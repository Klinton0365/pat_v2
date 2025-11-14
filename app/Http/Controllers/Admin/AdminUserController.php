<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminUserController extends Controller
{
    public function index()
    {
        $customers = Customer::with('user')->latest()->paginate(10);

        return view('admin.customers.index', compact('customers'));
    }

    public function create()
    {
        return view('admin.customers.create');
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $request->validate([
                'first_name' => 'required|string|max:100',
                'email' => 'required|email|unique:users,email',
                'customer_type' => 'required',
            ]);

            // Create User
            $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'city' => $request->city,
                'state' => $request->state,
                'zip' => $request->zip,
                'country' => $request->country,
            ]);

            // Create Customer
            Customer::create([
                'user_id' => $user->id,
                'customer_code' => 'CUST-'.str_pad($user->id, 5, '0', STR_PAD_LEFT),
                'customer_type' => $request->customer_type,
                'company_name' => $request->company_name,
                'gst_number' => $request->gst_number,
            ]);

            DB::commit();

            return redirect()->route('admin.customers.index')
                ->with('success', 'Customer created successfully ✅');

        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with('error', $e->getMessage());
        }
    }

    public function edit($id)
    {
        $customer = Customer::with('user')->findOrFail($id);

        return view('admin.customers.edit', compact('customer'));
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            $customer = Customer::findOrFail($id);
            $user = $customer->user;

            $request->validate([
                'first_name' => 'required|string|max:100',
                'email' => 'required|email|unique:users,email,'.$user->id,
            ]);

            // Update User
            $user->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'city' => $request->city,
                'state' => $request->state,
                'zip' => $request->zip,
                'country' => $request->country,
            ]);

            // Update Customer
            $customer->update([
                'customer_type' => $request->customer_type,
                'company_name' => $request->company_name,
                'gst_number' => $request->gst_number,
                'status' => $request->status,
                'credit_limit' => $request->credit_limit,
            ]);

            DB::commit();

            return redirect()->route('admin.customers.index')
                ->with('success', 'Customer updated successfully ✅');

        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with('error', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        Customer::findOrFail($id)->delete();

        return redirect()->route('admin.customers.index')->with('success', 'Customer deleted successfully ❌');
    }
}
