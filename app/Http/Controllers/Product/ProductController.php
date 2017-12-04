<?php

namespace App\Http\Controllers\Product;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Database\QueryException;
use App\Models\Product;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    /**
     * Show product create form.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("products.create");
    }

    /**
     * Store product to database.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes = $request->validate([
            "name" => "required|max:121|unique:products,name",
            "price" => "required|numeric|min:0|max:9999",
            "description" => "nullable|max:500",
            "status" => ["required", Rule::in(["Y", "N"])]
        ]);

        try{
            $product = Product::create($attributes);
            return redirect()->route("product.edit", ["product" => $product->id]);
        } catch (QueryException $exception) {
            return abort(500);
        }
    }

    /**
     * Show product edit form.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($product)
    {
        $product = Product::findOrFail($product);
        return view("products.edit", ["product" => $product]);
    }

    /**
     * Store product changes to database.
     *
     * @param Request $request
     * @param $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $product)
    {
        return dd($request);
    }
}
