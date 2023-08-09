<header class="page-header sticky-top px-xl-4 px-sm-2 px-0 py-lg-2 py-1">
    <div class="container-fluid">
        <nav class="navbar">
            <a href="{{ url('home') }}" class="brand-icon d-flex align-items-center mx-2 mx-sm-3 text-primary">
                <h1>
                    {{ strtoupper(Auth::user()->name) }}
                </h1>
            </a>
            <!-- start: toggle btn -->
            {{-- <div class="d-flex">
                <button type="button" class="btn btn-link d-none d-xl-block sidebar-mini-btn p-0 text-primary">
                    <span class="hamburger-icon">
                        <span class="line"></span>
                        <span class="line"></span>
                        <span class="line"></span>
                    </span>
                </button>
                <button type="button" class="btn btn-link d-block d-xl-none menu-toggle p-0 text-primary">
                    <span class="hamburger-icon">
                        <span class="line"></span>
                        <span class="line"></span>
                        <span class="line"></span>
                    </span>
                </button>
                <a href="{{ url('home') }}" class="brand-icon d-flex align-items-center mx-2 mx-sm-3 text-primary">
                    <img src="{{ asset('public') }}/assets/img/m360ict.gif" alt="">
                </a>
            </div> --}}
            <!-- start: search area -->
            <div class="header-right flex-grow-2 d-none d-md-block">
                <div class="main-search px-2 flex-fill">
                    <h4>{{ Auth::user()->name }}</h4>
                    <pre class="text-secondary">ID : {{ Auth::user()->unique_user_id }}</pre>
                </div>
            </div>

            <a class="btn bg-secondary text-light text-uppercase rounded-0">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn bg-secondary text-light text-uppercase rounded-0">Sign
                        out</button>
                </form>
            </a>

        </nav>
    </div>
</header>
