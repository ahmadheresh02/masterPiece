<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Company Portal') | Internship Portal</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Custom Button Styles -->
    <link href="{{ asset('css/buttons.css') }}" rel="stylesheet">

    <!-- Custom Styles -->
    <style>
        :root {
            --primary-color: #2563eb;
            --secondary-color: #1e40af;
            --success-color: #16a34a;
            --warning-color: #eab308;
            --danger-color: #dc2626;
            --light-bg: #f9fafb;
            --dark-bg: #1f2937;
            --card-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            --card-shadow-hover: 0 10px 15px rgba(0, 0, 0, 0.1);
        }

        body {
            background-color: var(--light-bg);
            font-family: 'Figtree', sans-serif;
        }

        /* Card Styles */
        .card {
            border: none !important;
            border-radius: 10px !important;
            box-shadow: var(--card-shadow) !important;
            transition: all 0.3s ease !important;
            margin-bottom: 20px;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: var(--card-shadow-hover) !important;
        }

        .card-body {
            padding: 1.5rem !important;
        }

        /* Stats Cards */
        .dashboard-stat-card {
            height: 100%;
        }

        .dashboard-stat-card .card-body {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        /* Section Titles */
        .section-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #333;
            margin-bottom: 1.5rem;
            position: relative;
            padding-bottom: 0.75rem;
        }

        .section-title:after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 50px;
            height: 3px;
            background-color: var(--primary-color);
        }

        /* User Avatar */
        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: var(--primary-color);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
        }

        /* Badge Styles */
        .badge {
            padding: 0.5rem 0.8rem !important;
            font-weight: 500 !important;
        }

        /* Table Styles */
        .table {
            border-collapse: separate;
            border-spacing: 0;
        }

        .table thead th {
            font-weight: 600;
            border-bottom: 1px solid #e9ecef;
        }

        .table tbody tr:hover {
            background-color: #f8f9fa;
        }

        /* Company header styles */
        .company-header {
            background-color: #fff;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
            padding: 1rem 0;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .company-logo {
            width: 50px;
            height: 50px;
            object-fit: contain;
        }

        .logout-btn {
            background-color: transparent;
            border: 1px solid #ddd;
            color: #666;
            transition: all 0.3s ease;
        }

        .logout-btn:hover {
            background-color: #f1f1f1;
            color: #333;
        }
    </style>

    @stack('styles')
</head>

<body>
    <!-- Simple Company Header -->
    <header class="company-header">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    @if (Auth::check() && Auth::user()->company && Auth::user()->company->logo_url)
                        <img src="{{ Auth::user()->company->logo_url }}" alt="Company Logo" class="company-logo me-3">
                    @elseif(Auth::guard('company')->check() && Auth::guard('company')->user()->logo_url)
                        <img src="{{ Auth::guard('company')->user()->logo_url }}" alt="Company Logo"
                            class="company-logo me-3">
                    @else
                        <div class="user-avatar me-3">
                            {{ substr(Auth::guard('company')->check() ? Auth::guard('company')->user()->name : (Auth::user()->company ? Auth::user()->company->name : 'C'), 0, 1) }}
                        </div>
                    @endif
                    <div>
                        <h1 class="h5 mb-0">
                            {{ Auth::guard('company')->check() ? Auth::guard('company')->user()->name : (Auth::user()->company ? Auth::user()->company->name : 'Company Portal') }}
                        </h1>
                        <small class="text-muted">Company Portal</small>
                    </div>
                </div>
                <div>
                    <!-- Logout Button -->
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-sm logout-btn">
                            <i class="bi bi-box-arrow-right me-1"></i> Sign Out
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="bg-white py-4 mt-5 border-top">
        <div class="container">
            <div class="text-center text-muted">
                <p class="mb-0">&copy; {{ date('Y') }} Internship Portal. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')
</body>

</html>
