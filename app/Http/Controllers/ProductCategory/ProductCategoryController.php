<?php

namespace App\Http\Controllers\ProductCategory;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommonResource;
use App\Models\ProductCategory\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data['product_categoryList'] = ProductCategory::where('product_category_status', 1)->where('product_category_created_by', Auth::user()->unique_user_id)->get();


        if (isAPIRequest()) {

            return response()->json(['success' => true, 'message' => 'Successfully Done', 'data' => $data['product_categoryList']], 200);
        } else {

            return view('pages.productcategory.list_product_category', $data);
        }
    }
    public function allProductCategory($created_by)
    {

        $data['product_categoryList'] = ProductCategory::where('product_category_status', 1)->where('v_product_category', Auth::user()->version)->where('product_category_created_by', $created_by)->get();

        return response()->json(['success' => true, 'message' => 'Successfully Done', 'data' => $data['product_categoryList']], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.productcategory.create_product_category');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'product_category_name' => 'required',
        ]);


        $product_category = new ProductCategory();
        $product_category->product_category_name = $request->product_category_name;
        $product_category->product_category_entry_id = $request->product_category_entry_id;
        $product_category->v_product_category = Auth::user()->version;
        if (isAPIRequest()) {
            $product_category->product_category_created_by =  $request->created_by;
        } else {
            $product_category->product_category_created_by =  Auth::user()->unique_user_id;
        }

        $product_category->save();

        $data = new CommonResource($product_category);

        return response()->json(['success' => true, 'message' => 'Successfully Done', 'data' => $data], 200);
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
        $data['data'] = ProductCategory::where('product_category_id', $id)->first();
        return view('pages.productcategory.edit_product_category', $data);
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

        // ProductCategory::where('product_category_id',$request->product_category_id)->update([
        //     'product_category_name' => $request->product_category_name,
        //     'product_category_entry_id' => $request->product_category_entry_id,
        //     'product_category_updated_by' => Auth::user()->id,
        //     'updated_at' => date("Y/m/d"),
        // ]);


        $item = ProductCategory::findOrFail($id);

        $item->update($request->all());

        $data = new CommonResource($item);

        return response()->json(['success' => true, 'message' => 'Successfully Done', 'data' => $data], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // ProductCategory::where('product_category_id',$id)->update([
        //     'product_category_deleted_by' => Auth::user()->id,
        //     'product_category_status' => 0,
        //     'product_category_is_deleted' => "YES",
        // ]);

        $item = ProductCategory::find($id);
        $item->product_category_deleted_by = "YES";
        $item->product_category_status = 0;
        $item->save();
        $data = new CommonResource($item);
        return response()->json(['success' => true, 'message' => 'Successfully Deleted', 'data' => $data], 200);
    }
}
