<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\ProductDistribution;

class ProductDistributionController extends Controller
{
    //
    public function productDistributionPage(){
        return view('pages.dashboard.product-distribute');
    }
    public function productDistributionCreate(Request $request){
        try{

        $productReceive =  $request->validate([
                'store_id'          => 'required',
                'store_category_id' => 'required',
                'product_id'        => 'required',
                'quantity'          => 'required',
                'unit_id'           => 'required',
                'unit_price'        => 'required',
                'total'             => 'required',
                'purpose'           => 'nullable',
            ]);

        ProductDistribution::create($productReceive);
        
        return response()->json([
            'status'    => 'Success',
            'message'   => 'Product Distribution Successfull !'
        ],200); 
        
        }catch(Exception $e){
            return response()->json([
                'status'    => 'Failed',
                'message'   => $e->getMessage()
            ]); 
        }

    }

    public function productDistributionList(){
       
        $allSupplier =  ProductDistribution::with('store','storeCategory','product','unit')->get();

        return $allSupplier;
    }

    public function productDistributionById(Request $request){

        $id = $request->input('id');
        $specificSupplier = ProductDistribution::where('id', $id)->first();
        return $specificSupplier;
    }

    public function productDistributionUpdate(Request $request){

        try{

            $id                 = $request->input('id');
            $store_id           = $request->input('store_id'); 
            $store_category_id  = $request->input('store_category_id'); 
            $product_id         = $request->input('product_id'); 
            $quantity           = $request->input('quantity');
            $unit_id            = $request->input('unit_id');
            $unit_price         = $request->input('unit_price');
            $total              = $request->input('total');
            $purpose            = $request->input('purpose');
    
            $supplierUpdate = ProductDistribution::where('id', $id)->update([
                'store_id' => $store_id,
                'store_category_id' => $store_category_id,
                'product_id' => $product_id,
                'quantity' => $quantity,
                'unit_id' => $unit_id,
                'unit_price' => $unit_price,
                'total' => $total,
                'purpose' => $purpose
            ]);
    
            return response()->json([
                'status' => 'Success',
                'message' => 'Product Distribution Updated Successfully !'
            ],200);
        }catch(Exception $e){
            return response()->json([
                'status' => 'Failed',
                'message' => $e->getMessage()
            ]);
        }
        
        
    }

    public function productDistributionDelete(Request $request){
        
        try{
            $id = $request->input('id');

            ProductDistribution::where('id', $id)->delete();
    
            return response()->json([
                'status' => 'Success',
                'message' => 'Deleted Successfull !'
            ],200);
        }catch(Exception $e){
            return response()->json([
                'status' => 'Failed',
                'message' => 'Something went wrong'
            ]);
        }
    }      
}
