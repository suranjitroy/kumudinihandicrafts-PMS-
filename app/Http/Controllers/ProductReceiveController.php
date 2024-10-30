<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\ProductReceive;

class ProductReceiveController extends Controller
{
    //
    public function productReceivePage(){
        return view('pages.dashboard.product-receive');
    }
    public function productReceiveCreate(Request $request){
        try{

        $productReceive =  $request->validate([
                'store_id'          => 'required',
                'store_category_id' => 'required',
                'product_id'        => 'required',
                'description'       => 'nullable',
                'supplier_id'       => 'required',
                'quantity'          => 'required',
                'unit_id'           => 'required',
                'unit_price'        => 'required',
                'total'             => 'required',
                'purpose'           => 'nullable',
            ]);

        ProductReceive::create($productReceive);
        
        return response()->json([
            'status'    => 'Success',
            'message'   => 'Product Receive Successfull !'
        ],200); 
        
        }catch(Exception $e){
            return response()->json([
                'status'    => 'Failed',
                'message'   => $e->getMessage()
            ]); 
        }

    }

    public function productReceiveList(){
       
        $allSupplier =  ProductReceive::with('store','storeCategory','product','unit','supplier')->get();

        return $allSupplier;
    }

    public function productReceiveById(Request $request){

        $id = $request->input('id');
        $specificSupplier = ProductReceive::where('id', $id)->first();
        return $specificSupplier;
    }

    public function productReceiveUpdate(Request $request){

        try{

            $id                 = $request->input('id');
            $store_id           = $request->input('store_id'); 
            $store_category_id  = $request->input('store_category_id'); 
            $product_id         = $request->input('product_id'); 
            $description        = $request->input('description'); 
            $supplier_id        = $request->input('supplier_id');
            $quantity           = $request->input('quantity');
            $unit_id            = $request->input('unit_id');
            $unit_price         = $request->input('unit_price');
            $total              = $request->input('total');
            $purpose            = $request->input('purpose');
    
            $supplierUpdate = ProductReceive::where('id', $id)->update([
                'store_id' => $store_id,
                'store_category_id' => $store_category_id,
                'product_id' => $product_id,
                'description' => $description,
                'supplier_id' => $supplier_id,
                'quantity' => $quantity,
                'unit_id' => $unit_id,
                'unit_price' => $unit_price,
                'total' => $total,
                'purpose' => $purpose
            ]);
    
            return response()->json([
                'status' => 'Success',
                'message' => 'Product Receive Updated Successfully !'
            ],200);
        }catch(Exception $e){
            return response()->json([
                'status' => 'Failed',
                'message' => $e->getMessage()
            ]);
        }
        
        
    }

    public function productReceiveDelete(Request $request){
        
        try{
            $id = $request->input('id');

            ProductReceive::where('id', $id)->delete();
    
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
