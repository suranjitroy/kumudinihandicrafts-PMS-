<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductReceive;
use Illuminate\Support\Facades\DB;
use App\Models\ProductDistribution;
use App\Models\StoreCategorie;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Database\Query\JoinClause;

class StockController extends Controller
{
    //

    public function stockPage(){

        // $productReceive = ProductReceive::
        // select('store_id','store_category_id','product_id','unit_id','quantity')
        // ->with('store','storeCategory','product','unit')
        // ->groupBy('product_id')
        // ->selectRaw('sum(quantity) as quantity')
        // ->get();

        // $productDistribute = ProductDistribution::
        // select('store_id','store_category_id','product_id','unit_id','quantity as disQuantity')
        // ->with('store','storeCategory','product','unit')
        // ->groupBy('product_id')
        // ->selectRaw('sum(quantity) as disQuantity')
        // ->get();

       // $unions = $productReceive->union($productDistribute);

        // $recQty = ProductReceive::with('store','storeCategory','product', 'unit')
        //            ->groupBy('product_id')
        //            ->selectRaw('sum(quantity) as recQt');

        // $stockReport = DB::table('product_receives')
        //     ->select('product_receives.product_id', 'products.product_name',
        //         DB::raw('SUM(product_receives.quantity) as total_received'),
        //         DB::raw('(SELECT COALESCE(SUM(product_distributions.quantity), 0)
        //                 FROM product_distributions
        //                 WHERE product_distributions.product_id = product_receives.product_id) as total_distributed'),
        //         DB::raw('SUM(product_receives.quantity) - 
        //                 (SELECT COALESCE(SUM(product_distributions.quantity), 0)
        //                 FROM product_distributions
        //                 WHERE product_distributions.product_id = product_receives.product_id) as current_stock'))
        //     ->join('products', 'product_receives.product_id', '=', 'products.id')
        //     ->groupBy('product_receives.product_id', 'products.product_name')
        //     ->get();

        return view('pages.dashboard.stock');           
                   

        // $product = Product::select('id')->find(5);
        // $productID = $product->id;

        
        // $category = StoreCategorie::select('id')->find(4);
        // $categoryId = $category->id;

        // $store = Store::select('id')->find(4);
        // $storeID = $store->id;

        // $product = Product::select('id')->find(7);
        // $productID = $product->id;

        
        // $category = StoreCategorie::select('id')->find(5);
        // $categoryId = $category->id;

        // $store = Store::select('id')->find(5);
        // $storeID = $store->id;

        // //return $id[0]->id;

        // $ReceiveQuantity = ProductReceive::select('store_id','store_category_id','product_id', 'quantity', 'unit_id')
        // ->where('product_id', $productID)
        // ->where('store_category_id', $categoryId)
        // ->where('store_id', $storeID)
        // ->sum('quantity');

        // $DistributeQuantity = ProductDistribution::select('store_id','store_category_id','product_id', 'quantity', 'unit_id')
        // ->where('product_id', $productID)
        // ->where('store_category_id', $categoryId)
        // ->where('store_id', $storeID)
        // ->sum('quantity');

        // $CurrentQuantity = $ReceiveQuantity - $DistributeQuantity;

        // return $ReceiveQuantity;
        // return $DistributeQuantity;

        //return [$ReceiveQuantity, $DistributeQuantity, $CurrentQuantity];


        // return view('pages.dashboard.stock',[
        //     'products' => $product,
        //     'recQty' => $recQty
        //     // 'ReceiveQuantity' => $ReceiveQuantity,
        //     // 'DistributeQuantity' => $DistributeQuantity,
        //     // 'CurrentQuantity' =>  $CurrentQuantity
        // ]);
    }

    
    public function storeWiseStockPage(){
        return view('pages.dashboard.store-wise-stock');                       
    }

    public function categoryWiseStockPage(){
        return view('pages.dashboard.stock-by-category');                       
    }


