<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sobre Brixo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/brixo.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body class="d-flex flex-column min-vh-100">

    <?= view('partials/floating_nav') ?>

    <main class="flex-grow-1">
        <section class="py-5">
            <div class="container" style="max-width: 960px;">
                <h1 class="h2 fw-bold mb-4">Sobre Brixo</h1>
                <p class="mb-3">Brixo conecta clientes con profesionales confiables para proyectos del hogar y servicios locales.</p>
                <p class="mb-3">Esta página comparte la misión, visión y valores del proyecto.</p>
            </div>
        </section>
    </main>

    <?= view('info/partials/footer_static') ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/js/nav-floating.js"></script>

</body>

</html>
