<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Admin\ProductRequest;
use App\Models\ProductGallery;
use Illuminate\Support\Str;

class DashboardProductController extends Controller
{
    public function index() 
    {
        $products = Product::with(['galleries', 'category'])->where('users_id', Auth::user()->id)->get();
        return view('pages.dashboard-products', [
            'products' => $products
        ]);
    }

    public function details(Request $request, $id) 
    {
        $product = Product::with((['galleries', 'user', 'category']))->findOrFail($id);
        $categories = Category::all();

        return view('pages.dashboard-products-details', [
            'product' => $product,
            'categories' => $categories
        ]);
    }

    public function uploadGallery(Request $request){
        $data = $request->all();

        $data['photo'] = $request->file('photo')->store('assets/product', 'public');

        ProductGallery::create($data);

        return redirect()->route('dashboard-product-details', $request->products_id);
    }

    public function deleteGallery(Request $request, $id){
        $item = ProductGallery::findOrFail($id);
        $item->delete();

        return redirect()->route('dashboard-product-details', $item->products_id); 
    }

    public function create() 
    {
        $categories = Category::all();
        return view('pages.dashboard-products-create', [
            'categories' => $categories
        ]);
    }

    public function store(ProductRequest $request)
    {
        $data = $request->all();

        $data['slug'] = Str::slug($request->name);

        $product = Product::create($data);

        $gallery = [
            'products_id' => $product->id,
            'photo' => $request->file('photo')->store('assets/product', 'public'),
        ];

        ProductGallery::create($gallery);

        return redirect()->route('dashboard-product');
        
    }

    public function update(ProductRequest $request, string $id){
        $data = $request->all();

        $item = Product::findOrFail($id);

        $data['slug'] = Str::slug($request->name);

        $item->update($data);

        return redirect()->route('dashboard-product');
    }

}
