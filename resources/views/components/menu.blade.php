<nav class="navbar has-background-dark has-shadow is-primary">
    <div class="navbar-brand">
        <a href="#" class="navbar-item">
            <img src="{{ asset('images/logo.png') }}" alt="getthis logo">
        </a>
        <a href="#" class="navbar-burger" id="burger">
            <span></span>
            <span></span>
            <span></span>
        </a>
    </div>
    <div class="navbar-menu has-background-dark" id="nav-links">
        <div class="navbar-end">
            <a href="{{ url('/') }}" class="navbar-item has-text-link-light">Home</a>
            <a href="{{ url('/articles') }}" class="navbar-item has-text-link-light">Articles</a>
            <a href="{{ url('/discussions') }}" class="navbar-item has-text-link-light">Forum</a>
            <a href="{{ url('/profile') }}" class="navbar-item has-text-link-light">Profile</a>
            <a href="{{ url('/contact') }}" class="navbar-item has-text-link-light">Contact</a>
        </div>
    </div>
</nav>
