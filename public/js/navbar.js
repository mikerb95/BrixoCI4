document.addEventListener('DOMContentLoaded', function() {
    // 1. Inject Styles
    const style = document.createElement('style');
    style.textContent = `
        body {
            padding-top: 80px; /* Adjust based on navbar height */
        }
        .navbar-custom {
            height: 80px;
            background-color: #fff;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            z-index: 1030;
        }
        .navbar-brand img {
            height: 40px;
            width: auto;
        }
        .nav-link {
            color: #333;
            font-weight: 500;
            margin-left: 20px;
            text-decoration: none;
            transition: color 0.2s;
        }
        .nav-link:hover {
            color: #007bff;
        }
        .nav-btn-login {
            background-color: #007bff;
            color: white !important;
            padding: 8px 20px;
            border-radius: 50px;
            transition: background-color 0.2s;
        }
        .nav-btn-login:hover {
            background-color: #0056b3;
        }
        .user-greeting {
            font-weight: 600;
            color: #333;
            margin-left: 20px;
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
        { text: 'Especialidades', href: '#' } // Defined as # for now
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
