@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <!-- Header -->
                <div class="p-6 border-b">
                    <div class="flex justify-between items-start">
                        <div>
                            <h1 class="text-2xl font-bold mb-2">{{ $internship->title }}</h1>
                            <div class="flex flex-wrap items-center text-gray-600 mb-4">
                                <div class="flex items-center mr-4 mb-2">
                                    <i class="fas fa-building mr-2"></i>
                                    <span>{{ $internship->company->name }}</span>
                                </div>
                                <div class="flex items-center mr-4 mb-2">
                                    <i class="fas fa-map-marker-alt mr-2"></i>
                                    <span>{{ $internship->location }}</span>
                                </div>
                                @if ($internship->is_remote)
                                    <div class="flex items-center mr-4 mb-2">
                                        <i class="fas fa-home mr-2"></i>
                                        <span>Remote</span>
                                    </div>
                                @endif
                                @if ($internship->duration)
                                    <div class="flex items-center mr-4 mb-2">
                                        <i class="far fa-clock mr-2"></i>
                                        <span>{{ $internship->duration }} months</span>
                                    </div>
                                @endif
                                <div class="flex items-center mb-2">
                                    <i class="far fa-calendar-alt mr-2"></i>
                                    <span>Apply by {{ $internship->application_deadline->format('M d, Y') }}</span>
                                </div>
                            </div>
                            <div>
                                @if ($internship->is_active)
                                    <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">Active</span>
                                @else
                                    <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-800">Inactive</span>
                                @endif
                            </div>
                        </div>
                        <div class="ml-4">
                            <a href="{{ route('company.dashboard') }}"
                                class="inline-block bg-gray-200 hover:bg-gray-300 text-gray-800 py-2 px-4 rounded-md mb-2">
                                <i class="fas fa-arrow-left mr-2"></i> Back to Dashboard
                            </a>
                            @if (Auth::user()->company && Auth::user()->company->id === $internship->company_id)
                                <div class="flex mt-2">
                                    <a href="{{ route('internships.edit', $internship) }}"
                                        class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-md mr-2">
                                        <i class="fas fa-edit mr-1"></i> Edit
                                    </a>
                                    <form action="{{ route('internships.destroy', $internship) }}" method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this internship listing?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded-md">
                                            <i class="fas fa-trash-alt mr-1"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Content -->
                <div class="p-6">
                    <!-- Description -->
                    <div class="mb-8">
                        <h2 class="text-xl font-semibold mb-4">Description</h2>
                        <div class="prose max-w-none">
                            {!! nl2br(e($internship->description)) !!}
                        </div>
                    </div>

                    <!-- Requirements -->
                    @if ($internship->requirements)
                        <div class="mb-8">
                            <h2 class="text-xl font-semibold mb-4">Requirements</h2>
                            <div class="prose max-w-none">
                                {!! nl2br(e($internship->requirements)) !!}
                            </div>
                        </div>
                    @endif

                    <!-- Skills -->
                    @if ($internship->skills_required && count($internship->skills_required) > 0)
                        <div class="mb-8">
                            <h2 class="text-xl font-semibold mb-4">Skills Required</h2>
                            <div class="flex flex-wrap gap-2">
                                @foreach ($internship->skills_required as $skill)
                                    <span
                                        class="bg-gray-100 text-gray-800 py-1 px-3 rounded-full text-sm">{{ $skill }}</span>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Company Info -->
                    <div class="mb-8">
                        <h2 class="text-xl font-semibold mb-4">About the Company</h2>
                        <div class="flex items-start">
                            <div
                                class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mr-4 overflow-hidden">
                                @if ($internship->company->logo_path)
                                    <img src="{{ Storage::url($internship->company->logo_path) }}"
                                        alt="{{ $internship->company->name }} logo" class="w-full h-full object-cover">
                                @else
                                    <i class="fas fa-building text-gray-400 text-2xl"></i>
                                @endif
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold">{{ $internship->company->name }}</h3>
                                <p class="text-gray-600 mb-2">
                                    {{ $internship->company->industry ?? 'Industry not specified' }}</p>
                                <p class="text-gray-600 mb-4">
                                    {{ $internship->company->location ?? 'Location not specified' }}</p>
                                @if ($internship->company->website)
                                    <a href="{{ $internship->company->website }}" target="_blank"
                                        class="text-blue-600 hover:text-blue-800">
                                        <i class="fas fa-external-link-alt mr-1"></i> Visit website
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Application Section -->
                    <div class="mt-8 pt-6 border-t">
                        <h2 class="text-xl font-semibold mb-4">Apply for this Internship</h2>

                        @auth
                            @if (Auth::user()->company)
                                <div class="bg-blue-50 text-blue-700 p-4 rounded-md">
                                    <p>You are logged in as a company. Only students can apply for internships.</p>
                                </div>
                            @else
                                @php
                                    $hasApplied = Auth::user()->applications->contains('listing_id', $internship->id);
                                @endphp

                                @if ($hasApplied)
                                    <div class="bg-green-50 text-green-700 p-4 rounded-md">
                                        <p>You have already applied for this internship.</p>
                                    </div>
                                @else
                                    @if ($internship->is_active && $internship->application_deadline->isFuture())
                                        <div class="bg-green-50 text-green-700 p-4 rounded-md mb-4">
                                            <p><i class="fas fa-info-circle mr-2"></i> This internship is accepting applications
                                                until {{ $internship->application_deadline->format('M d, Y') }}.</p>
                                        </div>
                                        <button type="button"
                                            class="inline-block bg-blue-600 hover:bg-blue-700 text-white py-3 px-6 rounded-md font-medium"
                                            data-bs-toggle="modal" data-bs-target="#applyModal">
                                            Apply Now
                                        </button>

                                        <!-- Apply Modal -->
                                        <div class="modal fade" id="applyModal" tabindex="-1" aria-labelledby="applyModalLabel"
                                            aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="applyModalLabel">Confirm Application</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Are you sure you want to apply for the internship:
                                                            <strong>{{ $internship->title }}</strong> at
                                                            <strong>{{ $internship->company->name }}</strong>?</p>
                                                        <p class="text-muted">You will be able to upload your resume and add a
                                                            cover letter in the next step.</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Cancel</button>
                                                        <a href="{{ route('applications.create', $internship) }}"
                                                            class="btn btn-primary">Confirm Application</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="bg-red-50 text-red-700 p-4 rounded-md">
                                            <p><i class="fas fa-exclamation-circle mr-2"></i> This internship is no longer
                                                accepting applications.</p>
                                        </div>
                                    @endif
                                @endif
                            @endif
                        @else
                            <div class="bg-gray-50 p-4 rounded-md">
                                <p class="mb-3">You need to be logged in to apply for this internship.</p>
                                <a href="{{ route('login') }}"
                                    class="inline-block bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-md mr-2">
                                    Sign In
                                </a>
                                <a href="{{ route('register') }}"
                                    class="inline-block bg-gray-600 hover:bg-gray-700 text-white py-2 px-4 rounded-md">
                                    Sign Up
                                </a>
                            </div>
                        @endauth
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
