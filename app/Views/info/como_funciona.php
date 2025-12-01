<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cómo funciona Brixo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/brixo.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body class="d-flex flex-column min-vh-100">

    <?= view('partials/navbar') ?>

    <main class="flex-grow-1">
        <section class="py-5">
            <div class="container" style="max-width: 960px;">
                <h1 class="h2 fw-bold mb-4">Cómo funciona</h1>
                <p class="mb-3">Explica de forma sencilla los pasos para que un cliente publique una necesidad y contrate a un profesional.</p>
            </div>
        </section>
    </main>

    <?= view('info/partials/footer_static') ?>

</body>

</html>
