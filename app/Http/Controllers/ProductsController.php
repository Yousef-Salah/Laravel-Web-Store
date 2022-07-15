<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class ProductsController extends Controller
{
    public function index(Category $category = null)
    {
        if(!$category) {
            $category = new Category;
            $products  = Product::with('category')->latest()->paginate(6);
        } else {
            $products = $category->products('category')->latest()->paginate(6);
        }
        
        // Eager Loading
        //$products = Product::with('category')->latest()->paginate(6);
        // select * from products order by desc linit 15 offset 0....
        // select * form categories where id in ()

        return view('store.products.index', [
            'category' => $category,
            'products' => $products,
        ]);
    }

    public function show(Category $category, Product $product)
    {
        // $category = Category::whereSlug($category_slug)->firstOrFail();
        // $product  = $category->products()->whereSlug($product_slug)->firstOrFail();

        return view('store.products.show', compact('category', 'product'));
    }
}
