<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BodyConditionScore;

class ListController extends Controller
{
    public function index()
    {
        $bcsData = BodyConditionScore::getBCSWithCow(10);

        return view('list.list', compact('bcsData'));
    }
}
