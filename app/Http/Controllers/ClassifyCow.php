<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Cow;
use App\Models\BodyConditionScore;

class ClassifyCow extends Controller
{
    public function classifyBCS(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:5120',
            'tag_id' => 'required',
            'tgl_lahir' => 'required',
            'jenis_kelamin' => 'required',
        ]);

        // 1. Simpan gambar ke storage
        $imagePath = $request->file('image')->store('cows', 'public');

        // 2. Kirim gambar ke FastAPI
        $response = Http::attach(
            'file',
            fopen($request->file('image')->getPathname(), 'r'),
            $request->file('image')->getClientOriginalName()
        )->post('http://127.0.0.1:8001/predict');

        if ($response->failed()) {
            return response()->json([
                'error' => 'FastAPI error',
                'details' => $response->json()
            ], 500);
        }

        $result = $response->json();

        // 3. Simpan data cow
        $cow = Cow::create([
            'tag_id' => $request->tag_id,
            'cow_img_path' => $imagePath,
            'tgl_lahir' => $request->tgl_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
        ]);

        // 4. Simpan hasil BCS
        BodyConditionScore::create([
            'cow_id' => $cow->id,
            'bcs_score' => $result['predicted_class'],
            'assessment_date' => now(),
            'notes' => 'Prediksi otomatis dari model FastAPI'
        ]);

        // 5. Response ke frontend
        return response()->json([
            'message' => 'Data sapi dan hasil BCS berhasil disimpan!',
            'cow' => $cow,
            'bcs_result' => $result,
        ]);
    }


    public function chartData()
    {
        // Ambil semua data BCS
        $bcs = BodyConditionScore::select('bcs_score', 'assessment_date')->get();

        // ==========================
        // 1) BAR CHART → rata-rata BCS per bulan
        // ==========================
        $monthlyScores = array_fill(0, 12, 0);
        $monthlyCounts = array_fill(0, 12, 0);

        foreach ($bcs as $item) {
            $monthIndex = date('n', strtotime($item->assessment_date)) - 1;
            $monthlyScores[$monthIndex] += $item->bcs_score;
            $monthlyCounts[$monthIndex]++;
        }

        // Hitung rata-rata per bulan
        foreach ($monthlyScores as $i => $val) {
            $monthlyScores[$i] = $monthlyCounts[$i] > 0
                ? round($val / $monthlyCounts[$i], 2)
                : 0;
        }

        // ==========================
        // 2) PIE CHART → jumlah BCS 1-5
        // ==========================
        $distribution = [
            1 => 0,
            2 => 0,
            3 => 0,
            4 => 0,
            5 => 0
        ];

        foreach ($bcs as $item) {
            $distribution[$item->bcs_score]++;
        }

        return response()->json([
            'monthly_scores' => array_values($monthlyScores),
            'distribution'   => array_values($distribution)
        ]);
    }
}
