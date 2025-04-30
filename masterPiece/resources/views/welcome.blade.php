<x-Layout>
    <div class="hero-section">
        <div class="container">
            <div class="search-container glass-card">
                <h2 class="search-title">Find Your Perfect Internship</h2>
                <p class="search-subtitle">Discover opportunities that match your skills and ambitions</p>

                <!-- Main Search Box -->
                <div class="search-box">
                    <div class="search-input-wrapper">
                        <i class="bi bi-search search-icon-left"></i>
                        <input type="text" class="form-control search-input"
                            placeholder="Search by keywords, job title, or company...">
                    </div>
                </div>

                <!-- Filter Row -->
                <div class="filter-row">
                    <!-- Field Filter -->
                    <div class="filter-item">
                        <div class="select-wrapper">
                            <select class="filter-select custom-select" id="fieldFilter">
                                <option value="">Field / Industry</option>
                                <option value="technology">Technology & IT</option>
                                <option value="business">Business & Finance</option>
                                <option value="marketing">Marketing & Communications</option>
                                <option value="healthcare">Healthcare</option>
                                <option value="engineering">Engineering</option>
                                <option value="education">Education</option>
                                <option value="arts">Arts & Design</option>
                                <option value="science">Science & Research</option>
                                <option value="legal">Legal</option>
                                <option value="nonprofit">Non-profit</option>
                            </select>
                            <i class="bi bi-chevron-down select-icon"></i>
                        </div>
                    </div>

                    <!-- Location Filter -->
                    <div class="filter-item">
                        <div class="select-wrapper">
                            <select class="filter-select custom-select" id="locationFilter">
                                <option value="">Location</option>
                                <option value="remote">Remote</option>
                                <option value="hybrid">Hybrid</option>
                                <option value="onsite">On-site</option>
                                <option value="newyork">New York</option>
                                <option value="sanfrancisco">San Francisco</option>
                                <option value="chicago">Chicago</option>
                                <option value="losangeles">Los Angeles</option>
                                <option value="boston">Boston</option>
                                <option value="seattle">Seattle</option>
                                <option value="austin">Austin</option>
                            </select>
                            <i class="bi bi-chevron-down select-icon"></i>
                        </div>
                    </div>

                    <!-- Duration Filter -->
                    <div class="filter-item">
                        <div class="select-wrapper">
                            <select class="filter-select custom-select" id="durationFilter">
                                <option value="">Duration</option>
                                <option value="summer">Summer Internship (2-3 months)</option>
                                <option value="semester">Semester (3-4 months)</option>
                                <option value="sixmonths">6 Months</option>
                                <option value="year">1 Year</option>
                                <option value="flexible">Flexible</option>
                            </select>
                            <i class="bi bi-chevron-down select-icon"></i>
                        </div>
                    </div>
                </div>

                <!-- Search Button -->
                <div class="search-button-container">
                    <button class="search-btn" type="button">
                        <i class="bi bi-search me-2"></i>Search Internships
                    </button>
                </div>

                <!-- Advanced Filters (Expandable) -->
                <div class="advanced-filters">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <span class="advanced-toggle" data-bs-toggle="collapse" data-bs-target="#advancedFilters">
                                <i class="bi bi-sliders me-2"></i> Advanced Filters
                            </span>
                            <a href="#" class="clear-filters"><i class="bi bi-x-circle me-1"></i>Clear all
                                filters</a>
                        </div>
                        <div>
                            <span class="results-counter">134 internships found</span>
                        </div>
                    </div>

                    <div class="collapse advanced-content" id="advancedFilters">
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="filter-label">Internship Type</label>
                                <div class="custom-checkbox-group">
                                    <div class="custom-checkbox">
                                        <input class="form-check-input" type="checkbox" id="paidCheck">
                                        <label class="form-check-label" for="paidCheck">Paid</label>
                                    </div>
                                    <div class="custom-checkbox">
                                        <input class="form-check-input" type="checkbox" id="unpaidCheck">
                                        <label class="form-check-label" for="unpaidCheck">Unpaid</label>
                                    </div>
                                    <div class="custom-checkbox">
                                        <input class="form-check-input" type="checkbox" id="creditCheck">
                                        <label class="form-check-label" for="creditCheck">For Academic Credit</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="filter-label">Experience Level</label>
                                <div class="custom-checkbox-group">
                                    <div class="custom-checkbox">
                                        <input class="form-check-input" type="checkbox" id="freshCheck">
                                        <label class="form-check-label" for="freshCheck">Freshman/Sophomore</label>
                                    </div>
                                    <div class="custom-checkbox">
                                        <input class="form-check-input" type="checkbox" id="juniorCheck">
                                        <label class="form-check-label" for="juniorCheck">Junior/Senior</label>
                                    </div>
                                    <div class="custom-checkbox">
                                        <input class="form-check-input" type="checkbox" id="gradCheck">
                                        <label class="form-check-label" for="gradCheck">Graduate Student</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="filter-label">Start Date</label>
                                <div class="custom-checkbox-group">
                                    <div class="custom-checkbox">
                                        <input class="form-check-input" type="checkbox" id="immediateCheck">
                                        <label class="form-check-label" for="immediateCheck">Immediate</label>
                                    </div>
                                    <div class="custom-checkbox">
                                        <input class="form-check-input" type="checkbox" id="summerCheck">
                                        <label class="form-check-label" for="summerCheck">Summer 2025</label>
                                    </div>
                                    <div class="custom-checkbox">
                                        <input class="form-check-input" type="checkbox" id="fallCheck">
                                        <label class="form-check-label" for="fallCheck">Fall 2025</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Active Filters -->
                    <div class="active-filters">
                        <div class="filter-tag">
                            <span>Technology & IT</span>
                            <i class="bi bi-x-circle"></i>
                        </div>
                        <div class="filter-tag">
                            <span>Remote</span>
                            <i class="bi bi-x-circle"></i>
                        </div>
                        <div class="filter-tag">
                            <span>3-4 months</span>
                            <i class="bi bi-x-circle"></i>
                        </div>
                        <div class="filter-tag">
                            <span>Paid</span>
                            <i class="bi bi-x-circle"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div style="text-align:center; " >
        <h1>Aaaaaaaaaaaaaaaaaaa</h1>
    </div>
    <div class="container container-cards mt-4">
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <div class="col">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex">
                            <div>
                                <img src="https://via.placeholder.com/50" class="card-img-top" alt="...">
                            </div>
                            <div class="d-flex flex-column ms-3">
                                <h5 class="card-title">FullStack Developer</h5>
                                <h6 class="card-subtitle mb-2 text-body-secondary">Orange</h6>
                            </div>
                        </div>

                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of
                            the card's content.</p>
                        <button type="button" class="search-btn">Easy Apply</button>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex">
                            <div>
                                <img src="https://via.placeholder.com/50" class="card-img-top" alt="...">
                            </div>
                            <div class="d-flex flex-column ms-3">
                                <h5 class="card-title">FullStack Developer</h5>
                                <h6 class="card-subtitle mb-2 text-body-secondary">Orange</h6>
                            </div>
                        </div>

                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of
                            the card's content.</p>
                        <button type="button" class="search-btn">Easy Apply</button>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex">
                            <div>
                                <img src="https://via.placeholder.com/50" class="card-img-top" alt="...">
                            </div>
                            <div class="d-flex flex-column ms-3">
                                <h5 class="card-title">FullStack Developer</h5>
                                <h6 class="card-subtitle mb-2 text-body-secondary">Orange</h6>
                            </div>
                        </div>

                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of
                            the card's content.</p>
                        <button type="button" class="search-btn">Easy Apply</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-Layout>
