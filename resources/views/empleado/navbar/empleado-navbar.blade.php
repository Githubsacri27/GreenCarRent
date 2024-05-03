<nav class="secondary-navbar empleado-nav">
    <ul>
        <li>
            <a href="{{ route('vehiculo.index') }}" class="empleado-nav-link {{ request()->routeIs('vehiculo.index') ? 'active' : '' }}" data-title="Vehiculo - Gestion">Gestión Vehículos</a>
        </li>
        <li>
            <a href="{{ route('alquiler.year') }}" class="empleado-nav-link {{ request()->routeIs('alquiler.year') ? 'active' : '' }}" data-title="Alquiler - Estadisticas">Estadísticas Alquiler</a>
        </li>
    </ul>
</nav>
