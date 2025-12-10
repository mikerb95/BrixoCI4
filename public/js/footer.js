document.addEventListener('DOMContentLoaded', function() {
    const footerContainer = document.getElementById('brixo-footer-container');
    
    if (footerContainer) {
        const currentYear = new Date().getFullYear();
        
        const footerHTML = `
        <footer class="bg-dark text-light py-5 mt-auto">
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
                            <a href="https://codeigniter.com" target="_blank" class="text-white-50 hover-text-white" title="CodeIgniter">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                                </svg>
                            </a>
                            <a href="https://getbootstrap.com" target="_blank" class="text-white-50 hover-text-white" title="Bootstrap">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 15l-4-4 1.41-1.41L11 14.17l6.59-6.59L19 9l-8 8z"/>
                                </svg>
                            </a>
                            <a href="https://leafletjs.com" target="_blank" class="text-white-50 hover-text-white" title="Leaflet">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                                </svg>
                            </a>
                            <a href="https://fontawesome.com" target="_blank" class="text-white-50 hover-text-white" title="FontAwesome">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                </svg>
                            </a>
                            <a href="https://www.php.net" target="_blank" class="text-white-50 hover-text-white" title="PHP">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                                    <text x="12" y="16" font-size="12" text-anchor="middle" fill="currentColor">PHP</text>
                                </svg>
                            </a>
                        </div>
                    </div>

                    <!-- Quick Links -->
                    <div class="col-md-4 mb-4">
                        <h5 class="text-uppercase fw-bold text-primary mb-3">Enlaces Rápidos</h5>
                        <ul class="list-unstyled">
                            <li class="mb-2"><a href="/" class="text-decoration-none text-white-50 hover-text-white">Inicio</a></li>
                            <li class="mb-2"><a href="/map" class="text-decoration-none text-white-50 hover-text-white">Mapa de Servicios</a></li>
                            <li class="mb-2"><a href="/panel" class="text-decoration-none text-white-50 hover-text-white">Mi Panel</a></li>
                            <li class="mb-2"><a href="/sobre-nosotros" class="text-decoration-none text-white-50 hover-text-white">Sobre Nosotros</a></li>
                            <li class="mb-2"><a href="/como-funciona" class="text-decoration-none text-white-50 hover-text-white">Cómo funciona</a></li>
                            <li class="mb-2"><a href="/seguridad" class="text-decoration-none text-white-50 hover-text-white">Seguridad</a></li>
                            <li class="mb-2"><a href="/ayuda" class="text-decoration-none text-white-50 hover-text-white">Ayuda</a></li>
                            <li class="mb-2"><a href="/unete-pro" class="text-decoration-none text-white-50 hover-text-white">Únete como pro</a></li>
                            <li class="mb-2"><a href="/historias-exito" class="text-decoration-none text-white-50 hover-text-white">Historias de éxito</a></li>
                            <li class="mb-2"><a href="/recursos" class="text-decoration-none text-white-50 hover-text-white">Recursos</a></li>
                        </ul>
                    </div>

                    <!-- Developers -->
                    <div class="col-md-4 mb-4">
                        <h5 class="text-uppercase fw-bold text-primary mb-3">Equipo de Desarrollo</h5>
                        <p class="small text-white-50 mb-2">Conoce a los creadores en GitHub:</p>
                        <ul class="list-unstyled d-flex flex-wrap gap-2">
                            <li>
                                <a href="https://github.com/mikerb95" target="_blank" class="btn btn-sm btn-outline-light rounded-pill" title="Mike">
                                    <i class="fab fa-github me-1"></i> mikerb95
                                </a>
                            </li>
                            <li>
                                <a href="https://github.com/Jerson7molina" target="_blank" class="btn btn-sm btn-outline-light rounded-pill" title="Jerson">
                                    <i class="fab fa-github me-1"></i> Jerson7molina
                                </a>
                            </li>
                            <li>
                                <a href="https://github.com/papidani1" target="_blank" class="btn btn-sm btn-outline-light rounded-pill" title="Dani">
                                    <i class="fab fa-github me-1"></i> papidani1
                                </a>
                            </li>
                            <li>
                                <a href="https://github.com/DavidPino20" target="_blank" class="btn btn-sm btn-outline-light rounded-pill" title="David">
                                    <i class="fab fa-github me-1"></i> DavidPino20
                                </a>
                            </li>
                            <li>
                                <a href="https://github.com/edwinmor24" target="_blank" class="btn btn-sm btn-outline-light rounded-pill" title="Edwin">
                                    <i class="fab fa-github me-1"></i> edwinmor24
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <hr class="border-secondary my-4">

                <div class="row align-items-center">
                    <div class="col-md-6 text-center text-md-start">
                        <p class="small text-white-50 mb-0">&copy; ${currentYear} Brixo. Todos los derechos reservados.</p>
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        <a href="#" class="text-white-50 text-decoration-none small me-3">Privacidad</a>
                        <a href="#" class="text-white-50 text-decoration-none small">Términos</a>
                    </div>
                </div>
            </div>
        </footer>
        `;
        
        footerContainer.innerHTML = footerHTML;
    }
});
