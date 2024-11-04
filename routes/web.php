<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductReceiveController;
use App\Http\Controllers\StoreCategorieControllar;
use App\Http\Controllers\StoreRequsitionController;
use App\Http\Controllers\ProductDistributionController;


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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/userLogin',[UserController::class,'LoginPage'])->name('login');
Route::get('/userRegistration',[UserController::class,'RegistrationPage']);
Route::get('/userProfile',[UserController::class,'userProfilePage']);
Route::get('/dashboard',[DashboardController::class,'DashboardPage']);


// Registration API

Route::post('/user-registration',[UserController::class,'userRegistration']);
Route::get('/token',[UserController::class,'tokenCreate']);
Route::get('/user-list',[UserController::class,'getUser'])->middleware('auth:sanctum');

// Login API
Route::post('/user-login',[UserController::class,'userLogin']);

//Logout API
//Route::get('/logout',[UserController::class,'userLogout'])->middleware('auth:sanctum');

Route::get('/logout',[UserController::class,'UserLogout'])->middleware('auth:sanctum');


//Store Page Frontend

Route::get('/store',[StoreController::class,'storePage']);

//Store Backend API

Route::post('/create-store',[StoreController::class,'storeCreate'])->middleware('auth:sanctum');
Route::post('/store-delete',[StoreController::class,'storeDelete'])->middleware('auth:sanctum');
Route::post('/store-update',[StoreController::class,'storeUpdate'])->middleware('auth:sanctum');
Route::get('/store-list',[StoreController::class,'getStoreList'])->middleware('auth:sanctum');
Route::post('/store-by-id',[StoreController::class,'storeById'])->middleware('auth:sanctum');

//Store Category Page Frontend

Route::get('/store-category',[StoreCategorieControllar::class,'storeCategoriePage']);

//Store Category Backend API

Route::post('/create-store-category',[StoreCategorieControllar::class,'storeCategoryCreate'])->middleware('auth:sanctum');
Route::post('/store-category-delete',[StoreCategorieControllar::class,'storeCategoryDelete'])->middleware('auth:sanctum');
Route::post('/store-category-update',[StoreCategorieControllar::class,'storeCategoryUpdate'])->middleware('auth:sanctum');
Route::get('/store-category-list',[StoreCategorieControllar::class,'getStoreCategoryList'])->middleware('auth:sanctum');
Route::post('/store-category-by-id',[StoreCategorieControllar::class,'storeCategoryById'])->middleware('auth:sanctum');

//Unit Page Frontend

Route::get('/unit',[UnitController::class,'unitPage']);

//Unit Backend API

Route::post('/create-unit',[UnitController::class,'unitCreate'])->middleware('auth:sanctum');
Route::post('/unit-delete',[UnitController::class,'unitDelete'])->middleware('auth:sanctum');
Route::post('/unit-update',[UnitController::class,'unitUpdate'])->middleware('auth:sanctum');
Route::get('/unit-list',[UnitController::class,'getUnitList'])->middleware('auth:sanctum');
Route::post('/unit-by-id',[UnitController::class,'unitById'])->middleware('auth:sanctum');

//Supplier Page Frontend

Route::get('/supplier',[SupplierController::class,'supplierPage']);

//Supplier Backend API

Route::post('/create-supplier',[SupplierController::class,'supplierCreate'])->middleware('auth:sanctum');
Route::post('/supplier-delete',[SupplierController::class,'supplierDelete'])->middleware('auth:sanctum');
Route::post('/supplier-update',[SupplierController::class,'supplierUpdate'])->middleware('auth:sanctum');
Route::get('/supplier-list',[SupplierController::class,'supplierList'])->middleware('auth:sanctum');
Route::post('/supplier-by-id',[SupplierController::class,'supplierById'])->middleware('auth:sanctum');

//Product Setup Page Frontend

Route::get('/product-setup',[ProductController::class,'productSetupPage']);

//Product Setup Backend API

Route::post('/create-pro-setup',[ProductController::class,'productSetupCreate'])->middleware('auth:sanctum');
Route::post('/pro-setup-delete',[ProductController::class,'productSetupDelete'])->middleware('auth:sanctum');
Route::post('/pro-setup-update',[ProductController::class,'productSetupUpdate'])->middleware('auth:sanctum');
Route::get('/pro-setup-list',[ProductController::class,'getProductSetupList'])->middleware('auth:sanctum');
Route::post('/pro-setup-by-id',[ProductController::class,'productSetupById'])->middleware('auth:sanctum');


