<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>كرة اليد</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <link href="../assets/css/style.css" rel="stylesheet">

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="../assets/css/swiper-bundle.min.css" />
    <?php include "../inc/link.php"; ?>
    <style>
    .swiper-container {
        width: 80%;
        margin: 0 auto;
    }

    .swiper-slide {
        width: auto;
        margin-right: 5px;
        /* corrected */
    }

    .swiper-slide img {
        width: 100%;
        height: 50vh;
    }

    .container-1 {
        width: 60%;
        margin: auto;
    }

    .container-3 {
        width: 100%;
        margin: auto;
    }

    .match-card {
        text-align: center;
        padding: 20px;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .match-card img {
        width: 80px;
        height: auto;
        margin-bottom: 10px;
    }

    .team-logos {
        display: flex;
        justify-content: space-between;
        width: 100%;
    }

    .team-logos img {
        width: 100px;
        height: auto;
    }
    </style>
</head>

<body>




    <div class="container" data-aos="fade-up">
        <div class="section-title">
            <h2>كرة اليد</h2>
            <h3><span>المقابلات</span></h3>
            <p>Ut possimus qui ut temporibus culpa velit eveniet modi omnis est adipisci expedita at voluptas atque
                vitae autem.</p>
        </div>
        <div class="swiper-container swiper-container-2">
            <div class="swiper-wrapper">

                <div class="swiper-slide match-card shadow">
                    <div class="team-logos">
                        <img src="../assets/img/logo.png" alt="Team 1 Logo">
                        <img src="../assets/img/logo.png" alt="Team 2 Logo">
                    </div>
                    <h2>3:0</h2>
                    <div class="details">
                        <p><i class="fas fa-calendar-alt"></i> February 12, 2022 - 06:00 PM</p>
                        <p><i class="fas fa-map-marker-alt"></i> ملعب البشير</p>
                    </div>
                </div>

                <div class="swiper-slide match-card shadow">
                    <div class="team-logos">
                        <img src="../assets/img/logo.png" alt="Team 1 Logo">
                        <img src="../assets/img/logo.png" alt="Team 2 Logo">
                    </div>
                    <h2>0:1</h2>
                    <div class="details">
                        <p><i class="fas fa-calendar-alt"></i> February 03, 2022 - 12:00 AM</p>
                        <p><i class="fas fa-map-marker-alt"></i> ملعب ابن بطوطة</p>
                    </div>
                </div>

                <div class="swiper-slide match-card shadow">
                    <div class="team-logos">
                        <img src="../assets/img/logo.png" alt="Team 1 Logo">
                        <img src="../assets/img/logo.png" alt="Team 2 Logo">
                    </div>
                    <h2>1:0</h2>
                    <div class="details">
                        <p><i class="fas fa-calendar-alt"></i> March 01, 2022 - 08:00 PM</p>
                        <p><i class="fas fa-map-marker-alt"></i> ملعب ابن بطوطة</p>
                    </div>
                </div>

                <div class="swiper-slide match-card shadow">
                    <div class="team-logos">
                        <img src="../assets/img/logo.png" alt="Team 1 Logo">
                        <img src="../assets/img/logo.png" alt="Team 2 Logo">
                    </div>
                    <h2>1:0</h2>
                    <div class="details">
                        <p><i class="fas fa-calendar-alt"></i> March 01, 2022 - 08:00 PM</p>
                        <p><i class="fas fa-map-marker-alt"></i> ملعب ابن بطوطة</p>
                    </div>
                </div>

                <div class="swiper-slide match-card shadow">
                    <div class="team-logos">
                        <img src="../assets/img/logo.png" alt="Team 1 Logo">
                        <img src="../assets/img/logo.png" alt="Team 2 Logo">
                    </div>
                    <h2>1:0</h2>
                    <div class="details">
                        <p><i class="fas fa-calendar-alt"></i> March 01, 2022 - 08:00 PM</p>
                        <p><i class="fas fa-map-marker-alt"></i> ملعب ابن بطوطة</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <?php include "../inc/footer.php"; ?>
    <!-- End Footer -->

    <!-- Vendor JS Files -->
    <script src="../assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="../assets/vendor/aos/aos.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="../assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="../assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="../assets/vendor/waypoints/noframework.waypoints.js"></script>
    <script src="../assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="../assets/js/main.js"></script>

    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Swiper JS -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>

    <script>
    var swiper = new Swiper('.swiper-container-2', {
        loop: true,
        spaceBetween: 60, // Ajoute un espace de 30px entre les diapositives
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
    });
    </script>

    <script>
    var swiper = new Swiper('.container-3', {
        slidesPerView: 1,
        spaceBetween: 0,
        loop: true,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });
    </script>

</body>

</html>