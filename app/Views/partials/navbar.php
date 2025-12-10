<!-- Floating Brixo-style Navbar (no external text) -->
<nav class="navbar navbar-expand-lg brixo-navbar">
    <div class="container-xl d-flex align-items-center justify-content-between">
        <!-- Brand alineado como la navbar flotante -->
        <a class="navbar-brand d-flex align-items-center" href="/">
            <img src="/images/brixo-logo.png" alt="Brixo" class="brixo-logo" onerror="this.style.display='none'">
        </a>

        <!-- Toggle para mobile -->
        <button class="navbar-toggler brixo-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#brixoNav"
            aria-controls="brixoNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="fas fa-bars"></span>
        </button>

        <!-- Links alineados horizontalmente como en la navbar flotante -->
        <div class="collapse navbar-collapse justify-content-end" id="brixoNav">
            <ul class="navbar-nav align-items-center gap-3 ms-3">
                <li class="nav-item"><a class="nav-link" href="/map">Mapa</a></li>
                <?php $navUser = session()->get('user'); ?>
                <?php if (!empty($navUser)): ?>
                    <?php $role = $navUser['rol'] ?? ''; ?>
                    <?php if ($role === 'admin'): ?>
                        <li class="nav-item"><a class="nav-link" href="/admin">Mi Panel</a></li>
                    <?php else: ?>
                        <li class="nav-item"><a class="nav-link" href="/panel">Mi Panel</a></li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <form action="/logout" method="post" class="d-inline">
                            <?= csrf_field() ?>
                            <button type="submit" class="nav-link btn btn-link border-0 bg-transparent">Cerrar
                                Sesión</button>
                        </form>
                    </li>
                <?php else: ?>
                    <li class="nav-item"><a class="nav-link" href="#" data-bs-toggle="modal"
                            data-bs-target="#loginModal">Ingresar</a></li>
                    <li class="nav-item"><a class="nav-link" href="#" data-bs-toggle="modal"
                            data-bs-target="#registerModal">Registrarse</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
<?= view('partials/modals') ?>