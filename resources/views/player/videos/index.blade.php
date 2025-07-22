<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Videos') }}
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

                    @if(session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-semibold">Your Videos ({{ $videos->count() }})</h3>
                        <a href="{{ route('player.videos.create') }}"
                           style="background-color: #3b82f6; color: white; padding: 8px 16px; border-radius: 6px; text-decoration: none; font-weight: bold;"
                           onmouseover="this.style.backgroundColor='#1d4ed8'"
                           onmouseout="this.style.backgroundColor='#3b82f6'">
                            Add New Video
                        </a>
                    </div>

                    @if($videos->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($videos as $video)
                                <div class="border rounded-lg p-4 shadow">
                                    <div class="aspect-w-16 aspect-h-9 mb-4">
                                        <iframe src="{{ $video->getEmbedUrl() }}" 
                                                frameborder="0" 
                                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                                allowfullscreen
                                                class="w-full h-48 rounded">
                                        </iframe>
                                    </div>
                                    
                                    <h4 class="font-semibold text-lg mb-2">{{ $video->title }}</h4>
                                    
                                    @if($video->description)
                                        <p class="text-gray-600 text-sm mb-3">{{ Str::limit($video->description, 100) }}</p>
                                    @endif
                                    
                                    <div class="flex justify-between items-center text-sm text-gray-500 mb-3">
                                        <span>{{ $video->created_at->diffForHumans() }}</span>
                                    </div>
                                    
                                    <div class="flex justify-end">
                                        <form method="POST" action="{{ route('player.videos.destroy', $video) }}" 
                                              onsubmit="return confirm('Are you sure you want to delete this video?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    style="background-color: #ef4444; color: white; padding: 4px 12px; border-radius: 6px; border: none; font-weight: bold; cursor: pointer; font-size: 14px;"
                                                    onmouseover="this.style.backgroundColor='#dc2626'"
                                                    onmouseout="this.style.backgroundColor='#ef4444'">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <p class="text-gray-500 mb-4">You haven't uploaded any videos yet.</p>
                            <a href="{{ route('player.videos.create') }}"
                               style="background-color: #3b82f6; color: white; padding: 8px 16px; border-radius: 6px; text-decoration: none; font-weight: bold;"
                               onmouseover="this.style.backgroundColor='#1d4ed8'"
                               onmouseout="this.style.backgroundColor='#3b82f6'">
                                Upload Your First Video
                            </a>
                        </div>
                    @endif

                    <div class="mt-6">
                        <a href="{{ route('player.dashboard') }}"
                           style="background-color: #6b7280; color: white; padding: 8px 16px; border-radius: 6px; text-decoration: none; font-weight: bold;"
                           onmouseover="this.style.backgroundColor='#374151'"
                           onmouseout="this.style.backgroundColor='#6b7280'">
                            Back to Dashboard
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
