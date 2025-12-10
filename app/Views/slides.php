<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Presentación - Brixo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #000;
            color: #fff;
        }

        .slide {
            display: none;
        }

        .slide.active {
            display: block;
        }

        .slide h1 {
            font-size: 3rem;
            text-align: center;
            margin-top: 20%;
        }

        .slide p {
            font-size: 1.5rem;
            text-align: center;
        }
    </style>
</head>

<body>
    <div id="slides">
        <div class="slide active" data-slide="1">
            <h1>Bienvenido a Brixo</h1>
            <p>Plataforma de conexión entre clientes y contratistas</p>
        </div>
        <div class="slide" data-slide="2">
            <h1>¿Qué es Brixo?</h1>
            <p>Una aplicación web para encontrar servicios profesionales cerca de ti</p>
        </div>
        <div class="slide" data-slide="3">
            <h1>Características</h1>
            <p>Mapa interactivo, perfiles verificados, sistema de reseñas</p>
        </div>
        <div class="slide" data-slide="4">
            <h1>¡Gracias!</h1>
            <p>¿Preguntas?</p>
        </div>
    </div>

    <script>
        let currentSlide = 1;
        const totalSlides = 4;

        function updateSlide() {
            fetch('/api/slide')
                .then(response => response.json())
                .then(data => {
                    const newSlide = data.slide;
                    if (newSlide !== currentSlide) {
                        document.querySelector('.slide.active').classList.remove('active');
                        document.querySelector(`[data-slide="${newSlide}"]`).classList.add('active');
                        currentSlide = newSlide;
                    }
                });
        }

        setInterval(updateSlide, 1000); // Polling cada segundo
    </script>
</body>

</html>