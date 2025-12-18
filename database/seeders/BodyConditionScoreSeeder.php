<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BodyConditionScoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $scores = [1, 1, 2, 2, 4, 5, 4, 5, 4, 4, 3, 3];

        foreach ($scores as $i => $score) {
            DB::table('body_condition_score')->insert([
                'bcs_score' => $score,
                'assessment_date' => now()->setMonth($i + 1)->format('Y-m-d'),
                'notes' => 'Auto generated seeder data',
                'cow_id' => 1, // selalu cow #1 untuk grafik
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
