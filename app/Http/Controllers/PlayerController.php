<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PlayerProfile;
use App\Models\Feedback;

class PlayerController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();
        $profile = $user->playerProfile;
        $videos = $profile ? $profile->videos : collect();
        $feedbackCount = $profile ? $profile->feedback()->count() : 0;

        return view('player.dashboard', compact('profile', 'videos', 'feedbackCount'));
    }

    public function editProfile()
    {
        $user = auth()->user();
        $profile = $user->playerProfile;

        return view('player.profile', compact('profile'));
    }

    public function storeProfile(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'bio' => 'nullable|string',
        ]);

        $user = auth()->user();

        PlayerProfile::create([
            'user_id' => $user->id,
            'full_name' => $request->full_name,
            'position' => $request->position,
            'location' => $request->location,
            'bio' => $request->bio,
        ]);

        return redirect()->route('player.dashboard')->with('success', 'Profile created successfully!');
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'bio' => 'nullable|string',
        ]);

        $user = auth()->user();
        $profile = $user->playerProfile;

        $profile->update([
            'full_name' => $request->full_name,
            'position' => $request->position,
            'location' => $request->location,
            'bio' => $request->bio,
        ]);

        return redirect()->route('player.dashboard')->with('success', 'Profile updated successfully!');
    }

    public function feedback()
    {
        $user = auth()->user();
        $profile = $user->playerProfile;

        if (!$profile) {
            return redirect()->route('player.profile.edit')->with('error', 'Please create your profile first.');
        }

        $feedback = $profile->feedback()->with('coach')->latest()->get();

        return view('player.feedback', compact('feedback'));
    }
}
