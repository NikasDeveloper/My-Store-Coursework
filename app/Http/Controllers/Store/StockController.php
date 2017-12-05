<?php

namespace App\Http\Controllers\Store;

use App\Models\Store;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Session;

class StockController extends Controller
{
    /**
     * Show stock refill form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRefillForm()
    {
        $products = Product::whereStatus('Y')->get();
        return view("store.refill", ["products" => $products]);
    }

    /**
     * Refill product in store.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function refill(Request $request)
    {
        $request->validate(["product" => "required|exists:products,id", "amount" => "required|integer|min:1|max:5000"]);

        $product = Product::findOrFail($request->input("product"));

        if (!$product->active) {
            return $request->wantsJson()
                ? response()->json([
                    "error" => ["title" => "Klaida!", "message" => "Negalima papildyti sandėlį neaktyvią preke."]
                ], 500)
                : abort(500);
        }

        DB::beginTransaction();

        try {

            $attributes = [];
            $product_id = $request->input("product");
            $amount = $request->input("amount");
            $now = Carbon::now();

            for ($i = 0; $i < $amount; $i++) {
                array_push($attributes, ["product_id" => $product_id, "created_at" => $now, "updated_at" => $now]);
            }

            if (DB::table('store')->insert($attributes)) DB::commit();

            if ($request->wantsJson()) {
                return response()->json([
                    "notification" => ["title" => "Pavyko!", "message" => "Prekė pridėta į sandėlį."],
                    "in_stock" => $product->stock->count()
                ]);
            }

            Session::put("stock_refilled", "Prekė pridėta į sandėlį");
            return redirect()->route("store.refill");

        } catch (QueryException $exception) {
            DB::rollBack();
            return $request->wantsJson() ? response()->json([
                "error" => ["title" => "Klaida!", "message" => "Nepavyko pridėti prekių į sandėlį."]
            ], 500) : abort(500);
        }

    }

    /**
     * Remove product from the store.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function restock(Request $request)
    {
        $request->validate(["product" => "required|exists:products,id"]);

        try {
            Store::where("product_id", $request->input("product"))->delete();
            return response()->json([
                "notification" => ["title" => "Pavyko!", "message" => "Prekė pašalinta iš sandėlio."]
            ]);
        } catch (QueryException $exception) {
            return response()->json([
                "error" => ["title" => "Klaida!", "message" => "Nepavyko pašalinti prekės iš sandėlio."]
            ], 500);
        }

    }
}
