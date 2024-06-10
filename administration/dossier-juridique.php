<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>الملف القانوني للجمعية</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <?php include "../inc/link.php"; ?>
    <style>
    h1 {
        text-align: center;
        margin-top: 20px;
        color: #333;
    }

    .pdf-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
        gap: 20px;
        margin-top: 20px;
    }

    .pdf-item {
        background-color: #fff;
        padding: 10px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    .pdf-item h2 {
        font-size: 1.2em;
        margin-bottom: 10px;
        color: #333;
    }

    .pdf-item iframe {
        width: 100%;
        border: none;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        height: 300px;
    }

    .buttons {
        display: flex;
        justify-content: center;
        gap: 10px;
        margin-top: 10px;
    }

    .view-btn,
    .download-btn {
        text-decoration: none;
        color: #fff;
        padding: 10px 20px;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    .view-btn {
        background-color: #28a745;
    }

    .view-btn:hover {
        background-color: #218838;
    }

    .download-btn {
        background-color: #007BFF;
    }

    .download-btn:hover {
        background-color: #0056b3;
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
                <h2>الملف القانوني للجمعية</h2>
                <h3>الملف القانوني<span> للجمعية</span></h3>
                <p>Ut possimus qui ut temporibus culpa velit eveniet modi omnis est adipisci expedita at voluptas atque vitae autem.</p>
            
            <div class="pdf-grid">
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

                // Requête SQL pour sélectionner les documents du type "الملف القانوني للجمعية"
                $type_id = 1; // ID du type "الملف القانوني للجمعية"
                $sql = "SELECT title, pdf FROM documents WHERE type_id = $type_id";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Affichage des documents
                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="pdf-item shadow">';
                        echo '<h2>' . $row["title"] . '</h2>';
                        echo '<iframe src="../admin/uploads/documents/' . $row["pdf"] . '" width="100%" height="300px"></iframe>';
                        echo '<div class="buttons">';
                        echo '<a href="../admin/uploads/documents/' . $row["pdf"] . '" target="_blank" class="view-btn">عرض</a>';
                        echo '<a href="../admin/uploads/documents/' . $row["pdf"] . '" download="' . pathinfo($row["pdf"], PATHINFO_FILENAME) . '" class="download-btn">تحميل</a>';
                        echo '</div>';
                        echo '</div>';
                    }
                } else {
                    echo '<p>No documents found.</p>';
                }
                $conn->close();
                ?>
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

</body>

</html>