//Product Receive Page Frontend

Route::get('/product-recieve',[ProductReceiveController::class,'productReceivePage']);

//Product Receive Backend API

Route::post('/create-product-receive',[ProductReceiveController::class,'productReceiveCreate'])->middleware('auth:sanctum');
Route::post('/pro-receive-delete',[ProductReceiveController::class,'productReceiveDelete'])->middleware('auth:sanctum');
Route::post('/pro-receive-update',[ProductReceiveController::class,'productReceiveUpdate'])->middleware('auth:sanctum');
Route::get('/pro-receive-list',[ProductReceiveController::class,'productReceiveList'])->middleware('auth:sanctum');
Route::post('/pro-receive-by-id',[ProductReceiveController::class,'productReceiveById'])->middleware('auth:sanctum');

//Product Distribution Page Frontend

Route::get('/product-distribution',[ProductDistributionController::class,'productDistributionPage']);

//Product Distribution Backend API

Route::post('/create-product-distribution',[ProductDistributionController::class,'productDistributionCreate'])->middleware('auth:sanctum');
Route::post('/pro-distribution-delete',[ProductDistributionController::class,'productDistributionDelete'])->middleware('auth:sanctum');
Route::post('/pro-distribution-update',[ProductDistributionController::class,'productDistributionUpdate'])->middleware('auth:sanctum');
Route::get('/pro-distribution-list',[ProductDistributionController::class,'productDistributionList'])->middleware('auth:sanctum');
Route::post('/pro-distribution-by-id',[ProductDistributionController::class,'productDistributionById'])->middleware('auth:sanctum');

//Stock Page Frontend

Route::get('/stock',[StockController::class,'stockPage']);
Route::get('/store-wise-stock',[StockController::class,'storeWiseStockPage']);
Route::get('/category-wise-stock',[StockController::class,'categoryWiseStockPage']);


//Various Type Backend API
Route::get('/stock-list',[StockController::class,'getStock'])->middleware('auth:sanctum');
Route::get('/stock-list-down',[StockController::class,'getStockDown'])->middleware('auth:sanctum');
Route::post('/stockwise-store-list',[StockController::class,'getStoreWiseStock'])->middleware('auth:sanctum');
Route::post('/stockwise-store-list-download',[StockController::class,'getStoreWiseStockDown'])->middleware('auth:sanctum');
Route::post('/stock-by-category-list',[StockController::class,'getStoreCategoryStock'])->middleware('auth:sanctum');
Route::post('/stock-by-category-list-download',[StockController::class,'getStoreCategoryStockDown'])->middleware('auth:sanctum');



//Profile API
Route::get('/user-profile',[UserController::class,'UserGetProfile'])->middleware('auth:sanctum');

//Section Page Frontend

Route::get('/section',[SectionController::class,'sectionPage']);

//Section Backend API

Route::post('/create-section',[SectionController::class,'sectionCreate'])->middleware('auth:sanctum');
Route::post('/section-delete',[SectionController::class,'sectionDelete'])->middleware('auth:sanctum');
Route::post('/section-update',[SectionController::class,'sectionUpdate'])->middleware('auth:sanctum');
Route::get('/section-list',[SectionController::class,'getSectionList'])->middleware('auth:sanctum');
Route::post('/section-by-id',[SectionController::class,'sectionById'])->middleware('auth:sanctum');


//Store Requisition Page Frontend

Route::get('/store-requsition',[StoreRequsitionController::class,'storeRequsitionPage'])->name('store.requsition');

//Store Requisition Backend API

Route::post('/store-req',[StoreRequsitionController::class,'storeReqCreate']);
// Route::post('/section-delete',[SectionController::class,'sectionDelete'])->middleware('auth:sanctum');
// Route::post('/section-update',[SectionController::class,'sectionUpdate'])->middleware('auth:sanctum');
// Route::get('/section-list',[SectionController::class,'getSectionList'])->middleware('auth:sanctum');
// Route::post('/section-by-id',[SectionController::class,'sectionById'])->middleware('auth:sanctum');


//Purches Requisition Page Frontend

//Route::get('/purches-requsition');

