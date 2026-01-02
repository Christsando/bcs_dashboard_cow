<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cow;
use App\Models\BodyConditionScore;
use App\Services\CowImageService;

class DetailController extends Controller
{

    public function showByCow(Cow $cow)
    {
        $bcsList = BodyConditionScore::where('cow_id', $cow->id)
            ->latest()
            ->get();

        $latestBCS = $bcsList->first();
        $cowImages = CowImageService::all();

        return view('detail.detail', compact('cow', 'bcsList', 'latestBCS', 'cowImages'));
    }

    public function update(Request $request, BodyConditionScore $bcs)
    {
        $request->validate([
            'notes' => 'nullable|string'
        ]);

        $bcs->update([
            'notes' => $request->notes,
        ]);

        return back()->with('Success');
    }

    public function chartData(Cow $cow)
    {
        $bcs = BodyConditionScore::where('cow_id', $cow->id)
            ->orderBy('assessment_date')
            ->get();

        return response()->json([
            'labels' => $bcs->pluck('assessment_date')
                ->map(fn($date) => \Carbon\Carbon::parse($date)->format('d M'))
                ->toArray(),

            'scores' => $bcs->pluck('bcs_score')->toArray(),
        ]);
    }
}
