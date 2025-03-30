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
use App\Http\Controllers\PurchaseRequsitionController;
use \App\Http\Controllers\ConsumptionSettingController;
use \App\Http\Controllers\SampleRequsitionController;
use \App\Http\Controllers\MasterInfoController;

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

//Profile API
Route::get('/user-profile',[UserController::class,'UserGetProfile'])->middleware('auth:sanctum');


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


//Section Page Frontend

Route::get('/section',[SectionController::class,'sectionPage']);

//Section Backend API

Route::post('/create-section',[SectionController::class,'sectionCreate'])->middleware('auth:sanctum');
Route::post('/section-delete',[SectionController::class,'sectionDelete'])->middleware('auth:sanctum');
Route::post('/section-update',[SectionController::class,'sectionUpdate'])->middleware('auth:sanctum');
Route::get('/section-list',[SectionController::class,'getSectionList'])->middleware('auth:sanctum');
Route::post('/section-by-id',[SectionController::class,'sectionById'])->middleware('auth:sanctum');






//Store Requisition Page Frontend

Route::get('/store-requsition',[StoreRequsitionController::class,'storeRequsitionPage'])
->name('store.requsition');

// Route::get('/store-requsition-update/{id}',[StoreRequsitionController::class,'storeRequsitionPageUpdate'])
// ->name('store.requsition.update');

// Route::post('/store-requsition-update-api',[StoreRequsitionController::class,'storeRequsitionPageUpdateAPI'])
// ->name('store.requsition.update');

//Route::get('/store-requsition-update-id/{id}',[StoreRequsitionController::class,'storeReqUpdateDetails']);





//Store Requisition Frontend Page
Route::get('/store-requsition-list',[StoreRequsitionController::class,  'storeRequsitionListPage']);

//Store Requisition Backend API
Route::post('/create-store-req',[StoreRequsitionController::class,'storeReqCreate'])->middleware('auth:sanctum');
Route::get('/store-req-list', [StoreRequsitionController::class,'storeReqList'])->middleware('auth:sanctum');
Route::post('/store-req-details', [StoreRequsitionController::class,'storeReqDetails'])->middleware('auth:sanctum');
Route::post('/store-req-details-up', [StoreRequsitionController::class,'storeReqDetailsUP'])->middleware('auth:sanctum');
//Route::post('/store-req-details-exist-pro', [StoreRequsitionController::class,'storeReqDetailsUP'])->middleware('auth:sanctum');
Route::post('/store-recommended', [StoreRequsitionController::class,'storeReqRecom'])->middleware('auth:sanctum');
Route::post('/store-not-recommended', [StoreRequsitionController::class,'storeReqNotRecom'])->middleware('auth:sanctum');
Route::post('/update-store-req', [StoreRequsitionController::class,'storeUpdateReq'])->middleware('auth:sanctum');
Route::post('/delete-store-req', [StoreRequsitionController::class,'storeReqDelete'])->middleware('auth:sanctum');

// Store Requsition Frontend Report Page
Route::get('/section-wise-req-report',[StoreRequsitionController::class,'sectionWiseReqRepPage']);
Route::get('/status-wise-req-report',[StoreRequsitionController::class,'statusWiseReqRepPage']);



// Store Requsition Report Backend API
Route::post('/section-wise-requsition-report',[StoreRequsitionController::class,'sectionWiseReqRep']);
Route::post('/status-wise-requsition-report',[StoreRequsitionController::class,'statusWiseReqRep']);



// Purchase Requsition Frontend Page
Route::get('/purchase-requsition',[PurchaseRequsitionController::class,'purchaseRequsitionPage'])
->name('purchase.requsition');
Route::get('/purchase-requsition-list',[PurchaseRequsitionController::class,  'purchaseRequsitionListPage']);




//Purchase Requisition Backend API
Route::post('/create-purchase-req',[PurchaseRequsitionController::class,'purchaseReqCreate'])->middleware('auth:sanctum');
Route::get('/purchase-req-list', [PurchaseRequsitionController::class,'purchaseReqList'])->middleware('auth:sanctum');
Route::post('/purchase-req-details', [PurchaseRequsitionController::class,'purchaseReqDetails'])->middleware('auth:sanctum');
Route::post('/update-purchase-req', [PurchaseRequsitionController::class,'purchaseUpdateReq'])->middleware('auth:sanctum');
Route::post('/purchase-req-details-up', [PurchaseRequsitionController::class,'purchaseReqDetailsUP'])->middleware('auth:sanctum');
Route::post('/delete-purchase-req', [PurchaseRequsitionController::class,'purchaseReqDelete'])->middleware('auth:sanctum');
Route::post('/purchase-recommended', [PurchaseRequsitionController::class,'purchaseReqRecom'])->middleware('auth:sanctum');
Route::post('/purchase-not-recommended', [PurchaseRequsitionController::class,'purchaseReqNotRecom'])->middleware('auth:sanctum');


//Consumption Setting Frontend Page

Route::get('/consumption-setting-list',[ConsumptionSettingController::class, 'consumptionListPage']);

//Consumption Setting Backend API

Route::get('/consumption-setting-alldata',[ConsumptionSettingController::class,'getConsumptionSettList'])->middleware('auth:sanctum');
Route::post('/create-consumption-setting',[ConsumptionSettingController::class,'consumptionSettCreate'])->middleware('auth:sanctum');
Route::post('/update-consumption-setting',[ConsumptionSettingController::class,'consumptionSettUpdate'])->middleware('auth:sanctum');
Route::post('/delete-consumption-setting',[ConsumptionSettingController::class,'consumptionSettDelete'])->middleware('auth:sanctum');
Route::post('/consumption-setting-by-id',[ConsumptionSettingController::class,'consumptionSettById'])->middleware('auth:sanctum');



//Master Page Frontend

Route::get('/master-info',[MasterInfoController::class,'masterPage']);

//Master Backend API

Route::post('/create-master',[MasterInfoController::class,'masterCreate'])->middleware('auth:sanctum');
Route::post('/master-delete',[MasterInfoController::class,'masterDelete'])->middleware('auth:sanctum');
Route::post('/master-update',[MasterInfoController::class,'masterUpdate'])->middleware('auth:sanctum');
Route::get('/master-list',[MasterInfoController::class,'getMasterList'])->middleware('auth:sanctum');
Route::post('/master-by-id',[MasterInfoController::class,'masterByID'])->middleware('auth:sanctum');

// Sample Requsition Frontend Page
Route::get('/sample-requsition',[SampleRequsitionController::class,'sampleRequsitionPage'])
    ->name('sample.requsition');

Route::get('/sample-requsition-2',[SampleRequsitionController::class,'sampleRequsitionPage2'])
    ->name('sample.requsition');
