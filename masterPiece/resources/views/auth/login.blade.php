<x-layout>
    <div class="hero-section">
        <div class="container mx-auto py-8">
            <div class="max-w-xl mx-auto px-4">
                <div class="search-container glass-card p-6">
                    <h1 class="search-title mb-6">Sign In</h1>

                    @if ($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="space-y-4">
                            <div>
                                <label for="email"
                                    class="block text-sm font-medium text-[var(--text-dark)] mb-1">Email Address</label>
                                <div class="search-input-wrapper">
                                    <i class="fas fa-envelope search-icon-left"></i>
                                    <input type="email" name="email" id="email" value="{{ old('email') }}"
                                        class="search-input @error('email') border-red-500 @enderror" required
                                        autocomplete="email" autofocus>
                                </div>
                                @error('email')
                                    <p class="text-red-500 text-xs mt-1">{{ $errors->first('email') }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="password"
                                    class="block text-sm font-medium text-[var(--text-dark)] mb-1">Password</label>
                                <div class="search-input-wrapper">
                                    <i class="fas fa-lock search-icon-left"></i>
                                    <input type="password" name="password" id="password"
                                        class="search-input @error('password') border-red-500 @enderror" required
                                        autocomplete="current-password">
                                </div>
                                @error('password')
                                    <p class="text-red-500 text-xs mt-1">{{ $errors->first('password') }}</p>
                                @enderror
                            </div>

                            <div class="flex items-center">
                                <input type="checkbox" name="remember" id="remember"
                                    {{ old('remember') ? 'checked' : '' }} class="form-check-input">
                                <label for="remember"
                                    class="form-check-label ml-2 text-sm font-medium text-[var(--text-dark)]">
                                    Remember Me
                                </label>
                            </div>

                            <div class="flex flex-col md:flex-row items-center justify-between mt-6">
                                <button type="submit" class="search-btn w-full md:w-auto mb-3 md:mb-0">
                                    Sign In
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="text-[var(--primary-color)] hover:underline text-sm"
                                        href="{{ route('password.request') }}">
                                        Forgot Your Password?
                                    </a>
                                @endif
                            </div>

                            <div class="border-t border-[var(--border-color)] pt-4 mt-6 text-center">
                                <p class="text-[var(--text-light)] text-sm">
                                    Don't have an account yet?
                                </p>
                                <div class="flex flex-col sm:flex-row justify-center gap-2 mt-2">
                                    <a href="{{ route('register.step1') }}"
                                        class="text-[var(--primary-color)] hover:underline font-medium">
                                        Register as a Student
                                    </a>
                                    <span class="hidden sm:inline text-[var(--text-light)]">|</span>
                                    <a href="{{ route('company.register') }}"
                                        class="text-[var(--primary-color)] hover:underline font-medium">
                                        Register as a Company
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout>
