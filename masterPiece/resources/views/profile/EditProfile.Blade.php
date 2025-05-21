<x-Layout>
    <div class="container py-5">
        <div class="row">
            <div class="col-12 mb-4">
                <div class="card shadow border-0 rounded-3">
                    <div class="card-body p-4">
                        <h2 class="mb-4 fw-bold">Edit Profile</h2>

                        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <!-- Profile picture -->
                            <div class="mb-4 text-center">
                                <div class="mb-3">
                                    @if ($user->profile_picture_url)
                                        <img src="{{ asset('storage/' . $user->profile_picture_url) }}"
                                            class="rounded-circle shadow-sm mb-3" alt="Profile picture"
                                            style="width: 150px; height: 150px; object-fit: cover;">
                                    @else
                                        <div class="rounded-circle shadow-sm bg-light d-flex align-items-center justify-content-center mb-3"
                                            style="width: 150px; height: 150px; margin: 0 auto;">
                                            <i class="bi bi-person-circle text-secondary" style="font-size: 80px;"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="profile_picture" class="form-label">Change Profile Picture</label>
                                    <input class="form-control @error('profile_picture') is-invalid @enderror"
                                        type="file" id="profile_picture" name="profile_picture">
                                    @error('profile_picture')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-4">
                                <!-- Basic Information -->
                                <div class="col-md-6 mb-4 mb-md-0">
                                    <h4 class="mb-3">Basic Information</h4>

                                    <div class="mb-3">
                                        <label for="first_name" class="form-label">First Name*</label>
                                        <input type="text"
                                            class="form-control @error('first_name') is-invalid @enderror"
                                            id="first_name" name="first_name"
                                            value="{{ old('first_name', $user->first_name) }}" required>
                                        @error('first_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="last_name" class="form-label">Last Name*</label>
                                        <input type="text"
                                            class="form-control @error('last_name') is-invalid @enderror" id="last_name"
                                            name="last_name" value="{{ old('last_name', $user->last_name) }}" required>
                                        @error('last_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="headline" class="form-label">Headline</label>
                                        <input type="text"
                                            class="form-control @error('headline') is-invalid @enderror" id="headline"
                                            name="headline" value="{{ old('headline', $user->headline) }}"
                                            placeholder="e.g. Computer Science Student">
                                        @error('headline')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="location" class="form-label">Location</label>
                                        <input type="text"
                                            class="form-control @error('location') is-invalid @enderror" id="location"
                                            name="location" value="{{ old('location', $user->location) }}"
                                            placeholder="e.g. Amman, Jordan">
                                        @error('location')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Phone Number</label>
                                        <input type="tel" class="form-control @error('phone') is-invalid @enderror"
                                            id="phone" name="phone" value="{{ old('phone', $user->phone) }}">
                                        @error('phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Education -->
                                <div class="col-md-6" id="education">
                                    <h4 class="mb-3">Education</h4>

                                    <div class="mb-3">
                                        <label for="university_name" class="form-label">University/College</label>
                                        <input type="text"
                                            class="form-control @error('university_name') is-invalid @enderror"
                                            id="university_name" name="university_name"
                                            value="{{ old('university_name', $user->university_name) }}">
                                        @error('university_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="education_level" class="form-label">Degree</label>
                                        <select class="form-select @error('education_level') is-invalid @enderror"
                                            id="education_level" name="education_level">
                                            <option value="" {{ !$user->education_level ? 'selected' : '' }}>
                                                Select Degree</option>
                                            <option value="Bachelor's"
                                                {{ $user->education_level == "Bachelor's" ? 'selected' : '' }}>
                                                Bachelor's Degree</option>
                                            <option value="Master's"
                                                {{ $user->education_level == "Master's" ? 'selected' : '' }}>Master's
                                                Degree</option>
                                            <option value="PhD"
                                                {{ $user->education_level == 'PhD' ? 'selected' : '' }}>PhD</option>
                                            <option value="Diploma"
                                                {{ $user->education_level == 'Diploma' ? 'selected' : '' }}>Diploma
                                            </option>
                                        </select>
                                        @error('education_level')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="major_field" class="form-label">Major/Field of Study</label>
                                        <input type="text"
                                            class="form-control @error('major_field') is-invalid @enderror"
                                            id="major_field" name="major_field"
                                            value="{{ old('major_field', $user->major_field) }}"
                                            placeholder="e.g. Computer Science">
                                        @error('major_field')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="graduation_year" class="form-label">Expected Graduation
                                            Year</label>
                                        <input type="number"
                                            class="form-control @error('graduation_year') is-invalid @enderror"
                                            id="graduation_year" name="graduation_year"
                                            value="{{ old('graduation_year', $user->graduation_year) }}"
                                            min="2000" max="2100">
                                        @error('graduation_year')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- About Section -->
                            <div class="mb-4">
                                <h4 class="mb-3">About</h4>
                                <div class="mb-3">
                                    <label for="about" class="form-label">Tell us about yourself</label>
                                    <textarea class="form-control @error('about') is-invalid @enderror" id="about" name="about" rows="5">{{ old('about', $user->about) }}</textarea>
                                    @error('about')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Experience Section -->
                            <div class="mb-4" id="experience">
                                <h4 class="mb-3">Experience</h4>
                                <div class="mb-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="has_experience"
                                            name="has_experience" {{ $user->has_experience ? 'checked' : '' }}>
                                        <label class="form-check-label" for="has_experience">I have previous work
                                            experience</label>
                                    </div>
                                </div>
                                <!-- Note: For simplicity, we're just using a checkbox to indicate experience.
                                     A more detailed experience section would require a different database structure. -->
                            </div>

                            <!-- Skills Section -->
                            <div class="mb-4" id="skills">
                                <h4 class="mb-3">Skills</h4>
                                <div class="mb-3">
                                    <label for="skills" class="form-label">Add your skills (comma separated)</label>
                                    <input type="text" class="form-control @error('skills') is-invalid @enderror"
                                        id="skills_input" name="skills"
                                        value="{{ old('skills', is_array($user->skills) ? implode(', ', $user->skills) : '') }}"
                                        placeholder="e.g. JavaScript, HTML, CSS, React">
                                    <div class="form-text">Separate skills with commas (e.g. JavaScript, HTML, CSS)
                                    </div>
                                    @error('skills')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Languages Section -->
                            <div class="mb-4" id="languages">
                                <h4 class="mb-3">Languages</h4>
                                <div class="mb-3">
                                    <label for="languages" class="form-label">Add languages you speak (comma
                                        separated)</label>
                                    <input type="text"
                                        class="form-control @error('languages') is-invalid @enderror"
                                        id="languages_input" name="languages"
                                        value="{{ old('languages', is_array($user->languages) ? implode(', ', $user->languages) : '') }}"
                                        placeholder="e.g. English, Arabic, French">
                                    <div class="form-text">Separate languages with commas (e.g. English, Arabic,
                                        French)</div>
                                    @error('languages')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Resume Section -->
                            <div class="mb-4" id="resume">
                                <h4 class="mb-3">Resume</h4>
                                <div class="mb-3">
                                    @if($user->default_resume_path)
                                        <div class="mb-3 d-flex align-items-center">
                                            <i class="bi bi-file-earmark-pdf text-danger me-3" style="font-size: 1.5rem;"></i>
                                            <div>
                                                <p class="mb-1">Current resume: <a href="{{ asset($user->default_resume_path) }}" target="_blank">View Resume</a></p>
                                                <p class="small text-muted">Updated: {{ $user->updated_at->format('M d, Y') }}</p>
                                            </div>
                                        </div>
                                    @endif

                                    <label for="resume" class="form-label">Upload New Resume</label>
                                    <input type="file" class="form-control @error('resume') is-invalid @enderror"
                                        id="resume" name="resume" accept=".pdf,.doc,.docx">
                                    <div class="form-text">Accepted formats: PDF, DOC, DOCX. Maximum size: 5MB.</div>
                                    @error('resume')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="d-flex justify-content-between mt-4">
                                <a href="{{ route('profile.show') }}" class="btn btn-secondary">Cancel</a>
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // This script will convert the comma-separated string to an array for the controller
        document.addEventListener('DOMContentLoaded', function() {
            const skillsInput = document.getElementById('skills_input');
            const languagesInput = document.getElementById('languages_input');

            // This is not necessary for the form submission, but improves the UX
            // by showing tags as they're added
            skillsInput.addEventListener('input', function() {
                // Future enhancement: Add a visual representation of skills as tags
            });

            languagesInput.addEventListener('input', function() {
                // Future enhancement: Add a visual representation of languages as tags
            });
        });
    </script>
</x-Layout>
