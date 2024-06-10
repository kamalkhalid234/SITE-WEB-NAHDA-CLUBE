<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "association";
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Création de la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    $created_at = date("Y-m-d H:i:s");

    // Préparation de la requête SQL pour insérer les données
    $sql = "INSERT INTO messages (name, email, subject, message, created_at) VALUES (?, ?, ?, ?, ?)";

    // Utilisation de prepared statement pour éviter les injections SQL
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $name, $email, $subject, $message, $created_at);

    // Exécution de la requête
    if ($stmt->execute()) {
        echo "<script> alert ('Your message has been sent. Thank you!')</script>";
    } else {
        echo "<script> alert ('Error: " . $sql . "<br>" . $conn->error . "')</script>";
    }

    // Fermeture du statement
    $stmt->close();
}

// Récupérer les informations de contact
$contact_sql = "SELECT * FROM contact_info";
$contact_result = $conn->query($contact_sql);

// Récupérer les informations de contact liées à la carte
$map_sql = "SELECT * FROM contact_info WHERE type = 'map'";
$map_result = $conn->query($map_sql);

// Fermeture de la connexion
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>BizLand Bootstrap Template - Index</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="../assets/img/favicon.png" rel="icon">
    <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">


    <!-- Link Swiper's CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <!-- Vendor CSS Files -->
    <link href="../assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="../assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="../assets/css/style.css" rel="stylesheet">
</head>

<body>

    <!-- ======= Header ======= -->
    <?php include "../inc/header.php"; ?>
    <!-- End Header -->

    <main id="main">

        <!-- ======= Contact Section ======= -->
        <section id="contact" class="contact">
            <div class="container" data-aos="fade-up">
                <div class="section-title">
                    <h2>اتصل بنا</h2>
                    <h3><span>اتصل </span>بنا</h3>
                </div>

                <div class="row" data-aos="fade-up" data-aos-delay="100">
                <?php
                    if ($contact_result->num_rows > 0) {
                        while ($row = $contact_result->fetch_assoc()) {
                            echo '<div class="col-lg-6 ">
                                    <div class="info-box mb-4 shadow">
                                        <i class="bx ' . $row["icon"] . '"></i>
                                        <h3>' . $row["title"] . '</h3>
                                        <p>' . $row["value"] . '</p>
                                    </div>
                                </div>';
                        }
                    } else {
                        echo "Aucune information de contact disponible.";
                    }
                    ?>

                </div>

                <div class="row" data-aos="fade-up" data-aos-delay="100">

<?php if ($map_result->num_rows > 0) {
    // Affichage de la carte Google Maps
    $row = $map_result->fetch_assoc();
    echo '<div class="col-lg-6">';
    echo '<iframe class="mb-4 mb-lg-0 shadow" src="' . $row['map_url'] . '" frameborder="0" style="border:0; width: 100%; height: 384px;" allowfullscreen></iframe>';
    echo '</div>';
} else {
    echo "Aucune information de carte disponible.";
} ?>


                    <div class="col-lg-6 ">
                        <form action="" method="post" class="shadow p-4">
                            <div class="mb-3">
                                <label for="name" class="form-label">Your Name</label>
                                <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Your Email</label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
                            </div>
                            <div class="mb-3">
                                <label for="subject" class="form-label">Subject</label>
                                <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
                            </div>
                            <div class="mb-3">
                                <label for="message" class="form-label">Message</label>
                                <textarea class="form-control" name="message" id="message" rows="5" placeholder="Message" required></textarea>
                            </div>
                            <div class="text-center"><button type="submit" class="btn btn-primary">Send Message</button></div>
                        </form>
                    </div>

                </div>

            </div>
        </section><!-- End Contact Section -->

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

    <!-- TemplateMain JS File -->
<script src="../assets/js/main.js"></script>

</body>
</html>