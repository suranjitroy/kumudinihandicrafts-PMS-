<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;

use App\Models\StoreRequsition;
use App\Models\StoreRequsitionDetail;
use Illuminate\Support\Facades\DB;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class StoreRequsitionController extends Controller
{
    public function storeRequsitionPage(){
        $config = [
            'table' => 'store_requsitions',
            'field' => 'store_req_no',
            'length' => 10,  // Use an integer instead of a string
            'prefix' => 'STR-'
            ];
    
        $id = IdGenerator::generate($config);
         
        return view('pages.dashboard.store-requsition',[
            'id' => $id
        ]);
    }
    public function storeReqCreate(Request $request){

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
        
            $storeRequsition = StoreRequsition::create([
                'req_date'      => $reqDate,
                'store_req_no'  => $reqNo,
                'section_id'    => $secID,
                'is_approve'    => $approve
            ]);

            $storeReqID = $storeRequsition->id;

            $products = $request->input('products');

            foreach($products as $product){

                StoreRequsitionDetail::create([
                    'store_requsition_id' => $storeReqID,
                    'product_id'          => $product['product_id'],
                    'quantity'            => $product['quantity'],
                    'unit_id'             => $product['unit_id']
                ]);

            }

            DB::commit();

           

            //return redirect()->route('store.requsition')->with('store_req_no');
            //return 1;

            // return response()->json([
            //     'status' => 'Insert Success',
            //     'message' => 'Save Successfull'
            // ]);

        } catch (Exception $e) {

            DB::rollBack();

            return 0;

            // return response()->json([
            //     'status' => 'Insert Fail',
            //     'message' => $e->getMessage()
            // ]);
        }

    }
}
