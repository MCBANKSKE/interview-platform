<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'passport_number',
        'email',
        'phone_number',
    ];

    public function submissions()
    {
        return $this->hasMany(Submission::class);
    }
}
