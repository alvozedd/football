<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PlayerProfile;
use App\Models\Feedback;

class CoachController extends Controller
{
    public function dashboard()
    {
        $totalPlayers = PlayerProfile::count();
        $totalFeedback = Feedback::where('coach_id', auth()->id())->count();

        return view('coach.dashboard', compact('totalPlayers', 'totalFeedback'));
    }

    public function players(Request $request)
    {
        $query = PlayerProfile::with('user', 'videos');

        // Filter by position if provided
        if ($request->filled('position')) {
            $query->where('position', $request->position);
        }

        $players = $query->latest()->paginate(12);

        return view('coach.players', compact('players'));
    }

    public function showPlayer(PlayerProfile $player)
    {
        $player->load('videos', 'feedback.coach');

        return view('coach.player-detail', compact('player'));
    }

    public function storeFeedback(Request $request)
    {
        $request->validate([
            'player_id' => 'required|exists:player_profiles,id',
            'comment' => 'required|string',
        ]);

        Feedback::create([
            'coach_id' => auth()->id(),
            'player_id' => $request->player_id,
            'comment' => $request->comment,
        ]);

        return back()->with('success', 'Feedback submitted successfully!');
    }
}
