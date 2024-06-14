<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title> كرة القدم</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="../assets/css/swiper-bundle.min.css" />
    <?php
    include "../inc/link.php";
    ?>


    <style>
    .swiper-container-1 {
        width: 80%;
        margin: 0 auto;
    }

    .swiper-slide {
        width: auto;
        margin-right: 5;
    }

    .swiper-slide img {
        width: 100%;
        height: 60vh;
    }

    .mySwiper {
        width: 100%;
    }

    .swiper-container {
        width: 80%;
        margin: 0 auto;
    }

    .swiper-slide {
        width: 50%;
        margin-right: 5px;
        /* corrected */
    }

    .swiper-slide img {
        width: 100%;
        height: 50vh;
    }


    .match-card {
        text-align: center;
        padding: 20px;
        width: 100%;
        flex-direction: column;
        align-items: center;
    }

    .match-card img {
        width: 100px;
        height: auto;
        margin-bottom: 10px;
    }

    .team-logos {
        display: flex;
        justify-content: space-between;
        width: 100%;
    }

    .team-logos img {
        width: 55px;
        height: auto;
    }

    .match {
        /* border: 2px solid black; */
    }
    </style>

</head>

<body>

    <!-- ======= Header ======= -->
    <?php include "../inc/header.php"; ?>
    <!-- End Header -->

    <main id="main">
        <!-- ======= Services Section ======= -->
        <section id="services" class="services">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2>كرة القدم البراعم</h2>
                    <h3> <span> المقابلات</span></h3>
                    <p>Ut possimus qui ut temporibus culpa velit eveniet modi omnis est adipisci expedita at voluptas
                        atque vitae autem.</p>
                </div>
                <div class="container swiper match shadow">
                    <div class="slide-container ">
                        <div class="card-wrapper swiper-wrapper   ">

                            <div class="swiper-slide match-card shadow  ">
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

            </div>
        </section>


        <!-- End Services Section -->
        <!-- ======= Team Section ======= -->
        <section id="team" class="team section-bg">
            <div class="container" data-aos="fade-up">
                <div class="section-title">
                    <h2> كرة القدم البراعم</h2>
                    <h3> <span>لاعبو </span>الفريق</h3>
                    <p>Ut possimus qui ut temporibus culpa velit eveniet modi omnis est adipisci expedita at
                        voluptas
                        atque vitae autem.</p>
                    <div class="container swiper">
                        <div class="slide-container">
                            <div class="card-wrapper swiper-wrapper">
                                <div class="card swiper-slide shadow">
                                    <div class="image-box">
                                        <!-- Ensure the image path is correct -->
                                        <img src="../admin/image/profile.jpg" alt="Player Image" />
                                    </div>
                                    <div
                                        class="profile-details bg-primary d-flex justify-content-center align-items-center">
                                        <div class="text-center">
                                            <!-- Display jersey number, name, and role with correct styling -->
                                            <h4 class="job text-yellow mb-0">1
                                            </h4>
                                            <h3 class="name text-white">1

                                            </h3>
                                            <h4 class="role text-yellow mb-0">1</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="card swiper-slide shadow">
                                    <div class="image-box">
                                        <!-- Ensure the image path is correct -->
                                        <img src="../admin/image/profile.jpg" alt="Player Image" />
                                    </div>
                                    <div
                                        class="profile-details bg-primary d-flex justify-content-center align-items-center">
                                        <div class="text-center">
                                            <!-- Display jersey number, name, and role with correct styling -->
                                            <h4 class="job text-yellow mb-0">2
                                            </h4>
                                            <h3 class="name text-white">2

                                            </h3>
                                            <h4 class="role text-yellow mb-0">2</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="card swiper-slide shadow">
                                    <div class="image-box">
                                        <!-- Ensure the image path is correct -->
                                        <img src="../admin/image/profile.jpg" alt="Player Image" />
                                    </div>
                                    <div
                                        class="profile-details bg-primary d-flex justify-content-center align-items-center">
                                        <div class="text-center">
                                            <!-- Display jersey number, name, and role with correct styling -->
                                            <h4 class="job text-yellow mb-0">3
                                            </h4>
                                            <h3 class="name text-white">3

                                            </h3>
                                            <h4 class="role text-yellow mb-0">3</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="card swiper-slide shadow">
                                    <div class="image-box">
                                        <!-- Ensure the image path is correct -->
                                        <img src="../admin/image/profile.jpg" alt="Player Image" />
                                    </div>
                                    <div
                                        class="profile-details bg-primary d-flex justify-content-center align-items-center">
                                        <div class="text-center">
                                            <!-- Display jersey number, name, and role with correct styling -->
                                            <h4 class="job text-yellow mb-0">4
                                            </h4>
                                            <h3 class="name text-white">4

                                            </h3>
                                            <h4 class="role text-yellow mb-0">4</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="card swiper-slide shadow">
                                    <div class="image-box">
                                        <!-- Ensure the image path is correct -->
                                        <img src="../admin/image/profile.jpg" alt="Player Image" />
                                    </div>
                                    <div
                                        class="profile-details bg-primary d-flex justify-content-center align-items-center">
                                        <div class="text-center">
                                            <!-- Display jersey number, name, and role with correct styling -->
                                            <h4 class="job text-yellow mb-0">5
                                            </h4>
                                            <h3 class="name text-white">5

                                            </h3>
                                            <h4 class="role text-yellow mb-0">5</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="card swiper-slide shadow">
                                    <div class="image-box">
                                        <!-- Ensure the image path is correct -->
                                        <img src="../admin/image/profile.jpg" alt="Player Image" />
                                    </div>
                                    <div
                                        class="profile-details bg-primary d-flex justify-content-center align-items-center">
                                        <div class="text-center">
                                            <!-- Display jersey number, name, and role with correct styling -->
                                            <h4 class="job text-yellow mb-0">6
                                            </h4>
                                            <h3 class="name text-white">6

                                            </h3>
                                            <h4 class="role text-yellow mb-0">6</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="card swiper-slide shadow">
                                    <div class="image-box">
                                        <!-- Ensure the image path is correct -->
                                        <img src="../admin/image/profile.jpg" alt="Player Image" />
                                    </div>
                                    <div
                                        class="profile-details bg-primary d-flex justify-content-center align-items-center">
                                        <div class="text-center">
                                            <!-- Display jersey number, name, and role with correct styling -->
                                            <h4 class="job text-yellow mb-0">7
                                            </h4>
                                            <h3 class="name text-white">7

                                            </h3>
                                            <h4 class="role text-yellow mb-0">7</h4>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- Swiper navigation buttons -->
                        <div class="swiper-button-next swiper-navBtn"></div>
                        <div class="swiper-button-prev swiper-navBtn"></div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ======= Portfolio Section ======= -->
        <section id="portfolio" class="portfolio">
            <div class="container albume" data-aos="fade-up">
                <div class="section-title">
                    <h2>كرة القدم البراعم</h2>
                    <h3>مكتبة <span> الصور</span></h3>
                    <p>Ut possimus qui ut temporibus culpa velit eveniet modi omnis est adipisci expedita at
                        voluptas
                        atque vitae autem.</p>
                </div>
                <div class="swiper mySwiper shadow">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <img src="../admin/image/customer-support.jpg" alt="Player Image" />
                        </div>
                        <div class="swiper-slide">
                            <img src="../admin/image/profile.jpg" alt="Player Image" />
                        </div>
                        <div class="swiper-slide">
                            <img src="../admin/image/customer-support.jpg" alt="Player Image" />
                        </div>
                        <div class="swiper-slide">
                            <img src="../admin/image/profile.jpg" alt="Player Image" />
                        </div>
                        <div class="swiper-slide">
                            <img src="../admin/image/customer-support.jpg" alt="Player Image" />
                        </div>
                        <div class="swiper-slide">
                            <img src="../admin/image/profile.jpg" alt="Player Image" />
                        </div>

                    </div>
                </div>

            </div>
        </section>
        <!-- End Portfolio Section -->





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
    <!-- Swiper JS CDN -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="../assets/js/script.js"></script>




    <script>
    var swiper = new Swiper('.swiper-container-2', {
        loop: true,
        spaceBetween: 30, // Ajoute un espace de 30px entre les diapositives
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
    var swiper = new Swiper(".mySwiper", {
        watchSlidesProgress: true,
        slidesPerView: 1,
    });
    </script>
</body>

</html>