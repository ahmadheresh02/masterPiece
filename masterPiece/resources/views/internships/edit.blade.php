@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-3xl mx-auto bg-white rounded-lg shadow p-6">
            <h1 class="text-2xl font-bold mb-6">Edit Internship</h1>

            <form action="{{ route('internships.update', $internship) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="title" class="block text-gray-700 font-medium mb-2">Internship Title</label>
                    <input type="text" name="title" id="title"
                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required value="{{ old('title', $internship->title) }}">
                    @error('title')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="description" class="block text-gray-700 font-medium mb-2">Description</label>
                    <textarea name="description" id="description" rows="6"
                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required>{{ old('description', $internship->description) }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="location" class="block text-gray-700 font-medium mb-2">Location</label>
                        <input type="text" name="location" id="location"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required value="{{ old('location', $internship->location) }}">
                        @error('location')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="duration" class="block text-gray-700 font-medium mb-2">Duration (months)</label>
                        <input type="number" name="duration" id="duration" min="1" max="24"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            value="{{ old('duration', $internship->duration) }}">
                        @error('duration')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mb-4">
                    <label for="requirements" class="block text-gray-700 font-medium mb-2">Requirements</label>
                    <textarea name="requirements" id="requirements" rows="4"
                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('requirements', $internship->requirements) }}</textarea>
                    @error('requirements')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="application_deadline" class="block text-gray-700 font-medium mb-2">Application
                        Deadline</label>
                    <input type="date" name="application_deadline" id="application_deadline"
                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required
                        value="{{ old('application_deadline', $internship->application_deadline ? $internship->application_deadline->format('Y-m-d') : '') }}">
                    @error('application_deadline')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="skills_required" class="block text-gray-700 font-medium mb-2">Skills Required (comma
                        separated)</label>
                    <input type="text" name="skills_required" id="skills_required"
                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        value="{{ old('skills_required', is_array($internship->skills_required) ? implode(', ', $internship->skills_required) : $internship->skills_required) }}">
                    <p class="text-gray-500 text-sm mt-1">Enter skills separated by commas (e.g. JavaScript, Python,
                        Communication)</p>
                    @error('skills_required')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <div class="flex items-center">
                        <input type="checkbox" name="is_remote" id="is_remote" class="mr-2" value="1"
                            {{ old('is_remote', $internship->is_remote) ? 'checked' : '' }}>
                        <label for="is_remote" class="text-gray-700">Remote position</label>
                    </div>
                    @error('is_remote')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                    <div class="flex items-center mt-3">
                        <input type="checkbox" name="is_active" id="is_active" class="mr-2" value="1"
                            {{ old('is_active', $internship->is_active) ? 'checked' : '' }}>
                        <label for="is_active" class="text-gray-700">Published and visible to students</label>
                    </div>
                    @error('is_active')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end">
                    <a href="{{ route('company.dashboard') }}"
                        class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-medium py-2 px-4 rounded-md mr-2">
                        Cancel
                    </a>
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md">
                        Update Internship
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
