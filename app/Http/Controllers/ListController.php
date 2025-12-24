<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BodyConditionScore;

class ListController extends Controller
{
    public function index(Request $request)
    {
        $bcsData = BodyConditionScore::query()
            ->when($request->search, function ($q) use ($request) {
                $q->whereHas('cow', function ($q2) use ($request) {
                    $q2->where('tag_id', 'like', '%' . $request->search . '%');
                });
            })
            ->when($request->bcs, function ($q) use ($request) {
                $q->where('bcs_score', $request->bcs);
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('list.list', compact('bcsData'));
    }
}
