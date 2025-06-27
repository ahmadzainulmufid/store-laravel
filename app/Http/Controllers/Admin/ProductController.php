<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = Product::with(['user', 'category']);
    
            return Datatables::of($query)
                ->addColumn('user_name', function ($item) {
                    return $item->user->name ?? '-';
                })
                ->addColumn('category_name', function ($item) {
                    return $item->category->name ?? '-';
                })
                ->editColumn('price', function ($item) {
                    return 'Rp ' . number_format($item->price, 0, ',', '.');
                })
                ->addColumn('action', function ($item) {
                    return '
                        <div class="btn-group">
                            <div class="dropdown">
                                <button class="btn btn-primary btn-sm dropdown-toggle"
                                    type="button" id="action' . $item->id . '"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Aksi
                                </button>
                                <div class="dropdown-menu" aria-labelledby="action' . $item->id . '">
                                    <a class="dropdown-item" href="' . route('admin.product.edit', $item->id) . '">Sunting</a>
                                    <form action="' . route('admin.product.destroy', $item->id) . '" method="POST">
                                        ' . method_field('delete') . csrf_field() . '
                                        <button type="submit" class="dropdown-item text-danger">Hapus</button>
                                    </form>
                                </div>
                            </div>
                        </div>';
                })
                ->rawColumns(['action'])
                ->make();
        }
    
        return view('pages.admin.product.index');
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        $categories = Category::all();

        return view('pages.admin.product.create', [
            'users' => $users,
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $data = $request->all();

        $data['slug'] = Str::slug($request->name);
        Product::create($data);

        return redirect()->route('admin.product.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item = Product::findOrFail($id);
        $users = User::all();
        $categories = Category::all();

        return view('pages.admin.product.edit', [
            'item' => $item,
            'users' => $users,
            'categories' => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, string $id)
    {
        $data = $request->all();

        $item = Product::findOrFail($id);

        $data['slug'] = Str::slug($request->name);

        $item->update($data);

        return redirect()->route('admin.product.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Product::findOrFail($id);
        $item->delete();

        return redirect()->route('admin.product.index');
    }
}
