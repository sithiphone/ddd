<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/unauthorized', 'MessageController@show');


Route::group(['middleware' => 'App\Http\Middleware\CheckRole'], function()
{
//Route::match(['get', 'post'], '/superAdminOnlyPage/', 'HomeController@super_admin');
    Route::get('adminRegister',[
        'uses' => 'AdminRegisterController@index',
        'as' => 'admin.register',
        'roles' => ['Super_admin', 'Admin']
    ]);
    Route::post('adminRegisterUser',[
        'uses' => 'AdminRegisterController@store',
        'as' => 'admin.register.user',
        'roles' => ['Super_admin', 'Admin']
    ]);
    Route::get('adminShowRegisterForm',[
        'uses' => 'AdminRegisterController@showRegisterForm',
        'as' => 'admin.show.register.form',
        'roles' => ['Super_admin', 'Admin']
    ]);
    Route::get('adminChangePassword/{id}',[
        'uses' => 'AdminRegisterController@showChangePasswordForm',
        'as' => 'admin.change.password.form',
        'roles' => ['Super_admin', 'Admin']
    ]);
    Route::get('adminChangePrivilege/{id}',[
        'uses' => 'AdminRegisterController@showChangePrivilegeForm',
        'as' => 'admin.change.privilege.form',
        'roles' => ['Super_admin', 'Admin']
    ]);
    Route::post('changePrivilage', [
        'uses' => 'AdminRegisterController@changePrivilege',
        'as' => 'admin.change.privilege',
        'roles' => ['Super_admin', 'Admin']
    ]);
    Route::post('adminEditProfile',[
        'uses' => 'AdminRegisterController@edit',
        'as' => 'admin.edit.profile',
        'roles' => ['Super_admin', 'Admin']
    ]);
    Route::post('adminResetPassword',[
        'uses' => 'AdminRegisterController@resetPassword',
        'as' => 'admin.change.password',
        'roles' => ['Super_admin', 'Admin']
    ]);
    Route::get('adminUpdateProfile/{id}',[
        'uses' => 'AdminRegisterController@update',
        'as' => 'admin.update.profile',
        'roles' => ['Super_admin', 'Admin']
    ]);
    Route::get('adminDeleteUser/{id}',[
        'uses' => 'AdminRegisterController@delete',
        'as' => 'admin.delete.user',
        'roles' => ['Super_admin', 'Admin']
    ]);
    Route::resource('products','ProductsController',[
        'roles' => ['Super_admin', 'Admin', 'Member']
    ]);
    Route::get('storeproduct',[
        'uses' => 'ProductsController@create',
        'as' => 'product.upload',
        'roles' => ['Super_admin', 'Admin', 'Member']
    ]);
    Route::post('storeproduct',[
        'uses' => 'ProductsController@store',
        'as' => '',
        'roles' => ['Super_admin', 'Admin', 'Member']
    ]);
    Route::resource('customers','CustomersController',[
        'roles' => ['Super_admin', 'Admin', 'Member']
    ]);
    Route::get('customersale', [
        'uses' => 'CustomersController@sale',
        'as' => 'customers.sale',
        'roles' => ['Super_admin', 'Admin', 'Member']
    ]);
    Route::get('write/billing/{customer_id}', [
    'uses' => 'CustomersController@writebill',
    'as' => 'customers.writebill',
    'roles' => ['Super_admin', 'Admin', 'Member']
    ]);
    Route::post('madeBill', [
        'uses' => 'BillsController@madeBill',
        'as' => 'customers.madebill',
        'roles' => ['Super_admin', 'Admin', 'Member']
    ]);
    Route::get('deletemadeorder/{id}', [
        'uses' => 'BillsController@deleteMadeorder',
        'as' => 'customers.deletemadeorder',
        'roles' => ['Super_admin', 'Admin', 'Member']
    ]);
    Route::get('madeorder.printPreview', [
        'uses' => 'BillsController@madeorderPrintpreview',
        'as' => 'madeorder.printPreview',
        'roles' => ['Super_admin', 'Admin', 'Member']
    ]);

    Route::get('billing/madeorder/{bill_id}/{cus_id}', [
        'uses' => 'BillingController@madeorderPrintpreview',
        'as' => 'madeorderbilling.printPreview',
        'roles' => ['Super_admin', 'Admin', 'Member']
    ]);

    Route::get('rate',[
        'uses' => 'RateController@index',
        'as' => 'rate.index',
        'roles' => ['Super_admin', 'Admin', 'Member']
    ]);
    Route::get('/rate/{id}',[
        'uses' => 'RateController@edit',
        'as' => 'rate.edit',
        'roles' => ['Super_admin', 'Admin', 'Member']
    ]);
    Route::put('/rate/{id}',[
        'uses' => 'RateController@update',
        'as' => 'rate.update',
        'roles' => ['Super_admin', 'Admin', 'Member']
    ]);

    Route::resource('bills','BillsController',[
        'roles' => ['Super_admin', 'Admin', 'Member']
    ]);
    Route::post('bills/autocomplete',[
        'uses' => 'BillsController@autocomplete',
        'as' => '',
        'roles' => ['Super_admin', 'Admin', 'Member']
    ]);
    Route::post('bills/billing',[
        'uses' => 'BillsController@create',
        'as' => 'bills.billing',
        'roles' => ['Super_admin', 'Admin', 'Member']
    ]);
    Route::post('bills/store',[
        'uses' => 'BillsController@store',
        'as' => 'bills.store',
        'roles' => ['Super_admin', 'Admin', 'Member']
    ]);
    Route::get('billsClear',[
        'uses' => 'BillsController@clear',
        'as' => 'bills.clear',
        'roles' => ['Super_admin', 'Admin', 'Member']
    ]);

    Route::get('billing', [
        'uses' => 'BillingController@index',
        'as' => 'billing.index',
        'roles' => ['Super_admin', 'Admin', 'Member']
    ]);
    Route::get('view.billing', [
        'uses' => 'BillingController@viewBill',
        'as' => 'view.billing',
        'roles' => ['Super_admin', 'Admin', 'Member']
    ]);
    Route::get('billing.printPreview', [
        'uses' => 'BillingController@printpreview',
        'as' => 'billing.printPreview',
        'roles' => ['Super_admin', 'Admin', 'Member']
    ]);
    Route::get('autocomplete',[
        'uses' => 'OrdersController@autocomplete',
        'as' => 'autocomplete',
        'roles' => ['Super_admin', 'Admin', 'Member']
    ]);
    Route::get('autocomplete_customer',[
        'uses' => 'OrdersController@autocompleteCustomer',
        'as' => 'autocomplete_customer',
        'roles' => ['Super_admin', 'Admin', 'Member']
    ]);

    Route::resource('orders','OrdersController',[
        'roles' => ['Super_admin', 'Admin', 'Member']
    ]);

    Route::resource('categories','CategoriesController',[
        'roles' => ['Super_admin', 'Admin', 'Member']
    ]);

    Route::resource('suppliers','SuppliersController',[
        'roles' => ['Super_admin', 'Admin', 'Member']
    ]);

    Route::resource('buys','BuysController',[
        'roles' => ['Super_admin', 'Admin', 'Member']
    ]);
    Route::get('autocomplete',[
        'uses' => 'BuysController@autocomplete',
        'as' => 'autocomplete',
        'roles' => ['Super_admin', 'Admin', 'Member']
    ]);
    Route::get('/printPreview',[
        'uses' => 'OrdersController@printPreview',
        'as' => 'orders.printPreview',
        'roles' => ['Super_admin', 'Admin', 'Member']
    ]);
    Route::get('/printPreviewQuotation',[
        'uses' => 'QuotationsController@printPreview',
        'as' => 'quotations.printPreview',
        'roles' => ['Super_admin', 'Admin', 'Member']
    ]);
    Route::resource('quotations','QuotationsController',[
        'roles' => ['Super_admin', 'Admin', 'Member']
    ]);
    Route::get('quotationscus',[
        'uses' => 'QuotationsController@selectCustomer',
        'as' => 'quotations.customer',
        'roles' => ['Super_admin', 'Admin', 'Member']
    ]);
    Route::get('quotationsselcus',[
        'uses' => 'QuotationsController@create',
        'as' => 'quotations.selected',
        'roles' => ['Super_admin', 'Admin', 'Member']
    ]);
    Route::get('reportQuotationsPrintpreview',[
        'uses' => 'reportQuotationsController@printpreview',
        'as' => 'reports.quotations.printpreview',
        'roles' => ['Super_admin', 'Admin', 'Member']
    ]);
    Route::get('autocompleteQuotation',[
        'uses' => 'QuotationdetailsController@autocomplete',
        'as' => 'autocompleteQuotation',
        'roles' => ['Super_admin', 'Admin', 'Member']
    ]);
    Route::post('quotationsave',[
        'uses' => 'QuotationsController@save',
        'as' => 'quotations.save',
        'roles' => ['Super_admin', 'Admin', 'Member']
    ]);
    Route::get('/printpreview',[
        'uses' => 'BuysController@printpreview',
        'as' => 'buys.printpreview',
        'roles' => ['Super_admin', 'Admin', 'Member']
    ]);
    Route::get('updatePrice/{id}',[
        'uses' => 'BuysController@updatePrice',
        'as' => 'buys.updatePrice',
        'roles' => ['Super_admin', 'Admin', 'Member']
    ]);
    Route::post('editPrice',[
        'uses' => 'BuysController@editPrice',
        'as' => 'buys.editPrice',
        'roles' => ['Super_admin', 'Admin', 'Member']
    ]);
    Route::get('reportSale',[
        'uses' => 'ReportSaleController@index',
        'as' => 'reportSales.index',
        'roles' => ['Super_admin', 'Admin', 'Member']
    ]);
    Route::get('reportsSalesPrintpreview',[
        'uses' => 'ReportSaleController@printpreview',
        'as' => 'reports.sales.printpreview',
        'roles' => ['Super_admin', 'Admin', 'Member']
    ]);
    Route::get('reportSaleMadeOrder',[
        'uses' => 'ReportSaleMadeOrderController@index',
        'as' => 'reportSalesMadeOrder.index',
        'roles' => ['Super_admin', 'Admin', 'Member']
    ]);
    Route::get('reportSaleMadeOrderPrintpreview',[
        'uses' => 'ReportSaleMadeOrderController@printpreview',
        'as' => 'reports.saleMadeOrder.printpreview',
        'roles' => ['Super_admin', 'Admin', 'Member']
    ]);
    Route::get('reportQuotations',[
        'uses' => 'ReportQuotationsController@index',
        'as' => 'reportQuotations.index',
        'roles' => ['Super_admin', 'Admin', 'Member']
    ]);
    Route::get('reportQuotationsPrintpreview',[
        'uses' => 'reportQuotationsController@printpreview',
        'as' => 'reports.quotations.printpreview',
        'roles' => ['Super_admin', 'Admin', 'Member']
    ]);
    Route::get('reportProducts',[
        'uses' => 'ReportProductsController@index',
        'as' => 'reportProducts.index',
        'roles' => ['Super_admin', 'Admin', 'Member']
    ]);
    Route::get('reportProductsPrintpreview',[
        'uses' => 'reportProductsController@printpreview',
        'as' => 'reports.products.printpreview',
        'roles' => ['Super_admin', 'Admin', 'Member']
    ]);
    Route::get('reportIncomes',[
        'uses' => 'ReportIncomesController@index',
        'as' => 'reportIncomes.index',
        'roles' => ['Super_admin', 'Admin', 'Member']
    ]);



    Route::get('reportIncomesPrintpreview',[
        'uses' => 'ReportIncomesController@printpreview',
        'as' => 'reports.incomes.printpreview',
        'roles' => ['Super_admin', 'Admin', 'Member']
    ]);
    Route::get('reportPayments',[
        'uses' => 'ReportPaymentsController@index',
        'as' => 'reportPayments.index',
        'roles' => ['Super_admin', 'Admin', 'Member']
    ]);
    Route::get('reportPaymentsPrintpreview',[
        'uses' => 'ReportPaymentsController@printpreview',
        'as' => 'reports.payments.printpreview',
        'roles' => ['Super_admin', 'Admin', 'Member']
    ]);
    Route::get('queuesIndex',[
        'uses' => 'QueuesController@index',
        'as' => 'queues.index',
        'roles' => ['Super_admin', 'Admin', 'Member']
    ]);
    Route::get('queuesFinish',[
        'uses' => 'QueuesController@finish',
        'as' => 'queues.finish',
        'roles' => ['Super_admin', 'Admin', 'Member']
    ]);
    Route::get('queuesStatus',[
        'uses' => 'QueuesController@complete',
        'as' => 'queues.complete',
        'roles' => ['Super_admin', 'Admin', 'Member']
    ]);
    Route::get('queuesUp',[
        'uses' => 'QueuesController@up',
        'as' => 'queues.up',
        'roles' => ['Super_admin', 'Admin', 'Member']
    ]);
    Route::get('queuesDown',[
        'uses' => 'QueuesController@down',
        'as' => 'queues.down',
        'roles' => ['Super_admin', 'Admin', 'Member']
    ]);
    Route::get('productDescription',[
        'uses' => 'QueuesController@showProductDesc',
        'as' => 'product.description',
        'roles' => ['Super_admin', 'Admin', 'Member']
    ]);
    Route::get('productDescriptionFinish',[
        'uses' => 'QueuesController@showProductDescFinish',
        'as' => 'product.description.finish',
        'roles' => ['Super_admin', 'Admin', 'Member']
    ]);
    Route::get('reportQueues',[
        'uses' => 'ReportQueuesController@index',
        'as' => 'reportQueues.index',
        'roles' => ['Super_admin', 'Admin', 'Member']
    ]);
    Route::get('showProductDesc',[
        'uses' => 'ProductdescriptionsController@index',
        'as' => 'show.product.desc',
        'roles' => ['Super_admin', 'Admin', 'Member']
    ]);
    Route::get('showProductDescFinish',[
        'uses' => 'ProductdescriptionsController@finish',
        'as' => 'show.product.desc.finish',
        'roles' => ['Super_admin', 'Admin', 'Member']
    ]);
    Route::get('showProductDescEditForm',[
        'uses' => 'ProductdescriptionsController@edit',
        'as' => 'show.product.desc.edit.form',
        'roles' => ['Super_admin', 'Admin', 'Member']
    ]);
    Route::get('showProductDescEditFinishphotoForm',[
        'uses' => 'ProductdescriptionsController@editfinishphoto',
        'as' => 'show.product.desc.edit.finishphoto.form',
        'roles' => ['Super_admin', 'Admin', 'Member']
    ]);
    Route::post('updateProductDesc',[
        'uses' => 'ProductdescriptionsController@update',
        'as' => 'update.product.desc',
        'roles' => ['Super_admin', 'Admin', 'Member']
    ]);
    Route::post('updateProductFinishphoto',[
        'uses' => 'ProductdescriptionsController@updatefinishphoto',
        'as' => 'update.product.finishphoto',
        'roles' => ['Super_admin', 'Admin', 'Member']
    ]);
    Route::get('descProductDetail', [
    'uses' => 'ProductdescriptionsController@showForm',
    'as' => 'show.productdescription.form',
    'roles' => ['Super_admin', 'Admin', 'Member']
    ]);
    Route::get('descProductDetailFinish', [
        'uses' => 'ProductdescriptionsController@showFormFinish',
        'as' => 'show.productdescriptionfinish.form',
        'roles' => ['Super_admin', 'Admin', 'Member']
    ]);
    Route::post('storeProductDetail', [
        'uses' => 'ProductdescriptionsController@store',
        'as' => 'store.productdescription',
        'roles' => ['Super_admin', 'Admin', 'Member']
    ]);
    Route::post('storeProductDetailFinishPhoto', [
        'uses' => 'ProductdescriptionsController@storefinishphoto',
        'as' => 'store.productdescriptionfinish',
        'roles' => ['Super_admin', 'Admin', 'Member']
    ]);
    Route::get('reportQueuesPrintpreview',[
        'uses' => 'ReportQueuesController@printpreview',
        'as' => 'reports.queues.printpreview',
        'roles' => ['Super_admin', 'Admin', 'Member']
    ]);
    Route::get('reportBuys',[
        'uses' => 'ReportBuysController@index',
        'as' => 'reportBuys.index',
        'roles' => ['Super_admin', 'Admin', 'Member']
    ]);
    Route::get('reportBuysPrintpreview',[
        'uses' => 'ReportBuysController@printpreview',
        'as' => 'reports.buys.printpreview',
        'roles' => ['Super_admin', 'Admin', 'Member']
    ]);
    Route::get('autocompleteReportBuySupplierName',[
        'uses' => 'ReportBuysController@autocompleteSupplierName',
        'as' => 'autocompleteReportBuySupplierName',
        'roles' => ['Super_admin', 'Admin', 'Member']
    ]);
    Route::get('autocompleteReportBuyUserName',[
        'uses' => 'ReportBuysController@autocompleteUserName',
        'as' => 'autocompleteReportBuyUserName',
        'roles' => ['Super_admin', 'Admin', 'Member']
    ]);
});
