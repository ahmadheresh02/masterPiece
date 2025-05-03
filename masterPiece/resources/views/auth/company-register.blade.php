<x-layout>
    <div class="hero-section">
        <div class="container mx-auto py-8">
            <div class="max-w-3xl mx-auto px-4">
                <div class="search-container glass-card p-6">
                    <h1 class="search-title mb-6">Register Your Company</h1>

                    @if ($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('company.register.post') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="space-y-4">
                            <h2 class="text-xl font-semibold mb-4 text-[var(--text-dark)]">Company Information</h2>

                            <!-- Company Name -->
                            <div>
                                <label for="name"
                                    class="block text-sm font-medium text-[var(--text-dark)] mb-1">Company Name*</label>
                                <div class="search-input-wrapper">
                                    <i class="fas fa-building search-icon-left"></i>
                                    <input type="text" name="name" id="name" value="{{ old('name') }}"
                                        class="search-input @error('name') border-red-500 @enderror" required>
                                </div>
                                @error('name')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div>
                                <label for="email"
                                    class="block text-sm font-medium text-[var(--text-dark)] mb-1">Email
                                    Address*</label>
                                <div class="search-input-wrapper">
                                    <i class="fas fa-envelope search-icon-left"></i>
                                    <input type="email" name="email" id="email" value="{{ old('email') }}"
                                        class="search-input @error('email') border-red-500 @enderror" required>
                                </div>
                                @error('email')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Password -->
                            <div>
                                <label for="password"
                                    class="block text-sm font-medium text-[var(--text-dark)] mb-1">Password*</label>
                                <div class="search-input-wrapper">
                                    <i class="fas fa-lock search-icon-left"></i>
                                    <input type="password" name="password" id="password"
                                        class="search-input @error('password') border-red-500 @enderror" required>
                                </div>
                                <p class="text-xs text-[var(--text-light)] mt-1">Must be at least 8 characters</p>
                                @error('password')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Confirm Password -->
                            <div>
                                <label for="password_confirmation"
                                    class="block text-sm font-medium text-[var(--text-dark)] mb-1">Confirm
                                    Password*</label>
                                <div class="search-input-wrapper">
                                    <i class="fas fa-lock search-icon-left"></i>
                                    <input type="password" name="password_confirmation" id="password_confirmation"
                                        class="search-input" required>
                                </div>
                            </div>

                            <hr class="my-6 border-t border-[var(--border-color)]">
                            <h2 class="text-xl font-semibold mb-4 text-[var(--text-dark)]">Company Details</h2>

                            <!-- Description -->
                            <div>
                                <label for="description"
                                    class="block text-sm font-medium text-[var(--text-dark)] mb-1">Company
                                    Description</label>
                                <textarea name="description" id="description" rows="4"
                                    class="w-full px-3 py-2 border border-[var(--border-color)] rounded-md @error('description') border-red-500 @enderror"
                                    placeholder="Tell us about your company, its mission, and vision...">{{ old('description') }}</textarea>
                                @error('description')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Logo Upload -->
                            <div>
                                <label for="logo"
                                    class="block text-sm font-medium text-[var(--text-dark)] mb-1">Company Logo</label>
                                <div
                                    class="border border-dashed border-[var(--border-color)] rounded-md p-4 text-center">
                                    <i class="fas fa-cloud-upload-alt text-4xl text-[var(--text-light)] mb-2"></i>
                                    <p class="text-sm text-[var(--text-light)] mb-2">Drag and drop your company logo
                                        here, or click to browse</p>
                                    <input type="file" name="logo" id="logo"
                                        class="w-full opacity-0 absolute inset-0 cursor-pointer" accept="image/*"
                                        style="height: 100px">
                                    <button type="button"
                                        class="px-4 py-2 bg-[var(--tag-bg)] text-[var(--tag-text)] rounded-md hover:bg-gray-300 transition-all">
                                        Choose File
                                    </button>
                                </div>
                                @error('logo')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Website URL -->
                            <div>
                                <label for="website_url"
                                    class="block text-sm font-medium text-[var(--text-dark)] mb-1">Website URL</label>
                                <div class="search-input-wrapper">
                                    <i class="fas fa-globe search-icon-left"></i>
                                    <input type="url" name="website_url" id="website_url"
                                        value="{{ old('website_url') }}"
                                        class="search-input @error('website_url') border-red-500 @enderror"
                                        placeholder="https://www.example.com">
                                </div>
                                @error('website_url')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Industry -->
                            <div>
                                <label for="industry" class="filter-label">Industry</label>
                                <div class="select-wrapper">
                                    <select name="industry" id="industry"
                                        class="filter-select @error('industry') border-red-500 @enderror">
                                        <option value="">Select your industry</option>
                                        <option value="Technology"
                                            {{ old('industry') == 'Technology' ? 'selected' : '' }}>Technology</option>
                                        <option value="Finance" {{ old('industry') == 'Finance' ? 'selected' : '' }}>
                                            Finance</option>
                                        <option value="Healthcare"
                                            {{ old('industry') == 'Healthcare' ? 'selected' : '' }}>Healthcare</option>
                                        <option value="Education"
                                            {{ old('industry') == 'Education' ? 'selected' : '' }}>Education</option>
                                        <option value="Retail" {{ old('industry') == 'Retail' ? 'selected' : '' }}>
                                            Retail</option>
                                        <option value="Manufacturing"
                                            {{ old('industry') == 'Manufacturing' ? 'selected' : '' }}>Manufacturing
                                        </option>
                                        <option value="Media" {{ old('industry') == 'Media' ? 'selected' : '' }}>Media
                                        </option>
                                        <option value="Transportation"
                                            {{ old('industry') == 'Transportation' ? 'selected' : '' }}>Transportation
                                        </option>
                                        <option value="Hospitality"
                                            {{ old('industry') == 'Hospitality' ? 'selected' : '' }}>Hospitality
                                        </option>
                                        <option value="Energy" {{ old('industry') == 'Energy' ? 'selected' : '' }}>
                                            Energy</option>
                                        <option value="Other" {{ old('industry') == 'Other' ? 'selected' : '' }}>
                                            Other</option>
                                    </select>
                                    <div class="select-icon">
                                        <i class="fas fa-chevron-down"></i>
                                    </div>
                                </div>
                                @error('industry')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <!-- Company Size -->
                                <div>
                                    <label for="company_size" class="filter-label">Company Size</label>
                                    <div class="select-wrapper">
                                        <select name="company_size" id="company_size"
                                            class="filter-select @error('company_size') border-red-500 @enderror">
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
                                        <div class="select-icon">
                                            <i class="fas fa-chevron-down"></i>
                                        </div>
                                    </div>
                                    @error('company_size')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Founded Year -->
                                <div>
                                    <label for="founded_year" class="filter-label">Founded Year</label>
                                    <div class="select-wrapper">
                                        <select name="founded_year" id="founded_year"
                                            class="filter-select @error('founded_year') border-red-500 @enderror">
                                            <option value="">Select year</option>
                                            @for ($year = date('Y'); $year >= 1900; $year--)
                                                <option value="{{ $year }}"
                                                    {{ old('founded_year') == $year ? 'selected' : '' }}>
                                                    {{ $year }}</option>
                                            @endfor
                                        </select>
                                        <div class="select-icon">
                                            <i class="fas fa-chevron-down"></i>
                                        </div>
                                    </div>
                                    @error('founded_year')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Location -->
                            <div>
                                <label for="location"
                                    class="block text-sm font-medium text-[var(--text-dark)] mb-1">Company
                                    Location</label>
                                <div class="search-input-wrapper">
                                    <i class="fas fa-map-marker-alt search-icon-left"></i>
                                    <input type="text" name="location" id="location"
                                        value="{{ old('location') }}"
                                        class="search-input @error('location') border-red-500 @enderror"
                                        placeholder="e.g. San Francisco, CA">
                                </div>
                                @error('location')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="mt-8 flex flex-col space-y-4" style="padding-top: 15px;">
                            <div class="custom-checkbox" style="padding-bottom: 18px;">
                                <input type="checkbox" id="terms" name="terms" value="1"
                                    class="form-check-input" required>
                                <label for="terms" class="form-check-label ml-2 text-sm text-[var(--text-dark)]">
                                    I agree to the <a href="#"
                                        class="text-[var(--primary-color)] hover:underline">Terms of Service</a> and <a
                                        href="#" class="text-[var(--primary-color)] hover:underline">Privacy
                                        Policy</a>
                                </label>
                            </div>

                            <button type="submit"
                                class="search-btn bg-[var(--secondary-color)] hover:bg-[#129d72] w-full">
                                Register Company
                            </button>
                        </div>

                        <div class="text-center mt-4">
                            <p class="text-sm text-[var(--text-light)]">
                                Already have a company account? <a href="{{ route('login') }}"
                                    class="text-[var(--primary-color)] hover:underline">Sign in</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout>
