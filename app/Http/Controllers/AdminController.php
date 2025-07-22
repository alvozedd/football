<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\PlayerProfile;
use App\Models\Video;
use App\Models\Feedback;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_users' => User::count(),
            'total_players' => PlayerProfile::count(),
            'total_coaches' => User::where('role', 'coach')->count(),
            'total_videos' => Video::count(),
            'total_feedback' => Feedback::count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }

    public function users()
    {
        $users = User::with('playerProfile')->latest()->paginate(20);

        return view('admin.users', compact('users'));
    }

    public function deleteUser(User $user)
    {
        // Don't allow deleting the current admin
        if ($user->id === auth()->id()) {
            return back()->with('error', 'You cannot delete your own account.');
        }

        $user->delete();

        return back()->with('success', 'User deleted successfully.');
    }

    public function deleteVideo(Video $video)
    {
        $video->delete();

        return back()->with('success', 'Video deleted successfully.');
    }

    public function deleteFeedback(Feedback $feedback)
    {
        $feedback->delete();

        return back()->with('success', 'Feedback deleted successfully.');
    }
}
