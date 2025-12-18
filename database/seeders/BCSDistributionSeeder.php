<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BCSDistributionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            1 => 9,
            2 => 23,
            3 => 10,
            4 => 15,
            5 => 8
        ];

        foreach ($data as $score => $qty) {
            for ($i = 0; $i < $qty; $i++) {
                DB::table('body_condition_score')->insert([
                    'bcs_score' => $score,
                    'assessment_date' => now()->format('Y-m-d'),
                    'notes' => 'Distribution seeder',
                    'cow_id' => rand(1, 3),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
