<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Candidate;
use App\Models\Question;

class Submission extends Model
{
    protected $fillable = [
        'candidate_id',
        'question_id',
        'answer_text',
        'answer_file',
        'marks_awarded',
    ];

    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
