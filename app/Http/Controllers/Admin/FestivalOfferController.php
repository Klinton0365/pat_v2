<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FestivalOffer;
use App\Models\Product;
use Illuminate\Http\Request;

class FestivalOfferController extends Controller
{
    public function index()
    {
        $offers = FestivalOffer::with('product')->latest()->get();

        return view('admin.festival_offers.index', compact('offers'));
    }

    public function create()
    {
        $products = Product::whereDoesntHave('festivalOffer')->get();

        return view('admin.festival_offers.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|unique:festival_offers',
            'title' => 'required',
            'slug' => 'required|unique:festival_offers',
            'is_percentage' => 'required|boolean',
        ]);

        FestivalOffer::create($request->all());

        return redirect()->route('admin.festival-offers.index')
            ->with('success', 'Festival Offer added!');
    }

    public function update(Request $request, FestivalOffer $festivalOffer)
    {
        $request->validate([
            'title' => 'required',
            'slug' => 'required|unique:festival_offers,slug,'.$festivalOffer->id,
            'is_percentage' => 'required|boolean',
        ]);

        $festivalOffer->update($request->all());

        return redirect()->route('admin.festival-offers.index')
            ->with('success', 'Updated successfully!');
    }

    public function edit(FestivalOffer $festivalOffer)
    {
        $products = Product::all();

        return view('admin.festival_offers.edit', compact('festivalOffer', 'products'));
    }

    public function destroy(FestivalOffer $festivalOffer)
    {
        $festivalOffer->delete();

        return back()->with('success', 'Offer deleted!');
    }
}
