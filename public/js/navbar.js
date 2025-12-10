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
        { text: 'Especialidades', href: '#' }, // Defined as # for now
        { text: 'Mi cuenta', href: '/panel' }
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
        // Logged in
        const userSpan = document.createElement('span');
        userSpan.className = 'user-greeting';
        userSpan.textContent = `Hola, ${window.brixoUser.nombre}`;
        userLi.appendChild(userSpan);
        
        // Optional: Add logout link or dropdown? 
        // For now, just the greeting as requested, but usually a logout is needed.
        // Adding a small logout link for usability if not explicitly forbidden.
        // User asked: "Hola, $Usuario". I will stick to that strictly.
        // But wait, "Mi cuenta" is already there.
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
