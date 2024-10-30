<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Store;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    // View Page

    public function storePage(){
        return view('pages.dashboard.store');
    }

    // Create Store

    public function storeCreate(Request $request){

       try{

        $name = $request->validate([
            'name' => 'required'
        ]);

        // $name = $request->input('name');

        Store::create($name);

        return response()->json([
            'status' => 'Success',
            'message' => 'Store Create Successfull !'
        ], 200);

       }catch(Exception $e){
            return response()->json([
                'status' => 'Failed',
                'message' => $e->getMessage()
            ]);
       }
       
       
    }

    public function getStoreList(){
        $allStore = store::all();
        return $allStore;
    }

    public function storeDelete(Request $request){
        
        try{

            $id = $request->input('id');
            Store::where('id',$id)->delete();

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

    public function storeUpdate(Request $request){

        try{

            $id = $request->input('id');
            $name = $request->input('name');

            Store::where('id',$id)->update([
                'name' => $name
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

    public function storeById(Request $request){
        
        $id     = $request->input('id');
        return Store::where('id',$id)->first();
      


    }


}
