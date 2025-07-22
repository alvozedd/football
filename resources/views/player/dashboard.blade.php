<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Player Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(!$profile)
                        <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded mb-4">
                            <strong>Welcome!</strong> Please create your player profile to get started.
                            <a href="{{ route('player.profile.edit') }}" class="underline">Create Profile</a>
                        </div>
                    @else
                        <div class="grid grid-cols-3 gap-4 mb-6">
                            <div class="bg-blue-100 p-3 rounded text-center">
                                <h3 class="text-sm font-semibold text-blue-800">Videos</h3>
                                <p class="text-xl font-bold text-blue-600">{{ $videos->count() }}</p>
                            </div>
                            <div class="bg-green-100 p-3 rounded text-center">
                                <h3 class="text-sm font-semibold text-green-800">Feedback</h3>
                                <p class="text-xl font-bold text-green-600">{{ $feedbackCount }}</p>
                            </div>
                            <div class="bg-purple-100 p-3 rounded text-center">
                                <h3 class="text-sm font-semibold text-purple-800">Position</h3>
                                <p class="text-lg font-bold text-purple-600">{{ $profile->position }}</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                            <div>
                                <h3 class="text-lg font-semibold mb-4">Quick Actions</h3>
                                <div class="space-y-3">
                                    <a href="{{ route('player.profile.edit') }}"
                                       style="background-color: #3b82f6; color: white; padding: 12px 16px; border-radius: 6px; text-decoration: none; display: block; text-align: center; font-weight: bold;"
                                       onmouseover="this.style.backgroundColor='#1d4ed8'"
                                       onmouseout="this.style.backgroundColor='#3b82f6'">
                                        Edit Profile
                                    </a>
                                    <a href="{{ route('player.videos.create') }}"
                                       style="background-color: #10b981; color: white; padding: 12px 16px; border-radius: 6px; text-decoration: none; display: block; text-align: center; font-weight: bold;"
                                       onmouseover="this.style.backgroundColor='#047857'"
                                       onmouseout="this.style.backgroundColor='#10b981'">
                                        Add New Video
                                    </a>
                                    <a href="{{ route('player.videos.index') }}"
                                       style="background-color: #8b5cf6; color: white; padding: 12px 16px; border-radius: 6px; text-decoration: none; display: block; text-align: center; font-weight: bold;"
                                       onmouseover="this.style.backgroundColor='#6d28d9'"
                                       onmouseout="this.style.backgroundColor='#8b5cf6'">
                                        Manage Videos
                                    </a>
                                    <a href="{{ route('player.feedback') }}"
                                       style="background-color: #f59e0b; color: white; padding: 12px 16px; border-radius: 6px; text-decoration: none; display: block; text-align: center; font-weight: bold;"
                                       onmouseover="this.style.backgroundColor='#d97706'"
                                       onmouseout="this.style.backgroundColor='#f59e0b'">
                                        View Feedback
                                    </a>
                                </div>
                            </div>

                            <div>
                                <h3 class="text-lg font-semibold mb-4">Recent Videos</h3>
                                @if($videos->count() > 0)
                                    <div class="space-y-3">
                                        @foreach($videos->take(3) as $video)
                                            <div class="border p-3 rounded">
                                                <h4 class="font-semibold">{{ $video->title }}</h4>
                                                <p class="text-sm text-gray-600">{{ Str::limit($video->description, 100) }}</p>
                                                <p class="text-xs text-gray-500">{{ $video->created_at->diffForHumans() }}</p>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <p class="text-gray-500">No videos uploaded yet.</p>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
