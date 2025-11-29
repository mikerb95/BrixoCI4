<nav class="navbar navbar-expand-lg fixed-top brixo-navbar">
    <div class="container-fluid px-4">
        <!-- Logo -->
        <a class="navbar-brand fw-bold" href="/">
            brixo
        </a>

        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#brixoNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Collapse Content -->
        <div class="collapse navbar-collapse" id="brixoNavbar">
            <!-- Main Navigation -->
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 gap-3">
                <li class="nav-item">
                    <a class="nav-link text-uppercase fw-bold" href="/servicios">Servicios</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-uppercase fw-bold" href="/mapa">Mapa</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-uppercase fw-bold" href="/productos">Productos</a>
                </li>
            </ul>

            <!-- Search Bar (Styled Dark) -->
            <form class="d-flex mx-auto search-form" role="search">
                <div class="input-group rounded-pill overflow-hidden">
                    <input class="form-control border-0 bg-transparent text-white shadow-none ps-3" type="search" placeholder="¿Qué buscas?" aria-label="Search">
                    <button class="btn border-0 text-primary pe-3" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>

            <!-- Right Side Actions -->
            <div class="d-flex align-items-center gap-3 ms-auto">
                <a href="#" class="nav-link text-white fw-bold d-none d-lg-block">Regístrate</a>
                <a href="#" class="btn btn-primary rounded-pill px-4 fw-bold d-flex align-items-center gap-2">
                    <i class="far fa-user"></i>
                    <span>Iniciar sesión</span>
                </a>
            </div>
        </div>
    </div>
</nav>