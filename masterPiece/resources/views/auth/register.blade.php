<x-layout>
    <div class="hero-section">
        <div class="container mx-auto py-8">
            <div class="max-w-3xl mx-auto px-4">
                <!-- Progress Bar -->
                <div class="mb-8">
                    <div class="flex justify-between mb-2" style="display: flex; justify-content: center; align-items: center; gap: 355px;">
                        <div class="flex items-center">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center {{ $step >= 1 ? 'bg-[var(--primary-color)] text-white' : 'bg-gray-200' }}">
                                <i class="fas fa-user"></i>
                            </div>
                            <span class="ml-2 text-sm font-medium text-white">Account</span>
                        </div>
                        <div class="flex items-center">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center {{ $step >= 2 ? 'bg-[var(--primary-color)] text-white' : 'bg-gray-200' }}">
                                <i class="fas fa-book-open"></i>
                            </div>
                            <span class="ml-2 text-sm font-medium text-white">Education</span>
                        </div>
                        <div class="flex items-center">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center {{ $step >= 3 ? 'bg-[var(--primary-color)] text-white' : 'bg-gray-200' }}">
                                <i class="fas fa-briefcase"></i>
                            </div>
                            <span class="ml-2 text-sm font-medium text-white">Experience</span>
                        </div>
                    </div>
                    <div class="overflow-hidden h-2 bg-gray-200 rounded-full">
                        <div
                            class="h-full bg-[var(--secondary-color)] rounded-full transition-all duration-300"
                            style="width: {{ ($step / 3) * 100 }}%"
                        ></div>
                    </div>
                </div>

                <div class="search-container glass-card p-6">
                    <h1 class="search-title mb-6">Join Our Internship Platform</h1>

                    @if ($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Step 1: Account Information --}}
                    @if($step == 1)
                        <form action="{{ route('register.step1.post') }}" method="POST">
                            @csrf
                            <div class="space-y-4">
                                <h2 class="text-xl font-semibold mb-4 text-[var(--text-dark)]">Account Information</h2>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label for="first_name" class="block text-sm font-medium text-[var(--text-dark)] mb-1">First Name*</label>
                                        <input
                                            type="text"
                                            name="first_name"
                                            id="first_name"
                                            value="{{ old('first_name', session('registration.first_name')) }}"
                                            class="search-input px-3 py-2 @error('first_name') border-red-500 @enderror"
                                            required
                                        >
                                        @error('first_name')
                                            <p class="text-red-500 text-xs mt-1">{{ $errors->first('first_name') }}</p>
                                        @enderror
                                    </div>
                                    <div>
                                        <label for="last_name" class="block text-sm font-medium text-[var(--text-dark)] mb-1">Last Name*</label>
                                        <input
                                            type="text"
                                            name="last_name"
                                            id="last_name"
                                            value="{{ old('last_name', session('registration.last_name')) }}"
                                            class="search-input px-3 py-2 @error('last_name') border-red-500 @enderror"
                                            required
                                        >
                                        @error('last_name')
                                            <p class="text-red-500 text-xs mt-1">{{ $errors->first('last_name') }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div>
                                    <label for="email" class="block text-sm font-medium text-[var(--text-dark)] mb-1">Email Address*</label>
                                    <div class="search-input-wrapper">
                                        <i class="fas fa-envelope search-icon-left"></i>
                                        <input
                                            type="email"
                                            name="email"
                                            id="email"
                                            value="{{ old('email', session('registration.email')) }}"
                                            class="search-input @error('email') border-red-500 @enderror"
                                            required
                                        >
                                    </div>
                                    @error('email')
                                        <p class="text-red-500 text-xs mt-1">{{ $errors->first('email') }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="password" class="block text-sm font-medium text-[var(--text-dark)] mb-1">Password*</label>
                                    <div class="search-input-wrapper">
                                        <i class="fas fa-lock search-icon-left"></i>
                                        <input
                                            type="password"
                                            name="password"
                                            id="password"
                                            class="search-input @error('password') border-red-500 @enderror"
                                            required
                                        >
                                    </div>
                                    <p class="text-xs text-[var(--text-light)] mt-1">Must be at least 8 characters</p>
                                    @error('password')
                                        <p class="text-red-500 text-xs mt-1">{{ $errors->first('password') }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="password_confirmation" class="block text-sm font-medium text-[var(--text-dark)] mb-1">Confirm Password*</label>
                                    <div class="search-input-wrapper">
                                        <i class="fas fa-lock search-icon-left"></i>
                                        <input
                                            type="password"
                                            name="password_confirmation"
                                            id="password_confirmation"
                                            class="search-input"
                                            required
                                        >
                                    </div>
                                </div>
                            </div>

                            <div class="search-button-container flex justify-end mt-8" style="padding-top: 20px;">
                                <button
                                    type="submit"
                                    class="search-btn"
                                >
                                    <span class="mr-1">Next</span>
                                    <i class="fas fa-chevron-right"></i>
                                </button>
                            </div>
                        </form>
                    @endif

                    {{-- Step 2: Education --}}
                    @if($step == 2)
                        <form action="{{ route('register.step2.post') }}" method="POST">
                            @csrf
                            <div class="space-y-4">
                                <h2 class="text-xl font-semibold mb-4 text-[var(--text-dark)]">Education Details </h2>

                                <div>
                                    <label for="university_name" class="block text-sm font-medium text-[var(--text-dark)] mb-1">University/Institution </label>
                                    <div class="search-input-wrapper">
                                        <i class="fas fa-university search-icon-left"></i>
                                        <input
                                            type="text"
                                            name="university_name"
                                            id="university_name"
                                            value="{{ old('university_name', session('registration.university_name')) }}"
                                            class="search-input @error('university_name') border-red-500 @enderror"
                                            placeholder="e.g. Stanford University"
                                        >
                                    </div>
                                    @error('university_name')
                                        <p class="text-red-500 text-xs mt-1">{{ $errors->first('university_name') }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="education_level" class="filter-label">Education Level</label>
                                    <div class="select-wrapper">
                                        <select
                                            name="education_level"
                                            id="education_level"
                                            class="filter-select @error('education_level') border-red-500 @enderror"
                                        >
                                            <option value="">Select your education level</option>
                                            <option value="High School" {{ old('education_level', session('registration.education_level')) == 'High School' ? 'selected' : '' }}>High School</option>
                                            <option value="Associate's" {{ old('education_level', session('registration.education_level')) == "Associate's" ? 'selected' : '' }}>Associate's Degree</option>
                                            <option value="Bachelor's" {{ old('education_level', session('registration.education_level')) == "Bachelor's" ? 'selected' : '' }}>Bachelor's Degree</option>
                                            <option value="Master's" {{ old('education_level', session('registration.education_level')) == "Master's" ? 'selected' : '' }}>Master's Degree</option>
                                            <option value="PhD" {{ old('education_level', session('registration.education_level')) == 'PhD' ? 'selected' : '' }}>PhD</option>
                                            <option value="Other" {{ old('education_level', session('registration.education_level')) == 'Other' ? 'selected' : '' }}>Other</option>
                                        </select>
                                        <div class="select-icon">
                                            <i class="fas fa-chevron-down"></i>
                                        </div>
                                    </div>
                                    @error('education_level')
                                        <p class="text-red-500 text-xs mt-1">{{ $errors->first('education_level') }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="major_field" class="block text-sm font-medium text-[var(--text-dark)] mb-1">Field of Study/Major</label>
                                    <div class="search-input-wrapper">
                                        <i class="fas fa-graduation-cap search-icon-left"></i>
                                        <input
                                            type="text"
                                            name="major_field"
                                            id="major_field"
                                            value="{{ old('major_field', session('registration.major_field')) }}"
                                            class="search-input @error('major_field') border-red-500 @enderror"
                                            placeholder="e.g. Computer Science"
                                        >
                                    </div>
                                    @error('major_field')
                                        <p class="text-red-500 text-xs mt-1">{{ $errors->first('major_field') }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="graduation_year" class="filter-label">Graduation Year</label>
                                    <div class="select-wrapper">
                                        <select
                                            name="graduation_year"
                                            id="graduation_year"
                                            class="filter-select @error('graduation_year') border-red-500 @enderror"
                                        >
                                            <option value="">Select year</option>
                                            @for($year = date('Y') + 5; $year >= date('Y') - 4; $year--)
                                                <option value="{{ $year }}" {{ old('graduation_year', session('registration.graduation_year')) == $year ? 'selected' : '' }}>{{ $year }}</option>
                                            @endfor
                                        </select>
                                        <div class="select-icon">
                                            <i class="fas fa-chevron-down"></i>
                                        </div>
                                    </div>
                                    @error('graduation_year')
                                        <p class="text-red-500 text-xs mt-1">{{ $errors->first('graduation_year') }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="flex justify-between mt-8" style="padding-top: 20px;">
                                <a
                                    href="{{ route('register.step1') }}"
                                    class="flex items-center px-4 py-2 bg-[var(--tag-bg)] text-[var(--tag-text)] rounded-md hover:bg-gray-300 transition-all"
                                >
                                    <i class="fas fa-chevron-left mr-1"></i>
                                    <span>Previous</span>
                                </a>
                                <button
                                    type="submit"
                                    class="search-btn"
                                >
                                    <span class="mr-1">Next</span>
                                    <i class="fas fa-chevron-right"></i>
                                </button>
                            </div>
                        </form>
                    @endif

                    {{-- Step 3: Experience & Profile --}}
                    @if($step == 3)
                        <form action="{{ route('register.step3.post') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="space-y-4">
                                <h2 class="text-xl font-semibold mb-4 text-[var(--text-dark)]">Experience & Profile</h2>

                                <div class="custom-checkbox mb-4">
                                    <input
                                        type="checkbox"
                                        id="has_experience"
                                        name="has_experience"
                                        value="1"
                                        {{ old('has_experience', session('registration.has_experience')) ? 'checked' : '' }}
                                        class="form-check-input"
                                    >
                                    <label for="has_experience" class="form-check-label ml-2 text-sm font-medium text-[var(--text-dark)]">
                                        I have relevant work experience
                                    </label>
                                </div>

                                <div>
                                    <label for="skills" class="block text-sm font-medium text-[var(--text-dark)] mb-1">Skills (Optional)</label>
                                    <div class="search-input-wrapper">
                                        <i class="fas fa-tools search-icon-left"></i>
                                        <input
                                            type="text"
                                            name="skills"
                                            id="skills"
                                            value="{{ old('skills', session('registration.skills')) }}"
                                            class="search-input @error('skills') border-red-500 @enderror"
                                            placeholder="e.g. JavaScript, Python, Project Management"
                                        >
                                    </div>
                                    @error('skills')
                                        <p class="text-red-500 text-xs mt-1">{{ $errors->first('skills') }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="phone" class="block text-sm font-medium text-[var(--text-dark)] mb-1">Phone Number (Optional)</label>
                                    <div class="search-input-wrapper">
                                        <i class="fas fa-phone search-icon-left"></i>
                                        <input
                                            type="tel"
                                            name="phone"
                                            id="phone"
                                            value="{{ old('phone', session('registration.phone')) }}"
                                            class="search-input @error('phone') border-red-500 @enderror"
                                            placeholder="e.g. +1 (555) 123-4567"
                                        >
                                    </div>
                                    @error('phone')
                                        <p class="text-red-500 text-xs mt-1">{{ $errors->first('phone') }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="headline" class="block text-sm font-medium text-[var(--text-dark)] mb-1">Professional Headline (Optional)</label>
                                    <div class="search-input-wrapper">
                                        <i class="fas fa-heading search-icon-left"></i>
                                        <input
                                            type="text"
                                            name="headline"
                                            id="headline"
                                            value="{{ old('headline', session('registration.headline')) }}"
                                            class="search-input @error('headline') border-red-500 @enderror"
                                            placeholder="e.g. Computer Science Student | Web Developer"
                                        >
                                    </div>
                                    @error('headline')
                                        <p class="text-red-500 text-xs mt-1">{{ $errors->first('headline') }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="location" class="block text-sm font-medium text-[var(--text-dark)] mb-1">Location (Optional)</label>
                                    <div class="search-input-wrapper">
                                        <i class="fas fa-map-marker-alt search-icon-left"></i>
                                        <input
                                            type="text"
                                            name="location"
                                            id="location"
                                            value="{{ old('location', session('registration.location')) }}"
                                            class="search-input @error('location') border-red-500 @enderror"
                                            placeholder="e.g. San Francisco, CA"
                                        >
                                    </div>
                                    @error('location')
                                        <p class="text-red-500 text-xs mt-1">{{ $errors->first('location') }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="languages" class="block text-sm font-medium text-[var(--text-dark)] mb-1">Languages (Optional)</label>
                                    <div class="search-input-wrapper">
                                        <i class="fas fa-language search-icon-left"></i>
                                        <input
                                            type="text"
                                            name="languages"
                                            id="languages"
                                            value="{{ old('languages', session('registration.languages')) }}"
                                            class="search-input @error('languages') border-red-500 @enderror"
                                            placeholder="e.g. English, Spanish, Mandarin"
                                        >
                                    </div>
                                    @error('languages')
                                        <p class="text-red-500 text-xs mt-1">{{ $errors->first('languages') }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="about" class="block text-sm font-medium text-[var(--text-dark)] mb-1">About Me (Optional)</label>
                                    <textarea
                                        name="about"
                                        id="about"
                                        rows="3"
                                        class="w-full px-3 py-2 border border-[var(--border-color)] rounded-md @error('about') border-red-500 @enderror"
                                        placeholder="Tell us a bit about yourself..."
                                    >{{ old('about', session('registration.about')) }}</textarea>
                                    @error('about')
                                        <p class="text-red-500 text-xs mt-1">{{ $errors->first('about') }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="profile_picture" class="block text-sm font-medium text-[var(--text-dark)] mb-1">Profile Picture (Optional)</label>
                                    <div class="border border-dashed border-[var(--border-color)] rounded-md p-4 text-center">
                                        <i class="fas fa-cloud-upload-alt text-4xl text-[var(--text-light)] mb-2"></i>
                                        <p class="text-sm text-[var(--text-light)] mb-2">Drag and drop your profile picture here, or click to browse</p>
                                        <input
                                            type="file"
                                            name="profile_picture"
                                            id="profile_picture"
                                            class="w-full opacity-0 absolute inset-0 cursor-pointer"
                                            accept="image/*"
                                            style="height: 100px"
                                        >
                                        <button type="button" class="px-4 py-2 bg-[var(--tag-bg)] text-[var(--tag-text)] rounded-md hover:bg-gray-300 transition-all">
                                            Choose File
                                        </button>
                                    </div>
                                    @error('profile_picture')
                                        <p class="text-red-500 text-xs mt-1">{{ $errors->first('profile_picture') }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="flex justify-between mt-8" style="padding-top: 20px;">
                                <a
                                    href="{{ route('register.step2') }}"
                                    class="flex items-center px-4 py-2 bg-[var(--tag-bg)] text-[var(--tag-text)] rounded-md hover:bg-gray-300 transition-all"
                                >
                                    <i class="fas fa-chevron-left mr-1"></i>
                                    <span>Previous</span>
                                </a>
                                <button
                                    type="submit"
                                    class="search-btn bg-[var(--secondary-color)] hover:bg-[#129d72]"
                                >
                                    {{-- <i class="fas fa-check mr-1"></i> --}}
                                      Complete Registration
                                </button>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-layout>
