<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Brand -->
        <a class="navbar-brand pt-0" href="{{ route('home') }}">
            <img src="{{ asset('images/LOGO.png') }}" class="navbar-brand-img" alt="...">
        </a>

        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
            <hr class="my-3">
            <!-- Navigation -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('statistics') }}">
                                    <i class="text-primary ni fas fa-chart-line"></i> {{ __('Statistics') }}
                            </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('hackers') }}">
                                    <i class="text-yellow ni fas fa-users"></i> {{ __('Hackers') }}
                            </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('checkin') }}">
                                    <i class="text-green ni fas fa-check"></i> {{ __('Check-in') }}
                            </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('mailing') }}">
                                <i class="text-orange ni fas fa-envelope"></i> {{ __('Mailing') }}
                            </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('settings') }}">
                                        <i class="text-red ni fas fa-tools"></i> {{ __('Settings') }}
                                </a>
                </li>


            </ul>
            <!-- Divider -->
            <hr class="my-3">
            <!-- Heading -->
            {{--
            <h6 class="navbar-heading text-muted">Documentation</h6> --}}
            <!-- Navigation -->
            <ul class="navbar-nav mb-md-3">
                <li class="nav-item">
                    <a class="nav-link" target="_blank" href="https://github.com/ScientificClubofESI/EasyHack/issues/new">
                        <i class="ni fas fa-question-circle"></i> Report
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <i class="ni fas fa-sign-out-alt"></i>Logout
                    </a>
                </li>

            </ul>
            <hr class="my-3">

            <div class="media-body ml-2 d-none d-lg-block">
                <span class="mb-0 text-sm  font-weight-bold">Admin : {{ auth()->user()->name }}</span>
            </div>
        </div>
    </div>
</nav>