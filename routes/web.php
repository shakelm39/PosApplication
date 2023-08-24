<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\UnitController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\StockController;
use App\Http\Controllers\Backend\DefaultController;
use App\Http\Controllers\Backend\InvoiceController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\CustomerController;
use App\Http\Controllers\Backend\PurchaseController;
use App\Http\Controllers\Backend\SupplierController;

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
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('backend.layouts.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';

   // middleware
Route::group(['middleware'=>'auth'],function(){

	//user group
	Route::prefix('users')->group(function(){

		Route::get('/view', 		[UserController::class,'index'])->name('users.index');
		Route::get('/add', 			[UserController::class,'create'])->name('users.create');
		Route::post('/store', 		[UserController::class,'store'])->name('users.store');
		Route::get('/edit', 		[UserController::class,'edit'])->name('users.edit');
		Route::post('/update', 		[UserController::class,'update'])->name('users.update');
		Route::get('/delete', 		[UserController::class,'delete'])->name('users.delete');

	});

	//profile group
	Route::prefix('profiles')->group(function(){

		Route::get('/view', 			[ProfileController::class,'view'])->name('profiles.view');
		Route::get('/edit', 			[ProfileController::class,'edit'])->name('profiles.edit');
		Route::post('/store', 			[ProfileController::class,'update'])->name('profiles.update');
		Route::get('/password/view', 	[ProfileController::class,'passwordView'])->name('profiles.password.view');
		Route::post('/password/update', [ProfileController::class,'passwordUpdate'])->name('profiles.password.update');
	});

	//Suppliers group
	Route::prefix('suppliers')->group(function(){

		Route::get('/view', 		[SupplierController::class,'index'])->name('suppliers.index');
		Route::get('/add', 			[SupplierController::class,'create'])->name('suppliers.create');
		Route::post('/store', 		[SupplierController::class,'store'])->name('suppliers.store');
		Route::get('/edit', 		[SupplierController::class,'edit'])->name('suppliers.edit');
		Route::post('/update', 		[SupplierController::class,'update'])->name('suppliers.update');
		Route::get('/delete', 		[SupplierController::class,'destroy'])->name('suppliers.delete');
	});

//Customers group
	Route::prefix('customers')->group(function(){

		Route::get('/view', 							[CustomerController::class,'view'])->name('customers.view');
		Route::get('/add', 								[CustomerController::class,'add'])->name('customers.add');
		Route::post('/store', 							[CustomerController::class,'store'])->name('customers.store');
		Route::get('/edit/{id}', 						[CustomerController::class,'edit'])->name('customers.edit');
		Route::post('/update/{id}', 					[CustomerController::class,'update'])->name('customers.update');
		Route::get('/delete/{id}', 						[CustomerController::class,'delete'])->name('customers.delete');
		Route::get('/credit', 							[CustomerController::class,'creditCustomer'])->name('customers.credit');
		Route::get('/credit/pdf', 						[CustomerController::class,'creditCustomerPdf'])->name('customers.credit.pdf');
		Route::get('/invoice/edit/{invoice_id}', 		[CustomerController::class,'editInvoice'])->name('customers.edit.invoice');
		Route::post('/invoice/update/{invoice_id}', 	[CustomerController::class,'updateInvoice'])->name('customers.update.invoice');
		Route::get('/invoice/details/pdf/{invoice_id}', [CustomerController::class,'invoiceDetailsPdf'])->name('invoice.details.pdf');
		Route::get('/paid', 							[CustomerController::class,'paidCustomer'])->name('customers.paid');
		Route::get('/paid/pdf', 						[CustomerController::class,'paidCustomerPdf'])->name('customers.paid.pdf');
		Route::get('/wise/report', 						[CustomerController::class,'customerWiseReport'])->name('customers.wise.report');
		Route::get('/wise/credit/report', 				[CustomerController::class,'customerWiseCredit'])->name('customers.wise.credit.report');
		Route::get('/wise/paid/report', 				[CustomerController::class,'customerWisePaid'])->name('customers.wise.paid.report');
	});

//Units group
	Route::prefix('units')->group(function(){

		Route::get('/view', 		[UnitController::class, 'index'])->name('units.index');
		Route::get('/add', 			[UnitController::class, 'create'])->name('units.create');
		Route::post('/store', 		[UnitController::class, 'store'])->name('units.store');
		Route::get('/edit', 		[UnitController::class, 'edit'])->name('units.edit');
		Route::post('/update', 		[UnitController::class, 'update'])->name('units.update');
		Route::get('/delete', 		[UnitController::class, 'destroy'])->name('units.delete');
	});
	
//Categories group
	Route::prefix('categories')->group(function(){

		Route::get('/view', 		[CategoryController::class,'index'])->name('categories.index');
		Route::get('/add',  		[CategoryController::class,'create'])->name('categories.create');
		Route::post('/store', 		[CategoryController::class,'store'])->name('categories.store');
		Route::get('/edit', 		[CategoryController::class,'edit'])->name('categories.edit');
		Route::post('/update', 		[CategoryController::class,'update'])->name('categories.update');
		Route::get('/delete', 		[CategoryController::class,'destroy'])->name('categories.delete');
	});
//Brands group
	Route::prefix('brands')->group(function(){

		Route::get('/view',         [BrandController::class, 'index'])->name('brands.index');
		Route::get('/add',          [BrandController::class, 'create'])->name('brands.create');
		Route::post('/store',       [BrandController::class, 'store'])->name('brands.store');
		Route::get('/edit',    		[BrandController::class, 'edit'])->name('brands.edit');
		Route::post('/update', 		[BrandController::class, 'update'])->name('brands.update');
		Route::get('/delete',  		[BrandController::class, 'destroy'])->name('brands.delete');
	});

//Products group

	Route::prefix('products')->group(function(){

		Route::get('/view', 		[ProductController::class,'index'])->name('products.index');
		Route::get('/add', 			[ProductController::class,'create'])->name('products.create');
		Route::post('/store', 		[ProductController::class,'store'])->name('products.store');
		Route::get('/edit/{id}', 	[ProductController::class,'edit'])->name('products.edit');
		Route::post('/update/{id}', [ProductController::class,'update'])->name('products.update');
		Route::get('/delete/{id}', 	[ProductController::class,'destroy'])->name('products.delete');
	});

//Purchase group
	Route::prefix('purchase')->group(function(){

		Route::get('/view', 		[PurchaseController::class,'index'])->name('purchase.index');
		Route::get('/add', 			[PurchaseController::class,'create'])->name('purchase.create');
		Route::post('/store', 		[PurchaseController::class,'store'])->name('purchase.store');
		Route::get('/pending', 		[PurchaseController::class,'pendingList'])->name('purchase.pending.list');
		Route::get('/approve/{id}', [PurchaseController::class,'approve'])->name('purchase.approve');
		Route::get('/delete/{id}', 	[PurchaseController::class,'delete'])->name('purchase.delete');
		Route::get('/report', 		[PurchaseController::class,'purchaseReport'])->name('purchase.report');
		Route::get('/report/pdf', 	[PurchaseController::class,'purchaseReportPdf'])->name('purchase.report.pdf');
	});

	//Invoice group
	Route::prefix('invoice')->group(function(){

		Route::get('/view', 				[InvoiceController::class,'view'])->name('invoice.view');
		Route::get('/add', 					[InvoiceController::class,'add'])->name('invoice.add');
		Route::post('/store', 				[InvoiceController::class,'store'])->name('invoice.store');
		Route::get('/pending', 				[InvoiceController::class,'pendingList'])->name('invoice.pending.list');
		Route::get('/approve/{id}', 		[InvoiceController::class,'approve'])->name('invoice.approve');
		Route::get('/delete/{id}', 			[InvoiceController::class,'delete'])->name('invoice.delete');
		Route::post('/approve/store/{id}', 	[InvoiceController::class,'approvalStore'])->name('approval.store');
		Route::get('/print/list', 			[InvoiceController::class,'printInvoiceList'])->name('invoice.print.list');
		Route::get('/print/{id}', 			[InvoiceController::class,'printInvoice'])->name('invoice.print');
		Route::get('/daily/report', 		[InvoiceController::class,'dailyReport'])->name('invoice.daily.report');
		Route::get('/daily/report/pdf', 	[InvoiceController::class,'dailyReportPdf'])->name('invoice.daily.report.pdf');

	});

	//Stock Management
	Route::prefix('stock')->group(function(){
		Route::get('/report', 						[StockController::class,'stockReport'])->name('stock.report');
		Route::get('/report/pdf', 					[StockController::class,'stockReportPdf'])->name('stock.report.pdf');
		Route::get('/report/supplier/product/wise', [StockController::class,'supplierProductWise'])->name('stock.report.supplier.product.wise');
		Route::get('/report/supplier/wise/pdf', 	[StockController::class,'supplierWisePdf'])->name('stock.report.supplier.wise.pdf');
		Route::get('/report/product/wise/pdf', 		[StockController::class,'productWisePdf'])->name('stock.report.product.wise.pdf');
	});
	//Default controller
	 Route::get('/get-category',[DefaultController::class,'getCategory'])->name('purchase.get-category');
	 Route::get('/get-brand',	[DefaultController::class,'getBrand'])->name('purchase.get-brand');
	 Route::get('/get-product',	[DefaultController::class,'getProduct'])->name('purchase.get-product');
	 Route::get('/get-stock',	[DefaultController::class,'getStock'])->name('check-product-stock');
	
});