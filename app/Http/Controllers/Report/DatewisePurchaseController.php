<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Models\Product\Purchase;
use Illuminate\Http\Request;

class DatewisePurchaseController extends Controller
{
    public function dateWiseReport(Request $request)
    {


        $startDate = $request->start_date;
        $endDate = $request->end_date;


        $data = Purchase::where('purchase_created_by', $request->unique_user_id)
            ->whereBetween('purchases.purchase_date', [$startDate, $endDate])
            ->join('purchase_items', 'purchase_items.purchase_id', '=', 'purchases.purchase_id');

        if ($request->user_version == 1) {
            $version = Purchase::where('purchase_created_by', $request->unique_user_id)
                ->whereBetween('purchases.purchase_date', [$startDate, $endDate])
                ->join('purchase_items', 'purchase_items.purchase_id', '=', 'purchases.purchase_id')->join('v1products', 'v1products.v1product_id', '=', 'purchase_items.purchase_product_id')
                ->join('product_categories', 'product_categories.product_category_id', '=', 'v1products.product_category')
                ->select('purchases.purchase_number', 'v1products.product_name', 'purchase_items.purchase_product_price', 'product_categories.product_category_name', 'purchase_items.purchase_product_quantity', 'purchase_items.purchase_product_total_price', 'purchases.purchase_date')->get();
            $version_total = $data->sum('purchase_items.purchase_product_total_price');
        } else {
            $version = Purchase::where('purchase_created_by', $request->unique_user_id)
                ->whereBetween('purchases.purchase_date', [$startDate, $endDate])
                ->join('purchase_items', 'purchase_items.purchase_id', '=', 'purchases.purchase_id')->join('products', 'products.product_id', '=', 'purchase_items.purchase_product_id')
                ->select('purchases.purchase_number', 'products.product_name', 'purchase_items.purchase_product_price', 'purchase_items.purchase_product_quantity', 'purchase_items.purchase_product_total_price', 'purchases.purchase_date')->get();
            $version_total = $data->sum('purchase_items.purchase_product_total_price');
        }




        // $total = Purchase::join('warehouses', 'purchases.purchase_warehouse_id', '=', 'warehouses.warehouse_id')
        //     ->whereBetween('purchases.purchase_date', [$startDate, $endDate])
        //     ->where('purchases.purchase_warehouse_id', $request->warehouse_id)
        //     ->sum('purchase_net_total');


        // 'totalPurchase' => $total

        $result = [
            'purchaseData' => $data,
            'totalPurchase' => $version_total,
        ];
        return response()->json(['message' => 'Successfull', 'success' => true, 'purchaseData' => $version, 'totalPurchase' => $version_total], 201);
    }
}
