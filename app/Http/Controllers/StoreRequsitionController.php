<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Section;
use Illuminate\Http\Request;

use App\Models\StoreRequsition;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\StoreRequsitionDetail;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class StoreRequsitionController extends Controller
{
    public function storeRequsitionPage(Request $request){

        $config = [
            'table' => 'store_requsitions',
            'field' => 'store_req_no',
            'length' => 10,  // Use an integer instead of a string
            'prefix' => 'STR-'
            ];
    
        $id = IdGenerator::generate($config);
         
        return view('pages.dashboard.store-requsition',[
            'id' => $id,
        ]);
    }
    public function storeReqCreate(Request $request){

        $user_id = Auth::id();

        $config = [
        'table' => 'store_requsitions',
        'field' => 'store_req_no',
        'length' => 10,  // Use an integer instead of a string
        'prefix' => 'STR-'
        ];

       $id = IdGenerator::generate($config);

       DB::beginTransaction();

        try {

            $reqDate = $request->input('req_date');
            $reqNo   = $id;
            $secID   = $request->input('section_id');
            $approve = $request->input('is_approve');
            $userID  = $user_id;
        
            $storeRequsition = StoreRequsition::create([
                'req_date'      => $reqDate,
                'store_req_no'  => $reqNo,
                'section_id'    => $secID,
                'is_approve'    => $approve,
                'user_id'       => $userID
            ]);

            $storeReqID = $storeRequsition->id;
            $storeReqNo = $storeRequsition->store_req_no;

            $products = $request->input('products');

            foreach($products as $product){

                StoreRequsitionDetail::create([
                    'store_requsition_id' => $storeReqID,
                    'store_req_no'        => $storeReqNo,
                    'product_id'          => $product['product_id'],
                    'quantity'            => $product['quantity'],
                    'unit_id'             => $product['unit_id'],
                    'user_id'             => $user_id
                ]);

            }

            DB::commit();

           

            // return redirect()->route('store.requsition')->with('store_req_no');
            return 1;

            // return response()->json([
            //     'status' => 'Insert Success',
            //     'message' => 'Save Successfull'
            // ]);

        } catch (Exception $e) {

            DB::rollBack();

            //return 0;

            return response()->json([
                'status' => 'Insert Fail',
                'message' => $e->getMessage()
            ]);
        }

    }

    public function storeUpdateReq(Request $request)
    {
        $user_id = Auth::id(); // Get current authenticated user ID
    
        DB::beginTransaction();
    
        try {
            $id = $request->input('id');
            // Find the existing store requisition by ID
            $storeRequsition = StoreRequsition::findOrFail($id);
    
            // Update the main requisition fields
            $storeRequsition->update([
                'req_date'   => $request->input('req_date'),
                'section_id' => $request->input('section_id'),
                'is_approve' => $request->input('is_approve'),
                'store_req_no' => $request->input('store_req_no'),
                'user_id'     => $user_id,
            ]);
    
            $storeReqID = $storeRequsition->id;
            $storeReqNo = $storeRequsition->store_req_no;
    
            // Remove existing details for the requisition
            StoreRequsitionDetail::where('store_requsition_id', $storeReqID)->delete();
    
            // Insert updated details
            $products = $request->input('products');
    
            foreach ($products as $product) {
                StoreRequsitionDetail::create([
                    'store_requsition_id' => $storeReqID,
                    'store_req_no'        => $storeReqNo,
                    'product_id'          => $product['product_id'],
                    'quantity'            => $product['quantity'],
                    'unit_id'             => $product['unit_id'],
                    'user_id'             => $user_id,
                ]);
            }
    
            DB::commit();

            return 1;
    
            // return response()->json([
            //     'status' => 'Update Success',
            //     'message' => 'Update successful',
            // ]);
        } catch (Exception $e) {
            DB::rollBack();
    
            return response()->json([
                'status' => 'Update Fail',
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function storeRequsitionListPage(){

        $config = [
            'table' => 'store_requsitions',
            'field' => 'store_req_no',
            'length' => 10,  // Use an integer instead of a string
            'prefix' => 'STR-'
            ];
    
        $id = IdGenerator::generate($config);

        return view('pages.dashboard.store-requsition-list', [
            'id' => $id,
        ]);
    }
    public function storeReqList(){
        $allreq = StoreRequsition::with('section')->get();
        return $allreq;
    }
    public function storeReqDetails(Request $request){
        $user_id    = Auth::id();
        $sectionID  = $request->input('section_id');
        $StoreReqID = $request->input('store_requsition_id');
        $StoreReqNo = $request->input('store_req_no');

        //$sectionDetail = Section::where('id', $sectionID)->first();
        $storeReq        = StoreRequsition::with('section')
                           ->where('section_id', $sectionID)
                           ->where('store_req_no', $StoreReqNo)
                           ->first();
        $storeReqDetail  = StoreRequsitionDetail::with('product','unit')
                           ->where('store_requsition_id', $StoreReqID)
                           ->where('store_req_no', $StoreReqNo)
                           ->get();
        return array(
            //'section' => $sectionDetail,
            'storeReq' => $storeReq,
            'storeReqDetail' => $storeReqDetail,
            'user_id' => $user_id,
            
        );

        // return view('components.storeRequisition.store-requisition-details', [
        //     'user_id' => $user_id
        // ]);

    }
    public function storeReqDetailsUp(Request $request){
        $user_id    = Auth::id();
        $sectionID  = $request->input('section_id');
        $StoreReqID = $request->input('store_requsition_id');
        $StoreReqNo = $request->input('store_req_no');

        //$sectionDetail = Section::where('id', $sectionID)->first();
        $storeReq        = StoreRequsition::with('section')
                           ->where('section_id', $sectionID)
                           ->where('store_req_no', $StoreReqNo)
                           ->first();
        $storeReqDetail  = StoreRequsitionDetail::with('product','unit')
                           ->where('store_requsition_id', $StoreReqID)
                           ->where('store_req_no', $StoreReqNo)
                           ->get();
        return array(
            //'section' => $sectionDetail,
            'storeReq' => $storeReq,
            'storeReqDetail' => $storeReqDetail,
            //'user_id' => $user_id,
            
        );

        // return view('components.storeRequisition.store-requisition-details', [
        //     'user_id' => $user_id
        // ]);

    }

    public function storeReqRecom(Request $request){

        try{

            $id = $request->input('id');
            $user_id = $request->input('user_id');
            $is_recom = 2;

            StoreRequsition::where('id',$id)
            ->where('user_id',$user_id)
            ->update([
                'is_approve' => $is_recom
            ]);

            return response()->json([
                'status' => 'Success',
                'message' => 'Recommended Successfully !'
            ],200);

        }catch(Exception $e){
            return response()->json([
                'status' => 'Failed',
                'message' => 'Something went wrong '
            ]);
        }

    }
    public function storeReqNotRecom(Request $request){

        try{

            $id = $request->input('id');
            $user_id = $request->input('user_id');
            $is_recom = 3;

            StoreRequsition::where('id',$id)
            ->where('user_id',$user_id)
            ->update([
                'is_approve' => $is_recom
            ]);

            return response()->json([
                'status' => 'Success',
                'message' => 'Not Recommended Successfully !'
            ],200);

        }catch(Exception $e){
            return response()->json([
                'status' => 'Failed',
                'message' => 'Something went wrong '
            ]);
        }

    }

    public function storeRequsitionPageUpdateAPI(Request $request){

        $id     = $request->input('id');

        $storeReq = StoreRequsition::with('section')->where('id', $id)->first();

        $storeReqDetail  = StoreRequsitionDetail::with('product','unit')
                           ->where('store_requsition_id', $id)
                           ->get();
                           
        return array(
            //'section' => $sectionDetail,
            'storeReq' => $storeReq,
            'storeReqDetail' => $storeReqDetail
            // 'user_id' => $user_id,
            
        );

        // return response()->json([
        //     'storeReq' => $storeReq
        // ]);

        // return view('pages.dashboard.store-requisition-update', [
        //     'storeReq' => $storeReq,
        //     'storeReqDetail' => $storeReqDetail,
        //     'id' => $id
        // ]);



         
        // return view('pages.dashboard.store-requisition-update',[
        //     'id' => $id,
        // ]);
    }

    public function storeRequsitionPageUpdate($id){

        $storeReq = StoreRequsition::with('section')->where('id', $id)->first();

        $storeReqDetail  = StoreRequsitionDetail::with('product','unit')
                           ->where('store_requsition_id', $id)
                           ->get();
                           
        // return array(
        //     //'section' => $sectionDetail,
        //     'storeReq' => $storeReq,
        //     // 'storeReqDetail' => $storeReqDetail,
        //     // 'user_id' => $user_id,
            
        // );

        // return response()->json([
        //     'storeReq' => $storeReq
        // ]);

        return view('pages.dashboard.store-requisition-update', [
            'storeReq' => $storeReq,
            'storeReqDetail' => $storeReqDetail,
        ]);



         
        // return view('pages.dashboard.store-requisition-update',[
        //     'id' => $id,
        // ]);
    }

    public function storeReqUpdateDetails($id){

        $storeReq = StoreRequsition::with('section')->where('id', $id)
                           ->first();
        $storeReqDetail  = StoreRequsitionDetail::with('product','unit')
                           ->where('store_requsition_id', $id)
                           ->first();
        //return $storeReqDetail;
         return array(
            'storeReq' => $storeReq,
            'storeReqDetail' => $storeReqDetail
        );


        // $user_id    = Auth::id();
        // $sectionID  = $request->input('section_id');
        // $StoreReqID = $request->input('store_requsition_id');
        // $StoreReqNo = $request->input('store_req_no');

        // //$sectionDetail = Section::where('id', $sectionID)->first();
        // $storeReq        = StoreRequsition::with('section')
        //                    ->where('section_id', $sectionID)
        //                    ->where('store_req_no', $StoreReqNo)
        //                    ->first();
        // $storeReqDetail  = StoreRequsitionDetail::with('product','unit')
        //                    ->where('store_requsition_id', $StoreReqID)
        //                    ->where('store_req_no', $StoreReqNo)
        //                    ->get();
  

        // return view('pages.dashboard.store-requisition-update', [
        //     'storeReq' => $storeReq,
        //     'storeReqDetail' => $storeReqDetail,
        //     'user_id' => $user_id,
        // ]);

    }

    public function storeReqDelete(Request $request){

        try{

            DB::beginTransaction();

            $id         = $request->input('id');
            $storeReqNo = $request->input('store_req_no');
    
            StoreRequsitionDetail::where('store_requsition_id', $id)
                                  ->where('store_req_no', $storeReqNo)
                                  ->delete();
            StoreRequsition::where('id', $id)
                                  ->where('store_req_no', $storeReqNo)
                                  ->delete();
            DB::commit();
    
            return response()->json([
                'status' => 'Success',
                'message' => 'Delete Successfull !'
            ],200);

        }catch(Exception $e){

            return response()->json([
                'status' => 'Failed',
                'message' => $e->getMessage()
            ]);

        }   

    }

    public function sectionWiseReqRepPage(Request $request){
        return view('pages.dashboard.section-wise-requsition');   
    }

    public function sectionWiseReqRep(Request $request){

        $secID = $request->input('section_id');

        $data = StoreRequsition::with('section')->where('section_id', $secID)->get();

        return $data;   
    }

    public function statusWiseReqRepPage(Request $request){
        return view('pages.dashboard.status-wise-requsition');   
    }

    public function statusWiseReqRep(Request $request){

        $isApproveID = $request->input('is_approve');

        $data = StoreRequsition::with('section')->where('is_approve', $isApproveID)->get();

        return $data;   
    }  
    
}
