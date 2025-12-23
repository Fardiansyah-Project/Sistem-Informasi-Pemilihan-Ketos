<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    protected $fillable = [
        'name',
        'candidate_number',
        'vision_mission',
        'photo',
        'vote_count'
    ];
    
    public function votes()
    {
        return $this->hasMany(Vote::class);
    }

}
