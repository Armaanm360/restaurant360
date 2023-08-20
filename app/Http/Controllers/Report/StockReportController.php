<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Models\Invoice\InvoicePosSale;
use App\Models\Product\Purchase;
use App\Models\Product\PurchaseItems;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockReportController extends Controller
{
    public function stockReport(Request $request)
    {
        $getPurchased = Purchase::where('purchase_created_by', $request->unique_user_id)
            ->join('purchase_items', 'purchase_items.purchase_id', '=', 'purchases.purchase_id')
            ->join('v1products', 'v1products.v1product_id', '=', 'purchase_items.purchase_product_id')
            ->select('v1products.product_name', 'purchase_items.purchase_product_quantity')
            ->get();



        $getSale = InvoicePosSale::where('invoice_created_by', $request->unique_user_id)
            ->join('pos_sale_products', 'pos_sale_products.pos_sale_id', '=', 'invoice_pos_sales.sale_id')->join('v1products', 'v1products.v1product_id', '=', 'pos_sale_products.product_id')
            ->select('v1products.product_name', 'pos_sale_products.quantity')->get();








        $saleData = $getSale->groupBy('product_name')->map(function ($item) {
            return [

                'sold_quantity' => $item->sum('quantity'),
            ];
        });


        $purData = $getPurchased->groupBy('product_name')->map(function ($items) {

            return [

                'pur_quantity' => $items->sum('purchase_product_quantity'),
            ];
        });


        $mergedData = [];

        foreach ($saleData as $productName => $soldItem) {
            $mergedData[$productName] = [
                "out" => $soldItem["sold_quantity"],
                "in" => 0 // Initialize purchased quantity
            ];
        }

        foreach ($purData as $productName => $purchasedItem) {
            if (isset($mergedData[$productName])) {
                $mergedData[$productName]["in"] = $purchasedItem["pur_quantity"];
            } else {
                $mergedData[$productName] = [
                    "out" => 0, // Initialize sold quantity
                    "in" => $purchasedItem["pur_quantity"]
                ];
            }
        }








        // echo gettype($purData);
        // die;









        return response()->json(['message' => 'Successfull', 'success' => true, 'bingi' => $mergedData], 201);
    }
}
