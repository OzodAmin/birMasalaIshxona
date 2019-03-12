<header id="header-container" class="fullwidth">
    <div id="header">
        <div class="container">
            <div class="left-side">
                <div id="logo">
                    <a href="{{ url('/') }}">
                        <img src="{{ asset('front/img/logo.png') }}" alt="IMG-LOGO">
                    </a>
                </div>
                <nav id="navigation">
                    <ul id="responsive">
                        <li>
                            <a href="#">Find Work</a>
                            <ul class="dropdown-nav">
                                <li><a href="#">Browse Jobs</a>
                                    <ul class="dropdown-nav">
                                        <li><a href="jobs-list-layout-full-page-map.html">Full Page List + Map</a>
                                        </li>
                                        <li><a href="jobs-grid-layout-full-page-map.html">Full Page Grid + Map</a>
                                        </li>
                                        <li><a href="jobs-grid-layout-full-page.html">Full Page Grid</a></li>
                                        <li><a href="jobs-list-layout-1.html">List Layout 1</a></li>
                                        <li><a href="jobs-list-layout-2.html">List Layout 2</a></li>
                                        <li><a href="jobs-grid-layout.html">Grid Layout</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">Browse Tasks</a>
                                    <ul class="dropdown-nav">
                                        <li><a href="tasks-list-layout-1.html">List Layout 1</a></li>
                                        <li><a href="tasks-list-layout-2.html">List Layout 2</a></li>
                                        <li><a href="tasks-grid-layout.html">Grid Layout</a></li>
                                        <li><a href="tasks-grid-layout-full-page.html">Full Page Grid</a></li>
                                    </ul>
                                </li>
                                <li><a href="browse-companies.html">Browse Companies</a></li>
                                <li><a href="single-job-page.html">Job Page</a></li>
                                <li><a href="single-task-page.html">Task Page</a></li>
                                <li><a href="single-company-profile.html">Company Profile</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="/categories">Категории</a>
                        </li>
                        <li>
                            <a href="/products">Товары</a>
                        </li>
                    </ul>
                </nav>
                <div class="clearfix"></div>
            </div>

            @include('layouts.user')

        </div>
    </div>
</header>

<div class="clearfix"></div>