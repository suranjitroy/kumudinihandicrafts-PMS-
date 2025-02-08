<?php

namespace App\Http\Controllers;

use App\Models\ConsumptionSetting;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConsumptionSettingController extends Controller
{
    public function consumptionListPage(){
        $user_id = Auth::id();
        return view('pages.dashboard.consumption-setting');
    }

    public function consumptionSettCreate(Request $request){
        try{
            $consumptionData = $request->validate([
                'material_name' => 'required',
                'size'          => 'required',
                'bahar'         => 'required',
                'yard'          => 'required',
                'inch'          => 'required',
            ]);

            ConsumptionSetting::create($consumptionData);

            return response()->json([
                'status' => 'Success',
                'message' => 'New Consumption Setup Successfull !'
            ]);

        }catch(Exception $e){
            return response()->json([
                'status' => 'Failed',
                'message' => $e->getMessage()
            ]);
        }

    }

    public function getConsumptionSettList(){
        return ConsumptionSetting::all();
    }

    public function consumptionSettDelete(Request $request){
        try{

            $id = $request->input('id');

            ConsumptionSetting::where('id', $id)->delete();

            return response()->json([
                'status' => 'Success',
                'message' => 'Consumption Setup Delete Successfull !'
            ]);

        }catch(Exception $e){
            return response()->json([
                'status' => 'Failed',
                'message' => 'Something Went Wrong'
                //'message' => $e->getMessage()

            ]);
        }

    }

    public function consumptionSettById(Request $request){
        $id = $request->input('id');
        return ConsumptionSetting::where('id',$id)->first();
    }

    public function consumptionSettUpdate(Request $request){
        try{

            $id              = $request->input('id');
            $materialName    = $request->input('material_name');
            $size            = $request->input('size');
            $bahar           = $request->input('bahar');
            $yard            = $request->input('yard');
            $inch            = $request->input('inch');

            ConsumptionSetting::where('id', $id)->update([
                'material_name' => $materialName,
                'size'          => $size,
                'bahar'         => $bahar,
                'yard'          => $yard,
                'inch'          => $inch
            ]);

            return response()->json([
                'status' => 'Success',
                'message' => 'Consumption Setup Update Successfull !'
            ], 200);

        }catch(Exception $e){
            return response()->json([
                'status' => 'Failed',
                //'message' => 'Consumption Setup Not Update!'
                'message' => $e->getMessage()
            ]);
        }

    }
}
