<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $fillable = [
        'coach_id',
        'player_id',
        'comment',
    ];

    // Relationships
    public function coach()
    {
        return $this->belongsTo(User::class, 'coach_id');
    }

    public function player()
    {
        return $this->belongsTo(PlayerProfile::class, 'player_id');
    }
}
