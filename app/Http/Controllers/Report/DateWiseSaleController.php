<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Models\Invoice\InvoicePosSale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DateWiseSaleController extends Controller
{
    public function dateWiseReport(Request $request)
    {


        $startDate = $request->start_date;
        $endDate = $request->end_date;


        $data = InvoicePosSale::where('invoice_created_by', $request->unique_user_id)
            ->whereBetween('invoice_pos_sales.invoice_date', [$startDate, $endDate])
            ->join('pos_sale_products', 'pos_sale_products.pos_sale_id', '=', 'invoice_pos_sales.sale_id');

        if ($request->user_version == 1) {
            $version = InvoicePosSale::where('invoice_created_by', $request->unique_user_id)
                ->whereBetween('invoice_pos_sales.invoice_date', [$startDate, $endDate])
                ->join('pos_sale_products', 'pos_sale_products.pos_sale_id', '=', 'invoice_pos_sales.sale_id')->join('v1products', 'v1products.v1product_id', '=', 'pos_sale_products.product_id')
                ->join('product_categories', 'product_categories.product_category_id', '=', 'v1products.product_category')
                ->select('invoice_pos_sales.invoice_no', 'v1products.product_name', 'pos_sale_products.price', 'product_categories.product_category_name', 'pos_sale_products.quantity', 'pos_sale_products.sub_total', 'invoice_pos_sales.invoice_date')->get();
            $version_total = $data->sum('pos_sale_products.sub_total');
        } else {

            $version = InvoicePosSale::where('invoice_created_by', $request->unique_user_id)
                ->whereBetween('invoice_pos_sales.invoice_date', [$startDate, $endDate])
                ->join('pos_sale_products', 'pos_sale_products.pos_sale_id', '=', 'invoice_pos_sales.sale_id')->join('created_food_items', 'created_food_items.food_item_id', '=', 'pos_sale_products.product_id')
                ->select('invoice_pos_sales.invoice_no', 'created_food_items.food_item_name', 'pos_sale_products.price', 'pos_sale_products.quantity', 'invoice_pos_sales.invoice_date', DB::raw('pos_sale_products.price * pos_sale_products.quantity AS total_price'))->get();
            $version_total = $data->sum(DB::raw('pos_sale_products.price * pos_sale_products.quantity'));
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
