<?php
// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$database = "association";


$conne = new mysqli($servername, $username, $password, $database);


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
    <link rel="stylesheet" href="assets/css/swiper-bundle.min.css" />
    <?php
    include "inc/link.php";
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

    <!-- ======= Hero Section ======= -->

    <main id="main">

        <!-- ======= Team Section ======= -->
        <section id="team" class="team section-bg">
            <div class="container" data-aos="fade-up">
                <div class="section-title">
                    <h2>Team</h2>
                    <h3> <span>لاعبو </span>الفريق</h3>
                    <p>Ut possimus qui ut temporibus culpa velit eveniet modi omnis est adipisci expedita at voluptas
                        atque vitae autem.</p>
                </div>

                <div class="container swiper">
                    <div class="slide-container">
                        <div class="card-wrapper swiper-wrapper">
                            <?php
                            // Enable error reporting for debugging
                            // error_reporting(E_ALL);
                            // ini_set('display_errors', 1);
                            
                            // Assume $conne is a valid MySQLi connection instance
                            if ($conne) {
                                // SQL query to select players from the specified category and sport
                                $sql_joueur = "SELECT nom, prenom, numero_maillot, image, role FROM joueurs WHERE categorie_id = 1 AND type_sport_id = 1";
                                $result_joueur = $conne->query($sql_joueur);

                                // Check if there are results
                                if ($result_joueur && $result_joueur->num_rows > 0) {
                                    // Use an array to keep track of displayed players
                                    $displayed_players = [];

                                    // Fetch and display each player's data
                                    while ($row = $result_joueur->fetch_assoc()) {
                                        // Combine name and jersey number to create a unique key
                                        $player_key = $row['numero_maillot'] . '_' . $row['nom'] . '_' . $row['prenom'];

                                        // Check if this player has already been displayed
                                        if (!in_array($player_key, $displayed_players)) {
                                            // Add player key to the array
                                            $displayed_players[] = $player_key;
                                            ?>
                            <div class="card swiper-slide shadow">
                                <div class="image-box">
                                    <!-- Ensure the image path is correct -->
                                    <img src="admin/image/<?= htmlspecialchars($row['image']) ?>" alt="Player Image" />
                                </div>
                                <div
                                    class="profile-details bg-primary d-flex justify-content-center align-items-center">
                                    <div class="text-center">
                                        <!-- Display jersey number, name, and role with correct styling -->
                                        <h4 class="job text-yellow mb-0"><?= htmlspecialchars($row['numero_maillot']) ?>
                                        </h4>
                                        <h3 class="name text-white"><?= htmlspecialchars($row['prenom']) ?>
                                            <?= htmlspecialchars($row['nom']) ?>
                                        </h3>
                                        <h4 class="role text-yellow mb-0"><?= htmlspecialchars($row['role']) ?></h4>
                                    </div>
                                </div>
                            </div>
                            <?php
                                        }
                                    }
                                } else {
                                    // Message if no players are found
                                    echo "Aucun joueur trouvé.";
                                }
                            } else {
                                // Error message if the database connection fails
                                echo "Erreur de connexion à la base de données.";
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
        </section><!-- End Team Section -->




    </main><!-- End #main -->

    <!-- Vendor JS Files -->
    <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/vendor/waypoints/noframework.waypoints.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="../assets/js/main.js"></script>
    <!-- Swiper JS CDN -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="assets/js/swiper-bundle.min.js"></script>
    <script src="assets/js/script.js"></script>

    <script>
    var swiper = new Swiper('.swiper-container', {
        slidesPerView: 'auto',
        spaceBetween: 2,
        loop: true,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
    });
    </script>
</body>

</html>