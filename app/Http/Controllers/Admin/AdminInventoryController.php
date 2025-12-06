<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\InventoryStock;
use App\Models\InventoryBatch;
use App\Models\InventoryMovement;
use Illuminate\Http\Request;
use DB;

class AdminInventoryController extends Controller
{
    public function index()
    {
        $stocks = InventoryStock::with('product')->get();

        return view('admin.inventory.index', compact('stocks'));
    }

    public function create()
    {
        $products = Product::all();

        return view('admin.inventory.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'quantity' => 'required|integer|min:1',
            'purchase_price' => 'required|numeric|min:1',
            'supplier_name' => 'nullable|string',
        ]);

        DB::beginTransaction();

        try {

            /** Create batch */
            $batch = InventoryBatch::create([
                'product_id' => $request->product_id,
                'batch_no' => 'BATCH-' . strtoupper(uniqid()),
                'quantity' => $request->quantity,
                'remaining_quantity' => $request->quantity,
                'purchase_price' => $request->purchase_price,
                'arrival_date' => now(),
                'supplier_name' => $request->supplier_name
            ]);

            /** Update stock */
            $stock = InventoryStock::firstOrCreate(
                ['product_id' => $request->product_id],
                ['total_stock' => 0, 'reserved_stock' => 0, 'available_stock' => 0]
            );

            $stock->total_stock += $request->quantity;
            $stock->available_stock += $request->quantity;
            $stock->save();

            /** Log movement */
            InventoryMovement::create([
                'product_id' => $request->product_id,
                'batch_id' => $batch->id,
                'type' => 'in',
                'quantity' => $request->quantity,
                'cost_price' => $request->purchase_price,
                'reference_type' => 'manual',
                'notes' => 'Stock added manually by admin'
            ]);

            DB::commit();
            return redirect()->route('inventories.index')->with('success', 'Stock added successfully.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }

    public function logs(Product $product)
    {
        $logs = InventoryMovement::where('product_id', $product->id)
            ->with('batch')
            ->orderBy('id', 'desc')
            ->get();

        return view('admin.inventory.logs', compact('product', 'logs'));
    }
}
