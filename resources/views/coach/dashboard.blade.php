<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Coach Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-6">Welcome, Coach {{ auth()->user()->name }}!</h3>

                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div class="bg-blue-100 p-4 rounded text-center">
                            <h4 class="text-sm font-semibold text-blue-800">Total Players</h4>
                            <p class="text-2xl font-bold text-blue-600">{{ $totalPlayers }}</p>
                        </div>
                        <div class="bg-green-100 p-4 rounded text-center">
                            <h4 class="text-sm font-semibold text-green-800">Your Feedback</h4>
                            <p class="text-2xl font-bold text-green-600">{{ $totalFeedback }}</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <div>
                            <h4 class="text-lg font-semibold mb-4">Quick Actions</h4>
                            <div class="space-y-3">
                                <a href="{{ route('coach.players') }}"
                                   style="background-color: #3b82f6; color: white; padding: 12px 16px; border-radius: 6px; text-decoration: none; display: block; text-align: center; font-weight: bold;"
                                   onmouseover="this.style.backgroundColor='#1d4ed8'"
                                   onmouseout="this.style.backgroundColor='#3b82f6'">
                                    Browse All Players
                                </a>
                                <a href="{{ route('coach.players', ['position' => 'Forward']) }}"
                                   style="background-color: #10b981; color: white; padding: 12px 16px; border-radius: 6px; text-decoration: none; display: block; text-align: center; font-weight: bold;"
                                   onmouseover="this.style.backgroundColor='#047857'"
                                   onmouseout="this.style.backgroundColor='#10b981'">
                                    View Forwards
                                </a>
                                <a href="{{ route('coach.players', ['position' => 'Midfielder']) }}"
                                   style="background-color: #8b5cf6; color: white; padding: 12px 16px; border-radius: 6px; text-decoration: none; display: block; text-align: center; font-weight: bold;"
                                   onmouseover="this.style.backgroundColor='#6d28d9'"
                                   onmouseout="this.style.backgroundColor='#8b5cf6'">
                                    View Midfielders
                                </a>
                                <a href="{{ route('coach.players', ['position' => 'Defender']) }}"
                                   style="background-color: #f59e0b; color: white; padding: 12px 16px; border-radius: 6px; text-decoration: none; display: block; text-align: center; font-weight: bold;"
                                   onmouseover="this.style.backgroundColor='#d97706'"
                                   onmouseout="this.style.backgroundColor='#f59e0b'">
                                    View Defenders
                                </a>
                                <a href="{{ route('coach.players', ['position' => 'Goalkeeper']) }}"
                                   style="background-color: #ef4444; color: white; padding: 12px 16px; border-radius: 6px; text-decoration: none; display: block; text-align: center; font-weight: bold;"
                                   onmouseover="this.style.backgroundColor='#dc2626'"
                                   onmouseout="this.style.backgroundColor='#ef4444'">
                                    View Goalkeepers
                                </a>
                            </div>
                        </div>

                        <div>
                            <h4 class="text-lg font-semibold mb-4">Scouting Tips</h4>
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <ul class="space-y-2 text-sm text-gray-700">
                                    <li>• Look for players with complete profiles and multiple videos</li>
                                    <li>• Pay attention to technical skills and game understanding</li>
                                    <li>• Consider the player's position and how they fit your system</li>
                                    <li>• Leave constructive feedback to help players improve</li>
                                    <li>• Use the search and filter options to find specific player types</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    @if($totalPlayers == 0)
                        <div class="mt-8 bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded">
                            <strong>No players yet!</strong> There are currently no player profiles in the system. Check back later as players create their profiles.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
