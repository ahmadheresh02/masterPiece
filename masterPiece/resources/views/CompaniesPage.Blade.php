<x-layout>
    <style>
    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    /* Companies Search Section */
    .companies-search-section {
        background-color: #f9fafb;
        padding: 40px 0;
        border-bottom: 1px solid var(--border-color);
    }

    .search-header {
        margin-bottom: 20px;
    }

    .search-title {
        font-size: 2rem;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 8px;
    }

    .search-description {
        text-align: center;
        color: var(--text-light);
        margin-bottom: 20px;
    }

    .company-search-box {
        display: flex;
        margin-bottom: 20px;
    }

    .company-search-input {
        flex: 1;
        padding: 12px 16px;
        border: 2px solid var(--border-color);
        border-radius: 8px 0 0 8px;
        font-size: 1rem;
        transition: all 0.3s ease;
    }

    .company-search-input:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 4px rgba(10, 102, 194, 0.1);
        outline: none;
    }

    .company-search-btn {
        background-color: var(--primary-color);
        color: white;
        border: none;
        border-radius: 0 8px 8px 0;
        padding: 12px 20px;
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .company-search-btn:hover {
        background-color: var(--primary-hover);
    }

    /* Filter Bar */
    .filter-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin: 30px 0 20px;
    }

    .section-title {
        font-size: 1.5rem;
        font-weight: 600;
        margin: 0;
    }

    .filter-group {
        display: flex;
        gap: 10px;
    }

    .filter-dropdown {
        position: relative;
        display: inline-block;
    }

    .filter-dropdown-btn {
        background-color: white;
        border: 1px solid var(--border-color);
        border-radius: 8px;
        padding: 8px 16px;
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        gap: 6px;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .filter-dropdown-btn:hover {
        border-color: var(--primary-color);
        color: var(--primary-color);
    }

    /* Company Cards Section */
    .featured-companies {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 20px;
        margin-bottom: 40px;
    }

    .company-card {
        background-color: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: var(--card-shadow);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: 1px solid var(--border-color);
    }

    .company-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
    }

    .company-card-content {
        padding: 20px;
    }

    .company-card-header {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
    }

    .company-logo {
        width: 50px;
        height: 50px;
        background-color: #f3f3f3;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        font-weight: bold;
        color: var(--primary-color);
        margin-right: 15px;
    }

    .company-info h3 {
        margin: 0 0 4px 0;
        font-size: 1.2rem;
    }

    .company-location {
        color: var(--text-light);
        font-size: 0.9rem;
        margin: 0;
    }

    .company-tags {
        display: flex;
        gap: 8px;
        margin: 12px 0;
        flex-wrap: wrap;
    }

    .company-tag {
        background-color: var(--tag-bg);
        color: var(--primary-color);
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 500;
    }

    .open-positions {
        font-size: 0.9rem;
        color: var(--secondary-color);
        font-weight: 500;
        margin-bottom: 15px;
    }

    .view-profile-btn {
        background-color: var(--primary-color);
        color: white;
        border: none;
        border-radius: 8px;
        padding: 8px 16px;
        font-size: 0.9rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .view-profile-btn:hover {
        background-color: var(--primary-hover);
    }

    .bookmark-btn {
        background-color: transparent;
        border: 1px solid var(--border-color);
        border-radius: 8px;
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        margin-left: 10px;
        transition: all 0.2s ease;
    }

    .bookmark-btn:hover {
        border-color: var(--primary-color);
        color: var(--primary-color);
    }

    .company-actions {
        display: flex;
        align-items: center;
    }

    /* Top Rated Companies Section */
    .top-rated-companies {
        margin-top: 40px;
        margin-bottom: 60px;
    }

    .ranked-company {
        display: flex;
        align-items: center;
        background-color: white;
        border-radius: 12px;
        padding: 15px;
        margin-bottom: 15px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .ranked-company:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
    }

    .company-rank {
        font-size: 1.2rem;
        font-weight: 700;
        color: var(--primary-color);
        width: 40px;
        text-align: center;
    }

    .ranked-company-logo {
        width: 40px;
        height: 40px;
        background-color: #f3f3f3;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        font-weight: bold;
        color: var(--primary-color);
        margin: 0 15px;
    }

    .ranked-company-info {
        flex: 1;
    }

    .ranked-company-name {
        font-weight: 600;
        margin: 0 0 2px 0;
    }

    .company-rating {
        display: flex;
        align-items: center;
        font-size: 0.9rem;
        color: var(--text-light);
    }

    .star-icon {
        color: #FFB400;
        margin-right: 4px;
    }

    .review-count {
        color: var(--text-light);
        margin-left: 5px;
    }

    .positions-count {
        text-align: right;
        margin-left: 20px;
    }

    .position-number {
        font-weight: 600;
        color: var(--text-dark);
    }

    .view-details-link {
        color: var(--primary-color);
        text-decoration: none;
        font-size: 0.9rem;
        font-weight: 500;
        transition: color 0.2s ease;
    }

    .view-details-link:hover {
        text-decoration: underline;
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .featured-companies {
            grid-template-columns: 1fr;
        }

        .filter-bar {
            flex-direction: column;
            align-items: flex-start;
            gap: 15px;
        }

        .filter-group {
            width: 100%;
            justify-content: space-between;
        }

        .company-search-box {
            flex-direction: column;
        }

        .company-search-input {
            border-radius: 8px;
            margin-bottom: 10px;
        }

        .company-search-btn {
            border-radius: 8px;
        }
    }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>
<body>
    <!-- Company Search Section -->
    <section class="companies-search-section">
        <div class="container">
            <div class="search-header">
                <h1 class="search-title">Find Great Companies</h1>
                <p class="search-description">Discover companies offering internship opportunities and start your career journey.</p>

                <div class="company-search-box">
                    <input type="text" class="company-search-input" placeholder="Search companies...">
                    <button class="company-search-btn">Search</button>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Companies Section -->
    <section class="container">
        <div class="filter-bar">
            <h2 class="section-title">Featured Companies</h2>

            <div class="filter-group">
                <div class="filter-dropdown">
                    <button class="filter-dropdown-btn">
                        Industry <i class="bi bi-chevron-down"></i>
                    </button>
                </div>

                <div class="filter-dropdown">
                    <button class="filter-dropdown-btn">
                        Location <i class="bi bi-chevron-down"></i>
                    </button>
                </div>
            </div>
        </div>

        <div class="featured-companies">
            <!-- Company Card 1 -->
            <div class="company-card">
                <div class="company-card-content">
                    <div class="company-card-header">
                        <div class="company-logo">G</div>
                        <div class="company-info">
                            <h3>Google</h3>
                            <p class="company-location">Mountain View, CA</p>
                        </div>
                    </div>

                    <div class="company-tags">
                        <span class="company-tag">Tech</span>
                        <span class="company-tag">Fortune 500</span>
                    </div>

                    <p class="open-positions">15 open positions</p>

                    <div class="company-actions">
                        <button class="view-profile-btn">View Profile</button>
                        <button class="bookmark-btn">
                            <i class="bi bi-bookmark"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Company Card 2 -->
            <div class="company-card">
                <div class="company-card-content">
                    <div class="company-card-header">
                        <div class="company-logo">M</div>
                        <div class="company-info">
                            <h3>Microsoft</h3>
                            <p class="company-location">Redmond, WA</p>
                        </div>
                    </div>

                    <div class="company-tags">
                        <span class="company-tag">Tech</span>
                        <span class="company-tag">Fortune 500</span>
                    </div>

                    <p class="open-positions">23 open positions</p>

                    <div class="company-actions">
                        <button class="view-profile-btn">View Profile</button>
                        <button class="bookmark-btn">
                            <i class="bi bi-bookmark"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Company Card 3 -->
            <div class="company-card">
                <div class="company-card-content">
                    <div class="company-card-header">
                        <div class="company-logo">M</div>
                        <div class="company-info">
                            <h3>Meta</h3>
                            <p class="company-location">Menlo Park, CA</p>
                        </div>
                    </div>

                    <div class="company-tags">
                        <span class="company-tag">Tech</span>
                        <span class="company-tag">Fortune 500</span>
                    </div>

                    <p class="open-positions">18 open positions</p>

                    <div class="company-actions">
                        <button class="view-profile-btn">View Profile</button>
                        <button class="bookmark-btn">
                            <i class="bi bi-bookmark"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Top Rated Companies Section -->
        <div class="top-rated-companies">
            <div class="filter-bar">
                <h2 class="section-title">Top Rated Companies</h2>
            </div>

            <!-- Ranked Company 1 -->
            <div class="ranked-company">
                <div class="company-rank">#1</div>
                <div class="ranked-company-logo">A</div>
                <div class="ranked-company-info">
                    <h3 class="ranked-company-name">Apple</h3>
                    <div class="company-rating">
                        <i class="bi bi-star-fill star-icon"></i>
                        4.8 <span class="review-count">(2,345 reviews)</span>
                    </div>
                </div>
                <div class="positions-count">
                    <div class="position-number">12 positions</div>
                    <a href="#" class="view-details-link">View Details</a>
                </div>
            </div>

            <!-- Ranked Company 2 -->
            <div class="ranked-company">
                <div class="company-rank">#2</div>
                <div class="ranked-company-logo">A</div>
                <div class="ranked-company-info">
                    <h3 class="ranked-company-name">Amazon</h3>
                    <div class="company-rating">
                        <i class="bi bi-star-fill star-icon"></i>
                        4.7 <span class="review-count">(1,987 reviews)</span>
                    </div>
                </div>
                <div class="positions-count">
                    <div class="position-number">28 positions</div>
                    <a href="#" class="view-details-link">View Details</a>
                </div>
            </div>

            <!-- Ranked Company 3 -->
            <div class="ranked-company">
                <div class="company-rank">#3</div>
                <div class="ranked-company-logo">S</div>
                <div class="ranked-company-info">
                    <h3 class="ranked-company-name">Spotify</h3>
                    <div class="company-rating">
                        <i class="bi bi-star-fill star-icon"></i>
                        4.6 <span class="review-count">(1,456 reviews)</span>
                    </div>
                </div>
                <div class="positions-count">
                    <div class="position-number">8 positions</div>
                    <a href="#" class="view-details-link">View Details</a>
                </div>
            </div>
        </div>
    </section>

</x-layout>
