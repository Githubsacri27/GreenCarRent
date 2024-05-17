<header data-bs-theme="dark">
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('home') }}">
                <span class="fas fa-home" aria-hidden="true"></span>
                <span class="sr-only">Inicio</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('condiciones') ? 'active' : '' }}" href="{{ route('condiciones') }}">Condiciones</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('contacto') ? 'active' : '' }}" href="{{ route('contacto') }}">Contacto</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('catalogo') ? 'active' : '' }}" href="{{ route('catalogo') }}">Catálogo</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">Quiénes somos</a>
                    </li>
                    @auth
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('cliente.edit.profile') ? 'active' : '' }}" href="@can('isClient'){{ route('cliente.edit.profile') }}@endcan @can('isEmpleado'){{ route('vehiculo.index') }}@endcan @can('isAdmin'){{ route('cliente.index') }}@endcan">Zona personal</a>
                    </li>
                    @endauth
                </ul>

                <div class="main-nav-link-btn" id="main-nav-link-btn">
                    @guest
                    <a id="btn-login" class="btn-rect btn-outline-light me-2" href="{{ route('login') }}">Iniciar sesión</a>
                    <a id="btn-signup" class="btn-rect btn-light" href="{{ route('register') }}">Registro</a>
                    @else
                    <a id="btn-logout" class="btn-rect btn-outline-dark" href="{{ route('logout') }}">Salir</a>
                    @endguest
                </div>
            </div>
        </div>
    </nav>
</header>