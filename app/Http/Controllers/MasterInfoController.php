<?php

namespace App\Http\Controllers;

use App\Models\MasterInfo;
use Illuminate\Http\Request;

class MasterInfoController extends Controller
{
    public function masterPage(){
        return view('pages.dashboard.master');
    }

    public function getMasterList(){

        $allmaster = MasterInfo::all();
        return $allmaster;

    }

    public function masterCreate(Request $request){

        try{
           $data =  $request->validate([
                'master_name' => 'required',
                'mob_no' => 'required',
            ]);

            MasterInfo::create($data);

            return response()->json([
                'status' => 'Success',
                'message' => 'Master Information Create Successfull'
            ], 200);

        }catch(\Exception $e){
            return response()->json([
                'status' => 'Faild',
                'message' => 'Master Information Not Create'
            ]);

        }

    }

    public function masterDelete(Request $request){
        try{

            $id = $request->input('id');

            MasterInfo::where('id', $id)->delete();

            return response()->json([
                'status' => 'Success',
                'message' => 'Delete Successfull'
            ],200);
        }catch(\Exception $e){
            return response()->json([
                'status' => 'Failed',
                'message' => 'Delete Not Successfull !'
                //'message' => $e->getMessage()

            ]);
        }
    }

    public function masterUpdate(Request $request){

        try{

            $id            = $request->input('id');
            $name          = $request->input('master_name');
            $mob_no        = $request->input('mob_no');

            MasterInfo::where('id',$id)->update([
                'master_name' => $name,
                'mob_no' => $mob_no
            ]);

            return response()->json([
                'status' => 'Success',
                'message' => 'Master Updated Successfull'
            ]);

        }catch(\Exception $e){
            return response()->json([
                'status' => 'Failed',
                //'message' => 'Master Updated Not Successfull'
                'message' => $e->getMessage()
            ]);
        }

    }

    public function masterByID(Request $request){
        $id =  $request->input('id');
        return MasterInfo::where('id', $id)->first();
    }
}
