<?php

use App\Http\Controllers\Backend\ExpenseCategoryController;
use App\Http\Controllers\Backend\ExpenseController;
use App\Http\Controllers\Backend\PurchaseInvoiceController;
use App\Http\Controllers\Backend\SettingsController;
use App\Http\Controllers\Backend\StockController;
use App\Http\Controllers\DailCashReportController;
use App\Http\Controllers\DailyCashReportController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SaleInvoiceController;
use App\Http\Controllers\StockReportController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Backend\AreaController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\CompanyController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\DistrictController;
use App\Http\Controllers\Backend\InvestorController;
use App\Http\Controllers\Backend\PurchaseController;
use App\Http\Controllers\Backend\SupplierController;
use App\Http\Controllers\Backend\CustomersController;
use App\Http\Controllers\Backend\PrivacyPolicyController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return to_route('home');
});
Route::get('/logout', function () {
    Auth::logout();
    return to_route('login');
});

Auth::routes([
    'register' => false, // Registration Routes...
    'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function () {

    Route::resource('purchase', PurchaseController::class);
    Route::resource('purchase-invoice', PurchaseInvoiceController::class);
    Route::post('pay_purchase_due/{id}', [PurchaseInvoiceController::class, 'pay_purchase_due'])->name('pay_purchase_due');
    Route::get('get-single-product/{id}', [ProductController::class, 'get_single_product']);
    Route::get('get-single-purchase-details/{id}', [PurchaseController::class, 'get_single_purchase']);

    Route::resource('sale', SaleController::class);
    Route::resource('sale-invoice', SaleInvoiceController::class);
    Route::post('pay_sale_due/{id}', [SaleInvoiceController::class, 'pay_sale_due'])->name('pay_sale_due');
    Route::get('get-single-sale-details/{id}', [SaleController::class, 'get_single_sale']);

    Route::resource('category', CategoryController::class);
    Route::resource('customer', CustomersController::class);
    Route::resource('supplier', SupplierController::class);
    Route::resource('investor', InvestorController::class);
    Route::resource('company', CompanyController::class);
    Route::resource('product', ProductController::class);
    Route::resource('district', DistrictController::class);
    Route::resource('area', AreaController::class);
    Route::resource('slider', SliderController::class);
    Route::resource('privacy-policy', PrivacyPolicyController::class);
    Route::resource('expense-category', ExpenseCategoryController::class);
    Route::resource('expense', ExpenseController::class);
    Route::resource('stock', StockController::class);
    Route::resource('settings', SettingsController::class);

    Route::get('daily-cash-closing', [DailyCashReportController::class, 'daily_cash_closing'])->name('daily_cash_closing');

    Route::get('stock-report', [StockReportController::class, 'stock_report'])->name('product_stock');
    Route::get('expense-report', [ReportController::class, 'expense_report'])->name('expense_report');

    Route::get('purchase-report', [ReportController::class, 'purchase_report'])->name('purchase_report');

    Route::get('customer-outstanding-report', [ReportController::class, 'customer_outstanding_report'])->name('customer_outstanding_report');
    Route::get('customer-invoice-list/{id}', [ReportController::class, 'customer_invoice_list'])->name('customer_invoice_list');
    Route::get('cash-collection-report', [ReportController::class, 'cash_collection_report'])->name('cash_collection_report');

    Route::get('supplier-outstanding-report', [ReportController::class, 'supplier_outstanding_report'])->name('supplier_outstanding_report');
    Route::get('supplier-invoice-list/{id}', [ReportController::class, 'supplier_invoice_list'])->name('supplier_invoice_list');
    Route::get('supplier-payment-report', [ReportController::class, 'supplier_payment_report'])->name('supplier_payment_report');

});
