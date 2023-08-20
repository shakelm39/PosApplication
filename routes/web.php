<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Backend\UnitController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\DefaultController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\CategoryController;
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

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

   // middleware
Route::group(['middleware'=>'auth'],function(){

	// //user group
	// Route::prefix('users')->group(function(){

	// 	Route::get('/view', 'Backend\UserController@view')->name('users.view');
	// 	Route::get('/add', 'Backend\UserController@add')->name('users.add');
	// 	Route::post('/store', 'Backend\UserController@store')->name('users.store');
	// 	Route::get('/edit/{id}', 'Backend\UserController@edit')->name('users.edit');
	// 	Route::post('/update/{id}', 'Backend\UserController@update')->name('users.update');
	// 	Route::get('/delete/{id}', 'Backend\UserController@delete')->name('users.delete');
	// });

	// //profile group
	// Route::prefix('profiles')->group(function(){

	// 	Route::get('/view', 'Backend\ProfileController@view')->name('profiles.view');
	// 	Route::get('/edit', 'Backend\ProfileController@edit')->name('profiles.edit');
	// 	Route::post('/store', 'Backend\ProfileController@update')->name('profiles.update');
	// 	Route::get('/password/view', 'Backend\ProfileController@passwordView')->name('profiles.password.view');
	// 	Route::post('/password/update', 'Backend\ProfileController@passwordUpdate')->name('profiles.password.update');
	// });

	//Suppliers group
	Route::prefix('suppliers')->group(function(){

		Route::get('/view', 		[SupplierController::class,'index'])->name('suppliers.index');
		Route::get('/add', 			[SupplierController::class,'create'])->name('suppliers.create');
		Route::post('/store', 		[SupplierController::class,'store'])->name('suppliers.store');
		Route::get('/edit', 		[SupplierController::class,'edit'])->name('suppliers.edit');
		Route::post('/update', 		[SupplierController::class,'update'])->name('suppliers.update');
		Route::get('/delete', 		[SupplierController::class,'destroy'])->name('suppliers.delete');
	});
// //Customers group
// 	Route::prefix('customers')->group(function(){

// 		Route::get('/view', 'Backend\CustomerController@view')->name('customers.view');
// 		Route::get('/add', 'Backend\CustomerController@add')->name('customers.add');
// 		Route::post('/store', 'Backend\CustomerController@store')->name('customers.store');
// 		Route::get('/edit/{id}', 'Backend\CustomerController@edit')->name('customers.edit');
// 		Route::post('/update/{id}', 'Backend\CustomerController@update')->name('customers.update');
// 		Route::get('/delete/{id}', 'Backend\CustomerController@delete')->name('customers.delete');
// 		Route::get('/credit', 'Backend\CustomerController@creditCustomer')->name('customers.credit');
// 		Route::get('/credit/pdf', 'Backend\CustomerController@creditCustomerPdf')->name('customers.credit.pdf');
// 		Route::get('/invoice/edit/{invoice_id}', 'Backend\CustomerController@editInvoice')->name('customers.edit.invoice');
// 		Route::post('/invoice/update/{invoice_id}', 'Backend\CustomerController@updateInvoice')->name('customers.update.invoice');
// 		Route::get('/invoice/details/pdf/{invoice_id}', 'Backend\CustomerController@invoiceDetailsPdf')->name('invoice.details.pdf');
// 		Route::get('/paid', 'Backend\CustomerController@paidCustomer')->name('customers.paid');
// 		Route::get('/paid/pdf', 'Backend\CustomerController@paidCustomerPdf')->name('customers.paid.pdf');
// 		Route::get('/wise/report', 'Backend\CustomerController@customerWiseReport')->name('customers.wise.report');
// 		Route::get('/wise/credit/report', 'Backend\CustomerController@customerWiseCredit')->name('customers.wise.credit.report');
// 		Route::get('/wise/paid/report', 'Backend\CustomerController@customerWisePaid')->name('customers.wise.paid.report');
// 	});

//Units group
	Route::prefix('units')->group(function(){

		Route::get('/view', 		[UnitController::class, 'index'])->name('units.index');
		Route::get('/add', 			[UnitController::class, 'create'])->name('units.create');
		Route::post('/store', 		[UnitController::class, 'store'])->name('units.store');
		Route::get('/edit/{id}', 	[UnitController::class, 'edit'])->name('units.edit');
		Route::post('/update', 		[UnitController::class, 'update'])->name('units.update');
		Route::get('/delete/{id}', 	[UnitController::class, 'destroy'])->name('units.delete');
	});
	
//Categories group
	Route::prefix('categories')->group(function(){

		Route::get('/view', 		[CategoryController::class,'index'])->name('categories.index');
		Route::get('/add',  		[CategoryController::class,'create'])->name('categories.create');
		Route::post('/store', 		[CategoryController::class,'store'])->name('categories.store');
		Route::get('/edit/{id}', 	[CategoryController::class,'edit'])->name('categories.edit');
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
	// Route::prefix('invoice')->group(function(){

	// 	Route::get('/view', 'Backend\InvoiceController@view')->name('invoice.view');
	// 	Route::get('/add', 'Backend\InvoiceController@add')->name('invoice.add');
	// 	Route::post('/store', 'Backend\InvoiceController@store')->name('invoice.store');
	// 	Route::get('/pending', 'Backend\InvoiceController@pendingList')->name('invoice.pending.list');
	// 	Route::get('/approve/{id}', 'Backend\InvoiceController@approve')->name('invoice.approve');
	// 	Route::get('/delete/{id}', 'Backend\InvoiceController@delete')->name('invoice.delete');
	// 	Route::post('/approve/store/{id}', 'Backend\InvoiceController@approvalStore')->name('approval.store');
	// 	Route::get('/print/list', 'Backend\InvoiceController@printInvoiceList')->name('invoice.print.list');
	// 	Route::get('/print/{id}', 'Backend\InvoiceController@printInvoice')->name('invoice.print');
	// 	Route::get('/daily/report', 'Backend\InvoiceController@dailyReport')->name('invoice.daily.report');
	// 	Route::get('/daily/report/pdf', 'Backend\InvoiceController@dailyReportPdf')->name('invoice.daily.report.pdf');

	// });
	//Stock Management
	// Route::prefix('stock')->group(function(){

	// 	Route::get('/report', 'Backend\StockController@stockReport')->name('stock.report');
	// 	Route::get('/report/pdf', 'Backend\StockController@stockReportPdf')->name('stock.report.pdf');
	// 	Route::get('/report/supplier/product/wise', 'Backend\StockController@supplierProductWise')->name('stock.report.supplier.product.wise');
	// 	Route::get('/report/supplier/wise/pdf', 'Backend\StockController@supplierWisePdf')->name('stock.report.supplier.wise.pdf');
	// 	Route::get('/report/product/wise/pdf', 'Backend\StockController@productWisePdf')->name('stock.report.product.wise.pdf');
		

	// });
	//Default controller
	 Route::get('/get-category',[DefaultController::class,'getCategory'])->name('purchase.get-category');
	 Route::get('/get-brand',	[DefaultController::class,'getBrand'])->name('purchase.get-brand');
	 Route::get('/get-product',	[DefaultController::class,'getProduct'])->name('purchase.get-product');
	 Route::get('/get-stock',	[DefaultController::class,'getStock'])->name('check-product-stock');
	
});