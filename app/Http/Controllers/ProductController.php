<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;
class ProductController extends Controller
{

public function index(Request $request)
{
    $query = Product::query();

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        $products = $query->get();

    $categories = Category::all();

    return view('pages.tshirt', [
        'products' => $products,
        'categories' => $categories
    ]);



}
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        } else {
            $imagePath = null;
        }

        $data = $request->all();
        $data['image'] = $imagePath;


        Product::create($data);
        $categories = Category::all();

    return view('pages.addproduct', [
        'categories' => $categories
    ]);
    }
    public function addProductView()
    {
        $products = Product::all();
        $categories = Category::all();
        return [
            'products' => $products,
            'categories' => $categories,
        ];
    }
}
