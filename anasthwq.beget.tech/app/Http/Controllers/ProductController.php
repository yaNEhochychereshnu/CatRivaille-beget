<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin')->except(['index', 'show', 'filter']);
    }

    public function filter(Request $request)
    {
        $query = Product::where('qty', '>', 0);

    if($request->filter !== 'all') {
        $query->where('category_id', $request->filter);
    }

    $products = Product::where('qty', '>', 0)->where('category_id', $request->filter)->get();
    $categories = Category::all();

    return view('products.index', ['categories' => $categories, 'products' => $products]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        $categories = Category::all();
        return view('products.index', ['categories'=>$categories, 'products'=>$products]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('products.create', ['categories'=>$categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $img = $request->img;
        $imgName = $img->getClientOriginalName();
        $img->move(public_path() . '/img', $imgName);
        $img_path = 'img/'.$imgName;

        $product = Product::create([
            'title' => $request->title,
            'material' => $request->material,
            'price' => $request->price,
            'size' => $request->size,
            'img_path' => $img_path,
            'qty' => $request->qty,
            'category_id' => $request->category_id,
        ]);
        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $product = Product::find($product->id);
        $categories = Category::all();
        return view('products.show', ['product'=>$product, 'categories'=>$categories]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $product = Product::find($product->id);
        $categories = Category::all();
        return view('products.edit', ['product'=>$product, 'categories'=>$categories]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $img = $request->img;

        if (is_null($img)) {
            $product = Product::find($product->id);
            $img_path = $product->img_path;
        } else {

            $imgName = $img->getClientOriginalName();
            $img->move(public_path() . '/img', $imgName);
            $img_path = "img/".$imgName;
        }

        $product = Product::find($product->id);
        $product->title = $request->title;
        $product->size = $request->size;
        $product->material = $request->material;
        $product->price = $request->price;
        $product->img_path = $img_path;
        $product->qty = $request->qty;
        $product->category_id = $request->category_id;

        $product->save();

        return redirect()->route('products.index')->with('info', 'Информация о товаре успешно обновлена.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product = Product::find($product->id);
        $product->delete();
        return redirect()->route('products.index')->with('info', 'Товар был успешно удален.');
    }
}
