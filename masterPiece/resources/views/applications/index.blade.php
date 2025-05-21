@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h1 class="text-2xl font-bold">Applications for "{{ $internship->title }}"</h1>
                    <p class="text-gray-600">Manage applications for this internship listing</p>
                </div>
                <div>
                    <a href="{{ route('company.dashboard') }}"
                        class="bg-gray-200 hover:bg-gray-300 text-gray-800 py-2 px-4 rounded-md">
                        <i class="fas fa-arrow-left mr-2"></i> Back to Dashboard
                    </a>
                </div>
            </div>

            @if (session('success'))
                <div class="bg-green-100 border border-green-200 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="overflow-x-auto">
                <table class="min-w-full bg-white">
                    <thead class="bg-gray-50 text-gray-700">
                        <tr>
                            <th class="py-3 px-4 text-left">Applicant</th>
                            <th class="py-3 px-4 text-left">Applied</th>
                            <th class="py-3 px-4 text-left">Status</th>
                            <th class="py-3 px-4 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($applications as $application)
                            <tr>
                                <td class="py-3 px-4">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 rounded-full overflow-hidden bg-gray-200 mr-3">
                                            <div
                                                class="w-full h-full flex items-center justify-center bg-indigo-100 text-indigo-800 font-semibold">
                                                {{ substr($application->user->name ?? 'U', 0, 1) }}
                                            </div>
                                        </div>
                                        <div>
                                            <p class="font-medium">{{ $application->user->name ?? 'Unknown User' }}</p>
                                            <p class="text-sm text-gray-500">{{ $application->user->email ?? 'No email' }}
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-3 px-4">{{ $application->created_at->format('M d, Y') }}</td>
                                <td class="py-3 px-4">
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
                                </td>
                                <td class="py-3 px-4">
                                    <div class="flex gap-2">
                                        <a href="{{ route('applications.show', $application->id) }}"
                                            class="text-blue-600 hover:text-blue-800">
                                            <i class="far fa-eye"></i>
                                        </a>
                                        <div class="relative" x-data="{ open: false }">
                                            <button @click="open = !open" class="text-gray-500 hover:text-gray-700">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <div x-show="open" @click.away="open = false"
                                                class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-10">
                                                <form action="{{ route('applications.updateStatus', $application->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    <input type="hidden" name="status" value="pending">
                                                    <button type="submit"
                                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 w-full text-left">
                                                        Mark as Pending
                                                    </button>
                                                </form>
                                                <form action="{{ route('applications.updateStatus', $application->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    <input type="hidden" name="status" value="under_review">
                                                    <button type="submit"
                                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 w-full text-left">
                                                        Mark as Under Review
                                                    </button>
                                                </form>
                                                <form action="{{ route('applications.updateStatus', $application->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    <input type="hidden" name="status" value="shortlisted">
                                                    <button type="submit"
                                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 w-full text-left">
                                                        Mark as Shortlisted
                                                    </button>
                                                </form>
                                                <form action="{{ route('applications.updateStatus', $application->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    <input type="hidden" name="status" value="rejected">
                                                    <button type="submit"
                                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 w-full text-left">
                                                        Mark as Rejected
                                                    </button>
                                                </form>
                                                <div class="border-t border-gray-100 my-1"></div>
                                                <form action="{{ route('applications.destroy', $application->id) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Are you sure you want to delete this application?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="block px-4 py-2 text-sm text-red-600 hover:bg-gray-100 w-full text-left">
                                                        Delete Application
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-6 text-center text-gray-500">No applications found for this
                                    internship</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $applications->links() }}
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Alpine.js -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@endpush
