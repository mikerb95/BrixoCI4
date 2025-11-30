<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Panel de Administrador - Brixo</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/brixo.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body class="bg-light">

    <!-- Navbar removed -->

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-white sidebar collapse vh-100 border-end">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active text-primary fw-bold" href="#">
                                <i class="fas fa-home me-2"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="#">
                                <i class="fas fa-users me-2"></i> Usuarios
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="#">
                                <i class="fas fa-hard-hat me-2"></i> Contratistas
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="#">
                                <i class="fas fa-tasks me-2"></i> Tareas
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="#">
                                <i class="fas fa-cog me-2"></i> Configuración
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Dashboard</h1>
                </div>

                <!-- Stats Cards -->
                <div class="row g-4 mb-4">
                    <div class="col-md-3">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body d-flex align-items-center">
                                <div class="bg-primary bg-opacity-10 p-3 rounded-circle me-3">
                                    <i class="fas fa-users text-primary fs-4"></i>
                                </div>
                                <div>
                                    <h6 class="card-subtitle text-muted mb-1">Usuarios Totales</h6>
                                    <h2 class="card-title mb-0">1,250</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body d-flex align-items-center">
                                <div class="bg-success bg-opacity-10 p-3 rounded-circle me-3">
                                    <i class="fas fa-check-circle text-success fs-4"></i>
                                </div>
                                <div>
                                    <h6 class="card-subtitle text-muted mb-1">Tareas Completadas</h6>
                                    <h2 class="card-title mb-0">845</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body d-flex align-items-center">
                                <div class="bg-warning bg-opacity-10 p-3 rounded-circle me-3">
                                    <i class="fas fa-clock text-warning fs-4"></i>
                                </div>
                                <div>
                                    <h6 class="card-subtitle text-muted mb-1">Pendientes</h6>
                                    <h2 class="card-title mb-0">56</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body d-flex align-items-center">
                                <div class="bg-info bg-opacity-10 p-3 rounded-circle me-3">
                                    <i class="fas fa-dollar-sign text-info fs-4"></i>
                                </div>
                                <div>
                                    <h6 class="card-subtitle text-muted mb-1">Ingresos Mes</h6>
                                    <h2 class="card-title mb-0">$12M</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Activity -->
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white py-3">
                        <h5 class="card-title mb-0">Actividad Reciente</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead>
                                    <tr>
                                        <th>Usuario</th>
                                        <th>Acción</th>
                                        <th>Fecha</th>
                                        <th>Estado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Juan Pérez</td>
                                        <td>Registró nueva tarea</td>
                                        <td>Hace 5 min</td>
                                        <td><span class="badge bg-success">Completado</span></td>
                                    </tr>
                                    <tr>
                                        <td>Maria Rodriguez</td>
                                        <td>Actualizó perfil</td>
                                        <td>Hace 1 hora</td>
                                        <td><span class="badge bg-info">Info</span></td>
                                    </tr>
                                    <tr>
                                        <td>Carlos Lopez</td>
                                        <td>Reportó un problema</td>
                                        <td>Hace 2 horas</td>
                                        <td><span class="badge bg-warning">Pendiente</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Mi Panel - Brixo</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/brixo.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body class="bg-light">

    <!-- Header -->
    <header class="navbar navbar-expand-lg navbar-light bg-white border-bottom sticky-top py-3 px-4">
        <div class="container-fluid">
            <a href="/" class="navbar-brand fw-bold fs-3 text-primary logo">Brixo</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <nav class="navbar-nav align-items-center gap-3 fw-medium">
                    <a href="/explorar" class="nav-link text-dark">Explorar</a>
                    <a href="/mis-tareas" class="nav-link text-dark">Mis Tareas</a>
                    <div class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center gap-2" href="#" role="button" data-bs-toggle="dropdown">
                            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                                <?= strtoupper(substr($user['nombre'], 0, 1)) ?>
                            </div>
                            <span><?= esc($user['nombre']) ?></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end border-0 shadow">
                            <li><a class="dropdown-item" href="/perfil">Mi Perfil</a></li>
                            <li><a class="dropdown-item" href="/ajustes">Ajustes</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item text-danger" href="/logout">Cerrar sesión</a></li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </header>

    <div class="container py-5">
        <div class="row">
            <!-- Sidebar / Profile Summary -->
            <div class="col-lg-3 mb-4">
                <div class="card border-0 shadow-sm text-center p-4">
                    <div class="mb-3 mx-auto bg-primary text-white rounded-circle d-flex align-items-center justify-content-center fs-2" style="width: 80px; height: 80px;">
                        <?= strtoupper(substr($user['nombre'], 0, 1)) ?>
                    </div>
                    <h5 class="fw-bold mb-1"><?= esc($user['nombre']) ?></h5>
                    <p class="text-muted small mb-3"><?= esc($user['correo']) ?></p>
                    <div class="d-grid gap-2">
                        <a href="/perfil" class="btn btn-outline-primary btn-sm rounded-pill">Editar Perfil</a>
                    </div>
                </div>

                <div class="list-group mt-4 shadow-sm rounded-3 border-0 overflow-hidden">
                    <a href="#" class="list-group-item list-group-item-action active border-0 py-3">
                        <i class="fas fa-columns me-2"></i> Resumen
                    </a>
                    <a href="#" class="list-group-item list-group-item-action border-0 py-3">
                        <i class="fas fa-clipboard-list me-2"></i> Mis Tareas
                    </a>
                    <a href="#" class="list-group-item list-group-item-action border-0 py-3">
                        <i class="fas fa-envelope me-2"></i> Mensajes
                    </a>
                    <a href="#" class="list-group-item list-group-item-action border-0 py-3">
                        <i class="fas fa-wallet me-2"></i> Pagos
                    </a>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-lg-9">
                <h3 class="fw-bold mb-4">Bienvenido de nuevo, <?= explode(' ', $user['nombre'])[0] ?></h3>

                <!-- Status Cards -->
                <div class="row g-4 mb-5">
                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm h-100 p-3">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <p class="text-muted mb-1 small fw-bold text-uppercase">Tareas Activas</p>
                                    <h2 class="mb-0 fw-bold">3</h2>
                                </div>
                                <div class="bg-primary bg-opacity-10 p-2 rounded-3 text-primary">
                                    <i class="fas fa-briefcase"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm h-100 p-3">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <p class="text-muted mb-1 small fw-bold text-uppercase">Mensajes</p>
                                    <h2 class="mb-0 fw-bold">5</h2>
                                </div>
                                <div class="bg-success bg-opacity-10 p-2 rounded-3 text-success">
                                    <i class="fas fa-comment-alt"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm h-100 p-3">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <p class="text-muted mb-1 small fw-bold text-uppercase">Saldo</p>
                                    <h2 class="mb-0 fw-bold">$0.00</h2>
                                </div>
                                <div class="bg-warning bg-opacity-10 p-2 rounded-3 text-warning">
                                    <i class="fas fa-wallet"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Active Tasks Section -->
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 fw-bold">Tareas Recientes</h5>
                        <a href="#" class="text-decoration-none small fw-bold">Ver todas</a>
                    </div>
                    <div class="card-body p-0">
                        <div class="list-group list-group-flush">
                            <!-- Item 1 -->
                            <div class="list-group-item p-4 border-bottom">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="bg-light p-3 rounded-3 text-secondary">
                                            <i class="fas fa-wrench fs-4"></i>
                                        </div>
                                        <div>
                                            <h6 class="fw-bold mb-1">Reparación de tubería</h6>
                                            <p class="text-muted small mb-0"><i class="far fa-clock me-1"></i> Publicado hace 2 días</p>
                                        </div>
                                    </div>
                                    <span class="badge bg-warning text-dark rounded-pill px-3">En proceso</span>
                                </div>
                            </div>
                            <!-- Item 2 -->
                            <div class="list-group-item p-4">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="bg-light p-3 rounded-3 text-secondary">
                                            <i class="fas fa-paint-roller fs-4"></i>
                                        </div>
                                        <div>
                                            <h6 class="fw-bold mb-1">Pintura de sala</h6>
                                            <p class="text-muted small mb-0"><i class="far fa-clock me-1"></i> Publicado hace 1 semana</p>
                                        </div>
                                    </div>
                                    <span class="badge bg-success rounded-pill px-3">Completado</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>