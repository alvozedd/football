<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlayerProfile extends Model
{
    protected $fillable = [
        'user_id',
        'full_name',
        'position',
        'location',
        'bio',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function videos()
    {
        return $this->hasMany(Video::class, 'profile_id');
    }

    public function feedback()
    {
        return $this->hasMany(Feedback::class, 'player_id');
    }
}
