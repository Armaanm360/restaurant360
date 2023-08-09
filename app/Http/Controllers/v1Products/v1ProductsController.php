<?php

namespace App\Http\Controllers\v1Products;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommonResource;
use App\Models\Product\Product;
use App\Models\ProductCategory\ProductCategory;
use App\Models\v1Products\v1Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class v1ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data['productList'] = v1Products::where('v1products.product_status', 1)->where('v_product', Auth::user()->version)->where('product_created_by', Auth::user()->unique_user_id)->join('product_categories', 'v1products.product_category', 'product_categories.product_category_id')->get();





        if (isAPIRequest()) {

            return response()->json(['success' => true, 'message' => 'Successfully Done', 'data' => $data['productList']], 200);
        } else {

            return view('pages.v1products.list_products', $data);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $date = date('Y-m-d');
        $productCategory = ProductCategory::where('product_category_status', 1)->where('product_category_created_by', Auth::user()->unique_user_id)->get();;
        $row_count = v1Products::where('product_created_at', $date)->count();
        return view('pages.v1Products.create_products', compact('productCategory', 'row_count'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'product_name' => 'required|unique:products,product_name',
        //     'product_code' => 'required|unique:products,product_code',
        //     'product_image' => 'required'
        // ]);



        // PlayersModel::where('id', $edit_user_id)->update($players_Obj);


        //create validator
        $validator = Validator::make($request->all(), [
            'product_name' => 'required',
            'product_code' => 'required',
            // 'product_image' => 'required'
        ]);




        if ($validator->fails()) {

            return response()->json([
                'message' => 'Invalid params passed', // the ,message you want to show
                'errors' => $validator->errors()
            ], 422);
        } else {
            $new_name = '';
            if ($request->hasFile('product_image')) {
                $image = $request->file('product_image');
                $destinationPath = public_path('uploads/products/');
                $new_name = rand() . '.' . $image->getClientOriginalExtension();
                $image->move($destinationPath, $new_name);
            }
            $product = new v1Products();
            $product->product_name = $request->product_name;
            $product->product_entry_id = $request->product_entry_id;
            $product->product_category = $request->product_category;
            $product->product_code = $request->product_code;
            $product->product_image = $new_name;
            $product->product_retail_price = $request->product_retail_price;
            $product->product_wholesale_price = $request->product_wholesale_price;
            $product->v_product = Auth::user()->version;
            if (isAPIRequest()) {
                $product->product_created_by =  $request->product_created_by;
            } else {
                $product->product_created_by =  Auth::user()->unique_user_id;
            }

            $product->product_created_at = date('Y-m-d');
            $product->created_at = date("Y-m-d");
            $product->save();


            $data = new CommonResource($product);

            return response()->json(['success' => true, 'message' => 'Successfully Done', 'data' => $product], 200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['data'] = v1Products::where('v1product_id', $id)->first();
        $productCategory = ProductCategory::where('product_category_status', 1)->get();
        return view('pages.v1products.edit_products', $data, compact('productCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        if ($request->hasFile('product_image')) {
            $file_info = Product::where('product_id', $request->product_id)->first();

            if ($request->hasFile('product_image')) {
                $image = $request->file('product_image');
                $destinationPath = public_path('uploads/products/');
                $new_name = rand() . '.' . $image->getClientOriginalExtension();
                $image->move($destinationPath, $new_name);
            }


            Product::where('product_id', $request->product_id)->update([
                'product_image' => $new_name,
            ]);
        }

        Product::where('product_id', $request->product_id)->update([
            'product_name' => $request->product_name,
            'product_entry_id' => $request->product_entry_id,
            'product_category' => $request->product_category,
            'product_code' => $request->product_code,
            'product_retail_price' => $request->product_retail_price,
            'product_wholesale_price' => $request->product_wholesale_price,
            'product_updated_by' => Auth::user()->id,
            'updated_at' => date("Y/m/d"),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {



        if (isAPIRequest()) {
            v1Products::where('v1product_id', $id)->update([
                'product_status' => 0,
                'product_is_deleted' => "YES",
            ]);
        } else {
            v1Products::where('v1product_id', $id)->update([
                'product_deleted_by' => Auth::user()->id,
                'product_status' => 0,
                'product_is_deleted' => "YES",
            ]);
        }

        return response()->json(['success' => true, 'message' => 'Successfully Deleted'], 200);
    }

    public function productSearchGet(Request $request)
    {

        if (Auth::user()->version == 1) {
            $products = v1Products::where('v_product', Auth::user()->version)->where('product_created_by', Auth::user()->unique_user_id)->where('product_name', 'like', "%{$request->q}%")->get();
        } else {
            $products = Product::where('product_created_by', Auth::user()->unique_user_id)->where('product_name', 'like', "%{$request->q}%")->get();
        }


        $product_array = array();
        foreach ($products as $product) {
            $label = $product['product_name'] . '(' . $product['product_entry_id'] . ')';
            $value = intval($product['product_name']);
            if (Auth::user()->version == 1) {
                $code = intval($product['v1product_id']);
            } else {
                $code = intval($product['product_id']);
            }

            $product_array[] = array("label" => $label, "value" => $value, "code" => $code);
        }
        $result = array('status' => 'ok', 'content' => $product_array);
        echo json_encode($result);
        exit;
    }

    public function get_product_barcode($id)
    {
        $product = Product::whereProductId($id)->get()[0];
        return view('pages.barcode.product_barcode')->with('product', $product);
    }


    public function barcode_scan()
    {
        return view('pages.barcode.scan');
    }


    function check_barcode(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'BarcodeQrImage' => 'required'
        ]);
        if ($validation->passes()) {
            $image = $request->file('BarcodeQrImage');
            $image->move(public_path('images'), $image->getClientOriginalName());

            $resultArray = DecodeBarcodeFile(public_path('images/' . $image->getClientOriginalName()), 0x3FF | 0x2000000 | 0x4000000 | 0x8000000 | 0x10000000); // 1D, PDF417, QRCODE, DataMatrix, Aztec Code

            if (is_array($resultArray)) {
                $resultCount = count($resultArray);
                echo "Total count: $resultCount", "\n";
                if ($resultCount > 0) {
                    for ($i = 0; $i < $resultCount; $i++) {
                        $result = $resultArray[$i];
                        echo "Barcode format: $result[0], ";
                        echo "value: $result[1], ";
                        echo "raw: ", bin2hex($result[2]), "\n";
                        echo "Localization : ", $result[3], "\n";
                    }
                } else {
                    echo 'No barcode found.', "\n";
                }
            }
        }
    }
}
