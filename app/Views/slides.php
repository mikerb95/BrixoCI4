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
            text-align: center;
        }

        .slide.active {
            display: block;
        }

        .slide img {
            max-width: 100%;
            max-height: 100vh;
            object-fit: contain;
        }
    </style>
</head>

<body>
    <div id="slides">
        <?php for ($i = 1; $i <= $totalSlides; $i++): ?>
            <div class="slide <?= $i === 1 ? 'active' : '' ?>" data-slide="<?= $i ?>">
                <img src="/presentation/Slide<?= $i ?>.PNG" alt="Slide <?= $i ?>" onerror="this.src='/presentation/Slide<?= $i ?>.png'; this.onerror=null;">
            </div>
        <?php endfor; ?>
    </div>

    <script>
        let currentSlide = 1;
        const totalSlides = <?= $totalSlides ?>;

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