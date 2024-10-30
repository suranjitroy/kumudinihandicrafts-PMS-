<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Exception;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    //

    public function supplierPage(){
        return view('pages.dashboard.supplier');
    }
    public function supplierCreate(Request $request){
        try{

        $supplier =  $request->validate([
                'name'      => 'required',
                'address'   => 'required',
                'mobile_no' => 'required',
                'email'     => 'nullable',
                'status'    => 'required',
            ]);

        Supplier::create($supplier);
        
        return response()->json([
            'status'    => 'Success',
            'message'   => 'Supplier Entry Successfull !'
        ],200); 
        
        }catch(Exception $e){
            return response()->json([
                'status'    => 'Failed',
                'message'   => $e->getMessage()
            ]); 
        }

    }

    public function supplierList(){
       
        $allSupplier =  Supplier::all();

        return $allSupplier;
    }

    public function supplierById(Request $request){

        $id = $request->input('id');
        $specificSupplier = Supplier::where('id', $id)->first();
        return $specificSupplier;
    }

    public function supplierUpdate(Request $request){

        try{
            $id          = $request->input('id');
            $name        = $request->input('name'); 
            $address     = $request->input('address'); 
            $mobileNo    = $request->input('mobile_no'); 
            $email       = $request->input('email'); 
            $status       = $request->input('status'); 
    
            $supplierUpdate = Supplier::where('id', $id)->update([
                'name' => $name,
                'address' => $address,
                'mobile_no' => $mobileNo,
                'email' => $email,
                'status' => $status,
            ]);
    
            return response()->json([
                'status' => 'Success',
                'message' => 'Supplier Updated Successfully !'
            ],200);
        }catch(Exception $e){
            return response()->json([
                'status' => 'Failed',
                'message' => $e->getMessage()
            ]);
        }
        
        
    }

    public function supplierDelete(Request $request){
        
        try{
            $id = $request->input('id');

            Supplier::where('id', $id)->delete();
    
            return response()->json([
                'status' => 'Success',
                'message' => 'Supplier Deleted Successfull !'
            ],200);
        }catch(Exception $e){
            return response()->json([
                'status' => 'Failed',
                'message' => 'Supplier Not Deleted Successfull !'
            ]);
        }
        
    
    
    }
}
