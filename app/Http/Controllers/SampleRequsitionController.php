<?php

namespace App\Http\Controllers;

use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Request;

class SampleRequsitionController extends Controller
{
    public function sampleRequsitionPage(){

//        $config = [
//            'table' => 'purchase_requsitions',
//            'field' => 'purchase_req_no',
//            'length' => 10,  // Use an integer instead of a string
//            'prefix' => 'PUR-'
//        ];
//
//        $id = IdGenerator::generate($config);

//        return view('pages.dashboard.sample-requsition', [
//            'id' => $id,
//        ]);

        return view('pages.dashboard.sample-requsition');
    }

    public function sampleRequsitionPage2(){

//        $config = [
//            'table' => 'purchase_requsitions',
//            'field' => 'purchase_req_no',
//            'length' => 10,  // Use an integer instead of a string
//            'prefix' => 'PUR-'
//        ];
//
//        $id = IdGenerator::generate($config);

//        return view('pages.dashboard.sample-requsition', [
//            'id' => $id,
//        ]);

        return view('pages.dashboard.sample-requsition-2');
    }
}
