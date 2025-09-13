<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Inventory;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
    // dd($request->all());
    // ✅ Validate inputs
    // $request->validate([
    //     'category_id' => 'required|exists:categories,id',
    //     'name' => 'required|string|max:255',
    //     'slug' => 'required|string|max:255|unique:products,slug',
    //     'price' => 'required|numeric',
    //     'discount' => 'nullable|numeric|min:0|max:100',
    //     'warranty_months' => 'nullable|integer',
    //     'colors' => 'nullable|array',
    //     'stock' => 'required|integer|min:0',
    //     'sku' => 'nullable|string|max:100|unique:products,sku',
    //     'main_image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
    //     'product_images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
    // ]);

    // ✅ Save main image
    $mainImagePath = $request->file('main_image')->store('products/main', 'public');

    // ✅ Save gallery images
    $productImages = [];
    if ($request->hasFile('product_images')) {
        foreach ($request->file('product_images') as $file) {
            $productImages[] = $file->store('products/gallery', 'public');
        }
    }

    // ✅ Create product
    $product = Product::create([
    'category_id'   => $request->category_id,
    'name'          => $request->name,
    'slug'          => $request->slug,
    'description'   => $request->description,
    'price'         => $request->price,
    'discount'      => $request->discount ?? 0,
    'warranty_months' => $request->warranty_months,
    'main_image'    => $mainImagePath,
    'product_images'=> json_encode($productImages),
    'colors'        => json_encode($request->colors),
    'stock'         => $request->stock ?? 0,
    'sku'           => $request->sku,
    'is_published'  => $request->has('is_published') ? 1 : 0,
    'publish_home'  => $request->has('publish_home') ? 1 : 0,
    'featured'      => $request->has('featured') ? 1 : 0,
    'rating'        => $request->rating ?? 0,
]);


    return redirect()->route('products.index')->with('success', 'Product created successfully.');
}


    // public function edit(Product $product)
    // {
    //     $categories = Category::all();
    //     return view('admin.products.edit', compact('product', 'categories'));
    // }

    public function edit(Product $product)
{
    $categories = Category::all();

    // decode JSON fields before sending to view
    $product->colors = json_decode($product->colors, true) ?? [];
    $product->product_images = json_decode($product->product_images, true) ?? [];

    return view('admin.products.edit', compact('product', 'categories'));
}



    public function update(Request $request, Product $product)
{
    $request->validate([
        'category_id' => 'required|exists:categories,id',
        'name' => 'required|string|max:255',
        'slug' => 'required|string|max:255|unique:products,slug,' . $product->id,
        'price' => 'required|numeric',
        'discount' => 'nullable|numeric|min:0|max:100',
        'warranty_months' => 'nullable|integer',
        'stock' => 'required|integer|min:0',
        'sku' => 'nullable|string|max:100|unique:products,sku,' . $product->id,
        'main_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        'product_images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
    ]);

    // Replace main image if new uploaded
    if ($request->hasFile('main_image')) {
        if ($product->main_image && Storage::disk('public')->exists($product->main_image)) {
            Storage::disk('public')->delete($product->main_image);
        }
        $product->main_image = $request->file('main_image')->store('products/main', 'public');
    }

    // Add new gallery images
    if ($request->hasFile('product_images')) {
        $newImages = [];
        foreach ($request->file('product_images') as $file) {
            $newImages[] = $file->store('products/gallery', 'public');
        }
        $product->product_images = array_merge($product->product_images ?? [], $newImages);
    }

    $product->update([
        'category_id' => $request->category_id,
        'name' => $request->name,
        'slug' => Str::slug($request->slug ?: $request->name),
        'description' => $request->description,
        'price' => $request->price,
        'discount' => $request->discount ?? 0.00,
        'warranty_months' => $request->warranty_months,
        'main_image' => $product->main_image,
        'product_images' => $product->product_images,
        'stock' => $request->stock,
        'sku' => $request->sku,
        'is_published' => $request->has('is_published') ? 1 : 0,
        'publish_home' => $request->has('publish_home') ? 1 : 0,
        'featured' => $request->has('featured') ? 1 : 0,
    ]);

    return redirect()->route('products.index')->with('success', 'Product updated successfully.');
}


    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully');
    }
}
