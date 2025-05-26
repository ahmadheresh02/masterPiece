<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name', 'InternConnect') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="{{ asset('css/buttons.css') }}" rel="stylesheet">

    <style>
        :root {
            --primary-color: #0A66C2;
            --primary-hover: #0855A0;
            --secondary-color: #14AE5C;
            --secondary-hover: #129d72;
            --accent-color: #FF6B6B;
            --dark-bg: #1E293B;
            --light-bg: #F8FAFC;
            --text-dark: #1D2939;
            --text-light: #667085;
            --surface-color: #FFFFFF;
            --border-color: #E4E7EC;
            --input-bg: #F1F5F9;
            --footer-bg: #1E293B;
            --hero-bg: #0A66C2;
            --tag-bg: #EEF4FF;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #F8FAFC;
            color: var(--text-dark);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        main {
            flex: 1;
        }

        /* Hero Section Styles */
        .hero-section {
            background: linear-gradient(135deg, #0A66C2 0%, #1E88E5 50%, #42A5F5 100%);
            padding: 4rem 0;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .hero-section::after {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            background: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%23ffffff' fill-opacity='0.05' fill-rule='evenodd'/%3E%3C/svg%3E") repeat;
            z-index: 1;
        }

        .hero-section .container {
            position: relative;
            z-index: 2;
        }

        .hero-section h1 {
            font-weight: 800;
            font-size: 2.75rem;
            margin-bottom: 1rem;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .hero-section p {
            font-size: 1.125rem;
            font-weight: 400;
            opacity: 0.9;
        }

        /* Search Section */
        .search-section {
            background: linear-gradient(135deg, #f8fafc 0%, #ffffff 100%);
            padding: 2.5rem 0;
            border-bottom: 1px solid var(--border-color);
        }

        .search-btn {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-hover) 100%);
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(10, 102, 194, 0.2);
            text-decoration: none;
            text-align: center;
            display: inline-block;
        }

        .search-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 16px rgba(10, 102, 194, 0.3);
            color: white;
        }

        /* Glass card for search container */
        .glass-card {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            border-radius: 1rem;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }

        .search-container {
            padding: 2rem;
            border-radius: 1rem;
        }

        .search-title {
            font-weight: 700;
            font-size: 1.75rem;
            color: var(--text-dark);
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .search-input-wrapper {
            position: relative;
            margin-bottom: 1rem;
        }

        .search-icon-left {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-light);
        }

        .search-input {
            width: 100%;
            padding: 0.75rem 1rem 0.75rem 2.5rem;
            border: 1px solid var(--border-color);
            border-radius: 0.5rem;
            background-color: var(--surface-color);
        }

        /* Select Wrapper */
        .select-wrapper {
            position: relative;
            margin-bottom: 1rem;
        }

        .select-icon {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-light);
            pointer-events: none;
        }

        .filter-label {
            display: block;
            font-size: 0.875rem;
            font-weight: 500;
            color: var(--text-dark);
            margin-bottom: 0.5rem;
        }

        .filter-select {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid var(--border-color);
            border-radius: 0.5rem;
            background-color: var(--surface-color);
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            color: var(--text-dark);
        }

        /* Auth Components Styling */
        .auth-wrapper {
            width: 100%;
            background-color: var(--surface-color);
            border-radius: 16px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            margin-bottom: 2rem;
        }

        .auth-header {
            background-color: var(--primary-color);
            color: white;
            padding: 2rem;
            text-align: center;
            position: relative;
        }

        .auth-header h1 {
            font-weight: 600;
            font-size: 1.75rem;
            margin-bottom: 0.5rem;
        }

        .auth-header p {
            opacity: 0.8;
            font-weight: 300;
            margin-bottom: 0;
        }

        .auth-header::after {
            content: "";
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 100%;
            height: 20px;
            background-color: var(--surface-color);
            border-radius: 50% 50% 0 0;
        }

        .auth-body {
            padding: 2rem;
        }

        .form-floating {
            margin-bottom: 1.5rem;
        }

        .form-floating .form-control {
            border-radius: 8px;
            border: 1px solid var(--border-color);
            padding: 0.375rem 0.75rem;
            padding-left: 2.5rem;
            height: calc(3.5rem + 2px);
            font-size: 0.95rem;
        }

        .form-floating .form-control:focus {
            box-shadow: 0 0 0 0.25rem rgba(10, 102, 194, 0.15);
            border-color: var(--primary-color);
        }

        .form-floating>label {
            padding: 1rem 0.75rem;
        }

        .form-group {
            position: relative;
            margin-bottom: 1.5rem;
        }

        .form-group i {
            position: absolute;
            left: 1rem;
            top: 1.15rem;
            color: var(--text-light);
            z-index: 5;
        }

        .form-check {
            display: flex;
            align-items: center;
        }

        .form-check-input {
            width: 1.2em;
            height: 1.2em;
            margin-right: 0.5rem;
        }

        .form-check-input:checked {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-auth {
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 8px;
            padding: 0.75rem 1.5rem;
            font-weight: 500;
            transition: all 0.3s ease;
            width: 100%;
        }

        .btn-auth:hover {
            background-color: #0855a1;
            color: white;
        }

        .auth-footer {
            text-align: center;
            margin-top: 2rem;
            color: var(--text-light);
        }

        .auth-footer a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .auth-footer a:hover {
            text-decoration: underline;
        }

        .auth-divider {
            display: flex;
            align-items: center;
            margin: 1.5rem 0;
        }

        .auth-divider::before,
        .auth-divider::after {
            content: "";
            flex: 1;
            border-bottom: 1px solid var(--border-color);
        }

        .auth-divider span {
            padding: 0 1rem;
            color: var(--text-light);
            font-size: 0.9rem;
        }

        .social-auth-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            padding: 0.75rem;
            width: 100%;
            background-color: white;
            transition: all 0.2s ease;
            margin-bottom: 1rem;
        }

        .social-auth-btn:hover {
            background-color: #f8f9fa;
            border-color: var(--text-light);
        }

        .social-auth-btn i {
            margin-right: 0.75rem;
            font-size: 1.25rem;
        }

        .social-auth-btn.google i {
            color: #DB4437;
        }

        .social-auth-btn.linkedin i {
            color: #0A66C2;
        }

        .form-floating .is-invalid {
            border-color: #dc3545;
        }

        .invalid-feedback {
            color: #dc3545;
            font-size: 0.875em;
            margin-top: 0.25rem;
        }

        /* Navbar Styles */
        .navbar {
            background-color: white;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.05);
            padding: 1rem 0;
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--primary-color);
        }

        .navbar-brand span {
            color: var(--secondary-color);
        }

        .navbar .nav-link {
            color: var(--text-dark);
            font-weight: 500;
            padding: 0.5rem 1rem;
            transition: all 0.2s ease;
        }

        .navbar .nav-link:hover,
        .navbar .nav-link.active {
            color: var(--primary-color);
        }

        .navbar .nav-btn {
            margin-left: 0.5rem;
            padding: 0.5rem 1.25rem;
        }

        .user-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background-color: var(--primary-color);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 500;
            margin-right: 0.5rem;
        }

        /* Footer Styles */
        .footer {
            background-color: var(--footer-bg);
            color: white;
            padding: 3rem 0 1.5rem;
            margin-top: 3rem;
        }

        .footer-logo {
            font-weight: 700;
            font-size: 1.5rem;
            color: white;
            margin-bottom: 1rem;
            display: inline-block;
            text-decoration: none;
        }

        .footer-logo span {
            color: var(--secondary-color);
        }

        .footer h5 {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 1.25rem;
            color: white;
        }

        .footer-links {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .footer-links li {
            margin-bottom: 0.75rem;
        }

        .footer-links a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .footer-links a:hover {
            color: white;
            text-decoration: underline;
        }

        .social-links {
            display: flex;
            gap: 1rem;
            margin-top: 1.5rem;
        }

        .social-links a {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
            transition: all 0.2s ease;
        }

        .social-links a:hover {
            background-color: var(--primary-color);
            transform: translateY(-3px);
        }

        hr {
            border-color: rgba(255, 255, 255, 0.1);
        }

        /* Section Titles */
        .section-title {
            font-weight: 700;
            margin-bottom: 1rem;
            color: var(--text-dark);
        }

        /* Fix for the register-selection page */
        .grid {
            display: grid;
        }

        .grid-cols-1 {
            grid-template-columns: repeat(1, minmax(0, 1fr));
        }

        @media (min-width: 768px) {
            .md\:grid-cols-2 {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        .gap-6 {
            gap: 1.5rem;
        }

        .flex {
            display: flex;
        }

        .flex-col {
            flex-direction: column;
        }

        .items-center {
            align-items: center;
        }

        .text-center {
            text-align: center;
        }

        .w-full {
            width: 100%;
        }

        .font-medium {
            font-weight: 500;
        }

        .text-lg {
            font-size: 1.125rem;
        }

        .mb-2 {
            margin-bottom: 0.5rem;
        }

        .mb-4 {
            margin-bottom: 1rem;
        }

        .mb-6 {
            margin-bottom: 1.5rem;
        }

        .mb-8 {
            margin-bottom: 2rem;
        }

        .text-sm {
            font-size: 0.875rem;
        }

        .mt-8 {
            margin-top: 2rem;
        }

        .pt-4 {
            padding-top: 1rem;
        }

        .p-6 {
            padding: 1.5rem;
        }

        .border-t {
            border-top-width: 1px;
        }

        /* Media queries */
        @media (max-width: 768px) {
            .navbar-brand {
                font-size: 1.3rem;
            }

            .hero-section h1 {
                font-size: 2rem;
            }
        }
    </style>

    @stack('styles')
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container">
                <!-- Brand Logo -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    Intern<span>Connect</span>
                </a>

                <!-- Mobile Toggle Button -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
                    aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Navigation Links -->
                <div class="collapse navbar-collapse" id="navbarContent">
                    <!-- Left Side Navigation -->
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('/') ? 'active' : '' }}"
                                href="{{ url('/') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('internships*') ? 'active' : '' }}"
                                href="{{ route('internships.index') }}">Internships</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('companies*') ? 'active' : '' }}"
                                href="{{ route('companies.index') }}">Companies</a>
                        </li>
                    </ul>

                    <!-- Right Side Navigation -->
                    <ul class="navbar-nav">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="btn btn-outline-primary nav-btn"
                                        href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register.step1'))
                                <li class="nav-item">
                                    <a class="btn btn-primary nav-btn"
                                        href="{{ route('register.step1') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle d-flex align-items-center"
                                    href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    <div class="user-avatar">
                                        {{ substr(Auth::user()->first_name ?? 'U', 0, 1) }}
                                    </div>
                                    <span>{{ Auth::user()->first_name ?? Auth::user()->name }}</span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    @if (Auth::guard('company')->check() || (Auth::check() && Auth::user()->company))
                                        <a class="dropdown-item" href="{{ route('applications.index') }}">
                                            <i class="fas fa-clipboard-list fa-fw me-2"></i>
                                            {{ __('Applications') }}
                                        </a>
                                    @elseif (Auth::check())
                                        <a class="dropdown-item" href="{{ route('applications.index') }}">
                                            <i class="fas fa-briefcase fa-fw me-2"></i>
                                            {{ __('My Applications') }}
                                        </a>
                                    @endif

                                    <a class="dropdown-item" href="{{ route('profile.show') }}">
                                        <i class="fas fa-user fa-fw me-2"></i>
                                        {{ __('My Profile') }}
                                    </a>

                                    <div class="dropdown-divider"></div>

                                    <!-- Direct logout form button instead of a link with JavaScript -->
                                    <form action="{{ route('logout') }}" method="POST" class="dropdown-item p-0">
                                        @csrf
                                        <button type="submit" class="dropdown-item"
                                            style="border: none; background: none; width: 100%; text-align: left;">
                                            <i class="fas fa-sign-out-alt fa-fw me-2"></i>
                                            {{ __('Logout') }}
                                        </button>
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <a href="{{ url('/') }}" class="footer-logo">Intern<span>Connect</span></a>
                    <p class="mb-4">Connecting talented students with great companies for meaningful internship
                        experiences that launch successful careers.</p>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>

                <div class="col-lg-2 col-md-6 mt-md-0 mt-4">
                    <h5>For Students</h5>
                    <ul class="footer-links">
                        <li><a href="{{ route('internships.index') }}">Browse Internships</a></li>
                        <li><a href="{{ route('companies.index') }}">Companies</a></li>
                        <li><a href="#">Career Resources</a></li>
                        <li><a href="#">CV Builder</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-md-6 mt-lg-0 mt-4">
                    <h5>For Companies</h5>
                    <ul class="footer-links">
                        <li><a href="#">Post Internships</a></li>
                        <li><a href="#">Find Talent</a></li>
                        <li><a href="#">Employer Resources</a></li>
                        <li><a href="#">Pricing</a></li>
                    </ul>
                </div>

                <div class="col-lg-4 col-md-6 mt-lg-0 mt-4">
                    <h5>Contact Us</h5>
                    <ul class="footer-links">
                        <li><i class="fas fa-map-marker-alt me-2"></i> Amman, Jordan</li>
                        <li><i class="fas fa-phone me-2"></i> +962 777 888 999</li>
                        <li><i class="fas fa-envelope me-2"></i> support@internconnect.com</li>
                    </ul>
                    <div class="mt-3">
                        <h5>Newsletter</h5>
                        <form class="d-flex mt-3">
                            <input type="email" class="form-control me-2" placeholder="Your email address">
                            <button type="submit" class="btn btn-secondary">Subscribe</button>
                        </form>
                    </div>
                </div>
            </div>

            <hr class="my-4">

            <div class="row">
                <div class="col-md-6">
                    <p class="mb-md-0">&copy; {{ date('Y') }} InternConnect. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <a href="#" class="me-3">Privacy Policy</a>
                    <a href="#" class="me-3">Terms of Service</a>
                    <a href="#">FAQ</a>
                </div>
            </div>
        </div>
    </footer>

    @stack('scripts')

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Modal initialization script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize all modals using Bootstrap's modal constructor
            var modalElements = document.querySelectorAll('.modal');
            if (typeof bootstrap !== 'undefined') {
                modalElements.forEach(function(modalElement) {
                    var modal = new bootstrap.Modal(modalElement);

                    // Store modal instance for later use
                    modalElement._bsModal = modal;
                });
            }

            // Add click handler for any button that opens a modal
            document.querySelectorAll('[data-bs-toggle="modal"]').forEach(function(button) {
                button.addEventListener('click', function(event) {
                    var targetSelector = button.getAttribute('data-bs-target');
                    var targetModal = document.querySelector(targetSelector);
                    if (targetModal && targetModal._bsModal) {
                        targetModal._bsModal.show();
                    } else if (typeof bootstrap !== 'undefined' && targetModal) {
                        var modal = new bootstrap.Modal(targetModal);
                        modal.show();
                    }
                });
            });
        });
    </script>
</body>

</html>
