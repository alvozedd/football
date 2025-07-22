<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Player Scouting') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Position Filter Buttons -->
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-3">Filter by Position</h3>
                        <div class="flex flex-wrap gap-2">
                            <a href="{{ route('coach.players') }}"
                               style="background-color: {{ !request('position') ? '#374151' : '#6b7280' }}; color: white; padding: 8px 16px; border-radius: 6px; text-decoration: none; font-weight: bold;"
                               onmouseover="this.style.backgroundColor='#374151'"
                               onmouseout="this.style.backgroundColor='{{ !request('position') ? '#374151' : '#6b7280' }}'">
                                All Players
                            </a>
                            <a href="{{ route('coach.players', ['position' => 'Forward']) }}"
                               style="background-color: {{ request('position') == 'Forward' ? '#10b981' : '#6b7280' }}; color: white; padding: 8px 16px; border-radius: 6px; text-decoration: none; font-weight: bold;"
                               onmouseover="this.style.backgroundColor='#10b981'"
                               onmouseout="this.style.backgroundColor='{{ request('position') == 'Forward' ? '#10b981' : '#6b7280' }}'">
                                Forwards
                            </a>
                            <a href="{{ route('coach.players', ['position' => 'Midfielder']) }}"
                               style="background-color: {{ request('position') == 'Midfielder' ? '#8b5cf6' : '#6b7280' }}; color: white; padding: 8px 16px; border-radius: 6px; text-decoration: none; font-weight: bold;"
                               onmouseover="this.style.backgroundColor='#8b5cf6'"
                               onmouseout="this.style.backgroundColor='{{ request('position') == 'Midfielder' ? '#8b5cf6' : '#6b7280' }}'">
                                Midfielders
                            </a>
                            <a href="{{ route('coach.players', ['position' => 'Defender']) }}"
                               style="background-color: {{ request('position') == 'Defender' ? '#f59e0b' : '#6b7280' }}; color: white; padding: 8px 16px; border-radius: 6px; text-decoration: none; font-weight: bold;"
                               onmouseover="this.style.backgroundColor='#f59e0b'"
                               onmouseout="this.style.backgroundColor='{{ request('position') == 'Defender' ? '#f59e0b' : '#6b7280' }}'">
                                Defenders
                            </a>
                            <a href="{{ route('coach.players', ['position' => 'Goalkeeper']) }}"
                               style="background-color: {{ request('position') == 'Goalkeeper' ? '#ef4444' : '#6b7280' }}; color: white; padding: 8px 16px; border-radius: 6px; text-decoration: none; font-weight: bold;"
                               onmouseover="this.style.backgroundColor='#ef4444'"
                               onmouseout="this.style.backgroundColor='{{ request('position') == 'Goalkeeper' ? '#ef4444' : '#6b7280' }}'">
                                Goalkeepers
                            </a>
                        </div>
                    </div>

                    <!-- Results Summary -->
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-semibold">
                            @if(request('position'))
                                {{ request('position') }}s: {{ $players->total() }} players
                            @else
                                All Players: {{ $players->total() }} total
                            @endif
                        </h3>
                        <a href="{{ route('coach.dashboard') }}"
                           style="background-color: #6b7280; color: white; padding: 8px 16px; border-radius: 6px; text-decoration: none; font-weight: bold;"
                           onmouseover="this.style.backgroundColor='#374151'"
                           onmouseout="this.style.backgroundColor='#6b7280'">
                            Back to Dashboard
                        </a>
                    </div>

                    @if($players->count() > 0)
                        <!-- Players Grid -->
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
                            @foreach($players as $player)
                                <div class="border rounded-lg p-4 shadow hover:shadow-lg transition-shadow">
                                    <div class="flex justify-between items-start mb-3">
                                        <h4 class="font-semibold text-lg">{{ $player->full_name }}</h4>
                                        <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded">
                                            {{ $player->position }}
                                        </span>
                                    </div>
                                    
                                    <p class="text-gray-600 text-sm mb-2">
                                        <strong>Location:</strong> {{ $player->location }}
                                    </p>
                                    
                                    @if($player->bio)
                                        <p class="text-gray-700 text-sm mb-3">{{ Str::limit($player->bio, 100) }}</p>
                                    @endif
                                    
                                    <div class="flex justify-between items-center text-sm text-gray-500 mb-3">
                                        <span>{{ $player->videos->count() }} video(s)</span>
                                        <span>{{ $player->feedback->count() }} feedback</span>
                                    </div>
                                    
                                    <a href="{{ route('coach.players.show', $player) }}"
                                       style="background-color: #3b82f6; color: white; padding: 8px 16px; border-radius: 6px; text-decoration: none; display: block; text-align: center; font-weight: bold;"
                                       onmouseover="this.style.backgroundColor='#1d4ed8'"
                                       onmouseout="this.style.backgroundColor='#3b82f6'">
                                        View Profile
                                    </a>
                                </div>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        <div class="mt-6">
                            {{ $players->appends(request()->query())->links() }}
                        </div>
                    @else
                        <div class="text-center py-12">
                            <p class="text-gray-500 mb-4">No players found matching your criteria.</p>
                            <a href="{{ route('coach.players') }}" 
                               class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                View All Players
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
