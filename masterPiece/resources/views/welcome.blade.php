@extends('layouts.app')

@section('title', 'Find Your Perfect Internship')

@section('content')
    <!-- Hero Section -->
    <div class="hero-section py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <h1 class="display-4 fw-bold mb-4">Launch Your Career With The Right Internship</h1>
                    <p class="lead mb-4">Connect with top companies offering meaningful internship experiences that match
                        your skills and ambitions.</p>
                    <div class="d-flex gap-3 mb-5">
                        <a href="{{ route('register') }}" class="btn btn-primary btn-lg">Get Started</a>
                        <a href="{{ route('internships.index') }}" class="btn btn-outline-primary btn-lg">Browse
                            Internships</a>
                    </div>

                    <div class="d-flex align-items-center">
                        <div class="d-flex me-4">
                            <div class="me-2">
                                <span class="fs-4 fw-bold text-primary">1500+</span>
                                <p class="mb-0 small">Internships</p>
                            </div>
                            <div class="vr mx-3"></div>
                            <div class="me-2">
                                <span class="fs-4 fw-bold text-primary">800+</span>
                                <p class="mb-0 small">Companies</p>
                            </div>
                            <div class="vr mx-3"></div>
                            <div>
                                <span class="fs-4 fw-bold text-primary">5000+</span>
                                <p class="mb-0 small">Students</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 text-center">
                    <img src="https://img.freepik.com/free-vector/internship-job-training-illustration_23-2148753901.jpg"
                        alt="Internship Illustration" class="img-fluid rounded-4" style="max-height: 500px;">
                </div>
            </div>
        </div>
    </div>

    <!-- Search Section -->
    <div class="bg-light py-5">
        <div class="container">
            <div class="card border-0 shadow">
                <div class="card-body p-4">
                    <h2 class="section-title text-center mb-4">Find Your Perfect Internship</h2>

                    <!-- Main Search Box -->
                    <form action="{{ route('internships.index') }}" method="GET">
                        <div class="row g-3">
                            <div class="col-lg-4">
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0">
                                        <i class="fas fa-search text-muted"></i>
                                    </span>
                                    <input type="text" class="form-control border-start-0" name="keyword"
                                        placeholder="Keywords, job title, or company...">
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0">
                                        <i class="fas fa-building text-muted"></i>
                                    </span>
                                    <select class="form-select border-start-0" name="industry">
                                        <option value="">Field / Industry</option>
                                        <option value="technology">Technology & IT</option>
                                        <option value="business">Business & Finance</option>
                                        <option value="marketing">Marketing & Communications</option>
                                        <option value="healthcare">Healthcare</option>
                                        <option value="engineering">Engineering</option>
                                        <option value="education">Education</option>
                                        <option value="arts">Arts & Design</option>
                                        <option value="science">Science & Research</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0">
                                        <i class="fas fa-map-marker-alt text-muted"></i>
                                    </span>
                                    <select class="form-select border-start-0" name="location">
                                        <option value="">Location</option>
                                        <option value="remote">Remote</option>
                                        <option value="hybrid">Hybrid</option>
                                        <option value="onsite">On-site</option>
                                        <option value="amman">Amman</option>
                                        <option value="irbid">Irbid</option>
                                        <option value="aqaba">Aqaba</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-2">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="fas fa-search me-2"></i> Search
                                </button>
                            </div>
                        </div>

                        <div class="mt-3">
                            <a class="text-primary small" data-bs-toggle="collapse" href="#advancedFilters" role="button">
                                <i class="fas fa-sliders-h me-1"></i> Advanced Filters
                            </a>
                        </div>

                        <div class="collapse mt-3" id="advancedFilters">
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label class="form-label small fw-bold">Internship Type</label>
                                    <div class="d-flex flex-wrap gap-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="paid" id="paidCheck">
                                            <label class="form-check-label" for="paidCheck">Paid</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="unpaid" id="unpaidCheck">
                                            <label class="form-check-label" for="unpaidCheck">Unpaid</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="credit"
                                                id="creditCheck">
                                            <label class="form-check-label" for="creditCheck">For Academic Credit</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label small fw-bold">Duration</label>
                                    <select class="form-select" name="duration">
                                        <option value="">Any Duration</option>
                                        <option value="summer">Summer (2-3 months)</option>
                                        <option value="semester">Semester (3-4 months)</option>
                                        <option value="sixmonths">6 Months</option>
                                        <option value="year">1 Year</option>
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label small fw-bold">Start Date</label>
                                    <select class="form-select" name="start_date">
                                        <option value="">Any Start Date</option>
                                        <option value="immediate">Immediate</option>
                                        <option value="summer">Summer 2025</option>
                                        <option value="fall">Fall 2025</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Featured Internships -->
    <div class="py-5">
        <div class="container">
            <div class="row mb-4">
                <div class="col-12 text-center">
                    <h2 class="section-title">Featured Internships</h2>
                    <p class="text-muted">Explore top opportunities from leading companies</p>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <div class="company-logo me-3">
                                    <img src="https://logo.clearbit.com/microsoft.com" alt="Microsoft"
                                        class="img-fluid rounded" style="width: 50px; height: 50px; object-fit: contain;">
                                </div>
                                <div>
                                    <h5 class="card-title mb-0">Software Engineering Intern</h5>
                                    <p class="card-subtitle text-muted mb-0">Microsoft</p>
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="d-flex flex-wrap gap-2 mb-2">
                                    <span class="badge bg-light text-dark">
                                        <i class="fas fa-map-marker-alt me-1"></i> Remote
                                    </span>
                                    <span class="badge bg-light text-dark">
                                        <i class="far fa-clock me-1"></i> 3 months
                                    </span>
                                    <span class="badge bg-light text-dark">
                                        <i class="fas fa-dollar-sign me-1"></i> Paid
                                    </span>
                                </div>
                                <p class="card-text">Join our team to develop cutting-edge software solutions and gain
                                    hands-on experience with industry-leading technologies.</p>
                            </div>

                            <a href="#" class="btn btn-outline-primary w-100">View Details</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <div class="company-logo me-3">
                                    <img src="https://logo.clearbit.com/google.com" alt="Google"
                                        class="img-fluid rounded" style="width: 50px; height: 50px; object-fit: contain;">
                                </div>
                                <div>
                                    <h5 class="card-title mb-0">UX Design Intern</h5>
                                    <p class="card-subtitle text-muted mb-0">Google</p>
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="d-flex flex-wrap gap-2 mb-2">
                                    <span class="badge bg-light text-dark">
                                        <i class="fas fa-map-marker-alt me-1"></i> Hybrid
                                    </span>
                                    <span class="badge bg-light text-dark">
                                        <i class="far fa-clock me-1"></i> 6 months
                                    </span>
                                    <span class="badge bg-light text-dark">
                                        <i class="fas fa-dollar-sign me-1"></i> Paid
                                    </span>
                                </div>
                                <p class="card-text">Design meaningful user experiences for millions of users worldwide.
                                    Work with a team of talented designers on real products.</p>
                            </div>

                            <a href="#" class="btn btn-outline-primary w-100">View Details</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <div class="company-logo me-3">
                                    <img src="https://logo.clearbit.com/tesla.com" alt="Tesla"
                                        class="img-fluid rounded" style="width: 50px; height: 50px; object-fit: contain;">
                                </div>
                                <div>
                                    <h5 class="card-title mb-0">Mechanical Engineering Intern</h5>
                                    <p class="card-subtitle text-muted mb-0">Tesla</p>
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="d-flex flex-wrap gap-2 mb-2">
                                    <span class="badge bg-light text-dark">
                                        <i class="fas fa-map-marker-alt me-1"></i> On-site
                                    </span>
                                    <span class="badge bg-light text-dark">
                                        <i class="far fa-clock me-1"></i> 4 months
                                    </span>
                                    <span class="badge bg-light text-dark">
                                        <i class="fas fa-dollar-sign me-1"></i> Paid
                                    </span>
                                </div>
                                <p class="card-text">Work alongside engineers to design and test components for electric
                                    vehicles and contribute to sustainable transportation.</p>
                            </div>

                            <a href="#" class="btn btn-outline-primary w-100">View Details</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-4">
                <a href="{{ route('internships.index') }}" class="btn btn-outline-primary">
                    View All Internships <i class="fas fa-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- How It Works -->
    <div class="bg-light py-5">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12 text-center">
                    <h2 class="section-title">How InternMatch Works</h2>
                    <p class="text-muted">Your path to career success in three simple steps</p>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card border-0 h-100 text-center">
                        <div class="card-body">
                            <div class="icon-circle mx-auto mb-4 d-flex align-items-center justify-content-center"
                                style="width: 80px; height: 80px; background-color: rgba(67, 97, 238, 0.1); border-radius: 50%;">
                                <i class="fas fa-user-plus fa-2x text-primary"></i>
                            </div>
                            <h3 class="fs-4">1. Create Your Profile</h3>
                            <p class="text-muted">Sign up and build your profile showcasing your skills, experience, and
                                education. Upload your resume to speed up applications.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card border-0 h-100 text-center">
                        <div class="card-body">
                            <div class="icon-circle mx-auto mb-4 d-flex align-items-center justify-content-center"
                                style="width: 80px; height: 80px; background-color: rgba(33, 208, 124, 0.1); border-radius: 50%;">
                                <i class="fas fa-search fa-2x text-success"></i>
                            </div>
                            <h3 class="fs-4">2. Discover Opportunities</h3>
                            <p class="text-muted">Browse through thousands of internship listings or use our smart filters
                                to find opportunities that match your interests and career goals.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card border-0 h-100 text-center">
                        <div class="card-body">
                            <div class="icon-circle mx-auto mb-4 d-flex align-items-center justify-content-center"
                                style="width: 80px; height: 80px; background-color: rgba(247, 37, 133, 0.1); border-radius: 50%;">
                                <i class="fas fa-paper-plane fa-2x" style="color: #f72585;"></i>
                            </div>
                            <h3 class="fs-4">3. Apply and Connect</h3>
                            <p class="text-muted">Apply to positions with just a few clicks and track your application
                                status. Get notified when companies respond to your applications.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Featured Companies -->
    <div class="py-5">
        <div class="container">
            <div class="row mb-4">
                <div class="col-12 text-center">
                    <h2 class="section-title">Top Companies Hiring</h2>
                    <p class="text-muted">Partner with leading companies offering quality internship experiences</p>
                </div>
            </div>

            <div class="row row-cols-2 row-cols-sm-3 row-cols-md-6 g-4 justify-content-center">
                <div class="col text-center">
                    <div class="card border-0 h-100">
                        <div class="card-body">
                            <img src="https://logo.clearbit.com/google.com" alt="Google" class="img-fluid"
                                style="max-height: 60px;">
                        </div>
                    </div>
                </div>
                <div class="col text-center">
                    <div class="card border-0 h-100">
                        <div class="card-body">
                            <img src="https://logo.clearbit.com/microsoft.com" alt="Microsoft" class="img-fluid"
                                style="max-height: 60px;">
                        </div>
                    </div>
                </div>
                <div class="col text-center">
                    <div class="card border-0 h-100">
                        <div class="card-body">
                            <img src="https://logo.clearbit.com/amazon.com" alt="Amazon" class="img-fluid"
                                style="max-height: 60px;">
                        </div>
                    </div>
                </div>
                <div class="col text-center">
                    <div class="card border-0 h-100">
                        <div class="card-body">
                            <img src="https://logo.clearbit.com/apple.com" alt="Apple" class="img-fluid"
                                style="max-height: 60px;">
                        </div>
                    </div>
                </div>
                <div class="col text-center">
                    <div class="card border-0 h-100">
                        <div class="card-body">
                            <img src="https://logo.clearbit.com/tesla.com" alt="Tesla" class="img-fluid"
                                style="max-height: 60px;">
                        </div>
                    </div>
                </div>
                <div class="col text-center">
                    <div class="card border-0 h-100">
                        <div class="card-body">
                            <img src="https://logo.clearbit.com/meta.com" alt="Meta" class="img-fluid"
                                style="max-height: 60px;">
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-5">
                <a href="{{ route('companies.index') }}" class="btn btn-outline-primary">
                    View All Companies <i class="fas fa-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Testimonials -->
    {{-- <div class="bg-light py-5">
        <div class="container">
            <div class="row mb-4">
                <div class="col-12 text-center">
                    <h2 class="section-title">Success Stories</h2>
                    <p class="text-muted">Hear from students who launched their careers with InternMatch</p>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="mb-3 text-warning">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <p class="card-text mb-4">"InternMatch connected me with a software engineering internship at
                                Microsoft that truly aligned with my career goals. Three months later, I received a
                                full-time offer!"</p>
                            <div class="d-flex align-items-center">
                                <div class="user-avatar me-3">A</div>
                                <div>
                                    <h6 class="mb-0">Ahmad Khalid</h6>
                                    <p class="text-muted small mb-0">Computer Science Graduate</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="mb-3 text-warning">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <p class="card-text mb-4">"Finding an internship used to be stressful until I found
                                InternMatch. The platform made it easy to filter opportunities and apply to multiple
                                positions with just a few clicks."</p>
                            <div class="d-flex align-items-center">
                                <div class="user-avatar me-3">L</div>
                                <div>
                                    <h6 class="mb-0">Lina Saadi</h6>
                                    <p class="text-muted small mb-0">Marketing Student</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="mb-3 text-warning">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                            <p class="card-text mb-4">"As a company, we've found exceptional talent through InternMatch.
                                The platform allows us to showcase our culture and find students who are truly passionate
                                about what we do."</p>
                            <div class="d-flex align-items-center">
                                <div class="user-avatar me-3">M</div>
                                <div>
                                    <h6 class="mb-0">Mohammed Rami</h6>
                                    <p class="text-muted small mb-0">HR Manager at TechCorp</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Call to Action -->
    <div class="py-5 bg-primary text-white">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8 mb-4 mb-lg-0">
                    <h2 class="fw-bold">Ready to Start Your Professional Journey?</h2>
                    <p class="lead mb-0">Join thousands of students finding their dream internships on InternMatch.</p>
                </div>
                <div class="col-lg-4 text-lg-end">
                    <a href="{{ route('register') }}" class="btn btn-light btn-lg px-4">Sign Up Now</a>
                    <a href="{{ route('internships.index') }}" class="btn btn-outline-light btn-lg px-4 ms-2">Browse
                        Internships</a>
                </div>
            </div>
        </div>
    </div> --}}
@endsection
