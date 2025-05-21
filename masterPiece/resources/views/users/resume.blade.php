@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Resume Management</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif

                        <div class="mb-4">
                            <h3>Default Resume</h3>
                            <p>Upload a default resume that you can use for all your internship applications.</p>
                        </div>

                        @if ($user->default_resume_path)
                            <div class="alert alert-info">
                                <p><strong>Current Resume:</strong> You have a default resume uploaded.</p>

                                <div class="d-flex mt-2">
                                    <a href="{{ route('resume.download') }}" class="btn btn-primary me-2">
                                        <i class="fas fa-download"></i> Download Resume
                                    </a>

                                    <form action="{{ route('resume.delete') }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Are you sure you want to delete your resume?')">
                                            <i class="fas fa-trash"></i> Delete Resume
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @else
                            <div class="alert alert-warning">
                                <p>You haven't uploaded a default resume yet.</p>
                            </div>
                        @endif

                        <form action="{{ route('resume.upload') }}" method="POST" enctype="multipart/form-data"
                            class="mt-4">
                            @csrf

                            <div class="form-group mb-3">
                                <label
                                    for="resume">{{ $user->default_resume_path ? 'Replace Resume' : 'Upload Resume' }}</label>
                                <input type="file" class="form-control @error('resume') is-invalid @enderror"
                                    id="resume" name="resume" required>
                                <small class="form-text text-muted">Accepted formats: PDF, DOC, DOCX. Maximum size:
                                    2MB.</small>
                                @error('resume')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-upload"></i>
                                {{ $user->default_resume_path ? 'Update Resume' : 'Upload Resume' }}
                            </button>
                        </form>

                        <div class="mt-4">
                            <a href="{{ route('profile.edit') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Back to Profile
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
