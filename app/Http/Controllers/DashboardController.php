<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BodyConditionScore;

class DashboardController extends Controller
{
    public function index(){
    $bcsData = BodyConditionScore::getBCSWithCow(10);

    return view('dashboard', compact('bcsData'));
    }
}
