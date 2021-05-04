<nav class="navbar navbar-expand-lg navbar-dark site_bg">
    <a id="navbar-guest" class="navbar-brand" href="/">

    <img src="{{ asset('images/logo.png') }}" width="80"></a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <ul class="navbar-nav mx-auto" style="">

            <li class="{{ (request()->is('programs')) ? 'active' : '' }}">
                <a class="nav-item nav-link" href="/programs">Programs</a>
            </li>

            <li class="{{ (request()->is('schedule')) ? 'active' : '' }}">
            <a class="nav-item nav-link" href="/schedule">Examination Schedule</a>
            </li>

            <li class="{{ (request()->is('about')) ? 'active' : '' }}">
                <a class="nav-item nav-link" href="/about">About</a>
            </li>

            <li class="{{ (request()->is('contact')) ? 'active' : '' }}">
                <a class="nav-item nav-link" href="/contact">Contact</a>
            </li>
        </ul>
    </div>
</nav>
