@extends('layouts.company')

@section('title', 'Edit Internship')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="mb-4 d-flex justify-content-between align-items-center">
                    <h1 class="h3 mb-0">Edit Internship</h1>
                    <a href="{{ route('company.dashboard') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left me-1"></i> Back to Dashboard
                    </a>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger mb-4">
                        <strong>Error!</strong> Please check the form for errors.
                        <ul class="mb-0 mt-2">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <form action="{{ route('internships.update', $internship) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <!-- Basic Information -->
                                <div class="col-12 mb-4">
                                    <h5 class="border-bottom pb-2">Basic Information</h5>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="title" class="form-label">Internship Title <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                                        id="title" name="title" value="{{ old('title', $internship->title) }}"
                                        required>
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="location" class="form-label">Location <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('location') is-invalid @enderror"
                                        id="location" name="location" value="{{ old('location', $internship->location) }}"
                                        required>
                                    @error('location')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="internship_type" class="form-label">Internship Type <span
                                            class="text-danger">*</span></label>
                                    <select class="form-select @error('internship_type') is-invalid @enderror"
                                        id="internship_type" name="internship_type" required>
                                        <option value="full-time"
                                            {{ old('internship_type', $internship->internship_type) == 'full-time' ? 'selected' : '' }}>
                                            Full-time</option>
                                        <option value="part-time"
                                            {{ old('internship_type', $internship->internship_type) == 'part-time' ? 'selected' : '' }}>
                                            Part-time</option>
                                        <option value="contract"
                                            {{ old('internship_type', $internship->internship_type) == 'contract' ? 'selected' : '' }}>
                                            Contract</option>
                                    </select>
                                    @error('internship_type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="duration" class="form-label">Duration (months) <span
                                            class="text-danger">*</span></label>
                                    <input type="number" class="form-control @error('duration') is-invalid @enderror"
                                        id="duration" name="duration" value="{{ old('duration', $internship->duration) }}"
                                        min="1" max="24" required>
                                    @error('duration')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="application_deadline" class="form-label">Application Deadline <span
                                            class="text-danger">*</span></label>
                                    <input type="date"
                                        class="form-control @error('application_deadline') is-invalid @enderror"
                                        id="application_deadline" name="application_deadline"
                                        value="{{ old('application_deadline', $internship->application_deadline ? $internship->application_deadline->format('Y-m-d') : '') }}"
                                        required>
                                    @error('application_deadline')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label d-block">Options</label>
                                    <div class="form-check form-check-inline">
                                        <input type="checkbox" class="form-check-input" id="is_remote" name="is_remote"
                                            value="1" {{ old('is_remote', $internship->is_remote) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_remote">Remote Available</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="checkbox" class="form-check-input" id="is_paid" name="is_paid"
                                            value="1"
                                            {{ old('is_paid', $internship->is_paid ?? false) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_paid">Paid Internship</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="checkbox" class="form-check-input" id="is_active" name="is_active"
                                            value="1" {{ old('is_active', $internship->is_active) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_active">Active Listing</label>
                                    </div>
                                </div>

                                <!-- Description Section -->
                                <div class="col-12 mt-3 mb-3">
                                    <h5 class="border-bottom pb-2">Description</h5>
                                </div>

                                <div class="col-12 mb-3">
                                    <label for="description" class="form-label">Full Description <span
                                            class="text-danger">*</span></label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                                        rows="5" required>{{ old('description', $internship->description) }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Requirements Section -->
                                <div class="col-12 mt-3 mb-3">
                                    <h5 class="border-bottom pb-2">Requirements</h5>
                                </div>

                                <div class="col-12 mb-3">
                                    <label for="requirements" class="form-label">Requirements & Qualifications <span
                                            class="text-danger">*</span></label>
                                    <textarea class="form-control @error('requirements') is-invalid @enderror" id="requirements" name="requirements"
                                        rows="4" required>{{ old('requirements', $internship->requirements) }}</textarea>
                                    @error('requirements')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12 mb-3">
                                    <label for="responsibilities" class="form-label">Responsibilities</label>
                                    <textarea class="form-control @error('responsibilities') is-invalid @enderror" id="responsibilities"
                                        name="responsibilities" rows="4">{{ old('responsibilities', $internship->responsibilities ?? '') }}</textarea>
                                    @error('responsibilities')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Additional Details -->
                                <div class="col-12 mt-3 mb-3">
                                    <h5 class="border-bottom pb-2">Additional Details</h5>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="salary_range" class="form-label">Salary Range (optional)</label>
                                    <input type="text" class="form-control @error('salary_range') is-invalid @enderror"
                                        id="salary_range" name="salary_range"
                                        value="{{ old('salary_range', $internship->salary_range ?? '') }}"
                                        placeholder="e.g. $500-$1000 per month">
                                    @error('salary_range')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="skills_required" class="form-label">Required Skills (comma
                                        separated)</label>
                                    <input type="text"
                                        class="form-control @error('skills_required') is-invalid @enderror"
                                        id="skills_required" name="skills_required"
                                        value="{{ old('skills_required', is_array($internship->skills_required) ? implode(', ', $internship->skills_required) : '') }}"
                                        placeholder="e.g. JavaScript, React, UI/UX">
                                    @error('skills_required')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12 mt-4">
                                    <div class="d-flex justify-content-end">
                                        <a href="{{ route('company.dashboard') }}"
                                            class="btn btn-secondary me-2">Cancel</a>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="bi bi-save me-1"></i> Update Internship
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Simple character counter for the textarea
        document.addEventListener('DOMContentLoaded', function() {
            const textareas = document.querySelectorAll('textarea');
            textareas.forEach(textarea => {
                textarea.addEventListener('input', function() {
                    if (this.value.length > 5000) {
                        this.value = this.value.substring(0, 5000);
                    }
                });
            });
        });
    </script>
@endpush
