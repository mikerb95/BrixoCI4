<!-- Floating Brixo-style Navbar (no external text) -->
<nav class="navbar navbar-expand-lg brixo-navbar">
    <div class="container-fluid">
        <!-- Mobile Toggle -->
        <button class="navbar-toggler brixo-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#brixoNav"
            aria-controls="brixoNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="fas fa-bars"></span>
        </button>

        <!-- Mobile Brand -->
        <a class="navbar-brand d-lg-none mx-auto" href="/">BRIXO</a>

        <!-- Collapse Content -->
        <div class="collapse navbar-collapse" id="brixoNav">
            <div class="d-flex justify-content-between align-items-center w-100">
                <!-- Left Links -->
                <ul class="navbar-nav align-items-center gap-3">
                    <li class="nav-item"><a class="nav-link" href="/mapa">Mapa</a></li>
                </ul>

                <!-- Center Brand (Desktop) -->
                <a class="navbar-brand d-none d-lg-block" href="/">BRIXO</a>

                <!-- Right Links -->
                <ul class="navbar-nav align-items-center gap-3">
                    <?php if (!empty(session()->get('user'))): ?>
                        <li class="nav-item"><a class="nav-link" href="/logout">Salir</a></li>
                    <?php else: ?>
                        <li class="nav-item"><a class="nav-link" href="#" data-bs-toggle="modal"
                                data-bs-target="#loginModal">Ingresar</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
</nav>