<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Coach Feedback') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-semibold">Feedback from Coaches ({{ $feedback->count() }})</h3>
                        <a href="{{ route('player.dashboard') }}"
                           style="background-color: #6b7280; color: white; padding: 8px 16px; border-radius: 6px; text-decoration: none; font-weight: bold;"
                           onmouseover="this.style.backgroundColor='#374151'"
                           onmouseout="this.style.backgroundColor='#6b7280'">
                            Back to Dashboard
                        </a>
                    </div>

                    @if($feedback->count() > 0)
                        <div class="space-y-6">
                            @foreach($feedback as $item)
                                <div class="border rounded-lg p-6 shadow-sm">
                                    <div class="flex justify-between items-start mb-4">
                                        <div>
                                            <h4 class="font-semibold text-lg text-gray-800">
                                                Coach {{ $item->coach->name }}
                                            </h4>
                                            <p class="text-sm text-gray-500">
                                                {{ $item->created_at->format('M j, Y \a\t g:i A') }}
                                            </p>
                                        </div>
                                        <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded">
                                            Feedback
                                        </span>
                                    </div>
                                    
                                    <div class="bg-gray-50 rounded-lg p-4">
                                        <p class="text-gray-700 leading-relaxed">{{ $item->comment }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-12">
                            <div class="mx-auto w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-3.582 8-8 8a8.959 8.959 0 01-4.906-1.456L3 21l2.544-5.094A8.959 8.959 0 013 12c0-4.418 3.582-8 8-8s8 3.582 8 8z"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-800 mb-2">No feedback yet</h3>
                            <p class="text-gray-500 mb-6">
                                Coaches haven't left any feedback on your profile yet. Make sure your profile is complete and you have uploaded some videos to attract coach attention.
                            </p>
                            <div class="space-x-4">
                                <a href="{{ route('player.profile.edit') }}"
                                   style="background-color: #3b82f6; color: white; padding: 8px 16px; border-radius: 6px; text-decoration: none; font-weight: bold; display: inline-block;"
                                   onmouseover="this.style.backgroundColor='#1d4ed8'"
                                   onmouseout="this.style.backgroundColor='#3b82f6'">
                                    Update Profile
                                </a>
                                <a href="{{ route('player.videos.create') }}"
                                   style="background-color: #10b981; color: white; padding: 8px 16px; border-radius: 6px; text-decoration: none; font-weight: bold; display: inline-block;"
                                   onmouseover="this.style.backgroundColor='#047857'"
                                   onmouseout="this.style.backgroundColor='#10b981'">
                                    Add Videos
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
