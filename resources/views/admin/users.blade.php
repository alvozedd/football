<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Management') }}
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
                        <h3 class="text-lg font-semibold">All Users ({{ $users->total() }})</h3>
                        <a href="{{ route('admin.dashboard') }}"
                           style="background-color: #6b7280; color: white; padding: 8px 16px; border-radius: 6px; text-decoration: none; font-weight: bold;"
                           onmouseover="this.style.backgroundColor='#374151'"
                           onmouseout="this.style.backgroundColor='#6b7280'">
                            Back to Dashboard
                        </a>
                    </div>

                    @if($users->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full table-auto">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Profile Status</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Joined</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($users as $user)
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div>
                                                    <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                                                    <div class="text-sm text-gray-500">{{ $user->email }}</div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                                    @if($user->role == 'admin') bg-red-100 text-red-800
                                                    @elseif($user->role == 'coach') bg-blue-100 text-blue-800
                                                    @else bg-green-100 text-green-800 @endif">
                                                    {{ ucfirst($user->role) }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                @if($user->role == 'player')
                                                    @if($user->playerProfile)
                                                        <span class="text-green-600">✓ Complete</span>
                                                        <div class="text-xs text-gray-400">
                                                            {{ $user->playerProfile->videos->count() }} videos
                                                        </div>
                                                    @else
                                                        <span class="text-yellow-600">⚠ Incomplete</span>
                                                    @endif
                                                @else
                                                    <span class="text-gray-400">N/A</span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $user->created_at->format('M j, Y') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <div class="flex space-x-2">
                                                    @if($user->role == 'player' && $user->playerProfile)
                                                        <a href="{{ route('coach.players.show', $user->playerProfile) }}" 
                                                           class="text-blue-600 hover:text-blue-900">View Profile</a>
                                                    @endif
                                                    
                                                    @if($user->id !== auth()->id())
                                                        <form method="POST" action="{{ route('admin.users.delete', $user) }}" 
                                                              onsubmit="return confirm('Are you sure you want to delete this user? This action cannot be undone.')"
                                                              class="inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" 
                                                                    class="text-red-600 hover:text-red-900">Delete</button>
                                                        </form>
                                                    @else
                                                        <span class="text-gray-400">Current User</span>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="mt-6">
                            {{ $users->links() }}
                        </div>
                    @else
                        <div class="text-center py-12">
                            <p class="text-gray-500 mb-4">No users found.</p>
                        </div>
                    @endif

                    <!-- Summary Stats -->
                    <div class="mt-6 grid grid-cols-3 gap-3">
                        <div class="bg-blue-50 p-3 rounded text-center">
                            <h4 class="text-sm font-semibold text-blue-800">Players</h4>
                            <p class="text-xl font-bold text-blue-600">{{ $users->where('role', 'player')->count() }}</p>
                        </div>
                        <div class="bg-green-50 p-3 rounded text-center">
                            <h4 class="text-sm font-semibold text-green-800">Coaches</h4>
                            <p class="text-xl font-bold text-green-600">{{ $users->where('role', 'coach')->count() }}</p>
                        </div>
                        <div class="bg-red-50 p-3 rounded text-center">
                            <h4 class="text-sm font-semibold text-red-800">Admins</h4>
                            <p class="text-xl font-bold text-red-600">{{ $users->where('role', 'admin')->count() }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
