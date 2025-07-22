<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PlayerProfile;
use App\Models\User;

class PlayerProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $players = User::where('role', 'player')->get();

        foreach ($players as $index => $player) {
            $profiles = [
                [
                    'full_name' => 'Alex Rodriguez',
                    'position' => 'Forward',
                    'location' => 'Manchester, UK',
                    'bio' => 'Experienced striker with excellent finishing ability. Strong in the air and good with both feet. Looking for opportunities to play at a higher level.',
                ],
                [
                    'full_name' => 'Jamie Wilson',
                    'position' => 'Midfielder',
                    'location' => 'London, UK',
                    'bio' => 'Creative midfielder with excellent passing range and vision. Good at set pieces and has a strong work rate. Comfortable playing in multiple midfield positions.',
                ],
                [
                    'full_name' => 'Sam Taylor',
                    'position' => 'Defender',
                    'location' => 'Liverpool, UK',
                    'bio' => 'Solid center-back with good aerial ability and leadership qualities. Strong in tackles and comfortable with the ball at feet. Captain of my local team.',
                ],
                [
                    'full_name' => 'Jordan Brown',
                    'position' => 'Goalkeeper',
                    'location' => 'Birmingham, UK',
                    'bio' => 'Reliable goalkeeper with excellent shot-stopping ability and good distribution. Strong command of the penalty area and good communication skills.',
                ],
            ];

            if (isset($profiles[$index])) {
                PlayerProfile::create([
                    'user_id' => $player->id,
                    'full_name' => $profiles[$index]['full_name'],
                    'position' => $profiles[$index]['position'],
                    'location' => $profiles[$index]['location'],
                    'bio' => $profiles[$index]['bio'],
                ]);
            }
        }
    }
}
