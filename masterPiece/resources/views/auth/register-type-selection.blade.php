<x-layout>
    <div class="hero-section">
        <div class="container mx-auto py-8">
            <div class="max-w-xl mx-auto px-4">
                <div class="search-container glass-card p-6">
                    <h1 class="search-title mb-6">Join Our Platform</h1>

                    <div class="text-center mb-8">
                        <p class="text-lg text-[var(--text-dark)] mb-4">
                            Are you looking for an internship or offering one?
                        </p>
                        <p class="text-sm text-[var(--text-light)] mb-6">
                            Choose the account type that best describes you
                        </p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- User Option -->
                        <div class="flex flex-col items-center">
                            {{-- <div class="bg-white rounded-full p-4 shadow-md mb-4">
                                <i class="fas fa-user text-[var(--primary-color)] text-4xl"></i>
                            </div> --}}
                            <h3 class="font-medium text-lg mb-2">I'm looking for an internship</h3>
                            {{-- <p class="text-[var(--text-light)] text-sm text-center mb-4">
                                Create a student profile to search and apply for internships
                            </p> --}}
                            <div class="d-flex">
                                <a href="{{ route('register.step1') }}" class="search-btn w-full text-center" style="width: 100%; text-decoration: none;">
                                    Register as Student
                                </a>
                            </div>
                        </div>

                        <!-- Company Option -->
                        <div class="flex flex-col items-center">
                            {{-- <div class="bg-white rounded-full p-4 shadow-md mb-4">
                                <i class="fas fa-building text-[var(--primary-color)] text-4xl"></i>
                            </div> --}}
                            <h3 class="font-medium text-lg mb-2">I'm offering internships</h3>
                            {{-- <p class="text-[var(--text-light)] text-sm text-center mb-4">
                                Create a company profile to post internship opportunities
                            </p> --}}
                            <div class="d-flex">
                                <a href="{{ route('company.register') }}" class="search-btn w-full text-center" style="width: 100%; text-decoration: none;">
                                    Register as Company
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="border-t border-[var(--border-color)] pt-4 mt-8 text-center">
                        <p class="text-[var(--text-light)] text-sm">
                            Already have an account?
                            <a href="{{ route('login') }}"
                                class="text-[var(--primary-color)] hover:underline font-medium">
                                Sign In
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
