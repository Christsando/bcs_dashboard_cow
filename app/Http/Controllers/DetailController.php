<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cow;
use App\Models\BodyConditionScore;

class DetailController extends Controller
{
    public function showByCow(Cow $cow)
    {
        $bcsList = BodyConditionScore::where('cow_id', $cow->id)
            ->latest()
            ->get();

        $latestBCS = $bcsList->first();

        return view('detail.detail', compact('cow', 'bcsList', 'latestBCS'));
    }
}
