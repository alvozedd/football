<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $profile ? 'Edit Profile' : 'Create Profile' }}
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

                    <form method="POST" action="{{ $profile ? route('player.profile.update') : route('player.profile.store') }}">
                        @csrf
                        @if($profile)
                            @method('PUT')
                        @endif

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Full Name -->
                            <div>
                                <label for="full_name" class="block text-sm font-medium text-gray-700">Full Name</label>
                                <input type="text" name="full_name" id="full_name" 
                                       value="{{ old('full_name', $profile->full_name ?? '') }}"
                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" 
                                       required>
                                @error('full_name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Position -->
                            <div>
                                <label for="position" class="block text-sm font-medium text-gray-700">Position</label>
                                <select name="position" id="position" 
                                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" 
                                        required>
                                    <option value="">Select Position</option>
                                    <option value="Goalkeeper" {{ old('position', $profile->position ?? '') == 'Goalkeeper' ? 'selected' : '' }}>Goalkeeper</option>
                                    <option value="Defender" {{ old('position', $profile->position ?? '') == 'Defender' ? 'selected' : '' }}>Defender</option>
                                    <option value="Midfielder" {{ old('position', $profile->position ?? '') == 'Midfielder' ? 'selected' : '' }}>Midfielder</option>
                                    <option value="Forward" {{ old('position', $profile->position ?? '') == 'Forward' ? 'selected' : '' }}>Forward</option>
                                </select>
                                @error('position')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Location -->
                            <div>
                                <label for="location" class="block text-sm font-medium text-gray-700">Location</label>
                                <input type="text" name="location" id="location" 
                                       value="{{ old('location', $profile->location ?? '') }}"
                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" 
                                       placeholder="e.g., London, UK"
                                       required>
                                @error('location')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Bio -->
                        <div class="mt-6">
                            <label for="bio" class="block text-sm font-medium text-gray-700">Bio</label>
                            <textarea name="bio" id="bio" rows="4" 
                                      class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                      placeholder="Tell coaches about yourself, your experience, and your goals...">{{ old('bio', $profile->bio ?? '') }}</textarea>
                            @error('bio')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mt-6 flex items-center justify-between">
                            <a href="{{ route('player.dashboard') }}"
                               style="background-color: #6b7280; color: white; padding: 8px 16px; border-radius: 6px; text-decoration: none; font-weight: bold;"
                               onmouseover="this.style.backgroundColor='#374151'"
                               onmouseout="this.style.backgroundColor='#6b7280'">
                                Cancel
                            </a>
                            <button type="submit"
                                    style="background-color: #3b82f6; color: white; padding: 8px 16px; border-radius: 6px; border: none; font-weight: bold; cursor: pointer;"
                                    onmouseover="this.style.backgroundColor='#1d4ed8'"
                                    onmouseout="this.style.backgroundColor='#3b82f6'">
                                {{ $profile ? 'Update Profile' : 'Create Profile' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
