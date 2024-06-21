<?php
// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$database = "association";
error_reporting(E_ALL);
ini_set('display_errors', 1);


$conne = new mysqli($servername, $username, $password, $database);

if ($conne->connect_error) {
    die("Connection failed: " . $conne->connect_error);
}
?>


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

    .swiper-slide {
        width: auto;
        margin-right: 5;
    }

    .swiper-slide img {
        width: 100%;
        height: 50vh;
    }

    .h-font {
        font-family: 'Meriend', cursive;
    }

    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }


    .custom-bg {
        background-color: var(--teal);
        border: 1px solid --teal
    }

    /* .custom-bg:hover {
        background-color: var(--teal_hover);
        border-color: var(--teal_hover);
    } */


    .h-line {
        width: 150px;
        margin: 0 auto;
        height: 1.7px;
    }


    .pop:hover {
        border-top-color: #007bff !important;
        transform: scale(1.06);
        transition: all 0.3s;
    }

    .text-yellow {
        color: yellow !important;
        /* Appliquer la couleur jaune */
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
                <img src="../assets/img/logo.png" class="shadow" alt="">
            </div>

    </section><!-- End Hero -->

    <main id="main">

        <!-- ======= Featured Services Section ======= -->
        <section id="featured-services" class="featured-services">
            <div class="container" data-aos="">
                <div class="section-title">
                    <h2>About</h2>
                    <h3>Types de <span>Sports</span></h3>
                </div>

                <div class="row justify-content-center">
                    <?php
                    // Récupérer les types et descriptions existants
                    $sql = "SELECT * FROM types_photos";
                    $result = $conne->query($sql);
                    while ($row = $result->fetch_assoc()): ?>
                    <div class="col-lg-4 col-md-6 mb-5 px-4">
                        <div class="bg-white rounded shadow p-4 border-top border-3 border-dark pop">
                            <div class="d-flex align-items-center mb-2">
                                <?php if (!empty($row['image'])): ?>
                                <img src="../admin/<?= $row['image'] ?>" width="70px" alt="">
                                <?php else: ?>
                                <img src="../assets/img/default-icon.png" width="70px" alt="">
                                <?php endif; ?>
                                <h5 class="m-0 ms-3"><?= $row['type'] ?></h5>
                            </div>
                            <p><?= $row['description'] ?: 'Pas de description disponible.' ?></p>
                        </div>
                    </div>
                    <?php endwhile; ?>
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
                    <div class="col-lg-6">
                        <?php  // Récupérer les images et les descriptions existantes
                        $sql_classment = "SELECT * FROM classement ORDER BY id DESC LIMIT 1";
                        $result_classement = $conne->query($sql_classment);
                        $row = $result_classement->fetch_assoc();
                        if (isset($row['equipe_image']) && !empty($row['equipe_image'])): ?>
                        <img src="../admin/<?= $row['equipe_image'] ?>" class="img-fluid shadow" alt="Image Équipe"
                            style="width: 100%; height: 60vh;">
                        <?php else: ?>
                        <p>Aucune image d'équipe trouvée.</p>
                        <?php endif; ?>
                    </div>
                    <div class="col-lg-6">
                        <div class="card shadow">
                            <?php if (isset($row['classement_image']) && !empty($row['classement_image'])): ?>
                            <img src="../admin/<?= $row['classement_image'] ?>" class="img-fluid shadow"
                                alt="Image Classement" style="width: 100%; height: 60vh;">
                            <div class="card-body">
                                <p class="card-text"><?= $row['description'] ?></p>
                            </div>
                            <?php else: ?>
                            <p>Aucune image de classement trouvée.</p>
                            <?php endif; ?>
                        </div>
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
                    <?php


                    // Requête SQL pour sélectionner les trois actualités les plus récentes
                    $sql = "SELECT * FROM news ORDER BY date DESC LIMIT 3";
                    $result = $conne->query($sql);
                    error_reporting(E_ALL);
                    ini_set('display_errors', 1);
                    if ($result->num_rows > 0) {
                        // Affichage des actualités
                        while ($row = $result->fetch_assoc()) {
                            echo '<div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0" data-aos="zoom-in" data-aos-delay="100">';
                            echo '<div class="card border-0 shadow">';
                            echo '<img src="../admin/uploads/image/' . $row["image"] . '" class="card-img-top" alt="' . $row["title"] . '">';
                            echo '<div class="card-body text-center">';
                            echo '<h5 class="card-title">' . $row["title"] . '</h5>';
                            echo '<p class="card-text">' . $row["content"] . '</p>';
                            echo '<p class="card-text">' . $row["date"] . '</p>'; // Afficher la date
                            echo '<a href="actualete.php?id=' . $row["id"] . '" class="btn btn-primary">Voir plus</a>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                        }
                    } else {
                        echo '<p>Aucune actualité trouvée.</p>';
                    }


                    ?>

                </div>
            </div>
        </section>




        <!-- ======= Portfolio Section ======= -->
        <section id="portfolio" class="portfolio">
            <div class="container albume" data-aos="fade-up">
                <div class="section-title">
                    <h2>مكتبة الصور</h2>
                    <h3>مكتبة <span> الصور</span></h3>
                    <p>Ut possimus qui ut temporibus culpa velit eveniet modi omnis est adipisci expedita at voluptas
                        atque vitae autem.</p>
                </div>
                <div class="swiper mySwiper">
                    <div class="swiper-wrapper">
                        <?php // Requête SQL pour sélectionner les images où type_id = 1
                        $sql = "SELECT * FROM gallery WHERE type_id = 1";
                        $result = $conne->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<div class='swiper-slide'>
                                        <img src='../admin/uploads/image/" . htmlspecialchars($row['image']) . "' alt='Player Image' />
                                      </div>";
                            }
                        } else {
                            echo "<p>Aucune image trouvée.</p>";
                        }
                        ?>

                    </div>
                </div>

            </div>
        </section>
        <!-- End Portfolio Section -->





        <!-- ======= Clients Section ======= -->
        <!-- ======= Clients Section ======= -->
        <section id="clients" class="clients section-bg">
            <div class="container">
                <div class="row">
                    <?php
                    // Requête SQL pour récupérer les images des sponsors
                    $sql = "SELECT image FROM sponsors";
                    $result = $conne->query($sql);

                    // Afficher les images des sponsors
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            ?>
                    <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
                        <img src="../admin/uploads/image/<?= $row['image'] ?>" class="img-fluid" alt="">
                    </div>

                    <?php
                        }
                    } else {
                        echo "Aucun sponsor trouvé.";
                    }
                    ?>
                </div>
            </div>
        </section><!-- End Clients Section -->


        <!-- End Clients Section -->


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
    <!-- Swiper JS CDN -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="../assets/js/swiper-bundle.min.js"></script>
    <script src="../assets/js/script.js"></script>

    <script>
    var swiper = new Swiper('.swiper-container', {
        slidesPerView: 'auto',
        spaceBetween: 1,
        loop: true,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
    });
    </script>

    <script>
    var swiper = new Swiper(".mySwiper", {
        watchSlidesProgress: true,
        slidesPerView: 2,
    });
    </script>
</body>

</html>