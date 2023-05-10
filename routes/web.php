<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Pos\SupplierController;
use App\Http\Controllers\Pos\CustomerController;
use App\Http\Controllers\Pos\SalesmanController;
use App\Http\Controllers\Pos\UnitController;
use App\Http\Controllers\Pos\CategoryController;
use App\Http\Controllers\Pos\ProductController;
use App\Http\Controllers\Pos\PurchaseController;
use App\Http\Controllers\Pos\InvoiceController;
use App\Http\Controllers\Pos\StockController;
use App\Http\Controllers\Pos\DefaultController;
use Illuminate\Support\Facades\Route;


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
    return view('admin.admin_master');
})->middleware(['auth']);

Route::middleware(['auth'])->group(function () {

//All Route Admin
Route::controller(AdminController::class)->group(function () {
    Route::get('/admin/logout', 'destroy')->name('admin.logout');
    Route::get('/admin/profile', 'profile')->name('admin.profile');
    Route::get('/edit/profile', 'editProfile')->name('edit.profile');
    Route::post('/store/profile', 'storeProfile')->name('store.profile');

    Route::get('/change/password', 'changePassword')->name('change.password');
    Route::post('/update/password', 'updatePassword')->name('update.password');
});

//All Route Supplier
Route::controller(SupplierController::class)->group(function () {
    Route::get('/supplier/all', 'supplierAll')->name('supplier.all');
    Route::get('/supplier/add', 'supplierAdd')->name('supplier.add');
    Route::post('/supplier/store', 'supplierStore')->name('supplier.store');
    Route::get('/supplier/edit/{id}', 'supplierEdit')->name('supplier.edit');
    Route::post('/supplier/update', 'supplierUpdate')->name('supplier.update');
    Route::get('/supplier/delete/{id}', 'supplierDelete')->name('supplier.delete');
});

//All Route Customer
Route::controller(CustomerController::class)->group(function () {
    Route::get('/customer/all', 'customerAll')->name('customer.all');
    Route::get('/customer/add', 'customerAdd')->name('customer.add');
    Route::post('/customer/store', 'customerStore')->name('customer.store');
    Route::get('/customer/edit/{id}', 'customerEdit')->name('customer.edit');
    Route::post('/customer/update', 'customerUpdate')->name('customer.update');
    Route::get('/customer/delete/{id}', 'customerDelete')->name('customer.delete');
    Route::get('/credit/customer', 'creditCustomer')->name('credit.customer');
    Route::get('/credit/customer/print/pdf', 'creditCustomerPrintPdf')->name('credit.customer.print.pdf');
    Route::get('/customer/edit/invoice/{invoice_id}', 'customerEditInvoice')->name('customer.edit.invoice');
    Route::post('/customer/update/invoice/{invoice_id}', 'customerUpdateInvoice')->name('customer.update.invoice');
    Route::get('/customer/invoice/details/{invoice_id}', 'customerInvoiceDetails')
    ->name('customer.invoice.details.pdf');
    Route::get('/paid/customer', 'paidCustomer')->name('paid.customer');
    Route::get('/paid/customer/print/pdf', 'paidCustomerPrintPdf')->name('paid.customer.print.pdf');
    Route::get('/customer/wise/report', 'customerWiseReport')->name('customer.wise.report');
    Route::get('/customer/wise/credit/report', 'customerWiseCreditReport')->name('customer.wise.credit.report');
    Route::get('/customer/wise/paid/report', 'customerWisePaidReport')->name('customer.wise.paid.report');
});

//All Route Customer
Route::controller(SalesmanController::class)->group(function () {
    Route::get('/salesman/all', 'salesmanAll')->name('salesman.all');
    Route::get('/salesman/add', 'salesmanAdd')->name('salesman.add');
    Route::post('/salesman/store', 'salesmanStore')->name('salesman.store');
    Route::get('/salesman/edit/{id}', 'salesmanEdit')->name('salesman.edit');
    Route::post('/salesman/update', 'salesmanUpdate')->name('salesman.update');
    Route::get('/salesman/delete/{id}', 'salesmanDelete')->name('salesman.delete');
});

//All Route Unit
Route::controller(UnitController::class)->group(function () {
    Route::get('/unit/all', 'unitAll')->name('unit.all');
    Route::get('/unit/add', 'unitAdd')->name('unit.add');
    Route::post('/unit/store', 'unitStore')->name('unit.store');
    Route::get('/unit/edit/{id}', 'unitEdit')->name('unit.edit');
    Route::post('/unit/update', 'unitUpdate')->name('unit.update');
    Route::get('/unit/delete/{id}', 'unitDelete')->name('unit.delete');
});

//All Route Category
Route::controller(CategoryController::class)->group(function () {
    Route::get('/category/all', 'categoryAll')->name('category.all');
    Route::get('/category/add', 'categoryAdd')->name('category.add');
    Route::post('/category/store', 'categoryStore')->name('category.store');
    Route::get('/category/edit/{id}', 'categoryEdit')->name('category.edit');
    Route::post('/category/update', 'categoryUpdate')->name('category.update');
    Route::get('/category/delete/{id}', 'categoryDelete')->name('category.delete');
});

//All Route Product
Route::controller(ProductController::class)->group(function () {
    Route::get('/product/all', 'productAll')->name('product.all');
    Route::get('/product/add', 'productAdd')->name('product.add');
    Route::post('/product/store', 'productStore')->name('product.store');
    Route::get('/product/edit/{id}', 'productEdit')->name('product.edit');
    Route::post('/product/update', 'productUpdate')->name('product.update');
    Route::get('/product/delete/{id}', 'productDelete')->name('product.delete');
});

//All Route Purchase
Route::controller(PurchaseController::class)->group(function () {
    Route::get('/purchase/all', 'purchaseAll')->name('purchase.all');
    Route::get('/purchase/add', 'purchaseAdd')->name('purchase.add');
    Route::post('/purchase/store', 'purchaseStore')->name('purchase.store');
    Route::get('/purchase/delete/{id}', 'purchaseDelete')->name('purchase.delete');
    Route::get('/purchase/pending', 'purchasePending')->name('purchase.pending');
    Route::get('/purchase/approve/{id}', 'purchaseApprove')->name('purchase.approve');
    Route::get('/daily/purchase/report', 'dailyPurchaseReport')->name('daily.purchase.report');
    Route::get('/daily/purchase/pdf', 'dailyPurchasePdf')->name('daily.purchase.pdf');
});

//All Route Invoice
Route::controller(InvoiceController::class)->group(function () {
    Route::get('/invoice/all', 'invoiceAll')->name('invoice.all');
    Route::get('/invoice/add', 'invoiceAdd')->name('invoice.add');
    Route::post('/invoice/store', 'invoiceStore')->name('invoice.store');
    Route::get('/invoice/pending/list', 'pendingList')->name('invoice.pending.list');
    Route::get('/invoice/delete/{id}', 'invoiceDelete')->name('invoice.delete');
    Route::get('/invoice/approve/{id}', 'invoiceApprove')->name('invoice.approve');

    Route::post('/approval/store/{id}', 'approvalStore')->name('approval.store');
    Route::get('/print/invoice/list', 'printInvoiceList')->name('print.invoice.list');
    Route::get('/print/invoice/{id}', 'printInvoice')->name('print.invoice');

    Route::get('/daily/invoice/report', 'dailyInvoiceReport')->name('daily.invoice.report');
    Route::get('/daily/invoice/pdf', 'dailyInvoicePdf')->name('daily.invoice.pdf');
});

//All Route Stock
Route::controller(StockController::class)->group(function () {
    Route::get('/stock/report', 'stockReport')->name('stock.report');
    Route::get('/stock/report/pdf', 'stockReportPdf')->name('stock.report.pdf');
    Route::get('/stock/supplier/wise', 'stockSupplierWise')->name('stock.supplier.wise');
    Route::get('/supplier/wise/pdf', 'supplierWisePdf')->name('supplier.wise.pdf');
    Route::get('/product/wise/pdf', 'productWisePdf')->name('product.wise.pdf');
});

}); //End Group Middleware

//All Route Default
Route::controller(DefaultController::class)->group(function () {
    Route::get('/get-category', 'getCategory')->name('get-category');
    Route::get('/get-product', 'getProduct')->name('get-product');
    Route::get('/check-product', 'getStock')->name('check-product-stock');
});

Route::get('/dashboard', function () {
    return view('admin.index');
})->middleware(['auth', 'verified'])->name('/dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';
