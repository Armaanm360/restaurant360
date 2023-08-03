<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});





Route::resource('account-transfer', Accounts\AccountTransferController::class);
Route::get('account/balance-statement', 'Accounts\AccountsController@balance_statement');
Route::post('account/save-opening-balance', 'AccountTransactions\AccountTransactionsController@save_opening_balance');
Route::get('search-account', function (Request $request) {
    return search_account($request->q);
});

Route::get('search-account-full-data', function (Request $request) {
    return search_account_full_data($request->q);
});



/* Money Receipt */
Route::resource('money-receipt', MoneyReceipt\MoneyReceiptController::class);
/* Money Receipt */


Route::resource('delivery-men', DeliveryMan\DeliveryManController::class);

/* expense */
Route::resource('expenses', Expenses\ExpensesController::class);

Route::resource('delivery-men', DeliveryMan\DeliveryManController::class);
Route::resource('company-info', CompanyInfo\CompanyInfoController::class);


Route::get('get-invoice-full-information', function (Request $request) {
    return get_invoice_full_information($request->q);
});



//settings
Route::resource('restaurant-table', Table\RestaurantTableController::class);
Route::resource('expense-head', ExpenseHead\ExpenseHeadController::class);
Route::resource('expense-sub-head', ExpenseSubHead\ExpenseSubHeadController::class);
Route::resource('product-category', ProductCategory\ProductCategoryController::class);
Route::resource('warehouse', Warehouse\WarehouseController::class);
Route::resource('product-color', ProductColor\ProductColorController::class);
Route::resource('staff', Staff\StaffController::class);


Route::resource('products', Products\ProductsController::class);
Route::resource('branch', Branch\BranchController::class);
Route::resource('company-info', CompanyInfo\CompanyInfoController::class);
Route::resource('terms', Terms\TermsController::class);

//suppliers
Route::resource('suppliers', Suppliers\SuppliersController::class);



Route::resource('invoice', invoice\invoiceController::class);



Route::get('invoice/chef/{id}', 'invoice\invoiceController@show_chef_invoice');


Route::get('today-invoices', 'invoice\invoiceController@today_invoices');


Route::post('registration', 'Admin\UserRegistrationController@userRegisterController');


Route::post('staff-signin', 'Admin\UserRegistrationController@userLoginController');


Route::get('search-category-product/{product_category}/{branch_id}', 'Common\CommonController@searchCategoryProduct');


Route::resource('purchases', Purchases\PurchasesController::class);


Route::resource('warehouse-branch-transfer', Transfer\WarehouseToBranchTransferController::class);



Route::get('create-sale/{type}/{created_by}', 'ProfitLossCreate\ProfitLossController@listSale');
Route::post('create-sale', 'ProfitLossCreate\ProfitLossController@createSale');
Route::get('create-expense/{created_by}', 'ProfitLossCreate\ProfitLossController@listExpense');
Route::post('create-expense', 'ProfitLossCreate\ProfitLossController@createExpense');
Route::get('show-profit-losss/{sale_type}/{created_by}', 'ProfitLossCreate\ProfitLossController@profitLoss');



Route::get('stock', 'Common\CommonController@stock');




Route::get('all-products/{created_by}', 'Products\ProductsController@allProductsGetUserWise');


Route::get('all-tables/{created_by}', 'Table\RestaurantTableController@allTableUserWise');


Route::get('all-product-category/{created_by}', 'ProductCategory\ProductCategoryController@allProductCategory');


//invoice list user wise
Route::get('list-of-invoices/{invoice_created_by}', 'invoice\invoiceController@listOfALLInvoices');

//today invoices
Route::get('list-of-today-invoices/{invoice_created_by}', 'invoice\invoiceController@today_invoices_api');
