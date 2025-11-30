<!-- Main Navbar -->
<nav class="navbar navbar-expand-lg ducati-navbar">
    <div class="container-fluid">
        <!-- Mobile Toggle -->
        <button class="navbar-toggler ducati-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#ducatiNav">
            <span class="fas fa-bars"></span>
        </button>

        <!-- Mobile Logo -->
        <a class="navbar-brand d-lg-none mx-auto" href="/">BRIXO</a>

        <!-- Collapse Content -->
        <div class="collapse navbar-collapse" id="ducatiNav">
            <div class="d-flex justify-content-between w-100 align-items-center">
                
                <!-- Left Links -->
                <ul class="navbar-nav d-flex align-items-center gap-3">
                    <li class="nav-item"><a class="nav-link" href="/servicios">Servicios</a></li>
                    <li class="nav-item"><a class="nav-link" href="/mapa">Mapa</a></li>
                    <li class="nav-item"><a class="nav-link" href="/explorar">Explorar</a></li>
                </ul>

                <!-- Center Logo (Desktop) -->
                <a class="navbar-brand d-none d-lg-block" href="/">
                    BRIXO
                </a>

                <!-- Right Links -->
                <ul class="navbar-nav d-flex align-items-center gap-3">
                    <li class="nav-item"><a class="nav-link" href="/publicar-tarea">Publicar Tarea</a></li>
                    <?php if (! empty(session()->get('user'))): ?>
                         <li class="nav-item"><a class="nav-link" href="/logout">Salir</a></li>
                    <?php else: ?>
                        <li class="nav-item"><a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#loginModal">Ingresar</a></li>
                    <?php endif; ?>
                    <li class="nav-item"><a class="nav-link" href="/signup">Registro</a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>