    public function getStock(){

        $stockReport = DB::table('product_receives')
            ->select('product_receives.product_id', 'stores.name', 'store_categories.category_name', 'products.product_name','units.unit_name',
                DB::raw('DATE_FORMAT(product_receives.created_at, "%d-%m-%Y") as receive_date'),    
                DB::raw('SUM(product_receives.quantity) as total_received'),
                DB::raw('(SELECT COALESCE(SUM(product_distributions.quantity), 0)
                        FROM product_distributions
                        WHERE product_distributions.product_id = product_receives.product_id) as total_distributed'),
                DB::raw('SUM(product_receives.quantity) - 
                        (SELECT COALESCE(SUM(product_distributions.quantity), 0)
                        FROM product_distributions
                        WHERE product_distributions.product_id = product_receives.product_id) as current_stock'))
            ->join('products', 'product_receives.product_id', '=', 'products.id')
            ->join('stores',   'product_receives.store_id', '=', 'stores.id')
            ->join('store_categories',   'product_receives.store_category_id', '=', 'store_categories.id')
            ->join('units', 'product_receives.unit_id', '=', 'units.id')
            ->groupBy('product_receives.product_id', 'products.product_name')
            ->get();

        // $productReceive = ProductReceive::
        // select('store_id','store_category_id','product_id','unit_id','quantity')
        // ->with('store','storeCategory','product','unit')
        // ->groupBy('product_id')
        // ->selectRaw('sum(quantity) as quantity')
        // ->get();

        // $productDistribute = ProductDistribution::
        // select('store_id','store_category_id','product_id','unit_id','quantity')
        // ->with('store','storeCategory','product','unit')
        // ->groupBy('product_id')
        // ->selectRaw('sum(quantity) as disQuantity')
        // ->get();

        // $unions = $productDistribute->union($productReceive);

        return  $stockReport;




        // $product = Product::select('id')->find(5);
        // $productID = $product->id;

        
        // $category = StoreCategorie::select('id')->find(4);
        // $categoryId = $category->id;

        // $store = Store::select('id')->find(4);
        // $storeID = $store->id;

        // $product = Product::select('id')->find(7);
        // $productID = $product->id;

        
        // $category = StoreCategorie::select('id')->find(5);
        // $categoryId = $category->id;

        // $store = Store::select('id')->find(5);
        // $storeID = $store->id;

        // //return $id[0]->id;

        // $ReceiveQuantity = ProductReceive::select('store_id','store_category_id','product_id', 'quantity', 'unit_id')
        // ->where('product_id', $productID)
        // ->where('store_category_id', $categoryId)
        // ->where('store_id', $storeID)
        // ->sum('quantity');

        // $DistributeQuantity = ProductDistribution::select('store_id','store_category_id','product_id', 'quantity', 'unit_id')
        // ->where('product_id', $productID)
        // ->where('store_category_id', $categoryId)
        // ->where('store_id', $storeID)
        // ->sum('quantity');

        // $CurrentQuantity = $ReceiveQuantity - $DistributeQuantity;

        // // return $ReceiveQuantity;
        // // return $DistributeQuantity;

        // return [$ReceiveQuantity, $DistributeQuantity, $CurrentQuantity];



        // $test = DB::table('product_receives')
        // ->join('products', function(JoinClause $join){
        //    $join->on('product_receives.product_id' , '=', 'products.id')
        //    ->sum('product_receives.quantity');
        // })->get();
        
        
        // // ->join('stores','product_receives.store_id', '=' , 'stores.id')
        // // ->join('store_categories','product_receives.store_category_id', '=' , 'store_categories.id')
        
        // //->join('units','product_receives.unit_id', '=' , 'units.id')
        

        //$productDistribution = ProductDistribution::with('store','storeCategory','product','unit')->get();
        //return $test ;

        //  $recQuantity = ProductReceive::select('store_id','store_category_id', 'rproduct_id', 'quantity')
        //  ->with('store','storeCategory','product','unit')
        //  ->sum('quantity');

        //$product = Product::all();

        //$id = $product->id;
        //$product = ProductReceive::with('store','storeCategory','product','unit')->get();
        // $product = ProductDistribution::with('store','storeCategory','product','unit')->get();
        //     return $product;


        // return $data = [
        //     'products '=> $product
        // ];

        // $recQuantity = ProductReceive::where('product_id','')->sum('quantity');
        // $disQuantity = ProductDistribution::sum('quantity');

        // // $currentStockQty = $recQuantity - $disQuantity;
        // //return   $recQuantity;
        // // return $data = [
        // //     'recQuantity' => $recQuantity
        // // ];

    }

    public function getStockDown(){

        $data = DB::table('product_receives')
            ->select('product_receives.product_id', 'stores.name', 'store_categories.category_name', 'products.product_name','units.unit_name',
                DB::raw('SUM(product_receives.quantity) as total_received'),
                DB::raw('(SELECT COALESCE(SUM(product_distributions.quantity), 0)
                        FROM product_distributions
                        WHERE product_distributions.product_id = product_receives.product_id) as total_distributed'),
                DB::raw('SUM(product_receives.quantity) - 
                        (SELECT COALESCE(SUM(product_distributions.quantity), 0)
                        FROM product_distributions
                        WHERE product_distributions.product_id = product_receives.product_id) as current_stock'))
            ->join('products', 'product_receives.product_id', '=', 'products.id')
            ->join('stores',   'product_receives.store_id', '=', 'stores.id')
            ->join('store_categories',   'product_receives.store_category_id', '=', 'store_categories.id')
            ->join('units', 'product_receives.unit_id', '=', 'units.id')
            ->groupBy('product_receives.product_id', 'products.product_name')
            ->get();


        //return  $stockReport;

        $pdf = Pdf::loadview('report.StockReport', [
            'datas' => $data
        ]);

        return $pdf->download('Stock-Report.pdf');


    }

    public function getStoreWiseStock(Request $request){

        $id = $request->input('store_id');

        $stockWiseReport = DB::table('product_receives')
            ->select('product_receives.product_id', 'stores.name', 'store_categories.category_name', 'products.product_name','units.unit_name',
                DB::raw('SUM(product_receives.quantity) as total_received'),
                DB::raw('(SELECT COALESCE(SUM(product_distributions.quantity), 0)
                        FROM product_distributions
                        WHERE product_distributions.product_id = product_receives.product_id) as total_distributed'),
                DB::raw('SUM(product_receives.quantity) - 
                        (SELECT COALESCE(SUM(product_distributions.quantity), 0)
                        FROM product_distributions
                        WHERE product_distributions.product_id = product_receives.product_id) as current_stock'))
            ->join('products', 'product_receives.product_id', '=', 'products.id')
            ->join('stores',   'product_receives.store_id', '=', 'stores.id')
            ->join('store_categories',   'product_receives.store_category_id', '=', 'store_categories.id')
            ->join('units', 'product_receives.unit_id', '=', 'units.id')
            ->where('product_receives.store_id','=', $id)
            ->groupBy('product_receives.product_id', 'products.product_name')
            ->get();

            return  $stockWiseReport;

            // return response()->json([
            //     'status' => 'Success',
            // ],200);

    }

    public function getStoreWiseStockDown(Request $request){

        $id = $request->input('store_id');

        $data = DB::table('product_receives')
            ->select('product_receives.product_id', 'stores.name', 'store_categories.category_name', 'products.product_name','units.unit_name',
                DB::raw('SUM(product_receives.quantity) as total_received'),
                DB::raw('(SELECT COALESCE(SUM(product_distributions.quantity), 0)
                        FROM product_distributions
                        WHERE product_distributions.product_id = product_receives.product_id) as total_distributed'),
                DB::raw('SUM(product_receives.quantity) - 
                        (SELECT COALESCE(SUM(product_distributions.quantity), 0)
                        FROM product_distributions
                        WHERE product_distributions.product_id = product_receives.product_id) as current_stock'))
            ->join('products', 'product_receives.product_id', '=', 'products.id')
            ->join('stores',   'product_receives.store_id', '=', 'stores.id')
            ->join('store_categories',   'product_receives.store_category_id', '=', 'store_categories.id')
            ->join('units', 'product_receives.unit_id', '=', 'units.id')
            ->where('product_receives.store_id','=', $id)
            ->groupBy('product_receives.product_id', 'products.product_name')
            ->get();

            //return $data;

            $pdf = Pdf::loadview('report.StoreWiseStockReport', [
                'datas' => $data
            ]);

            return  $pdf->download('Store-Wise-Product-Stock-Report.pdf');

            // return response()->json([
            //     'status' => 'Success',
            // ],200);

    }    

    public function getStoreCategoryStock(Request $request){

        $id = $request->input('store_category_id');

        $stockCategoryReport = DB::table('product_receives')
            ->select('product_receives.product_id', 'stores.name', 'store_categories.category_name', 'products.product_name','units.unit_name',
                DB::raw('SUM(product_receives.quantity) as total_received'),
                DB::raw('(SELECT COALESCE(SUM(product_distributions.quantity), 0)
                        FROM product_distributions
                        WHERE product_distributions.product_id = product_receives.product_id) as total_distributed'),
                DB::raw('SUM(product_receives.quantity) - 
                        (SELECT COALESCE(SUM(product_distributions.quantity), 0)
                        FROM product_distributions
                        WHERE product_distributions.product_id = product_receives.product_id) as current_stock'))
            ->join('products', 'product_receives.product_id', '=', 'products.id')
            ->join('stores',   'product_receives.store_id', '=', 'stores.id')
            ->join('store_categories',   'product_receives.store_category_id', '=', 'store_categories.id')
            ->join('units', 'product_receives.unit_id', '=', 'units.id')
            ->where('product_receives.store_category_id','=', $id)
            ->groupBy('product_receives.product_id', 'products.product_name')
            ->get();

            return $stockCategoryReport;

    }

    public function getStoreCategoryStockDown(Request $request){

        $id = $request->input('store_category_id');

        $data = DB::table('product_receives')
            ->select('product_receives.product_id', 'stores.name', 'store_categories.category_name', 'products.product_name','units.unit_name',
                DB::raw('SUM(product_receives.quantity) as total_received'),
                DB::raw('(SELECT COALESCE(SUM(product_distributions.quantity), 0)
                        FROM product_distributions
                        WHERE product_distributions.product_id = product_receives.product_id) as total_distributed'),
                DB::raw('SUM(product_receives.quantity) - 
                        (SELECT COALESCE(SUM(product_distributions.quantity), 0)
                        FROM product_distributions
                        WHERE product_distributions.product_id = product_receives.product_id) as current_stock'))
            ->join('products', 'product_receives.product_id', '=', 'products.id')
            ->join('stores',   'product_receives.store_id', '=', 'stores.id')
            ->join('store_categories',   'product_receives.store_category_id', '=', 'store_categories.id')
            ->join('units', 'product_receives.unit_id', '=', 'units.id')
            ->where('product_receives.store_category_id','=', $id)
            ->groupBy('product_receives.product_id', 'products.product_name')
            ->get();

            //return $data;

            $pdf = Pdf::loadview('report.StoreCategoryWiseStockReport', [
                'datas' => $data
            ]);

            return  $pdf->download('Store-Category-Wise-Stock-Report.pdf');

    }

}
