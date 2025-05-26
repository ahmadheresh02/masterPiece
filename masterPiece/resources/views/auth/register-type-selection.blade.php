@extends('layouts.app')

@section('content')
    <div class="hero-section">
        <div class="container py-8">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6">
                    <div class="search-container glass-card">
                        <h1 class="search-title">Join Our Platform</h1>

                        <div class="text-center mb-8">
                            <p class="fs-5 mb-4">
                                Are you looking for an internship or offering one?
                            </p>
                            <p class="text-sm mb-6 text-muted">
                                Choose the account type that best describes you
                            </p>
                        </div>

                        <div class="row g-4">
                            <!-- User Option -->
                            <div class="col-md-6 text-center">
                                <h3 class="font-medium text-lg mb-2">I'm looking for an internship</h3>
                                <a href="{{ route('register.step1') }}" class="search-btn d-block">
                                    Register as Student
                                </a>
                            </div>

                            <!-- Company Option -->
                            <div class="col-md-6 text-center">
                                <h3 class="font-medium text-lg mb-2">I'm offering internships</h3>
                                <a href="{{ route('company.register') }}" class="search-btn d-block">
                                    Register as Company
                                </a>
                            </div>
                        </div>

                        <div class="border-top pt-4 mt-4 text-center">
                            <p class="text-muted">
                                Already have an account?
                                <a href="{{ route('login') }}" class="text-primary fw-medium">
                                    Sign In
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
