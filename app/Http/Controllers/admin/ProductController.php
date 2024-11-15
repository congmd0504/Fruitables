<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Product $product)
    {
        $products = Product::with('category', 'tags')->paginate(5);
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.products.index', compact('products', 'categories', 'tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.products.add', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function updateFile(Request $request, $filename)
    {
        if ($request->hasFile($filename)) {
            return $request->file($filename)->store('products');
        }
        return "";
    }
    public function store(PostProductRequest $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $data = $request->all();
                $data['image'] = $this->updateFile($request, 'image');
                $product = Product::create($data);
                $product->tags()->attach($request->tags);
            });
            return back()->with('success', 'Thêm mới sản phẩm thành công!');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        try {
            DB::transaction(function () use ($request, $product) {
                $data = $request->all();
                if ($request->hasFile('image')) {
                    $data['image'] = $this->updateFile($request, 'image');
                    Storage::delete($product->image);
                }
                $product->update($data);
                $tags = $request->input('tags', []);
                 $product->tags()->sync($tags);

            });
            return back()->with('success', 'Cập nhập sản phẩm thành công!');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        $product->tags()->sync([]);
        return back()->with('success', 'Xóa sản phẩm thành công!');
    }
}
