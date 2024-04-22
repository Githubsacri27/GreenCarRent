<header data-bs-theme="dark">
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{route('home')}}">Inicio</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{route('condiciones')}}">Condiciones</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{route('contacto')}}">Contacto</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{route('catalogo')}}">Catálogo</a>
                    </li>
                    @auth
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="@can(" isClient"){{route("cliente.edit.profile")}} @endcan @can("isStaff"){{route("vehiculo.index")}} @endcan @can("isAdmin"){{route("cliente.index")}} @endcan">My Area</a>
                    </li>
                    @endauth
                </ul>

                <div class="main-nav-link-btn" id="main-nav-link-btn">
                    @guest
                    <a id="btn-login" class="btn-rect btn-outline-dark" href="{{route("login")}}">Log in</a>
                    <a id="btn-signup" class="btn-rect btn-light" href="{{route("register")}}">Sign up</a>
                    @else
                    <a id="btn-logout" class="btn-rect btn-outline-dark" href="{{route("logout")}}">Logout</a>
                    @endguest
                </div>
            </div>
        </div>
    </nav>
</header>