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
        // Validasi
        $request->validate([
            'image' => 'required|image|max:5120',
            // 'tag_id' => 'string|max:255',
        ]);

        try {
            // 1. Simpan gambar ke storage
            $imagePath = $request->file('image')->store('cows', 'public');

            // 2. Kirim gambar ke FastAPI
            $response = Http::attach(
                'file',
                fopen($request->file('image')->getPathname(), 'r'),
                $request->file('image')->getClientOriginalName()
            )->post('http://127.0.0.1:8001/predict');

            // Cek response FastAPI
            if ($response->failed()) {
                return redirect()->back()
                    ->withErrors(['error' => 'FastAPI gagal memproses gambar. Pastikan server berjalan.'])
                    ->withInput();
            }

            $result = $response->json();

            $timestamp = now()->format('YmdHis');
            $num = rand(100, 999);
            $tagId = "COW-{$timestamp}{$num}";

            // 3. Simpan data cow
            $cow = Cow::create([
                'tag_id' => $tagId,
                'cow_img_path' => $imagePath,
                'image_source'=> "upload",
            ]);

            // 4. Simpan hasil BCS
            $bcs = BodyConditionScore::create([
                'cow_id' => $cow->id,
                'bcs_score' => $result['predicted_class'],
                'assessment_date' => now(),
                'notes' => 'Prediksi otomatis dari model FastAPI'
            ]);

            // 5. Redirect dengan success message
            return redirect()->back()->with(
                'success',
                "Data berhasil disimpan! Tag ID: {$cow->tag_id} | BCS Score: {$bcs->bcs_score}"
            );
        } catch (\Exception $e) {
            // Handle error
            return redirect()->back()
                ->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()])
                ->withInput();
        }
    }

    public function chartData()
    {
        // Ambil semua data BCS
        $bcs = BodyConditionScore::select('bcs_score', 'assessment_date')->get();

        // BAR CHART → rata-rata BCS per bulan
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

        // PIE CHART → jumlah BCS 1-5
        $distribution = [1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0];

        foreach ($bcs as $item) {
            if (isset($distribution[$item->bcs_score])) {
                $distribution[$item->bcs_score]++;
            }
        }

        return response()->json([
            'monthly_scores' => array_values($monthlyScores),
            'distribution'   => array_values($distribution)
        ]);
    }
}
