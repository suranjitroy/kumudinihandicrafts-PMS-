<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function productSetupPage(){
        $product = Product::with('store','storeCategory')->get();

        return view('pages.dashboard.product',[
            'products' => $product
        ]);
    }

    public function productSetupCreate(Request $request){

        try{
 
         $product = $request->validate([
             'store_id' => 'required',
             'store_category_id' => 'required',
             'product_name' => 'required'
         ]);
 
         Product::create($product);
 
         return response()->json([
             'status' => 'Success',
             'message' => 'Product Create Successfull !'
         ], 200);
 
        }catch(Exception $e){
             return response()->json([
                 'status' => 'Failed',
                 'message' => $e->getMessage()
             ]);
        }
        
        
     }
 
     public function getProductSetupList(){
         return Product::with('store','storeCategory')->get();
     }
 
     public function productSetupDelete(Request $request){     
         try{
 
             $id = $request->input('id');
             Product::where('id',$id)->delete();
 
             return response()->json([
                 'status' => 'Success',
                 'message' => 'Delete Successfull !'
             ],200);
 
         }catch(Exception $e){
             return response()->json([
                 'status' => 'Failed',
                 'message' => 'Something went wrong'
             ]);
         }
 
     }
     
     public function productSetupUpdate(Request $request){

        try{

            $id = $request->input('id');
            $storeID = $request->input('store_id');
            $storeCategoryID = $request->input('store_category_id');
            $productName = $request->input('product_name');

            Product::where('id',$id)->update([
                'store_id' => $storeID,
                'store_category_id' => $storeCategoryID,
                'product_name' => $productName
            ]);

            return response()->json([
                'status' => 'Success',
                'message' => 'Updated Successfully !'
            ],200);

        }catch(Exception $e){
            return response()->json([
                'status' => 'Failed',
                'message' => 'Something went wrong '
            ]);
        }
        

    }

    public function productSetupById(Request $request){
        
        $id     = $request->input('id');
        return Product::where('id',$id)->first();
      


    }
}
