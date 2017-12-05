<?php

namespace App\Http\Controllers\Store;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
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
        return sizeof($request->all()) === 0 ? view("store.search") : $this->showSearchResult($request);
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
        $columns = [
            "products.id", "products.name", DB::raw('sum(CASE WHEN store.id IS NULL THEN 0 ELSE 1 END) as counter')
        ];
        $where = [['products.status', '=', 'Y']];

        if (!empty($bindings->product)) array_push($where, ["products.id", "=", $bindings->product]);
        if (!empty($bindings->name)) array_push($where, ["products.name", "like", $bindings->name . "%"]);

        switch ($bindings->status) {
            case "Y":
                $having = "counter > 0";
                break;
            case "N":
                $having = "counter = 0";
                break;
            case null:
            default:
                $having = "counter = counter";
                break;
        }

        $products = DB::table('products')
            ->select($columns)
            ->leftJoin('store', 'products.id', '=', 'store.product_id')
            ->where($where)
            ->groupBy("products.id")
            ->havingRaw($having)
            ->orderBy("counter")
            ->get();

        return view("store.search", ["bindings" => $bindings, "products" => $products, "searched" => true]);
    }

}
