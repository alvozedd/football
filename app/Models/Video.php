<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = [
        'profile_id',
        'title',
        'description',
        'youtube_link',
    ];

    // Relationships
    public function playerProfile()
    {
        return $this->belongsTo(PlayerProfile::class, 'profile_id');
    }

    // Helper method to get YouTube embed URL
    public function getEmbedUrl()
    {
        // Convert YouTube watch URL to embed URL
        $url = $this->youtube_link;
        if (preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([a-zA-Z0-9_-]+)/', $url, $matches)) {
            return 'https://www.youtube.com/embed/' . $matches[1];
        }
        return $url;
    }
}
