<?php

namespace App\Http\Controllers;

use App\Models\Cow;
use App\Models\BodyConditionScore;
use Illuminate\Support\Facades\Http;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function predictAllBCS()
    {
        $cows = Cow::all(); // ambil semua sapi

        foreach ($cows as $cow) {

            // Path gambar sesuai kolom cow_img_path
            $imagePath = str_replace('storage/', '', $cow->cow_img_path);
            $imagePath = storage_path('app/public/' . $imagePath);


            // Pastikan file gambar ada
            if (!file_exists($imagePath)) {
                continue; // skip kalau gambarnya tidak ditemukan
            }

            // Kirim gambar ke API model ML
            $response = Http::attach(
                'file',
                file_get_contents($imagePath),
                basename($imagePath)
            )->post('http://127.0.0.1:8001/predict');

            // Ambil hasil
            $result = $response->json();

            // Simpan ke DB
            BodyConditionScore::create([
                'cow_id' => $cow->id,
                'bcs_score' => $result['predicted_class'],
                'assessment_date' => now(),
                'notes' => 'Predicted automatically using ML model',
            ]);
        }

        return "All cows have been predicted!";
    }
}
