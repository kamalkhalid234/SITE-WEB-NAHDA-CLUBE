<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>BizLand Bootstrap Template - Index</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <?php include "../inc/link.php"; ?>
    <link href="../assets/css/archife.css" rel="stylesheet">
</head>

<body>

    <!-- ======= Header ======= -->
    <?php include "../inc/header.php"; ?>
    <!-- End Header -->

    <main id="main">
        <div class="container" data-aos="fade-up">
            <div class="section-title">
                <h2>أرشيف الجمعية</h2>
                <h3>أرشيف<span> الجمعية</span></h3>
                <p>Ut possimus qui ut temporibus culpa velit eveniet modi omnis est adipisci expedita at voluptas atque vitae autem.</p>
            </div>

            <section>
                <div class="container">
                    <div class="top-content">
                        <span>Photo Gallery</span>
                        <!-- Ajoutez des étiquettes pour chaque type de photo -->
                        <?php
                        // Connexion à la base de données
                        $servername = "localhost";
                        $username = "root";
                        $password = "";
                        $database = "association";

                        $conn = new mysqli($servername, $username, $password, $database);

                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }
                        error_reporting(E_ALL);
                        ini_set('display_errors', 1);
                        // Requête SQL pour sélectionner les types de photos distincts
                        $sql = "SELECT id, type FROM types_photos";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            // Affichage des étiquettes pour chaque type de photo
                            while ($row = $result->fetch_assoc()) {
                                echo '<label><input type="radio" name="photo-type" class="photo-type" value="' . $row["id"] . '"> ' . $row["type"] . '</label>';
                            }
                        }
                        $conn->close();
                        ?>
                    </div>

                    <div class="photo-gallery">
                        <?php
                        // Connexion à la base de données
                        $conn = new mysqli($servername, $username, $password, $database);

                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }

                        // Requête SQL pour sélectionner les images avec leurs types
                        $sql = "SELECT gallery.image, types_photos.type, gallery.type_id FROM gallery
                                INNER JOIN types_photos ON gallery.type_id = types_photos.id";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            // Affichage des images pour chaque type
                            while ($row = $result->fetch_assoc()) {
                                echo '<div class="pic type-' . $row["type_id"] . '">';
                                echo '<img src="../admin/uploads/image/' . $row["image"] . '" alt="">';
                                echo '</div>';
                            }
                        }
                        $conn->close();
                        ?>
                    </div>
                </div>
            </section>
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

    <!-- Custom JS for filtering -->
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const radioButtons = document.querySelectorAll('.photo-type');
            const photos = document.querySelectorAll('.pic');

            radioButtons.forEach(radio => {
                radio.addEventListener('change', () => {
                    const selectedType = 'type-' + radio.value;

                    photos.forEach(photo => {
                        if (photo.classList.contains(selectedType)) {
                            photo.style.display = 'block';
                        } else {
                            photo.style.display = 'none';
                        }
                    });
                });
            });
        });
    </script>

</body>

</html>
