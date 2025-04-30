<x-Layout>
    <!-- Company Profile Header -->
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center">
                            <div class="company-logo bg-light rounded p-3 me-3" style="width: 100px; height: 100px; display: flex; align-items: center; justify-content: center;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-building text-secondary" viewBox="0 0 16 16">
                                    <path d="M4 2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm3.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1zM4 5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm3.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1zM4 8.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm3.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1z"/>
                                    <path d="M2 1a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V1zm11 0H3v14h10V1z"/>
                                </svg>
                            </div>
                            <div class="ms-3">
                                <h2 class="mb-1">TechNova</h2>
                                <p class="text-muted mb-2">San Francisco, California</p>
                                <div class="d-flex align-items-center mb-3">
                                    <span class="badge bg-light text-dark me-2">Technology</span>
                                    <span class="badge bg-light text-dark me-2">Fortune 500</span>
                                    <span class="badge bg-light text-dark">500+ Employees</span>
                                </div>
                                <p class="mb-0">TechNova's mission is to revolutionize digital experiences and create innovative solutions for the modern world.</p>
                            </div>
                            <div class="ms-auto">
                                <button class="btn btn-dark me-2">Follow</button>
                                {{-- <button class="btn btn-outline-dark">Share Profile</button> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Company Stats -->
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center">
                        <p class="text-muted mb-1">Open Positions</p>
                        <h3 class="mb-0">12</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center">
                        <p class="text-muted mb-1">Avg. Rating</p>
                        <h3 class="mb-0">4.7 ★</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center">
                        <p class="text-muted mb-1">Reviews</p>
                        <h3 class="mb-0">1,245</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center">
                        <p class="text-muted mb-1">Hire Rate</p>
                        <h3 class="mb-0">78%</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Company Navigation -->
    {{-- <div class="container mt-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-0">
                <ul class="nav nav-tabs border-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Open Positions</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Reviews</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Life at TechNova</a>
                    </li>
                </ul>
            </div>
        </div>
    </div> --}}

    <!-- Company Details -->
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-8">
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <h4>About TechNova</h4>
                        <p>TechNova is a multinational technology company specializing in internet-related services and products, which include cloud computing, artificial intelligence, software development, and digital marketing solutions.</p>
                        <p>Our commitment to innovation depends on everyone being comfortable sharing their ideas and opinions.</p>

                        <h4 class="mt-4">Internship Program Overview</h4>
                        <div class="mt-3">
                            <div class="d-flex align-items-center mb-3">
                                <div class="me-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16">
                                        <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z"/>
                                        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="fw-bold mb-0">Duration</p>
                                    <p class="mb-0">12-16 weeks, Full-time</p>
                                </div>
                            </div>

                            <div class="d-flex align-items-center mb-3">
                                <div class="me-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-geo-alt" viewBox="0 0 16 16">
                                        <path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A31.493 31.493 0 0 1 8 14.58a31.481 31.481 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94zM8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10z"/>
                                        <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="fw-bold mb-0">Locations</p>
                                    <p class="mb-0">Multiple locations across US</p>
                                </div>
                            </div>

                            <div class="d-flex align-items-center">
                                <div class="me-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-gift" viewBox="0 0 16 16">
                                        <path d="M3 2.5a2.5 2.5 0 0 1 5 0 2.5 2.5 0 0 1 5 0v.006c0 .07 0 .27-.038.494H15a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1v7.5a1.5 1.5 0 0 1-1.5 1.5h-11A1.5 1.5 0 0 1 1 14.5V7a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h2.038A2.968 2.968 0 0 1 3 2.506V2.5zm1.068.5H7v-.5a1.5 1.5 0 1 0-3 0c0 .085.002.274.045.43a.522.522 0 0 0 .023.07zM9 3h2.932a.56.56 0 0 0 .023-.07c.043-.156.045-.345.045-.43a1.5 1.5 0 0 0-3 0V3zM1 4v2h6V4H1zm8 0v2h6V4H9zm5 3H9v8h4.5a.5.5 0 0 0 .5-.5V7zm-7 8V7H2v7.5a.5.5 0 0 0 .5.5H7z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="fw-bold mb-0">Benefits</p>
                                    <p class="mb-0">Competitive salary, housing stipend, meals</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <h4>Company Details</h4>

                        <div class="mt-3">
                            <p class="fw-bold mb-1">Website</p>
                            <p class="mb-3">www.technova.com</p>

                            <p class="fw-bold mb-1">Industry</p>
                            <p class="mb-3">Technology, Internet Services</p>

                            <p class="fw-bold mb-1">Company Size</p>
                            <p class="mb-3">500+ employees</p>

                            <p class="fw-bold mb-1">Founded</p>
                            <p class="mb-3">2010</p>

                            <h5 class="mt-4 mb-3">Social Media</h5>
                            <div class="d-flex">
                                <a href="#" class="me-2 text-dark">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-linkedin" viewBox="0 0 16 16">
                                        <path d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854V1.146zm4.943 12.248V6.169H2.542v7.225h2.401zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248-.822 0-1.359.54-1.359 1.248 0 .694.521 1.248 1.327 1.248h.016zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016a5.54 5.54 0 0 1 .016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225h2.4z"/>
                                    </svg>
                                </a>
                                <a href="#" class="me-2 text-dark">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-twitter-x" viewBox="0 0 16 16">
                                        <path d="M12.6.75h2.454l-5.36 6.142L16 15.25h-4.937l-3.867-5.07-4.425 5.07H.316l5.733-6.57L0 .75h5.063l3.495 4.633L12.601.75Zm-.86 13.028h1.36L4.323 2.145H2.865l8.875 11.633Z"/>
                                    </svg>
                                </a>
                                <a href="#" class="text-dark">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16">
                                        <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Available Internships -->
    <div class="container mt-4 mb-5">
        <h3 class="mb-4">Available Internships</h3>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <!-- Internship Card 1 -->
            <div class="col">
                <div class="card h-100 card-shadow">
                    <div class="card-body">
                        <div class="d-flex">
                            <div>
                                <img src="/api/placeholder/50/50" class="card-img-top" alt="TechNova Logo">
                            </div>
                            <div class="d-flex flex-column ms-3">
                                <h5 class="card-title">Backend Developer</h5>
                                <h6 class="card-subtitle mb-2 text-body-secondary">TechNova</h6>
                            </div>
                        </div>
                        <p class="card-text mt-3">Join our backend team to develop scalable services using Java, Spring Boot, and AWS. Perfect for CS students interested in cloud architecture.</p>
                        <button type="button" class="search-btn">Easy Apply</button>
                    </div>
                </div>
            </div>

            <!-- Internship Card 2 -->
            <div class="col">
                <div class="card h-100 card-shadow">
                    <div class="card-body">
                        <div class="d-flex">
                            <div>
                                <img src="/api/placeholder/50/50" class="card-img-top" alt="TechNova Logo">
                            </div>
                            <div class="d-flex flex-column ms-3">
                                <h5 class="card-title">UI/UX Designer</h5>
                                <h6 class="card-subtitle mb-2 text-body-secondary">TechNova</h6>
                            </div>
                        </div>
                        <p class="card-text mt-3">Create intuitive user experiences for our web and mobile applications. Strong portfolio and knowledge of Figma and Adobe XD required.</p>
                        <button type="button" class="search-btn">Easy Apply</button>
                    </div>
                </div>
            </div>

            <!-- Internship Card 3 -->
            <div class="col">
                <div class="card h-100 card-shadow">
                    <div class="card-body">
                        <div class="d-flex">
                            <div>
                                <img src="/api/placeholder/50/50" class="card-img-top" alt="TechNova Logo">
                            </div>
                            <div class="d-flex flex-column ms-3">
                                <h5 class="card-title">Data Scientist</h5>
                                <h6 class="card-subtitle mb-2 text-body-secondary">TechNova</h6>
                            </div>
                        </div>
                        <p class="card-text mt-3">Analyze large datasets to extract actionable insights using Python, R, and various ML frameworks. Background in statistics or computer science preferred.</p>
                        <button type="button" class="search-btn">Easy Apply</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- CSS specifically for this page -->
    <style>
        .nav-tabs .nav-link {
            border: none;
            color: var(--text-light);
            padding: 15px 20px;
            font-weight: 500;
        }

        .nav-tabs .nav-link.active {
            color: var(--primary-color);
            border-bottom: 2px solid var(--primary-color);
            background: transparent;
        }

        .badge {
            font-weight: 500;
            padding: 6px 12px;
        }

        .search-btn {
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 5px;
            padding: 8px 16px;
            transition: all 0.3s ease;
        }

        .search-btn:hover {
            background-color: var(--primary-color-dark);
            transform: translateY(-2px);
        }

        .card {
            transition: all 0.3s ease;
            width: 100%;
        }

        .card-shadow {
            box-shadow: none;
        }

        /* .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1) !important;
        } */
    </style>
</x-Layout>
