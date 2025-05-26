@extends('layouts.app')

@section('title', 'Apply for Internship')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="mb-4 d-flex justify-content-between align-items-center">
                    <h1 class="h3 mb-0">Apply for {{ $internship->title }}</h1>
                    <a href="{{ route('internships.show', $internship) }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left me-1"></i> Back to Listing
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

                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <h5 class="card-title mb-4">Internship Details</h5>

                        <div class="row">
                            <div class="col-md-6">
                                <dl>
                                    <dt>Company:</dt>
                                    <dd>{{ $internship->company->name }}</dd>

                                    <dt>Location:</dt>
                                    <dd>{{ $internship->location }} {{ $internship->is_remote ? '(Remote Available)' : '' }}
                                    </dd>

                                    <dt>Duration:</dt>
                                    <dd>{{ $internship->duration }} {{ Str::plural('month', $internship->duration) }}</dd>
                                </dl>
                            </div>
                            <div class="col-md-6">
                                <dl>
                                    <dt>Type:</dt>
                                    <dd>{{ ucfirst($internship->internship_type) }}</dd>

                                    <dt>Deadline:</dt>
                                    <dd>{{ $internship->application_deadline->format('M d, Y') }}</dd>

                                    @if ($internship->salary_range)
                                        <dt>Compensation:</dt>
                                        <dd>{{ $internship->salary_range }}</dd>
                                    @endif
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <h5 class="card-title border-bottom pb-3 mb-4">Application Form</h5>

                        <form action="{{ route('applications.store', $internship) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="mb-4">
                                <label for="resume" class="form-label fw-bold">Resume / CV <span
                                        class="text-danger">*</span></label>
                                <input type="file" class="form-control @error('resume') is-invalid @enderror"
                                    id="resume" name="resume" required>
                                <div class="form-text">Upload your resume (PDF, DOC, DOCX format, max 2MB)</div>
                                @error('resume')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="cover_letter" class="form-label fw-bold">Cover Letter <span
                                        class="text-danger">*</span></label>
                                <textarea class="form-control @error('cover_letter') is-invalid @enderror" id="cover_letter" name="cover_letter"
                                    rows="6" placeholder="Explain why you're a good fit for this position..." required>{{ old('cover_letter') }}</textarea>
                                <div class="form-text">Tell the employer why you're interested in this internship and what
                                    makes you a great candidate.</div>
                                @error('cover_letter')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="text-center">
                                <p class="mb-3 text-muted small">By submitting this application, you confirm that all
                                    information provided is accurate and complete.</p>
                                <button type="submit" class="btn btn-primary px-5">
                                    <i class="bi bi-send me-1"></i> Submit Application
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
