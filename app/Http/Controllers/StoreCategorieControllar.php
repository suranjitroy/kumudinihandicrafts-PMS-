<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\StoreCategorie;

class StoreCategorieControllar extends Controller
{
    //


    public function storeCategoriePage(){
        return view('pages.dashboard.store-categorie');
    }

    public function storeCategoryCreate(Request $request){

        try{
 
         $name = $request->validate([
             'store_id' => 'required',
             'category_name' => 'required'
         ]);
 
 
         StoreCategorie::create($name);
 
         return response()->json([
             'status' => 'Success',
             'message' => 'Store Category Create Successfull !'
         ], 200);
 
        }catch(Exception $e){
             return response()->json([
                 'status' => 'Failed',
                 'message' => $e->getMessage()
             ]);
        }
        
        
     }
 
     public function getStoreCategoryList(){
         return StoreCategorie::with('store')->get();
     }
 
     public function storeCategoryDelete(Request $request){
         
         try{
 
             $id = $request->input('id');
             StoreCategorie::where('id',$id)->delete();
 
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
     
     public function storeCategoryUpdate(Request $request){

        try{

            $id = $request->input('id');
            $storeID = $request->input('store_id');
            $categoryName = $request->input('category_name');

            StoreCategorie::where('id',$id)->update([
                'store_id' => $storeID,
                'category_name' => $categoryName
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

    public function storeCategoryById(Request $request){
        
        $id     = $request->input('id');
        return StoreCategorie::where('id',$id)->first();
      


    }

}
