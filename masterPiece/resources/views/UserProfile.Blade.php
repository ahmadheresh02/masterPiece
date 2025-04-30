<x-Layout>
    <style>
        .card {
            min-width: 100%;
        }
    </style>
    <div class="container py-5">
        <!-- Profile Card -->
        <div class="card mb-4 shadow border-0 rounded-3" style="width: 100%;">
            <div class="card-body p-4">
                <div class="d-flex flex-column flex-md-row align-items-center align-items-md-start mb-3">
                    <div class="me-md-4 mb-3 mb-md-0 text-center">
                        <img src="img/prof.png" class="rounded-circle shadow-sm" alt="Profile picture" style="width: 150px;">
                    </div>
                    <div class="flex-grow-1 text-center text-md-start">
                        <h2 class="mb-2 fw-bold">Sarah Johnson</h2>
                        <div class="d-flex flex-wrap justify-content-center justify-content-md-start align-items-center mb-3">
                            <span class="badge bg-primary me-2 mb-2 py-2 px-3 rounded-pill">Software Engineer</span>
                            <span class="badge bg-secondary mb-2 py-2 px-3 rounded-pill">Student</span>
                        </div>
                        <p class="mb-3 text-muted">Computer Science student at Stanford University, passionate about AI and machine learning. Looking for Summer 2025 internship opportunities.</p>
                        <div>
                            <button class="btn btn-primary me-2">Edit Profile</button>
                            <button class="btn btn-outline-secondary">Share Profile</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-lg-8">
                <!-- About Section -->
                <div class="card mb-4 shadow-sm border-0 rounded-3">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h3 class="card-title mb-0 fw-bold">About</h3>
                        </div>
                        <p class="text-muted">Third-year Computer Science student with experience in full-stack development and machine learning. Previously interned at local tech startups. Seeking opportunities to apply my skills in a challenging environment.</p>
                    </div>
                </div>

                <!-- Experience Section -->
                <div class="card mb-4 shadow-sm border-0 rounded-3">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h3 class="card-title mb-0 fw-bold">Experience</h3>
                            <button class="btn btn-outline-primary btn-sm rounded-circle">
                                <i class="bi bi-plus"></i>
                            </button>
                        </div>

                        <!-- Experience Item 1 -->
                        <div class="mb-4 pb-4 border-bottom">
                            <div class="d-flex">
                                <div class="me-3">
                                    <div class="bg-light rounded-circle p-3 shadow-sm">
                                        <i class="bi bi-building"></i>
                                    </div>
                                </div>
                                <div>
                                    <h5 class="mb-1 fw-bold">Software Engineering Intern</h5>
                                    <h6 class="text-primary mb-1">TechStart Inc.</h6>
                                    <div class="text-muted mb-3 small"><i class="bi bi-calendar me-1"></i>Summer 2024</div>
                                    <p class="text-muted">Developed and maintained web applications using React and Node.js. Collaborated with senior developers on feature implementation.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Experience Item 2 -->
                        <div>
                            <div class="d-flex">
                                <div class="me-3">
                                    <div class="bg-light rounded-circle p-3 shadow-sm">
                                        <i class="bi bi-mortarboard"></i>
                                    </div>
                                </div>
                                <div>
                                    <h5 class="mb-1 fw-bold">Research Assistant</h5>
                                    <h6 class="text-primary mb-1">Stanford AI Lab</h6>
                                    <div class="text-muted mb-3 small"><i class="bi bi-calendar me-1"></i>2023 - Present</div>
                                    <p class="text-muted">Assisting in research projects focused on natural language processing and machine learning algorithms.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Education Section -->
                <div class="card mb-4 shadow-sm border-0 rounded-3">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h3 class="card-title mb-0 fw-bold">Education</h3>
                            <button class="btn btn-outline-primary btn-sm rounded-circle">
                                <i class="bi bi-plus"></i>
                            </button>
                        </div>

                        <div class="d-flex">
                            <div class="me-3">
                                <div class="bg-light rounded-circle p-3 shadow-sm">
                                    <i class="bi bi-mortarboard"></i>
                                </div>
                            </div>
                            <div>
                                <h5 class="mb-1 fw-bold">Stanford University</h5>
                                <h6 class="text-primary mb-1">BS Computer Science</h6>
                                <div class="text-muted small"><i class="bi bi-calendar me-1"></i>2022 - 2026 (Expected)</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <!-- Skills Section -->
                <div class="card mb-4 shadow-sm border-0 rounded-3">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h3 class="card-title mb-0 fw-bold">Skills</h3>
                            <button class="btn btn-outline-primary btn-sm rounded-circle">
                                <i class="bi bi-plus"></i>
                            </button>
                        </div>
                        <div class="d-flex flex-wrap gap-2">
                            <span class="badge bg-light text-dark border px-3 py-2 rounded-pill">Python</span>
                            <span class="badge bg-light text-dark border px-3 py-2 rounded-pill">JavaScript</span>
                            <span class="badge bg-light text-dark border px-3 py-2 rounded-pill">React</span>
                            <span class="badge bg-light text-dark border px-3 py-2 rounded-pill">Node.js</span>
                            <span class="badge bg-light text-dark border px-3 py-2 rounded-pill">Machine Learning</span>
                            <span class="badge bg-light text-dark border px-3 py-2 rounded-pill">Git</span>
                        </div>
                    </div>
                </div>

                <!-- Certifications -->
                <div class="card shadow-sm border-0 rounded-3">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h3 class="card-title mb-0 fw-bold">Certifications</h3>
                            <button class="btn btn-outline-primary btn-sm rounded-circle">
                                <i class="bi bi-plus"></i>
                            </button>
                        </div>
                        <div class="d-flex">
                            <div class="me-3">
                                <div class="bg-light rounded-circle p-3 shadow-sm">
                                    <i class="bi bi-award"></i>
                                </div>
                            </div>
                            <div>
                                <h5 class="mb-1 fw-bold">AWS Certified Cloud Practitioner</h5>
                                <div class="text-muted small"><i class="bi bi-calendar me-1"></i>Issued Dec 2024</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-Layout>
