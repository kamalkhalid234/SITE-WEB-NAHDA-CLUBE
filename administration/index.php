<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>NAHAD</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="../assets/css/swiper-bundle.min.css" />
    <?php
    include "../inc/link.php";
    ?>
    <style>
    .tajarib {
        background-color: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .tajarib thead {
        background-color: #007bff;
        color: #fff;
    }

    .tajarib th,
    .tajarib td {
        vertical-align: middle;
    }

    .tajarib img {
        width: 100%;
        height: 50px;
        border-radius: 50%;
    }

    .table-bordered {
        border: 1px solid #dee2e6;
    }

    .swiper-container {
        width: 100%;
        margin: 0 auto;
    }

    .swiper-wrapper {
        display: flex;
        flex-wrap: nowrap;
    }

    .swiper-slide {
        flex: 1 0 auto;
        /* Allows slides to take up the available space */
        margin-right: 0;
        /* Removes right margin */
    }

    .swiper-slide img {
        width: 100%;
        height: 50vh;
        object-fit: cover;
        /* Ensures the image covers the entire area */
        display: block;
        /* Removes any potential inline-space issues */
    }
    </style>
</head>

<body>

    <!-- ======= Header ======= -->
    <?php include "../inc/header.php"; ?>
    <!-- End Header -->

    <!-- ======= Hero Section ======= -->
    <section id="hero" class="d-flex align-items-center">
        <div class="container" data-aos="zoom-out" data-aos-delay="100">
            <div class="row">

            </div>
            <h1>NAHDA <span>الموقع الرسمي </span></h1>
            <h1>VILLE DE CHICHAOUA</h1>
            <h2> نهضة شيشاوة , هو نادي لكرة القدم تأسس في عام 1973 ومقره مدينة شيشاوة</h2>
            <div class="d-flex">
                <a href="https://www.youtube.com/watch?v=jDDaplaOz7Q" class="glightbox btn-watch-video"><i
                        class="bi bi-play-circle"></i><span>Watch Video</span></a>
            </div>
            <div class="logo-container">
                <img src="../assets/img/logo.png" alt="">
            </div>

    </section><!-- End Hero -->

    <main id="main">

        <!-- ======= Featured Services Section ======= -->
        <section id="featured-services" class="featured-services">
            <div class="container" data-aos="">
                <div class="section-title">
                    <h2>About</h2>
                    <h3>Find Out More <span>About Us</span></h3>
                    <p>Ut possimus qui ut temporibus culpa velit eveniet modi omnis est adipisci expedita at voluptas
                        atque vitae autem.</p>
                </div>

                <div class="row justify-content-center">
                    <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
                        <div class="icon-box" data-aos="fade-up" data-aos-delay="100">
                            <div class="icon"><i class="bx bx-football"></i></div>
                            <h4 class="title"><a href="">كرة القدم </a></h4>
                            <p class="description">Voluptatum deleniti atque corrupti quos dolores et quas molestias
                                excepturi</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
                        <div class="icon-box" data-aos="fade-up" data-aos-delay="400">
                            <div class="icon"><i class="bx bx-basketball"></i></div>
                            <h4 class="title"><a href="">كرة السلة</a></h4>
                            <p class="description">At vero eos et accusamus et iusto odio dignissimos ducimus qui
                                blanditiis</p>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
                        <div class="icon-box" data-aos="fade-up" data-aos-delay="400">
                            <div class="icon"><i class="bx bx-tennis-ball"></i></div>
                            <h4 class="title"><a href="">كرة اليد</a></h4>
                            <p class="description">At vero eos et accusamus et iusto odio dignissimos ducimus qui
                                blanditiis</p>
                        </div>
                    </div>

                </div>

            </div>
        </section>

        <!-- End Featured Services Section -->

        <!-- ======= About Section ======= -->
        <section id="about" class="about section-bg">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2>جدول النقط</h2>
                    <h3>جدول <span> النقط</span></h3>
                    <p>Ut possimus qui ut temporibus culpa velit eveniet modi omnis est adipisci expedita at voluptas
                        atque vitae autem.</p>
                </div>

                <div class="row">
                    <div class="col-lg-6" data-aos="fade-right" data-aos-delay="100">
                        <img src="../assets/img/equipe/imagN1.jpg" class="img-fluid" alt="">
                    </div>
                    <div class="col-lg-6 mx-auto pt-5 pt-lg-3 content d-flex flex-column justify-content-center">
                        <table class="table table-hover table-bordered tajarib">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Image</th>
                                    <th>Team Name</th>
                                    <th>Rating</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td><img src="../assets/img/logo.png" alt="Team A"></td>
                                    <td>Team A</td>
                                    <td>8.5</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td><img src="../assets/img/logo.png" alt="Team B"></td>
                                    <td>Team B</td>
                                    <td>7.9</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td><img src="../assets/img/logo.png" alt="Team C"></td>
                                    <td>Team C</td>
                                    <td>9.1</td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td><img src="../assets/img/logo.png" alt="Team D"></td>
                                    <td>Team D</td>
                                    <td>6.8</td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td><img src="../assets/img/logo.png" alt="Team A"></td>
                                    <td>Team A</td>
                                    <td>8.5</td>
                                </tr>
                                <tr>
                                    <td>6</td>
                                    <td><img src="../assets/img/logo.png" alt="Team B"></td>
                                    <td>Team B</td>
                                    <td>7.9</td>
                                </tr>
                                <tr>
                                    <td>7</td>
                                    <td><img src="../assets/img/logo.png" alt="Team C"></td>
                                    <td>Team C</td>
                                    <td>9.1</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </section>
        <!-- End About Section -->




        <!-- ======= Services Section ======= -->
        <section id="services" class="services">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2>أحدث الأخبار</h2>
                    <h3>أحدث <span> الأخبار</span></h3>
                    <p>Ut possimus qui ut temporibus culpa velit eveniet modi omnis est adipisci expedita at voluptas
                        atque vitae autem.</p>
                </div>

                <div class="row">
                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0" data-aos="zoom-in"
                        data-aos-delay="200">
                        <div class="card">
                            <img src="../assets/img/equipe/imagN1.jpg" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text">Some quick example text to build on the card title and make up the
                                    bulk
                                    of the card's content.</p>
                                <a href="actualete.php" class="btn btn-primary">Go somewhere</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0" data-aos="zoom-in"
                        data-aos-delay="300">
                        <div class="card">
                            <img src="../assets/img/equipe/imagN1.jpg" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text">Some quick example text to build on the card title and make up the
                                    bulk
                                    of the card's content.</p>
                                <a href="actualete.php" class="btn btn-primary">Go somewhere</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0" data-aos="zoom-in"
                        data-aos-delay="400">
                        <div class="card">
                            <img src="../assets/img/equipe/imagN1.jpg" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text">Some quick example text to build on the card title and make up the
                                    bulk
                                    of the card's content.</p>
                                <a href="actualete.php" class="btn btn-primary">Go somewhere</a>
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
                    <h2>Team</h2>
                    <h3> <span>لاعبو </span>الفريق</h3>
                    <p>Ut possimus qui ut temporibus culpa velit eveniet modi omnis est adipisci expedita at voluptas
                        atque
                        vitae autem.</p>
                </div>

                <div class="container swiper">
                    <div class="slide-container">
                        <div class="card-wrapper swiper-wrapper">
                            <div class="card swiper-slide">
                                <div class="image-box">
                                    <img src="../assets/img/jeuour/image_porf.png" alt="" />
                                </div>
                                <div class="profile-details">
                                    <div class="name-job">
                                        <h3 class="name">David Cardlos</h3>
                                        <h4 class="job">Full Stack Developer</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="card swiper-slide">
                                <div class="image-box">
                                    <img src="../assets/img/jeuour/image_porf.png" alt="" />
                                </div>
                                <div class="profile-details">
                                    <div class="name-job">
                                        <h3 class="name">Siliana Ramis</h3>
                                        <h4 class="job">Photographer</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="card swiper-slide">
                                <div class="image-box">
                                    <img src="../assets/img/jeuour/image_porf.png" alt="" />
                                </div>
                                <div class="profile-details">
                                    <div class="name-job">
                                        <h3 class="name">Richard Bond</h3>
                                        <h4 class="job">Data Analyst</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="card swiper-slide">
                                <div class="image-box">
                                    <img src="../assets/img/jeuour/image_porf.png" alt="" />
                                </div>
                                <div class="profile-details">
                                    <div class="name-job">
                                        <h3 class="name">Priase</h3>
                                        <h4 class="job">App Developer</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="card swiper-slide">
                                <div class="image-box">
                                    <img src="../assets/img/jeuour/image_porf.png" alt="" />
                                </div>
                                <div class="profile-details">
                                    <div class="name-job">
                                        <h3 class="name">James Laze</h3>
                                        <h4 class="job">Blogger</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-button-next swiper-navBtn"></div>
                    <div class="swiper-button-prev swiper-navBtn"></div>
                    <div class="swiper-pagination"></div>
                </div>


            </div>
        </section><!-- End Team Section -->


        <!-- ======= Portfolio Section ======= -->
        <!-- ======= Portfolio Section ======= -->
        <section id="portfolio" class="portfolio">
            <div class="container albume" data-aos="fade-up">
                <div class="section-title">
                    <h2>مكتبة الصور</h2>
                    <h3>مكتبة <span> الصور</span></h3>
                    <p>Ut possimus qui ut temporibus culpa velit eveniet modi omnis est adipisci expedita at voluptas
                        atque vitae autem.</p>
                </div>
                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <img src="../assets/img/equipe/imagN1.jpg" alt="Image 1">
                        </div>
                        <div class="swiper-slide">
                            <img src="../assets/img/equipe/imagN2.jpg" alt="Image 2">
                        </div>
                        <div class="swiper-slide">
                            <img src="../assets/img/equipe/imagN1.jpg" alt="Image 3">
                        </div>
                        <div class="swiper-slide">
                            <img src="../assets/img/equipe/imagN2.jpg" alt="Image 4">
                        </div>
                        <div class="swiper-slide">
                            <img src="../assets/img/equipe/imagN1.jpg" alt="Image 5">
                        </div>
                        <div class="swiper-slide">
                            <img src="../assets/img/equipe/imagN2.jpg" alt="Image 6">
                        </div>
                        <div class="swiper-slide">
                            <img src="../assets/img/equipe/imagN1.jpg" alt="Image 7">
                        </div>
                        <div class="swiper-slide">
                            <img src="../assets/img/equipe/imagN2.jpg" alt="Image 8">
                        </div>
                        <!-- Ajoutez d'autres diapositives selon vos besoins -->
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </section><!-- End Portfolio Section -->

        <!-- End Portfolio Section -->




        <!-- ======= Clients Section ======= -->
        <section id="clients" class="clients section-bg">
            <div class="container">
                <div class="row">
                    <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
                        <img src="../assets/img/clients/arig.jpg" class="img-fluid" alt="">
                    </div>

                    <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
                        <img src="../assets/img/clients/mobadara.jpg" class="img-fluid" alt="">
                    </div>

                    <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">

                        <img src="../assets/img/clients/jama3a.jpg" class="img-fluid" alt="">
                    </div>

                    <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
                        <img src="../assets/img/clients/wizara_chabab.jpg" class="img-fluid" alt="">
                    </div>

                    <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
                        <img src="../assets/img/clients/wizara_chabab.jpg" class="img-fluid" alt="">
                    </div>

                    <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
                        <img src="../assets/img/clients/wizara_chabab.jpg" class="img-fluid" alt="">
                    </div>
                </div>

            </div>
        </section><!-- End Clients Section -->


    </main><!-- End #main -->

    <!-- ======= Footer ======= -->

    <?php include "../inc/footer.php"; ?>
    <!-- End Footer -->

    <div id="preloader"></div>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

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
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <!-- Swiper JS CDN -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="../assets/js/swiper-bundle.min.js"></script>
    <script src="../assets/js/script.js"></script>

    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script>
    var swiper = new Swiper('.swiper-container', {
        slidesPerView: 'auto',
        spaceBetween: 5,
        loop: true,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
    });
    </script>
</body>

</html>