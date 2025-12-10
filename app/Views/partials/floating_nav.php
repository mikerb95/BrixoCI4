<nav id="floating-nav" class="floating-navbar">
    <div class="floating-inner d-flex justify-content-between align-items-center w-100">
        <a href="/" class="brand fw-bold d-flex align-items-center">
            <img src="/images/brixo-logo.png" alt="Brixo" onerror="this.style.display='none'">
        </a>
        <ul class="d-flex list-unstyled mb-0 align-items-center gap-3 ms-3">
            <li><a href="/mapa" class="float-link">Mapa</a></li>
            <?php $floatUser = session()->get('user'); ?>
            <?php if (!empty($floatUser)): ?>
                <li class="d-none d-md-inline"><span class="float-link disabled">Hola,
                        <?= esc($floatUser['nombre'] ?? 'Usuario') ?></span></li>
                <?php $role = $floatUser['rol'] ?? ''; ?>
                <?php if ($role === 'admin'): ?>
                    <li><a href="/admin" class="float-link">Mi Panel</a></li>
                <?php else: ?>
                    <li><a href="/panel" class="float-link">Mi Panel</a></li>
                <?php endif; ?>
                <li><form action="/logout" method="post" style="display: inline;">
                        <?= csrf_field() ?>
                        <button type="submit" class="float-link btn btn-link p-0 border-0 bg-transparent">Salir</button>
                    </form></li>
            <?php else: ?>
                <li><a href="#" class="float-link" data-bs-toggle="modal" data-bs-target="#loginModal">Ingresar</a></li>
                <li><a href="#" class="float-link" data-bs-toggle="modal" data-bs-target="#registerModal">Registrarse</a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>