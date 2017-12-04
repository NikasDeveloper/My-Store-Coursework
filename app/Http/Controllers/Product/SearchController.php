<?php

namespace App\Http\Controllers\Product;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    /**
     * Show search form.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function showSearchForm(Request $request)
    {
        return sizeof($request->all()) === 0 ? view("products.search") : $this->showSearchResult($request);
    }

    /**
     * Show search form + result.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    private function showSearchResult(Request $request)
    {
        $bindings = (object)$request->validate([
            "product" => "nullable|numeric|min:1|max:99999999|exists:products,id",
            "name" => "nullable|max:121",
            "status" => ["nullable", Rule::in(["Y", "N"])]
        ]);

        $where = [];

        if (!empty($bindings->product)) array_push($where, ["id", "=", $bindings->product]);
        if (!empty($bindings->name)) array_push($where, ["name", "like", $bindings->name . "%"]);
        if (!empty($bindings->status)) array_push($where, ["status", "=", $bindings->status]);

        $products = Product::where($where)->orderBy("name")->get();

        return view("products.search", [
            "bindings" => (object)$bindings, "products" => $products, "searched" => true
        ]);
    }
}
