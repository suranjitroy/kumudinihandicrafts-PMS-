<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\PurchaseRequsition;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\PurchaseRequsitionDetail;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class PurchaseRequsitionController extends Controller
{

    public function purchaseRequsitionPage(){

        $config = [
            'table' => 'purchase_requsitions',
            'field' => 'purchase_req_no',
            'length' => 10,  // Use an integer instead of a string
            'prefix' => 'PUR-'
            ];

        $id = IdGenerator::generate($config);

        return view('pages.dashboard.purchase-requsition', [
            'id' => $id,
        ]);
    }

    public function purchaseRequsitionListPage(){

        $config = [
            'table' => 'purchase_requsitions',
            'field' => 'purchase_req_no',
            'length' => 10,  // Use an integer instead of a string
            'prefix' => 'PUR-'
            ];

        $id = IdGenerator::generate($config);

        return view('pages.dashboard.purchase-requsition-list', [
            'id' => $id,
        ]);
    }

    public function purchaseReqCreate(Request $request){

        $user_id = Auth::id();

        $config = [

        'table' => 'purchase_requsitions',
        'field' => 'purchase_req_no',
        'length' => 10,  // Use an integer instead of a string
        'prefix' => 'PUR-'

        ];

       $id = IdGenerator::generate($config);

       DB::beginTransaction();

        try {

            $reqDate      = $request->input('req_date');
            $reqNo        = $id;
            $secID        = $request->input('section_id');
            $grandTotal   = $request->input('grand_total');
            $approve      = $request->input('is_approve');
            $userID       = $user_id;

            $purchaseRequsition = PurchaseRequsition::create([
                'req_date'         => $reqDate,
                'purchase_req_no'  => $reqNo,
                'section_id'       => $secID,
                'grand_total'      => $grandTotal,
                'is_approve'       => $approve,
                'user_id'          => $userID
            ]);

            $purchaseReqID = $purchaseRequsition->id;
            $purchaseReqNo = $purchaseRequsition->purchase_req_no;

            $products = $request->input('products');

            foreach($products as $product){

                PurchaseRequsitionDetail::create([
                    'purchase_requsition_id' => $purchaseReqID,
                    'purchase_req_no'        => $purchaseReqNo,
                    'product_id'             => $product['product_id'],
                    'quantity'               => $product['quantity'],
                    'unit_id'                => $product['unit_id'],
                    'unit_price'             => $product['unit_price'],
                    'total'                  => $product['total'],
                    'user_id'                => $user_id
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
    public function purchaseReqList(){
        $allreq = PurchaseRequsition::with('section')->get();
        return $allreq;
    }
    public function purchaseReqDetails(Request $request){
        $user_id    = Auth::id();
        $sectionID  = $request->input('section_id');
        $PurReqID   = $request->input('purchase_requsition_id');
        $PurReqNo   = $request->input('purchase_req_no');

        //$sectionDetail = Section::where('id', $sectionID)->first();
        $purReq        = PurchaseRequsition::with('section')
                           ->where('section_id', $sectionID)
                           ->where('purchase_req_no', $PurReqNo)
                           ->first();
        $purReqDetail  = PurchaseRequsitionDetail::with('product','unit')
                           ->where('purchase_requsition_id', $PurReqID)
                           ->where('purchase_req_no', $PurReqNo)
                           ->get();
        return array(
            //'section' => $sectionDetail,
            'purReq' => $purReq,
            'purReqDetail' => $purReqDetail,
            'user_id' => $user_id,

        );

        // return view('components.storeRequisition.store-requisition-details', [
        //     'user_id' => $user_id
        // ]);

    }
    public function purchaseReqDetailsUp(Request $request){
        $user_id        = Auth::id();
        $sectionID      = $request->input('section_id');
        $PurchaseReqID  = $request->input('purchase_requsition_id');
        $PurchaseReqNo  = $request->input('purchase_req_no');

        //$sectionDetail = Section::where('id', $sectionID)->first();
        $purReq         = PurchaseRequsition::with('section')
                           ->where('section_id', $sectionID)
                           ->where('purchase_req_no', $PurchaseReqNo)
                           ->first();
        $purReqDetail   = PurchaseRequsitionDetail::with('product','unit')
                           ->where('purchase_requsition_id', $PurchaseReqID)
                           ->where('purchase_req_no', $PurchaseReqNo)
                           ->get();
        return array(
            //'section' => $sectionDetail,
            'purReq' => $purReq,
            'purReqDetail' => $purReqDetail,
            //'user_id' => $user_id,

        );

        // return view('components.storeRequisition.store-requisition-details', [
        //     'user_id' => $user_id
        // ]);

    }

    public function purchaseUpdateReq(Request $request){
        $user_id = Auth::id(); // Get current authenticated user ID

        DB::beginTransaction();

        try {
            $id = $request->input('id');
            // Find the existing store requisition by ID
            $purchaseRequsition = PurchaseRequsition::findOrFail($id);

            // Update the main requisition fields
            $purchaseRequsition->update([
                'req_date'          => $request->input('req_date'),
                'purchase_req_no'   => $request->input('purchase_req_no'),
                'section_id'        => $request->input('section_id'),
                'grand_total'       => $request->input('grand_total'),
                'is_approve'        => $request->input('is_approve'),
                'user_id'           => $user_id,

            ]);

            $purReqID = $purchaseRequsition->id;
            $purReqNo = $purchaseRequsition->purchase_req_no;

            // Remove existing details for the requisition
            PurchaseRequsitionDetail::where('purchase_requsition_id', $purReqID)->delete();

            // Insert updated details
            $products = $request->input('products');

            foreach ($products as $product) {
                PurchaseRequsitionDetail::create([

                    'purchase_req_no'        => $purReqNo,
                    'purchase_requsition_id' => $purReqID,
                    'product_id'             => $product['product_id'],
                    'quantity'               => $product['quantity'],
                    'unit_id'                => $product['unit_id'],
                    'unit_price'             => $product['unit_price'],
                    'total'                  => $product['total'],
                    'user_id'                => $user_id,
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
    public function purchaseReqDelete(Request $request){

        try{

            DB::beginTransaction();

            $id         = $request->input('id');
            $purReqNo = $request->input('purchase_req_no');

            PurchaseRequsitionDetail::where('purchase_requsition_id', $id)
                                  ->where('purchase_req_no', $purReqNo)
                                  ->delete();
            PurchaseRequsition::where('id', $id)
                                  ->where('purchase_req_no', $purReqNo)
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
    public function purchaseReqRecom(Request $request){

        try{

            $id = $request->input('id');
            $user_id = $request->input('user_id');
            $is_recom = 2;

            PurchaseRequsition::where('id',$id)
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
    public function purchaseReqNotRecom(Request $request){
        try{

            $id = $request->input('id');
            $user_id = $request->input('user_id');
            $is_recom = 3;

            PurchaseRequsition::where('id',$id)
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
}

