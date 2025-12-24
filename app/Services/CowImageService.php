<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class CowImageService
{
    public static function all(): array
    {
        $images = [];

        // 1. Dataset → public/cow/**
        $datasetPath = public_path('cow');
        if (File::exists($datasetPath)) {
            foreach (File::allFiles($datasetPath) as $file) {
                if (preg_match('/\.(jpg|jpeg|png|webp)$/i', $file->getFilename())) {
                    $relative = str_replace(public_path(), '', $file->getPathname());
                    $images[] = asset($relative);
                }
            }
        }

        // 2. Upload → storage/app/public/cows
        foreach (Storage::disk('public')->files('cows') as $file) {
            if (preg_match('/\.(jpg|jpeg|png|webp)$/i', $file)) {
                $images[] = Storage::url($file);
            }
        }

        return $images;
    }
}
