<!-- Navbar -->
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <!-- Navbar brand -->
        <a class="navbar-brand" href="{{ route('home') }}">Bankia</a>

        <!-- Toggler for responsive navigation -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar links -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <!-- Home link -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Inicio</a>
                </li>

                <!-- Cuentas link -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('cuenta_list') ? 'active' : '' }}" href="{{ route('cuenta_list') }}">Cuentas</a>
                </li>

                <!-- Clientes link -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('cliente_list') ? 'active' : '' }}" href="{{ route('cliente_list') }}">Clientes</a>
                </li>

                <!-- Estadisticas link -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('cuentas_stadistics') ? 'active' : '' }}" href="{{ route('cuentas_stadistics') }}">Estadisticas</a>
                </li>
            </ul>

            <!-- Links (Login / Logout) -->
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 d-flex align-items-center">
                @if (Auth::check())
                    <li class="nav-item">
                        <span class="navbar-text me-3">Has hecho login como {{ Auth::user()->name }}</span>
                    </li>
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger nav-link px-3 py-2 rounded d-flex align-items-center transition-all hover-text-white">
                                <i class="bi bi-power fs-5 me-2"></i> Log Out
                            </button>
                        </form>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="/google-auth/redirect">Iniciar Sesión con Google</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Registrarse</a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>