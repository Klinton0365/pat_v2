<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Inventory;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->latest()->get();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'category_id' => 'required|exists:categories,id',
    //         'name' => 'required|string|max:255',
    //         'price' => 'required|numeric',
    //     ]);
    //     Product::create($request->all());
    //     return redirect()->route('products.index')->with('success', 'Product created successfully');
    // }

    public function store(Request $request)
    {
        // $request->validate([
        //     'category_id' => 'required|exists:categories,id',
        //     'name' => 'required|string|max:255',
        //     'price' => 'required|numeric',
        //     'main_image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        //     'product_images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        // ]);

        $mainImagePath = null;
        if ($request->hasFile('main_image')) {
            $mainImagePath = $request->file('main_image')->store('products/main', 'public');
        }

        $productImages = [];
        if ($request->hasFile('product_images')) {
            foreach ($request->file('product_images') as $file) {
                $productImages[] = $file->store('products/gallery', 'public');
            }
        }

        Product::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'warranty_months' => $request->warranty_months,
            'main_image' => $mainImagePath,
            'product_images' => json_encode($productImages),
        ]);

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }


    // public function update(Request $request, Product $product)
    // {
    //     $request->validate([
    //         'category_id' => 'required|exists:categories,id',
    //         'name' => 'required|string|max:255',
    //         'price' => 'required|numeric',
    //     ]);

    //     $product->update($request->all());
    //     return redirect()->route('products.index')->with('success', 'Product updated successfully');
    // }

    public function update(Request $request, Product $product)
{
    // dd($request->all(), $product);
    // $request->validate([
    //     'category_id' => 'required|exists:categories,id',
    //     'name' => 'required|string|max:255',
    //     'price' => 'required|numeric',
    //     'main_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
    //     'product_images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
    // ]);

    // If new main image uploaded
    if ($request->hasFile('main_image')) {
        // Optionally delete old image from storage
        if ($product->main_image && Storage::disk('public')->exists($product->main_image)) {
            Storage::disk('public')->delete($product->main_image);
        }
        $product->main_image = $request->file('main_image')->store('products/main', 'public');
    }

    // If new product images uploaded
    if ($request->hasFile('product_images')) {
        $newImages = [];
        foreach ($request->file('product_images') as $file) {
            $newImages[] = $file->store('products/gallery', 'public');
        }

        // merge old + new images (optional)
        $oldImages = $product->product_images ?? [];
        $product->product_images = json_encode(array_merge($oldImages, $newImages));
    }

    // Update other fields
    $product->update([
        'category_id' => $request->category_id,
        'name' => $request->name,
        'description' => $request->description,
        'price' => $request->price,
        'warranty_months' => $request->warranty_months,
        'main_image' => $product->main_image,
        'product_images' => $product->product_images,
    ]);

    return redirect()->route('products.index')->with('success', 'Product updated successfully.');
}



    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully');
    }
}
