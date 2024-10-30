<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function sectionPage(){
        return view('pages.dashboard.section');
    }
    public function sectionCreate(Request $request){

        try{
            $name = $request->validate([
                'name' => 'required'
            ]);
    
            Section::create($name);
    
            return response()->json([
                'status' => 'Success',
                'message' => 'Section Name Created Successfull !'
                ],200);
        }catch(Exception $e) {
            return response()->json([
                'status' => 'Failed',
                'message' => $e->getMessage()
            ]);
        };
        



    }
    public function getSectionList(Request $request){ 
        $allsection = Section::all();
        return $allsection;
    }
    public function sectionDelete(Request $request){
        try{
            $id = $request->input('id');
            Section::where('id',$id)->delete();
            return response()->json([
                'status' => 'Success',
                'message' => 'Delete Successfull!'
            ], 200);
        }catch(Exception $e){
            return response()->json([
                'status' => 'Failed',
                'message' => 'Something went wrong'
            ]);
        }
        
    }
    public function sectionByID(Request $request){
        $id = $request->input('id');
        return Section::where('id', $id)->first();
    }
    public function sectionUpdate(Request $request){
        
        try{

            $id = $request->input('id');
            $name = $request->input('name');
            Section::where('id', $id)->update([
                'name'=> $name
            ]);
            return response()->json([
                'status' => 'Success',
                'message' => 'Updated Successfull'
            ],200);

        }catch(Exception $e){
            return response()->json([
                'status' => 'Failed',
                'message' => 'Something went wrong'
            ]);
        }

    }
    
}
