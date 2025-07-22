<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add New Video') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if(session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('player.videos.store') }}">
                        @csrf

                        <!-- Title -->
                        <div class="mb-6">
                            <label for="title" class="block text-sm font-medium text-gray-700">Video Title</label>
                            <input type="text" name="title" id="title" 
                                   value="{{ old('title') }}"
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" 
                                   placeholder="e.g., Match Highlights vs Arsenal U21"
                                   required>
                            @error('title')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- YouTube Link -->
                        <div class="mb-6">
                            <label for="youtube_link" class="block text-sm font-medium text-gray-700">YouTube Link</label>
                            <input type="url" name="youtube_link" id="youtube_link" 
                                   value="{{ old('youtube_link') }}"
                                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" 
                                   placeholder="https://www.youtube.com/watch?v=..."
                                   required>
                            @error('youtube_link')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-1 text-sm text-gray-500">
                                Paste the full YouTube URL (e.g., https://www.youtube.com/watch?v=dQw4w9WgXcQ)
                            </p>
                        </div>

                        <!-- Description -->
                        <div class="mb-6">
                            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                            <textarea name="description" id="description" rows="4" 
                                      class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                      placeholder="Describe what coaches will see in this video...">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="bg-blue-50 border border-blue-200 rounded-md p-4 mb-6">
                            <h4 class="font-semibold text-blue-800 mb-2">Tips for Great Videos:</h4>
                            <ul class="text-sm text-blue-700 space-y-1">
                                <li>• Upload your best highlights and skills</li>
                                <li>• Include match footage showing your position play</li>
                                <li>• Add training videos demonstrating technique</li>
                                <li>• Write clear descriptions explaining what coaches should watch for</li>
                                <li>• Make sure videos are public or unlisted on YouTube</li>
                            </ul>
                        </div>

                        <div class="flex items-center justify-between">
                            <a href="{{ route('player.videos.index') }}"
                               style="background-color: #6b7280; color: white; padding: 8px 16px; border-radius: 6px; text-decoration: none; font-weight: bold;"
                               onmouseover="this.style.backgroundColor='#374151'"
                               onmouseout="this.style.backgroundColor='#6b7280'">
                                Cancel
                            </a>
                            <button type="submit"
                                    style="background-color: #3b82f6; color: white; padding: 8px 16px; border-radius: 6px; border: none; font-weight: bold; cursor: pointer;"
                                    onmouseover="this.style.backgroundColor='#1d4ed8'"
                                    onmouseout="this.style.backgroundColor='#3b82f6'">
                                Add Video
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
