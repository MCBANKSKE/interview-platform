<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'text',
        'type',
        'expected_answer',
        'max_marks',
    ];

    public function submissions()
    {
        return $this->hasMany(Submission::class);
    }
}
