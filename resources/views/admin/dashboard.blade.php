<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
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

                    <h3 class="text-lg font-semibold mb-6">System Overview</h3>

                    <!-- Statistics Cards -->
                    <div class="grid grid-cols-5 gap-3 mb-6">
                        <div class="bg-blue-100 p-3 rounded text-center">
                            <h4 class="text-sm font-semibold text-blue-800">Users</h4>
                            <p class="text-xl font-bold text-blue-600">{{ $stats['total_users'] }}</p>
                        </div>
                        <div class="bg-green-100 p-3 rounded text-center">
                            <h4 class="text-sm font-semibold text-green-800">Players</h4>
                            <p class="text-xl font-bold text-green-600">{{ $stats['total_players'] }}</p>
                        </div>
                        <div class="bg-purple-100 p-3 rounded text-center">
                            <h4 class="text-sm font-semibold text-purple-800">Coaches</h4>
                            <p class="text-xl font-bold text-purple-600">{{ $stats['total_coaches'] }}</p>
                        </div>
                        <div class="bg-orange-100 p-3 rounded text-center">
                            <h4 class="text-sm font-semibold text-orange-800">Videos</h4>
                            <p class="text-xl font-bold text-orange-600">{{ $stats['total_videos'] }}</p>
                        </div>
                        <div class="bg-red-100 p-3 rounded text-center">
                            <h4 class="text-sm font-semibold text-red-800">Feedback</h4>
                            <p class="text-xl font-bold text-red-600">{{ $stats['total_feedback'] }}</p>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <div>
                            <h4 class="text-lg font-semibold mb-4">Management</h4>
                            <div class="space-y-3">
                                <a href="{{ route('admin.users') }}"
                                   style="background-color: #3b82f6; color: white; padding: 12px 16px; border-radius: 6px; text-decoration: none; display: block; text-align: center; font-weight: bold;"
                                   onmouseover="this.style.backgroundColor='#1d4ed8'"
                                   onmouseout="this.style.backgroundColor='#3b82f6'">
                                    Manage Users
                                </a>
                                <a href="{{ route('coach.players') }}"
                                   style="background-color: #10b981; color: white; padding: 12px 16px; border-radius: 6px; text-decoration: none; display: block; text-align: center; font-weight: bold;"
                                   onmouseover="this.style.backgroundColor='#047857'"
                                   onmouseout="this.style.backgroundColor='#10b981'">
                                    View All Players
                                </a>
                            </div>
                        </div>

                        <div>
                            <h4 class="text-lg font-semibold mb-4">System Information</h4>
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <ul class="space-y-2 text-sm text-gray-700">
                                    <li><strong>Application:</strong> Football Scout Report</li>
                                    <li><strong>Environment:</strong> {{ app()->environment() }}</li>
                                    <li><strong>Laravel Version:</strong> {{ app()->version() }}</li>
                                    <li><strong>PHP Version:</strong> {{ phpversion() }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Activity Summary -->
                    <div class="mt-8">
                        <h4 class="text-lg font-semibold mb-4">Platform Status</h4>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            @if($stats['total_users'] == 0)
                                <p class="text-yellow-600">⚠️ No users registered yet</p>
                            @elseif($stats['total_players'] == 0)
                                <p class="text-yellow-600">⚠️ No player profiles created yet</p>
                            @elseif($stats['total_videos'] == 0)
                                <p class="text-yellow-600">⚠️ No videos uploaded yet</p>
                            @else
                                <p class="text-green-600">✅ Platform is active with users, players, and content</p>
                            @endif
                        </div>
                    </div>

                    <!-- Admin Notes -->
                    <div class="mt-8 bg-blue-50 border border-blue-200 rounded-lg p-4">
                        <h4 class="font-semibold text-blue-800 mb-2">Admin Guidelines</h4>
                        <ul class="text-sm text-blue-700 space-y-1">
                            <li>• Monitor user activity and content quality</li>
                            <li>• Remove inappropriate content or spam</li>
                            <li>• Help resolve user issues and disputes</li>
                            <li>• Ensure the platform maintains a professional environment</li>
                            <li>• Be careful when deleting users - this action cannot be undone</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
