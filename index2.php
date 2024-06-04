<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Swiper Carrousel</title>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <style>
    .swiper-container {
        width: 100%;
        border: 2px solid black;
        margin: 0 auto;
    }

    .swiper-slide {
        width: auto;
        margin-right: 15px;
    }

    .swiper-slide img {
        width: 100%;
        height: auto;
    }
    </style>
</head>

<body>

    <div class="swiper-container">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <img src="assets/img/equipe/imagN1.jpg" alt="Image 1">
            </div>
            <div class="swiper-slide">
                <img src="assets/img/equipe/imagN1.jpg" alt="Image 1">
            </div>
            <div class="swiper-slide">
                <img src="assets/img/equipe/imagN1.jpg" alt="Image 1">
            </div>
            <!-- Ajoutez d'autres diapositives selon vos besoins -->
        </div>
        <div class="swiper-pagination"></div>
    </div>

    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script>
    var swiper = new Swiper('.swiper-container', {
        slidesPerView: 'auto',
        spaceBetween: 10,
        loop: true,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
    });
    </script>

</body>

</html>