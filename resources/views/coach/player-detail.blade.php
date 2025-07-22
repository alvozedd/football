<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $player->full_name }} - Player Profile
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Player Info -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-xl font-semibold mb-4">{{ $player->full_name }}</h3>
                            <div class="space-y-2">
                                <p><strong>Position:</strong> {{ $player->position }}</p>
                                <p><strong>Location:</strong> {{ $player->location }}</p>
                                <p><strong>Videos:</strong> {{ $player->videos->count() }}</p>
                                <p><strong>Feedback Received:</strong> {{ $player->feedback->count() }}</p>
                            </div>
                        </div>
                        <div>
                            @if($player->bio)
                                <h4 class="font-semibold mb-2">About</h4>
                                <p class="text-gray-700">{{ $player->bio }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Videos -->
            @if($player->videos->count() > 0)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-semibold mb-4">Videos ({{ $player->videos->count() }})</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @foreach($player->videos as $video)
                                <div class="border rounded-lg p-4">
                                    <div class="aspect-w-16 aspect-h-9 mb-3">
                                        <iframe src="{{ $video->getEmbedUrl() }}" 
                                                frameborder="0" 
                                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                                allowfullscreen
                                                class="w-full h-48 rounded">
                                        </iframe>
                                    </div>
                                    <h4 class="font-semibold mb-2">{{ $video->title }}</h4>
                                    @if($video->description)
                                        <p class="text-gray-600 text-sm">{{ $video->description }}</p>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            <!-- Leave Feedback -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">Leave Feedback</h3>
                    <form method="POST" action="{{ route('coach.feedback.store') }}">
                        @csrf
                        <input type="hidden" name="player_id" value="{{ $player->id }}">
                        
                        <div class="mb-4">
                            <label for="comment" class="block text-sm font-medium text-gray-700">Your Feedback</label>
                            <textarea name="comment" id="comment" rows="4" 
                                      class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                      placeholder="Share your thoughts on this player's skills, potential, and areas for improvement..."
                                      required>{{ old('comment') }}</textarea>
                            @error('comment')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <button type="submit"
                                style="background-color: #3b82f6; color: white; padding: 8px 16px; border-radius: 6px; border: none; font-weight: bold; cursor: pointer;"
                                onmouseover="this.style.backgroundColor='#1d4ed8'"
                                onmouseout="this.style.backgroundColor='#3b82f6'">
                            Submit Feedback
                        </button>
                    </form>
                </div>
            </div>

            <!-- Previous Feedback -->
            @if($player->feedback->count() > 0)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-semibold mb-4">Previous Feedback ({{ $player->feedback->count() }})</h3>
                        <div class="space-y-4">
                            @foreach($player->feedback as $feedback)
                                <div class="border-l-4 border-blue-500 pl-4 py-2">
                                    <div class="flex justify-between items-start mb-2">
                                        <strong class="text-gray-800">Coach {{ $feedback->coach->name }}</strong>
                                        <span class="text-sm text-gray-500">{{ $feedback->created_at->diffForHumans() }}</span>
                                    </div>
                                    <p class="text-gray-700">{{ $feedback->comment }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            <!-- Navigation -->
            <div class="flex justify-between">
                <a href="{{ route('coach.players') }}"
                   style="background-color: #6b7280; color: white; padding: 8px 16px; border-radius: 6px; text-decoration: none; font-weight: bold;"
                   onmouseover="this.style.backgroundColor='#374151'"
                   onmouseout="this.style.backgroundColor='#6b7280'">
                    Back to Players
                </a>
                <a href="{{ route('coach.dashboard') }}"
                   style="background-color: #3b82f6; color: white; padding: 8px 16px; border-radius: 6px; text-decoration: none; font-weight: bold;"
                   onmouseover="this.style.backgroundColor='#1d4ed8'"
                   onmouseout="this.style.backgroundColor='#3b82f6'">
                    Dashboard
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
