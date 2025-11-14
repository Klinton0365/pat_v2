<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Order;
use App\Models\Technician;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminServiceController extends Controller
{
    public function index()
    {
        $services = Service::with(['customer', 'product', 'technician'])
            ->latest()
            ->paginate(20);

        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.create', [
            'customers' => Customer::all(),
            'products' => Product::all(),
            'orders' => Order::all(),
            'technicians' => Technician::all(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required',
            'issue_type' => 'required',
        ]);

        $service = Service::create([
            'customer_id' => $request->customer_id,
            'order_id' => $request->order_id,
            'product_id' => $request->product_id,
            'service_code' => 'SRV-' . Str::upper(Str::random(8)),
            'source_type' => $request->source_type ?? 'internal',
            'external_product_name' => $request->external_product_name,
            'issue_type' => $request->issue_type,
            'problem_description' => $request->problem_description,
            'scheduled_date' => $request->scheduled_date,
            'next_service_date' => $request->next_service_date,
        ]);

        return redirect()->route('admin.services.index')
            ->with('success', 'Service created successfully!');
    }

    public function edit(Service $service)
    {
        return view('admin.services.edit', [
            'service' => $service,
            'customers' => Customer::all(),
            'products' => Product::all(),
            'orders' => Order::all(),
            'technicians' => Technician::all(),
        ]);
    }

    public function update(Request $request, Service $service)
    {
        $service->update($request->all());

        return redirect()->route('admin.services.index')
            ->with('success', 'Service updated successfully!');
    }

    public function destroy(Service $service)
    {
        $service->delete();

        return redirect()->route('admin.services.index')
            ->with('success', 'Service deleted!');
    }

    /** Assign Technician */
    public function assignTechnician(Request $request, Service $service)
    {
        $service->update([
            'technician_id' => $request->technician_id,
            'status' => 'in_progress',
        ]);

        return back()->with('success', 'Technician Assigned!');
    }

    /** Update Status */
    public function updateStatus(Request $request, Service $service)
    {
        $service->update([
            'status' => $request->status,
            'completed_at' => $request->status == 'completed' ? now() : null,
        ]);

        return back()->with('success', 'Service status updated!');
    }
}
