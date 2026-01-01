<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BodyConditionScore;

class DashboardController extends Controller
{
    public function index()
    {
        $bcsData = BodyConditionScore::getBCSWithCow(10);

        return view('dashboard', compact('bcsData'));
    }

    public function updateAttention(Request $request, $id)
    {
        $request->validate([
            'attention' => 'required|in:0,1,2'
        ]);

        $bcs = BodyConditionScore::findOrFail($id);
        $bcs->attention = $request->attention;
        $bcs->save();

        return response()->json([
            'success' => true
        ]);
    }
}
