<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BodyConditionScore extends Model
{
    protected $table = 'body_condition_score';
    // fillable fields
    protected $fillable = [
        'cow_id',
        'bcs_score',
        'assessment_date',
        'notes',
    ];

    public function cow()
    {
        return $this->belongsTo(Cow::class);
    }

    public static function getBCSWithCow($perPage = 10)
    {
        return self::with('cow')
            ->latest()
            ->paginate($perPage);
    }
}
