<footer class="bg-dark text-light py-3 mt-auto">
    <div class="container">
        <div class="row">
            <!-- Brand & About -->
            <div class="col-md-4 mb-4">
                <h5 class="text-uppercase fw-bold text-primary mb-3">Brixo</h5>
                <p class="small text-white-50">
                    Conectando hogares con los mejores profesionales.
                    Calidad, confianza y seguridad en cada servicio.
                </p>
                <div class="d-flex gap-3 mt-3">
                    <a href="#" class="text-white-50 hover-text-white"><i class="fab fa-facebook fa-lg"></i></a>
                    <a href="#" class="text-white-50 hover-text-white"><i class="fab fa-twitter fa-lg"></i></a>
                    <a href="#" class="text-white-50 hover-text-white"><i class="fab fa-instagram fa-lg"></i></a>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="col-md-4 mb-4">
                <h5 class="text-uppercase fw-bold text-primary mb-3">Enlaces Rápidos</h5>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="<?= base_url('/') ?>"
                            class="text-decoration-none text-white-50 hover-text-white">Inicio</a></li>
                    <li class="mb-2"><a href="<?= base_url('mapa') ?>"
                            class="text-decoration-none text-white-50 hover-text-white">Mapa de Servicios</a></li>
                    <li class="mb-2"><a href="<?= base_url('panel') ?>"
                            class="text-decoration-none text-white-50 hover-text-white">Mi Panel</a></li>
                    <li class="mb-2"><a href="<?= base_url('sobre-nosotros') ?>"
                            class="text-decoration-none text-white-50 hover-text-white">Sobre Nosotros</a></li>
                    <li class="mb-2"><a href="<?= base_url('como-funciona') ?>"
                            class="text-decoration-none text-white-50 hover-text-white">Cómo funciona</a></li>
                    <li class="mb-2"><a href="<?= base_url('seguridad') ?>"
                            class="text-decoration-none text-white-50 hover-text-white">Seguridad</a></li>
                    <li class="mb-2"><a href="<?= base_url('ayuda') ?>"
                            class="text-decoration-none text-white-50 hover-text-white">Ayuda</a></li>
                    <li class="mb-2"><a href="<?= base_url('unete-pro') ?>"
                            class="text-decoration-none text-white-50 hover-text-white">Únete como pro</a></li>
                    <li class="mb-2"><a href="<?= base_url('historias-exito') ?>"
                            class="text-decoration-none text-white-50 hover-text-white">Historias de éxito</a></li>
                    <li class="mb-2"><a href="<?= base_url('recursos') ?>"
                            class="text-decoration-none text-white-50 hover-text-white">Recursos</a></li>
                </ul>
            </div>

            <!-- Developers -->
            <div class="col-md-4 mb-4">
                <h5 class="text-uppercase fw-bold text-primary mb-3">Equipo de Desarrollo</h5>
                <p class="small text-white-50 mb-2">Conoce a los creadores en GitHub:</p>
                <ul class="list-unstyled d-flex flex-wrap gap-2">
                    <li>
                        <a href="https://github.com/mikerb95" target="_blank"
                            class="btn btn-sm btn-outline-light rounded-pill" title="Mike">
                            <i class="fab fa-github me-1"></i> mikerb95
                        </a>
                    </li>
                    <li>
                        <a href="https://github.com/Jerson7molina" target="_blank"
                            class="btn btn-sm btn-outline-light rounded-pill" title="Jerson">
                            <i class="fab fa-github me-1"></i> Jerson7molina
                        </a>
                    </li>
                    <li>
                        <a href="https://github.com/papidani1" target="_blank"
                            class="btn btn-sm btn-outline-light rounded-pill" title="Dani">
                            <i class="fab fa-github me-1"></i> papidani1
                        </a>
                    </li>
                    <li>
                        <a href="https://github.com/DavidPino20" target="_blank"
                            class="btn btn-sm btn-outline-light rounded-pill" title="David">
                            <i class="fab fa-github me-1"></i> DavidPino20
                        </a>
                    </li>
                    <li>
                        <a href="https://github.com/edwinmor24" target="_blank"
                            class="btn btn-sm btn-outline-light rounded-pill" title="Edwin">
                            <i class="fab fa-github me-1"></i> edwinmor24
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <hr class="border-secondary my-4">

        <div class="row align-items-center">
            <div class="col-md-6 text-center text-md-start">
                <p class="small text-white-50 mb-0">&copy; <?= date('Y') ?> Brixo. Todos los derechos reservados.</p>
            </div>
            <div class="col-md-6 text-center text-md-end">
                <a href="#" class="text-white-50 text-decoration-none small me-3">Privacidad</a>
                <a href="#" class="text-white-50 text-decoration-none small">Términos</a>
            </div>
        </div>
    </div>
</footer>

<script>
    window.brixoUser = <?= json_encode(session()->get('user') ?? null) ?>;
</script>

<?= view('partials/modals') ?>
<script src="/js/navbar.js"></script>

<style>
    .hover-text-white:hover {
        color: #fff !important;
        transition: color 0.3s ease;
    }
</style>