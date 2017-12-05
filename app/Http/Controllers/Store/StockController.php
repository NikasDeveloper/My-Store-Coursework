<?php

namespace App\Http\Controllers\Store;

use Carbon\Carbon;
use App\Models\Store;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

class StockController extends Controller
{
    public function showRefillForm()
    {

    }


    /**
     * Refill product in store.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function refill(Request $request)
    {
        $request->validate(["product" => "required|exists:products,id", "amount" => "required|integer|min:1|max:5000"]);

        $product = Product::findOrFail($request->input("product"));

        if(!$product->active){
            return response()->json([
                "error" => ["title" => "Klaida!", "message" => "Negalima papildyti sandėlį neaktyvią preke."]
            ], 500);
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

            return response()->json([
                "notification" => ["title" => "Pavyko!", "message" => "Prekė pridėta į sandėlį."],
                "in_stock" => $product->stock->count()
            ]);

        } catch (QueryException $exception) {
            DB::rollBack();
            return response()->json([
                "error" => ["title" => "Klaida!", "message" => "Nepavyko pridėti prekių į sandėlį."]
            ], 500);
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
