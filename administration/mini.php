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
                    <h2> كرة القدم الصغار </h2>
                    <h3> <span> المقابلات</span></h3>
                    <p>Ut possimus qui ut temporibus culpa velit eveniet modi omnis est adipisci expedita at
                        voluptas
                        atque vitae autem.</p>
                </div>
                <div class="container swiper match shadow">
                    <div class="slide-container ">
                        <div class="card-wrapper swiper-wrapper   ">

                        <?php
                            $categorie_id = 4; // Set category ID
                            $type_sport_id = 1; // Set type sport ID

                            $sql = "SELECT * FROM matches WHERE categorie_id = $categorie_id AND type_sport_id = $type_sport_id";
                            $result = $conne->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo '
                                    <div class="swiper-slide match-card shadow">
                                        <div class="team-logos">
                                            <img src="../assets/img/' . $row["team1_logo"] . '" alt="Team 1 Logo">
                                            <img src="../assets/img/' . $row["team2_logo"] . '" alt="Team 2 Logo">
                                        </div>
                                        <h2>' . $row["score"] . '</h2>
                                        <div class="details">
                                            <p><i class="fas fa-calendar-alt"></i> ' . $row["date"] . ' - ' . $row["time"] . '</p>
                                            <p><i class="fas fa-map-marker-alt"></i> ' . $row["location"] . '</p>
                                        </div>
                                    </div>';
                                }
                            } else {
                                echo "0 results";
                            }
                            ?>
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
                    <h2> كرة القدم الصغار </h2>
                    <h3> <span>لاعبو </span>الفريق</h3>
                    <p>Ut possimus qui ut temporibus culpa velit eveniet modi omnis est adipisci expedita at
                        voluptas
                        atque vitae autem.</p>
                    <div class="container swiper">
                        <div class="slide-container">
                            <div class="card-wrapper swiper-wrapper">
                            <?php
                                $sql = "SELECT * FROM joueurs WHERE categorie_id = $categorie_id";
                                $result = $conne->query($sql);

                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo '
                                        <div class="card swiper-slide shadow">
                                            <div class="image-box">
                                                <img src="../admin/image/' . $row["image"] . '" alt="Player Image" />
                                            </div>
                                            <div class="profile-details bg-primary d-flex justify-content-center align-items-center">
                                                <div class="text-center">
                                                    <h3 class="name text-white">' . $row["prenom"] . ' ' . $row["nom"] . '</h3>
                                                    <h4 class="role text-yellow mb-0">' . $row["role"] . '</h4>
                                                </div>
                                            </div>
                                        </div>';
                                    }
                                } else {
                                    echo "0 results";
                                }
                                ?>

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
                    <h2> كرة القدم الصغار </h2>
                    <h3>مكتبة <span> الصور</span></h3>
                    <p>Ut possimus qui ut temporibus culpa velit eveniet modi omnis est adipisci expedita at
                        voluptas
                        atque vitae autem.</p>
                </div>
                <div class="swiper mySwiper shadow">
                    <div class="swiper-wrapper">
                    <?php
                        $sql = "SELECT * FROM gallery WHERE categorie_id = $categorie_id AND type_id = $type_sport_id";
                        $result = $conne->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo '
                                <div class="swiper-slide">
                                    <img src="../admin/image/' . $row["image"] . '" alt="Photo Image" />
                                </div>';
                            }
                        } else {
                            echo "0 results";
                        }
                        ?>

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