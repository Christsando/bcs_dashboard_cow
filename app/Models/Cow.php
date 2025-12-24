<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cow extends Model
{
    protected $table = 'cows';
    
    // fillable fields
    protected $fillable = [
        'tag_id',
        'cow_img_path',
        // 'tgl_lahir',
        // 'jenis_kelamin',
        'image_source'
    ];

    public function bcs()
    {
        return $this->hasMany(BodyConditionScore::class);
    }
}