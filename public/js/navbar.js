document.addEventListener('DOMContentLoaded', function() {
    // 1. Inject Styles — Glassmorphism theme with Inter font
    const style = document.createElement('style');
    style.textContent = `
        body {
            padding-top: 90px; /* Adjust for floating glassmorphism navbar */
        }
        .navbar-custom {
            height: auto;
            min-height: 64px;
            background: rgba(255, 255, 255, 0.55);
            backdrop-filter: blur(20px) saturate(180%);
            -webkit-backdrop-filter: blur(20px) saturate(180%);
            border: 1px solid rgba(255, 255, 255, 0.45);
            border-radius: 18px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08), 0 1px 2px rgba(0, 0, 0, 0.04);
            z-index: 1030;
            padding: 0.5rem 1.25rem;
            margin: 12px auto 0;
            width: 94%;
            max-width: 1400px;
            left: 50%;
            transform: translateX(-50%);
            transition: background 0.3s ease, box-shadow 0.3s ease;
        }
        .navbar-custom:hover {
            background: rgba(255, 255, 255, 0.72);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.12), 0 2px 4px rgba(0, 0, 0, 0.06);
        }
        .navbar-brand img {
            height: 34px;
            width: auto;
        }
        .nav-link {
            color: #1f2937;
            font-family: 'Inter', system-ui, sans-serif;
            font-weight: 500;
            font-size: 0.9rem;
            letter-spacing: -0.01em;
            margin-left: 4px;
            padding: 0.45rem 0.85rem;
            border-radius: 10px;
            text-decoration: none;
            transition: background 0.25s ease, color 0.25s ease, transform 0.15s ease;
        }
        .nav-link:hover {
            background: rgba(0, 159, 217, 0.08);
            color: #009fd9;
            transform: translateY(-1px);
        }
        .nav-btn-login {
            background: linear-gradient(135deg, #009fd9 0%, #0077B6 100%);
            color: white !important;
            font-family: 'Inter', system-ui, sans-serif;
            font-weight: 600;
            font-size: 0.875rem;
            padding: 0.5rem 1.25rem;
            border-radius: 10px;
            border: none;
            box-shadow: 0 2px 8px rgba(0, 159, 217, 0.25);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .nav-btn-login:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 16px rgba(0, 159, 217, 0.35);
        }
        .user-greeting {
            font-family: 'Inter', system-ui, sans-serif;
            font-weight: 600;
            color: #1f2937;
            margin-left: 8px;
        }
        .dropdown-menu {
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            background: rgba(255, 255, 255, 0.92) !important;
            border: 1px solid rgba(255, 255, 255, 0.5) !important;
            border-radius: 12px !important;
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.12) !important;
            overflow: hidden;
        }
        .dropdown-item {
            font-family: 'Inter', system-ui, sans-serif;
            font-size: 0.875rem;
            font-weight: 500;
            border-radius: 8px;
            margin: 2px 8px;
            padding: 0.45rem 0.75rem;
            transition: background 0.2s ease;
        }
        .dropdown-item:hover {
            background: rgba(0, 159, 217, 0.08);
        }
    `;
    document.head.appendChild(style);

    // 2. Create Navbar HTML Structure
    const navbar = document.createElement('nav');
    navbar.className = 'navbar navbar-expand-lg fixed-top navbar-custom';
    
    const container = document.createElement('div');
    container.className = 'container'; // This ensures alignment with page content

    // Logo (Left aligned)
    const brandLink = document.createElement('a');
    brandLink.className = 'navbar-brand';
    brandLink.href = '/';
    const logoImg = document.createElement('img');
    logoImg.src = '/images/brixo-logo.png';
    logoImg.alt = 'Brixo Logo';
    brandLink.appendChild(logoImg);

    // Toggler for mobile (Bootstrap standard)
    const toggler = document.createElement('button');
    toggler.className = 'navbar-toggler';
    toggler.type = 'button';
    toggler.setAttribute('data-bs-toggle', 'collapse');
    toggler.setAttribute('data-bs-target', '#navbarContent');
    toggler.innerHTML = '<span class="navbar-toggler-icon"></span>';

    // Content Wrapper (Right aligned options)
    const collapseDiv = document.createElement('div');
    collapseDiv.className = 'collapse navbar-collapse justify-content-end';
    collapseDiv.id = 'navbarContent';

    const navList = document.createElement('ul');
    navList.className = 'navbar-nav align-items-center';

    // Menu Items
    const menuItems = [
        { text: 'Mapa', href: '/map' },
        { text: 'Especialidades', href: '/especialidades' }
    ];

    menuItems.forEach(item => {
        const li = document.createElement('li');
        li.className = 'nav-item';
        const a = document.createElement('a');
        a.className = 'nav-link';
        a.href = item.href;
        a.textContent = item.text;
        li.appendChild(a);
        navList.appendChild(li);
    });

    // User Session Logic
    const userLi = document.createElement('li');
    userLi.className = 'nav-item';

    if (window.brixoUser) {
        // Logged in - Dropdown Menu
        userLi.className = 'nav-item dropdown';
        
        // Toggle Link
        const toggleLink = document.createElement('a');
        toggleLink.className = 'nav-link dropdown-toggle';
        toggleLink.href = '#';
        toggleLink.id = 'navbarDropdown';
        toggleLink.role = 'button';
        toggleLink.setAttribute('data-bs-toggle', 'dropdown');
        toggleLink.setAttribute('aria-expanded', 'false');
        toggleLink.textContent = 'Mi Cuenta';
        userLi.appendChild(toggleLink);

        // Dropdown Menu
        const dropdownMenu = document.createElement('ul');
        dropdownMenu.className = 'dropdown-menu dropdown-menu-end';
        dropdownMenu.setAttribute('aria-labelledby', 'navbarDropdown');

        // Profile Name Header
        const nameItem = document.createElement('li');
        const nameHeader = document.createElement('h6');
        nameHeader.className = 'dropdown-header';
        nameHeader.textContent = window.brixoUser.nombre;
        nameItem.appendChild(nameHeader);
        dropdownMenu.appendChild(nameItem);

        // Mi Panel Link
        const panelItem = document.createElement('li');
        const panelLink = document.createElement('a');
        panelLink.className = 'dropdown-item';
        panelLink.href = window.brixoUser.rol === 'admin' ? '/admin' : '/panel';
        panelLink.textContent = 'Mi Panel';
        panelItem.appendChild(panelLink);
        dropdownMenu.appendChild(panelItem);

        // Divider
        const dividerItem = document.createElement('li');
        dividerItem.innerHTML = '<hr class="dropdown-divider">';
        dropdownMenu.appendChild(dividerItem);

        // Logout
        const logoutItem = document.createElement('li');
        const logoutForm = document.createElement('form');
        logoutForm.action = '/logout';
        logoutForm.method = 'post';
        logoutForm.className = 'd-block w-100';

        if (window.csrfTokenName && window.csrfHash) {
            const csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = window.csrfTokenName;
            csrfInput.value = window.csrfHash;
            logoutForm.appendChild(csrfInput);
        }

        const logoutBtn = document.createElement('button');
        logoutBtn.type = 'submit';
        logoutBtn.className = 'dropdown-item';
        logoutBtn.textContent = 'Cerrar Sesión';
        
        logoutForm.appendChild(logoutBtn);
        logoutItem.appendChild(logoutForm);
        dropdownMenu.appendChild(logoutItem);

        userLi.appendChild(dropdownMenu);

        // Hover functionality
        userLi.addEventListener('mouseenter', function() {
            if (window.innerWidth >= 992) {
                toggleLink.classList.add('show');
                toggleLink.setAttribute('aria-expanded', 'true');
                dropdownMenu.classList.add('show');
            }
        });
        userLi.addEventListener('mouseleave', function() {
            if (window.innerWidth >= 992) {
                toggleLink.classList.remove('show');
                toggleLink.setAttribute('aria-expanded', 'false');
                dropdownMenu.classList.remove('show');
            }
        });

    } else {
        // Not logged in
        const loginBtn = document.createElement('a');
        loginBtn.className = 'nav-link nav-btn-login';
        loginBtn.href = '#';
        loginBtn.textContent = 'Iniciar sesión';
        loginBtn.setAttribute('data-bs-toggle', 'modal');
        loginBtn.setAttribute('data-bs-target', '#loginModal');
        userLi.appendChild(loginBtn);
    }
    navList.appendChild(userLi);

    // Assemble
    collapseDiv.appendChild(navList);
    container.appendChild(brandLink);
    container.appendChild(toggler);
    container.appendChild(collapseDiv);
    navbar.appendChild(container);

    // 3. Prepend to Body
    document.body.prepend(navbar);
});
