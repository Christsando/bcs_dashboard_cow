<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CowSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $basePath = storage_path('app/public/cow');
        $timestamp = Carbon::now()->format('YmdHis');

        $data = [];
        $counter = 1;

        foreach (glob($basePath . '/*') as $folder) {
        if (is_dir($folder)) {

            foreach (glob($folder . '/*.jpg') as $file) {

                $num = str_pad($counter, 3, '0', STR_PAD_LEFT);

                // Ambil path relatif untuk disimpan di DB
                $relativePath = 'storage/cow/' . basename($folder) . '/' . basename($file);

                $data[] = [
                    'tag_id' => "COW-{$timestamp}{$num}",
                    'cow_img_path' => $relativePath,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];

                $counter++;
            }

        }
    }

    DB::table('cows')->insert($data);
    }
}
