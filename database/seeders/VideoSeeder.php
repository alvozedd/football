<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Video;
use App\Models\PlayerProfile;

class VideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $profiles = PlayerProfile::all();

        $sampleVideos = [
            [
                'title' => 'Match Highlights vs City FC',
                'description' => 'Goals and key moments from our 3-1 victory against City FC. Shows finishing ability and movement in the box.',
                'youtube_link' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
            ],
            [
                'title' => 'Training Session - Shooting Practice',
                'description' => 'Individual shooting practice session focusing on accuracy and power. Various angles and distances.',
                'youtube_link' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
            ],
            [
                'title' => 'Skills Compilation',
                'description' => 'Collection of best skills, tricks, and technical ability from recent matches and training.',
                'youtube_link' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
            ],
        ];

        foreach ($profiles as $profile) {
            // Add 2-3 videos per player
            $videoCount = rand(2, 3);

            for ($i = 0; $i < $videoCount; $i++) {
                $videoData = $sampleVideos[$i % count($sampleVideos)];

                Video::create([
                    'profile_id' => $profile->id,
                    'title' => $videoData['title'] . ' - ' . $profile->full_name,
                    'description' => $videoData['description'],
                    'youtube_link' => $videoData['youtube_link'],
                ]);
            }
        }
    }
}
