@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="mb-5">
                    <!-- Progress Tracker -->
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="d-flex align-items-center">
                            <div class="position-relative">
                                <div class="rounded-circle d-flex align-items-center justify-content-center {{ $step >= 1 ? 'bg-primary' : 'bg-light' }}"
                                    style="width: 48px; height: 48px; {{ $step >= 1 ? 'color: white;' : 'color: #64748B;' }}">
                                    <i class="fas fa-user"></i>
                                </div>
                                <div class="position-absolute" style="bottom: -20px; width: 100%; text-align: center;">
                                    <span class="small fw-medium">Account</span>
                                </div>
                            </div>
                            <div class="progress flex-grow-1 mx-3" style="height: 2px;">
                                <div class="progress-bar {{ $step >= 2 ? 'bg-primary' : 'bg-light' }}" style="width: 100%">
                                </div>
                            </div>
                        </div>

                        <div class="d-flex align-items-center">
                            <div class="position-relative">
                                <div class="rounded-circle d-flex align-items-center justify-content-center {{ $step >= 2 ? 'bg-primary' : 'bg-light' }}"
                                    style="width: 48px; height: 48px; {{ $step >= 2 ? 'color: white;' : 'color: #64748B;' }}">
                                    <i class="fas fa-book-open"></i>
                                </div>
                                <div class="position-absolute" style="bottom: -20px; width: 100%; text-align: center;">
                                    <span class="small fw-medium">Education</span>
                                </div>
                            </div>
                            <div class="progress flex-grow-1 mx-3" style="height: 2px;">
                                <div class="progress-bar {{ $step >= 3 ? 'bg-primary' : 'bg-light' }}" style="width: 100%">
                                </div>
                            </div>
                        </div>

                        <div class="position-relative">
                            <div class="rounded-circle d-flex align-items-center justify-content-center {{ $step >= 3 ? 'bg-primary' : 'bg-light' }}"
                                style="width: 48px; height: 48px; {{ $step >= 3 ? 'color: white;' : 'color: #64748B;' }}">
                                <i class="fas fa-briefcase"></i>
                            </div>
                            <div class="position-absolute" style="bottom: -20px; width: 100%; text-align: center;">
                                <span class="small fw-medium">Experience</span>
                            </div>
                        </div>
                    </div>

                    <!-- Progress bar -->
                    <div class="progress mt-4" style="height: 6px;">
                        <div class="progress-bar bg-success" style="width: {{ ($step / 3) * 100 }}%"></div>
                    </div>
                </div>

                <div class="auth-wrapper">
                    <div class="auth-header">
                        <h1>Create Your Account</h1>
                        <p>Join InternConnect to find your perfect internship</p>
                    </div>

                    <div class="auth-body">
                        @if ($errors->any())
                            <div class="alert alert-danger mb-4">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        {{-- Step 1: Account Information --}}
                        @if ($step == 1)
                            <form action="{{ route('register.step1.post') }}" method="POST">
                                @csrf
                                <h4 class="mb-4">Account Information</h4>

                                <div class="row g-3 mb-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-floating">
                                                <input type="text" name="first_name" id="first_name"
                                                    value="{{ old('first_name', session('registration.first_name')) }}"
                                                    class="form-control @error('first_name') is-invalid @enderror"
                                                    placeholder="First Name" required>
                                                <label for="first_name">First Name*</label>
                                                @error('first_name')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-floating">
                                                <input type="text" name="last_name" id="last_name"
                                                    value="{{ old('last_name', session('registration.last_name')) }}"
                                                    class="form-control @error('last_name') is-invalid @enderror"
                                                    placeholder="Last Name" required>
                                                <label for="last_name">Last Name*</label>
                                                @error('last_name')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-floating">
                                        <input type="email" name="email" id="email"
                                            value="{{ old('email', session('registration.email')) }}"
                                            class="form-control @error('email') is-invalid @enderror"
                                            placeholder="Email Address" required>
                                        <label for="email">Email Address*</label>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-floating">
                                        <input type="password" name="password" id="password"
                                            class="form-control @error('password') is-invalid @enderror"
                                            placeholder="Password" required>
                                        <label for="password">Password*</label>
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <small class="form-text text-muted">Must be at least 8 characters</small>
                                </div>

                                <div class="form-group">
                                    <div class="form-floating">
                                        <input type="password" name="password_confirmation" id="password_confirmation"
                                            class="form-control" placeholder="Confirm Password" required>
                                        <label for="password_confirmation">Confirm Password*</label>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end mt-4">
                                    <button type="submit" class="btn btn-auth">
                                        Next <i class="fas fa-chevron-right ms-1"></i>
                                    </button>
                                </div>
                            </form>
                        @endif

                        {{-- Step 2: Education --}}
                        @if ($step == 2)
                            <form action="{{ route('register.step2.post') }}" method="POST">
                                @csrf
                                <h4 class="mb-4">Education Details</h4>

                                <div class="form-group">
                                    <div class="form-floating">
                                        <input type="text" name="university_name" id="university_name"
                                            value="{{ old('university_name', session('registration.university_name')) }}"
                                            class="form-control @error('university_name') is-invalid @enderror"
                                            placeholder="University/Institution">
                                        <label for="university_name">University/Institution</label>
                                        @error('university_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-floating">
                                        <select name="education_level" id="education_level"
                                            class="form-control @error('education_level') is-invalid @enderror">
                                            <option value="">Select your education level</option>
                                            <option value="High School"
                                                {{ old('education_level', session('registration.education_level')) == 'High School' ? 'selected' : '' }}>
                                                High School</option>
                                            <option value="Associate's"
                                                {{ old('education_level', session('registration.education_level')) == "Associate's" ? 'selected' : '' }}>
                                                Associate's Degree</option>
                                            <option value="Bachelor's"
                                                {{ old('education_level', session('registration.education_level')) == "Bachelor's" ? 'selected' : '' }}>
                                                Bachelor's Degree</option>
                                            <option value="Master's"
                                                {{ old('education_level', session('registration.education_level')) == "Master's" ? 'selected' : '' }}>
                                                Master's Degree</option>
                                            <option value="PhD"
                                                {{ old('education_level', session('registration.education_level')) == 'PhD' ? 'selected' : '' }}>
                                                PhD</option>
                                            <option value="Other"
                                                {{ old('education_level', session('registration.education_level')) == 'Other' ? 'selected' : '' }}>
                                                Other</option>
                                        </select>
                                        <label for="education_level">Education Level</label>
                                        @error('education_level')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-floating">
                                        <input type="text" name="major_field" id="major_field"
                                            value="{{ old('major_field', session('registration.major_field')) }}"
                                            class="form-control @error('major_field') is-invalid @enderror"
                                            placeholder="Field of Study/Major">
                                        <label for="major_field">Field of Study/Major</label>
                                        @error('major_field')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-floating">
                                        <select name="graduation_year" id="graduation_year"
                                            class="form-control @error('graduation_year') is-invalid @enderror">
                                            <option value="">Select year</option>
                                            @for ($year = date('Y') + 5; $year >= date('Y') - 4; $year--)
                                                <option value="{{ $year }}"
                                                    {{ old('graduation_year', session('registration.graduation_year')) == $year ? 'selected' : '' }}>
                                                    {{ $year }}
                                                </option>
                                            @endfor
                                        </select>
                                        <label for="graduation_year">Graduation Year</label>
                                        @error('graduation_year')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between mt-4">
                                    <a href="{{ route('register.step1') }}" class="btn btn-outline-secondary">
                                        <i class="fas fa-chevron-left me-1"></i> Previous
                                    </a>
                                    <button type="submit" class="btn btn-auth">
                                        Next <i class="fas fa-chevron-right ms-1"></i>
                                    </button>
                                </div>
                            </form>
                        @endif

                        {{-- Step 3: Experience & Profile --}}
                        @if ($step == 3)
                            <form action="{{ route('register.step3.post') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <h4 class="mb-4">Experience & Profile</h4>

                                <div class="form-check mb-4">
                                    <input type="checkbox" id="has_experience" name="has_experience" value="1"
                                        {{ old('has_experience', session('registration.has_experience')) ? 'checked' : '' }}
                                        class="form-check-input">
                                    <label for="has_experience" class="form-check-label">
                                        I have relevant work experience
                                    </label>
                                </div>

                                <div class="form-group">
                                    <div class="form-floating">
                                        <input type="text" name="skills" id="skills"
                                            value="{{ old('skills', session('registration.skills')) }}"
                                            class="form-control @error('skills') is-invalid @enderror"
                                            placeholder="Skills">
                                        <label for="skills">Skills (Optional)</label>
                                        @error('skills')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <small class="form-text text-muted">e.g. JavaScript, Python, Project Management</small>
                                </div>

                                <div class="form-group">
                                    <div class="form-floating">
                                        <input type="tel" name="phone" id="phone"
                                            value="{{ old('phone', session('registration.phone')) }}"
                                            class="form-control @error('phone') is-invalid @enderror"
                                            placeholder="Phone Number">
                                        <label for="phone">Phone Number (Optional)</label>
                                        @error('phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-floating">
                                        <input type="text" name="headline" id="headline"
                                            value="{{ old('headline', session('registration.headline')) }}"
                                            class="form-control @error('headline') is-invalid @enderror"
                                            placeholder="Professional Headline">
                                        <label for="headline">Professional Headline (Optional)</label>
                                        @error('headline')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <small class="form-text text-muted">e.g. Computer Science Student | Web
                                        Developer</small>
                                </div>

                                <div class="form-group">
                                    <div class="form-floating">
                                        <input type="text" name="location" id="location"
                                            value="{{ old('location', session('registration.location')) }}"
                                            class="form-control @error('location') is-invalid @enderror"
                                            placeholder="Location">
                                        <label for="location">Location (Optional)</label>
                                        @error('location')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-floating">
                                        <input type="text" name="languages" id="languages"
                                            value="{{ old('languages', session('registration.languages')) }}"
                                            class="form-control @error('languages') is-invalid @enderror"
                                            placeholder="Languages">
                                        <label for="languages">Languages (Optional)</label>
                                        @error('languages')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <small class="form-text text-muted">e.g. English, Spanish, Mandarin</small>
                                </div>

                                <div class="form-group">
                                    <label for="about" class="form-label">About Me (Optional)</label>
                                    <textarea name="about" id="about" rows="3" class="form-control @error('about') is-invalid @enderror"
                                        placeholder="Tell us a bit about yourself...">{{ old('about', session('registration.about')) }}</textarea>
                                    @error('about')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="profile_picture" class="form-label">Profile Picture (Optional)</label>
                                    <div class="input-group">
                                        <input type="file" name="profile_picture" id="profile_picture"
                                            class="form-control @error('profile_picture') is-invalid @enderror"
                                            accept="image/*">
                                        @error('profile_picture')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label for="resume" class="form-label">Resume (Optional)</label>
                                    <div class="input-group">
                                        <input type="file" name="resume" id="resume"
                                            class="form-control @error('resume') is-invalid @enderror"
                                            accept=".pdf,.doc,.docx">
                                        @error('resume')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <small class="form-text text-muted">Accepted formats: PDF, DOC, DOCX. Maximum size:
                                        5MB</small>
                                </div>

                                <div class="d-flex justify-content-between mt-4">
                                    <a href="{{ route('register.step2') }}" class="btn btn-outline-secondary">
                                        <i class="fas fa-chevron-left me-1"></i> Previous
                                    </a>
                                    <button type="submit" class="btn btn-success">
                                        <i class="fas fa-check me-1"></i> Complete Registration
                                    </button>
                                </div>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
