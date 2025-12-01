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
                <li class="nav-item"><a class="nav-link" href="/mapa">Mapa</a></li>
            </ul>
        </div>
    </div>
</nav>