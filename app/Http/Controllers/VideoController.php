<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;

class VideoController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $profile = $user->playerProfile;

        if (!$profile) {
            return redirect()->route('player.profile.edit')->with('error', 'Please create your profile first.');
        }

        $videos = $profile->videos()->latest()->get();

        return view('player.videos.index', compact('videos'));
    }

    public function create()
    {
        return view('player.videos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'youtube_link' => 'required|url',
        ]);

        $user = auth()->user();
        $profile = $user->playerProfile;

        if (!$profile) {
            return redirect()->route('player.profile.edit')->with('error', 'Please create your profile first.');
        }

        Video::create([
            'profile_id' => $profile->id,
            'title' => $request->title,
            'description' => $request->description,
            'youtube_link' => $request->youtube_link,
        ]);

        return redirect()->route('player.videos.index')->with('success', 'Video added successfully!');
    }

    public function destroy(Video $video)
    {
        $user = auth()->user();

        // Check if the video belongs to the current user
        if ($video->playerProfile->user_id !== $user->id) {
            abort(403, 'Unauthorized action.');
        }

        $video->delete();

        return redirect()->route('player.videos.index')->with('success', 'Video deleted successfully!');
    }
}
