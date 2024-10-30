<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function unitPage(){
        return view('pages.dashboard.unit');
    }

    // Create Store

    public function unitCreate(Request $request){

       try{

        $name = $request->validate([
            'unit_name' => 'required'
        ]);

        // $name = $request->input('name');

        Unit::create($name);

        return response()->json([
            'status' => 'Success',
            'message' => 'Unit Create Successfull !'
        ], 200);

       }catch(Exception $e){
            return response()->json([
                'status' => 'Failed',
                'message' => $e->getMessage()
            ]);
       }
       
       
    }

    public function getUnitList(){
        return Unit::all();
    }

    public function unitDelete(Request $request){
        
        try{

            $id = $request->input('id');
            Unit::where('id',$id)->delete();

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

    public function unitUpdate(Request $request){

        try{

            $id = $request->input('id');
            $name = $request->input('unit_name');

            Unit::where('id',$id)->update([
                'unit_name' => $name
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

    public function unitById(Request $request){
        
        $id     = $request->input('id');
        return Unit::where('id',$id)->first();
      


    }
}
