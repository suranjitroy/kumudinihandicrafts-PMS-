<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function DashboardPage(){
        return view('pages.dashboard.dashboard-page');
    }
}
