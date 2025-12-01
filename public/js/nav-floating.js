(function () {
    const hero = document.querySelector('.hero');
    const floatingNav = document.getElementById('floating-nav');
    const heroNav = document.getElementById('hero-nav');

    function showFloatingNav(show) {
        if (!floatingNav) return;
        floatingNav.classList.toggle('visible', !!show);
        if (heroNav) heroNav.classList.toggle('hidden', !!show);
        document.body.classList.toggle('floating-offset', !!show);
    }

    if (hero && 'IntersectionObserver' in window) {
        const observer = new IntersectionObserver(
            (entries) => {
                const entry = entries[0];
                showFloatingNav(!entry.isIntersecting);
            },
            { root: null, rootMargin: '0px 0px 0px 0px', threshold: 0 }
        );
        observer.observe(hero);
    } else {
        const foldThreshold = () => (hero ? hero.offsetHeight : 120);
        function onScroll() {
            showFloatingNav(window.scrollY > foldThreshold());
        }
        window.addEventListener('scroll', onScroll);
        window.addEventListener('resize', onScroll);
        onScroll();
    }
})();
