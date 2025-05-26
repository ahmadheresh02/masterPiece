@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="auth-wrapper">
                    <div class="auth-header">
                        <h1>Register Your Company</h1>
                        <p>Join InternConnect to post internship opportunities</p>
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

                        <form action="{{ route('company.register.post') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <!-- Company Information Section -->
                            <h4 class="mb-4">Company Information</h4>

                            <!-- Company Name -->
                            <div class="form-group">
                                <i class="fas fa-building"></i>
                                <div class="form-floating">
                                    <input type="text" name="name" id="name" value="{{ old('name') }}"
                                        class="form-control @error('name') is-invalid @enderror" placeholder="Company Name"
                                        required>
                                    <label for="name">Company Name*</label>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="form-group">
                                <i class="fas fa-envelope"></i>
                                <div class="form-floating">
                                    <input type="email" name="email" id="email" value="{{ old('email') }}"
                                        class="form-control @error('email') is-invalid @enderror"
                                        placeholder="Email Address" required>
                                    <label for="email">Email Address*</label>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Password -->
                            <div class="form-group">
                                <i class="fas fa-lock"></i>
                                <div class="form-floating">
                                    <input type="password" name="password" id="password"
                                        class="form-control @error('password') is-invalid @enderror" placeholder="Password"
                                        required>
                                    <label for="password">Password*</label>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <small class="form-text text-muted">Must be at least 8 characters</small>
                            </div>

                            <!-- Confirm Password -->
                            <div class="form-group">
                                <i class="fas fa-lock"></i>
                                <div class="form-floating">
                                    <input type="password" name="password_confirmation" id="password_confirmation"
                                        class="form-control" placeholder="Confirm Password" required>
                                    <label for="password_confirmation">Confirm Password*</label>
                                </div>
                            </div>

                            <hr class="my-4">
                            <h4 class="mb-4">Company Details</h4>

                            <!-- Description -->
                            <div class="form-group mb-4">
                                <label for="description" class="form-label">Company Description*</label>
                                <textarea name="description" id="description" rows="4"
                                    class="form-control @error('description') is-invalid @enderror"
                                    placeholder="Tell us about your company, its mission, and vision..." required>{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Logo Upload -->
                            <div class="mb-4">
                                <label for="logo" class="form-label">Company Logo</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-image"></i></span>
                                    <input type="file" name="logo" id="logo"
                                        class="form-control @error('logo') is-invalid @enderror" accept="image/*">
                                    @error('logo')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Website URL -->
                            <div class="form-group">
                                <i class="fas fa-globe"></i>
                                <div class="form-floating">
                                    <input type="url" name="website_url" id="website_url"
                                        value="{{ old('website_url') }}"
                                        class="form-control @error('website_url') is-invalid @enderror"
                                        placeholder="Website URL" required>
                                    <label for="website_url">Website URL*</label>
                                    @error('website_url')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Industry -->
                            <div class="form-group">
                                <i class="fas fa-industry"></i>
                                <div class="form-floating">
                                    <select name="industry" id="industry"
                                        class="form-control @error('industry') is-invalid @enderror" required>
                                        <option value="">Select your industry</option>
                                        <option value="Technology" {{ old('industry') == 'Technology' ? 'selected' : '' }}>
                                            Technology</option>
                                        <option value="Finance" {{ old('industry') == 'Finance' ? 'selected' : '' }}>
                                            Finance</option>
                                        <option value="Healthcare" {{ old('industry') == 'Healthcare' ? 'selected' : '' }}>
                                            Healthcare</option>
                                        <option value="Education" {{ old('industry') == 'Education' ? 'selected' : '' }}>
                                            Education</option>
                                        <option value="Retail" {{ old('industry') == 'Retail' ? 'selected' : '' }}>Retail
                                        </option>
                                        <option value="Manufacturing"
                                            {{ old('industry') == 'Manufacturing' ? 'selected' : '' }}>Manufacturing
                                        </option>
                                        <option value="Media" {{ old('industry') == 'Media' ? 'selected' : '' }}>Media
                                        </option>
                                        <option value="Transportation"
                                            {{ old('industry') == 'Transportation' ? 'selected' : '' }}>Transportation
                                        </option>
                                        <option value="Hospitality"
                                            {{ old('industry') == 'Hospitality' ? 'selected' : '' }}>Hospitality</option>
                                        <option value="Energy" {{ old('industry') == 'Energy' ? 'selected' : '' }}>Energy
                                        </option>
                                        <option value="Other" {{ old('industry') == 'Other' ? 'selected' : '' }}>Other
                                        </option>
                                    </select>
                                    <label for="industry">Industry*</label>
                                    @error('industry')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row g-3 mb-3">
                                <!-- Company Size -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <i class="fas fa-users"></i>
                                        <div class="form-floating">
                                            <select name="company_size" id="company_size"
                                                class="form-control @error('company_size') is-invalid @enderror" required>
                                                <option value="">Select company size</option>
                                                <option value="1-10"
                                                    {{ old('company_size') == '1-10' ? 'selected' : '' }}>1-10 employees
                                                </option>
                                                <option value="11-50"
                                                    {{ old('company_size') == '11-50' ? 'selected' : '' }}>11-50 employees
                                                </option>
                                                <option value="51-200"
                                                    {{ old('company_size') == '51-200' ? 'selected' : '' }}>51-200
                                                    employees</option>
                                                <option value="201-500"
                                                    {{ old('company_size') == '201-500' ? 'selected' : '' }}>201-500
                                                    employees</option>
                                                <option value="501-1000"
                                                    {{ old('company_size') == '501-1000' ? 'selected' : '' }}>501-1000
                                                    employees</option>
                                                <option value="1001-5000"
                                                    {{ old('company_size') == '1001-5000' ? 'selected' : '' }}>1001-5000
                                                    employees</option>
                                                <option value="5001+"
                                                    {{ old('company_size') == '5001+' ? 'selected' : '' }}>5001+ employees
                                                </option>
                                            </select>
                                            <label for="company_size">Company Size*</label>
                                            @error('company_size')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Founded Year -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <i class="fas fa-calendar-alt"></i>
                                        <div class="form-floating">
                                            <select name="founded_year" id="founded_year"
                                                class="form-control @error('founded_year') is-invalid @enderror" required>
                                                <option value="">Select year</option>
                                                @for ($year = date('Y'); $year >= 1900; $year--)
                                                    <option value="{{ $year }}"
                                                        {{ old('founded_year') == $year ? 'selected' : '' }}>
                                                        {{ $year }}
                                                    </option>
                                                @endfor
                                            </select>
                                            <label for="founded_year">Founded Year*</label>
                                            @error('founded_year')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Location -->
                            <div class="form-group">
                                <i class="fas fa-map-marker-alt"></i>
                                <div class="form-floating">
                                    <input type="text" name="location" id="location" value="{{ old('location') }}"
                                        class="form-control @error('location') is-invalid @enderror"
                                        placeholder="Location" required>
                                    <label for="location">Company Location*</label>
                                    @error('location')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-check mb-4 mt-4">
                                <input class="form-check-input" type="checkbox" name="terms" id="terms"
                                    value="1" required>
                                <label class="form-check-label" for="terms">
                                    I agree to the <a href="#" class="text-decoration-none">Terms of Service</a> and
                                    <a href="#" class="text-decoration-none">Privacy Policy</a>
                                </label>
                                @error('terms')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-success btn-lg w-100">
                                Register Company
                            </button>

                            <div class="auth-footer">
                                <p>Already have a company account?</p>
                                <a href="{{ route('login') }}">Sign in</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
