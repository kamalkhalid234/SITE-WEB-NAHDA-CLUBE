<?php
// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "association";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Récupérer les données de la table de support
$sql = "SELECT * FROM support";
$result = $conn->query($sql);

// Afficher les données dans la page HTML
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>BizLand Bootstrap Template - Index</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <?php include "../inc/link.php"; ?>
    <style>
        .support-option {
            margin-bottom: 20px;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            text-align: center;
            box-shadow: 1px 1px 1px 1px black;
        }

        .support-option h2 {
            margin-bottom: 15px;
        }
    </style>
</head>

<body>
    <!-- ======= Header ======= -->
    <?php include "../inc/header.php"; ?>
    <!-- End Header -->
    <main>
        <div class="container" data-aos="fade-up">
            <div class="section-title">
                <h2>دعم الجمعية</h2>
                <h3>دعم<span> الجمعية</span></h3>
                <p>Ut possimus qui ut temporibus culpa velit eveniet modi omnis est adipisci expedita at voluptas atque vitae autem.</p>
                <?php
                // Afficher les données de la table de support
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="support-option shadow">';
                        echo '<h2>' . $row['title'] . ' <span class="badge badge-primary">' . $row['badge'] . '</span></h2>';
                        echo '<p>' . $row['description'] . '</p>';
                        echo '</div>';
                    }
                } else {
                    echo "Aucun support disponible.";
                }
                ?>
            </div>
        </div>
    </main>
    <!-- ======= Footer ======= -->
       <?php include "../inc/footer.php"; ?>
       <!-- End Footer -->

       <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
       <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
       <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

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

   </body>

   </html>
