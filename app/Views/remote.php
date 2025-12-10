<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Control Remoto - Presentación</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f8f9fa;
        }

        .control-btn {
            font-size: 2rem;
            padding: 1rem;
        }
    </style>
</head>

<body>
    <div class="container text-center mt-5">
        <h1>Control Remoto de Presentación</h1>
        <p>Slide actual: <span id="current-slide">1</span></p>
        <div class="d-flex justify-content-center gap-3 mt-4">
            <button class="btn btn-primary control-btn" onclick="changeSlide(-1)">⬅️ Anterior</button>
            <button class="btn btn-primary control-btn" onclick="changeSlide(1)">Siguiente ➡️</button>
        </div>
    </div>

    <script>
        let currentSlide = 1;
        const totalSlides = <?= $totalSlides ?>;

        function updateDisplay() {
            document.getElementById('current-slide').textContent = currentSlide;
        }

        function changeSlide(direction) {
            const newSlide = currentSlide + direction;
            if (newSlide >= 1 && newSlide <= totalSlides) {
                fetch('/api/slide', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ slide: newSlide })
                })
                    .then(response => response.json())
                    .then(data => {
                        currentSlide = data.slide;
                        updateDisplay();
                    });
            }
        }

        // Actualizar display inicial
        fetch('/api/slide')
            .then(response => response.json())
            .then(data => {
                currentSlide = data.slide;
                updateDisplay();
            });

        // Polling para actualizar si cambia desde otro lugar
        setInterval(() => {
            fetch('/api/slide')
                .then(response => response.json())
                .then(data => {
                    if (data.slide !== currentSlide) {
                        currentSlide = data.slide;
                        updateDisplay();
                    }
                });
        }, 1000);
    </script>
</body>

</html>