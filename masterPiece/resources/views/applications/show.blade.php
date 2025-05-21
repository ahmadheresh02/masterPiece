@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="p-6 border-b">
                <div class="flex justify-between items-center">
                    <div>
                        <h1 class="text-2xl font-bold">Application Details</h1>
                        <p class="text-gray-600">{{ $application->internshipListing->title }}</p>
                    </div>
                    <div>
                        <a href="{{ route('internships.applications.index', $application->listing_id) }}"
                            class="bg-gray-200 hover:bg-gray-300 text-gray-800 py-2 px-4 rounded-md">
                            <i class="fas fa-arrow-left mr-2"></i> Back to Applications
                        </a>
                    </div>
                </div>
            </div>

            @if (session('success'))
                <div class="bg-green-100 border border-green-200 text-green-700 px-4 py-3 mb-4 mx-6 mt-6 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="p-6 grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Left Column - Applicant Info -->
                <div class="md:col-span-1">
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h2 class="text-xl font-semibold mb-4">Applicant Information</h2>

                        <div class="flex flex-col items-center mb-4">
                            <div class="w-24 h-24 rounded-full overflow-hidden bg-gray-200 mb-3">
                                <div
                                    class="w-full h-full flex items-center justify-center bg-indigo-100 text-indigo-800 text-3xl font-semibold">
                                    {{ substr($application->user->name ?? 'U', 0, 1) }}
                                </div>
                            </div>
                            <h3 class="text-lg font-semibold">{{ $application->user->name }}</h3>
                            <p class="text-gray-600">{{ $application->user->email }}</p>
                        </div>

                        <div class="border-t border-gray-200 pt-4">
                            <div class="mb-3">
                                <p class="text-gray-500 text-sm">Applied on:</p>
                                <p>{{ $application->created_at->format('F j, Y') }}</p>
                            </div>

                            <div class="mb-3">
                                <p class="text-gray-500 text-sm">Status:</p>
                                <div class="mt-1">
                                    @if ($application->status == 'under_review')
                                        <span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800">Under
                                            Review</span>
                                    @elseif($application->status == 'shortlisted')
                                        <span
                                            class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">Shortlisted</span>
                                    @elseif($application->status == 'rejected')
                                        <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-800">Rejected</span>
                                    @elseif($application->status == 'pending')
                                        <span
                                            class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                                    @else
                                        <span
                                            class="px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-800">{{ ucfirst($application->status) }}</span>
                                    @endif
                                </div>
                            </div>

                            <div>
                                <p class="text-gray-500 text-sm">Contact:</p>
                                <p>{{ $application->user->phone ?? 'No phone number' }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Status Update Form -->
                    <div class="bg-gray-50 p-4 rounded-lg mt-4">
                        <h3 class="font-semibold mb-3">Update Application Status</h3>
                        <form action="{{ route('applications.updateStatus', $application->id) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="status" class="block text-gray-700 text-sm font-medium mb-1">Status</label>
                                <select name="status" id="status"
                                    class="w-full border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                                    <option value="pending" {{ $application->status == 'pending' ? 'selected' : '' }}>
                                        Pending</option>
                                    <option value="under_review"
                                        {{ $application->status == 'under_review' ? 'selected' : '' }}>Under Review
                                    </option>
                                    <option value="shortlisted"
                                        {{ $application->status == 'shortlisted' ? 'selected' : '' }}>Shortlisted</option>
                                    <option value="rejected" {{ $application->status == 'rejected' ? 'selected' : '' }}>
                                        Rejected</option>
                                    <option value="accepted" {{ $application->status == 'accepted' ? 'selected' : '' }}>
                                        Accepted</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="feedback" class="block text-gray-700 text-sm font-medium mb-1">Feedback
                                    (optional)</label>
                                <textarea name="feedback" id="feedback" rows="3"
                                    class="w-full border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">{{ $application->feedback }}</textarea>
                            </div>

                            <button type="submit"
                                class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-md">
                                Update Status
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Right Column - Application Content -->
                <div class="md:col-span-2">
                    <!-- Cover Letter -->
                    <div class="bg-white border border-gray-200 rounded-lg p-4 mb-4">
                        <h2 class="text-xl font-semibold mb-3">Cover Letter</h2>
                        <div class="prose max-w-none">
                            {!! nl2br(e($application->cover_letter)) !!}
                        </div>
                    </div>

                    <!-- Resume -->
                    @if ($application->resume_path)
                        <div class="bg-white border border-gray-200 rounded-lg p-4 mb-4">
                            <h2 class="text-xl font-semibold mb-3">Resume</h2>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <i class="fas fa-file-pdf text-red-500 text-2xl mr-3"></i>
                                    <div>
                                        <p class="font-medium">Resume</p>
                                        <p class="text-gray-500 text-sm">PDF Document</p>
                                    </div>
                                </div>
                                <a href="{{ Storage::url($application->resume_path) }}"
                                    class="bg-gray-100 hover:bg-gray-200 text-gray-800 py-1 px-3 rounded" target="_blank">
                                    <i class="fas fa-download mr-1"></i> Download
                                </a>
                            </div>
                        </div>
                    @endif

                    <!-- Internship Information -->
                    <div class="bg-white border border-gray-200 rounded-lg p-4">
                        <h2 class="text-xl font-semibold mb-3">Internship Information</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-gray-500 text-sm">Position:</p>
                                <p class="font-medium">{{ $application->internshipListing->title }}</p>
                            </div>
                            <div>
                                <p class="text-gray-500 text-sm">Company:</p>
                                <p class="font-medium">{{ $application->internshipListing->company->name }}</p>
                            </div>
                            <div>
                                <p class="text-gray-500 text-sm">Location:</p>
                                <p>{{ $application->internshipListing->location }}</p>
                            </div>
                            <div>
                                <p class="text-gray-500 text-sm">Type:</p>
                                <p>{{ $application->internshipListing->is_remote ? 'Remote' : 'On-site' }}</p>
                            </div>
                            <div>
                                <p class="text-gray-500 text-sm">Duration:</p>
                                <p>{{ $application->internshipListing->duration ?? 'Not specified' }} months</p>
                            </div>
                            <div>
                                <p class="text-gray-500 text-sm">Deadline:</p>
                                <p>{{ $application->internshipListing->application_deadline->format('M d, Y') }}</p>
                            </div>
                        </div>

                        <div class="mt-3">
                            <a href="{{ route('internships.show', $application->listing_id) }}"
                                class="text-blue-600 hover:text-blue-800 text-sm">
                                <i class="fas fa-external-link-alt mr-1"></i> View full internship details
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endpush
