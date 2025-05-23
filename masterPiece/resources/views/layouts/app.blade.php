<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Find the perfect internship opportunity or talented interns for your company">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'InternMatch') }} - @yield('title', 'Connect with Opportunities')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Inter:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Scripts & Styles -->
    @php
        $manifest = null;
        try {
            $manifest = json_decode(file_get_contents(public_path('build/manifest.json')), true);
        } catch (\Exception $e) {
            // Manifest not found, we'll use CDN fallbacks
        }
    @endphp

    @if ($manifest)
        @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @else
        <!-- Fallback when Vite assets are not available -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @endif

    <!-- Custom Styles -->
    <style>
        :root {
            --primary-color: #4361ee;
            --primary-dark: #3a56d4;
            --secondary-color: #21d07c;
            --secondary-dark: #1db86e;
            --accent-color: #f72585;
            --text-dark: #2b2d42;
            --text-light: #6c757d;
            --text-muted: #8d99ae;
            --background-light: #f8f9fa;
            --background-white: #ffffff;
            --border-color: #e9ecef;
            --success-color: #38b000;
            --warning-color: #ffb703;
            --danger-color: #d90429;
            --box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            --transition: all 0.3s ease;
        }

        html,
        body {
            height: 100%;
        }

        body {
            font-family: 'Inter', sans-serif;
            color: var(--text-dark);
            background-color: var(--background-light);
            line-height: 1.6;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            overflow-x: hidden;
            position: relative;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
        }

        .navbar {
            box-shadow: var(--box-shadow);
            padding: 15px 0;
            background-color: var(--background-white);
        }

        .navbar-brand {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            color: var(--primary-color);
            font-size: 1.5rem;
        }

        .navbar-brand span {
            color: var(--secondary-color);
        }

        .navbar-nav .nav-link {
            font-weight: 500;
            color: var(--text-dark);
            position: relative;
            margin: 0 10px;
            transition: var(--transition);
        }

        .navbar-nav .nav-link:hover {
            color: var(--primary-color);
        }

        .navbar-nav .nav-link.active {
            color: var(--primary-color);
        }

        .navbar-nav .nav-link.active:after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 0;
            width: 100%;
            height: 2px;
            background-color: var(--primary-color);
        }

        .nav-btn {
            padding: 8px 20px;
            border-radius: 50px;
            margin-left: 8px;
            font-weight: 500;
            transition: var(--transition);
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
            border-color: var(--primary-dark);
        }

        .btn-outline-primary {
            border-color: var(--primary-color);
            color: var(--primary-color);
        }

        .btn-outline-primary:hover {
            background-color: var(--primary-color);
            color: white;
        }

        .btn-secondary {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
        }

        .btn-secondary:hover {
            background-color: var(--secondary-dark);
            border-color: var(--secondary-dark);
        }

        .user-avatar {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            background-color: var(--primary-color);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 500;
            margin-right: 10px;
        }

        main {
            flex: 1 0 auto;
            /* Changed to flex: 1 0 auto for better cross-browser compatibility */
            display: flex;
            flex-direction: column;
            width: 100%;
            position: relative;
            z-index: 1;
        }

        .section-title {
            margin-bottom: 1.5rem;
            font-weight: 600;
            position: relative;
            display: inline-block;
        }

        .section-title:after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 60px;
            height: 3px;
            background-color: var(--primary-color);
        }

        .card {
            border: none;
            box-shadow: var(--box-shadow);
            transition: var(--transition);
            border-radius: 10px;
            overflow: hidden;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .footer {
            background-color: #2b2d42;
            color: white;
            padding: 3rem 0 1.5rem;
            width: 100%;
            margin-top: auto;
        }

        .footer-logo {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            font-size: 1.8rem;
            color: white;
            margin-bottom: 1rem;
            display: block;
        }

        .footer-logo span {
            color: var(--secondary-color);
        }

        .footer h5 {
            font-size: 1.1rem;
            margin-bottom: 1.2rem;
            position: relative;
        }

        .footer h5::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: -8px;
            width: 40px;
            height: 2px;
            background-color: var(--secondary-color);
        }

        .footer-links {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .footer-links li {
            margin-bottom: 0.8rem;
        }

        .footer-links a {
            color: #d1d1d1;
            text-decoration: none;
            transition: var(--transition);
        }

        .footer-links a:hover {
            color: var(--secondary-color);
            padding-left: 5px;
        }

        .social-links {
            margin-top: 1.5rem;
        }

        .social-links a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
            margin-right: 10px;
            transition: var(--transition);
        }

        .social-links a:hover {
            background-color: var(--primary-color);
            transform: translateY(-3px);
        }

        .dropdown-menu {
            border: none;
            box-shadow: var(--box-shadow);
            border-radius: 10px;
            padding: 1rem 0;
        }

        .dropdown-item {
            padding: 0.5rem 1.5rem;
            transition: var(--transition);
        }

        .dropdown-item:hover {
            background-color: rgba(67, 97, 238, 0.1);
            color: var(--primary-color);
        }

        .dashboard-sidebar {
            background-color: white;
            border-radius: 10px;
            box-shadow: var(--box-shadow);
            padding: 1.5rem;
            height: 100%;
        }

        .dashboard-sidebar .nav-link {
            color: var(--text-dark);
            padding: 0.8rem 1rem;
            border-radius: 5px;
            margin-bottom: 0.5rem;
            transition: var(--transition);
        }

        .dashboard-sidebar .nav-link:hover {
            background-color: rgba(67, 97, 238, 0.1);
            color: var(--primary-color);
        }

        .dashboard-sidebar .nav-link.active {
            background-color: var(--primary-color);
            color: white;
        }

        .dashboard-sidebar .nav-link i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }

        /* Mobile & Responsive Styles */
        @media (max-width: 768px) {
            .navbar-brand {
                font-size: 1.3rem;
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
                    Intern<span>Match</span>
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

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="btn btn-primary nav-btn"
                                        href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle d-flex align-items-center"
                                    href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false" v-pre>
                                    <div class="user-avatar">
                                        {{ substr(Auth::user()->first_name ?? 'U', 0, 1) }}
                                    </div>
                                    <span>{{ Auth::user()->first_name ?? Auth::user()->name }}</span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    @if (Auth::guard('company')->check())
                                        <a class="dropdown-item" href="{{ route('company.dashboard') }}">
                                            <i class="fas fa-tachometer-alt fa-fw me-2"></i>
                                            {{ __('Dashboard') }}
                                        </a>
                                    @endif

                                    <a class="dropdown-item" href="{{ route('profile.show') }}">
                                        <i class="fas fa-user fa-fw me-2"></i>
                                        {{ __('My Profile') }}
                                    </a>

                                    @if (!Auth::guard('company')->check())
                                        <a class="dropdown-item" href="{{ route('applications.index') }}">
                                            <i class="fas fa-briefcase fa-fw me-2"></i>
                                            {{ __('My Applications') }}
                                        </a>
                                    @endif

                                    <div class="dropdown-divider"></div>

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt fa-fw me-2"></i>
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
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
                    <a href="{{ url('/') }}" class="footer-logo">Intern<span>Match</span></a>
                    <p class="mb-4">Connecting talented students with great companies for meaningful internship
                        experiences
                        that launch successful careers.</p>
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
                        <li><a href="#">Browse Internships</a></li>
                        <li><a href="#">Companies</a></li>
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
                        <li><i class="fas fa-envelope me-2"></i> support@internmatch.com</li>
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

            <hr class="my-4" style="background-color: rgba(255,255,255,0.1);">

            <div class="row">
                <div class="col-md-6">
                    <p class="mb-md-0">&copy; {{ date('Y') }} InternMatch. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <a href="#" class="text-white me-3">Privacy Policy</a>
                    <a href="#" class="text-white me-3">Terms of Service</a>
                    <a href="#" class="text-white">FAQ</a>
                </div>
            </div>
        </div>
    </footer>

    @stack('scripts')

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
