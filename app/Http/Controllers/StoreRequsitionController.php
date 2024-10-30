<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StoreRequsitionController extends Controller
{
    public function storeRequsitionPage(){
        return view('pages.dashboard.store-requsition');
    }
}
