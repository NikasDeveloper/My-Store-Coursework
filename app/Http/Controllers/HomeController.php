<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(config("app.reason") == "UX") return view('home');

        $disabled_products = Product::whereStatus('N')->count();
        $active_products = Product::whereStatus('Y')->count();
        $product_labels = (object)[
            "active" => $active_products > 0 ? $active_products . "vnt." : "",
            "disabled" => $disabled_products > 0 ? $disabled_products . "vnt." : "",
        ];
        $total_stock = Store::all()->count();
        $in_stock_products = DB::table('products')
            ->select([DB::raw('sum(CASE WHEN store.id IS NULL THEN 0 ELSE 1 END) as counter')])
            ->leftJoin('store', 'products.id', '=', 'store.product_id')
            ->where([['products.status', '=', 'Y']])
            ->groupBy("products.id")
            ->havingRaw("counter > 0")
            ->orderBy("counter")
            ->get()
            ->count();
        $sold_out_products = DB::table('products')
            ->select([DB::raw('sum(CASE WHEN store.id IS NULL THEN 0 ELSE 1 END) as counter')])
            ->leftJoin('store', 'products.id', '=', 'store.product_id')
            ->where([['products.status', '=', 'Y']])
            ->groupBy("products.id")
            ->havingRaw("counter = 0")
            ->orderBy("counter")
            ->get()
            ->count();
        $stock_labels = (object)[
            "in_stock" => $in_stock_products > 0 ? $in_stock_products . "vnt." : "",
            "sold_out" => $sold_out_products > 0 ? $sold_out_products . "vnt." : "",
        ];

        return view("dashboard", [
            "disabled_products" => $disabled_products,
            "active_products" => $active_products,
            "product_labels" => $product_labels,
            "total_stock" => $total_stock,
            "sold_out_products" => $sold_out_products,
            "in_stock_products" => $in_stock_products,
            "stock_labels" => $stock_labels
        ]);
    }
}
