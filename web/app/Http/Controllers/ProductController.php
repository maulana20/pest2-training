<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Filters\ProductFilter;
use App\Pipelines\ProductPipeline;

class ProductController extends Controller
{
    public function multiFilter(ProductFilter $filter)
    {
        $products = Product::filter($filter)->get();
        return view('products.index', compact('products'));
    }

    public function multiPipeline(ProductPipeline $pipeline)
    {
        $products = Product::pipeline($pipeline)->get();
        return view('products.index', compact('products'));
    }

    public function subscribeList()
    {
        $products = Product::get();
        return view('products.index', compact('products'));
    }
}
