<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>الجموع الاستثنائية</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <?php
    include "../inc/link.php";
    ?>


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
        /* Adjust the height as necessary */
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
                <h2>الجموع الاستثنائية</h2>
                <h3>الجموع<span> الاستثنائية</span></h3>
                <p>Ut possimus qui ut temporibus culpa velit eveniet modi omnis est adipisci expedita at voluptas
                    atque vitae autem.</p>
                <div class="pdf-grid">
                    <div class="pdf-item shadow">
                        <h2>لائحة المكتب المسير</h2>
                        <iframe src="documents/bureau.pdf" width="100%" height="300px"></iframe>
                        <div class="buttons">
                            <a href="documents/bureau.pdf" target="_blank" class="view-btn">عرض</a>
                            <a href="documents/bureau.pdf" download="bureau" class="download-btn">تحميل</a>
                        </div>
                    </div>
                    <div class="pdf-item shadow">
                        <h2>الوصل النهائي</h2>
                        <iframe src="documents/certificat.pdf" width="100%" height="300px"></iframe>
                        <div class="buttons">
                            <a href="documents/certificat.pdf" target="_blank" class="view-btn">عرض</a>
                            <a href="documents/certificat.pdf" download="certificat" class="download-btn">تحميل</a>
                        </div>
                    </div>
                    <div class="pdf-item shadow">
                        <h2>النظام الاساسي النموذجي للجمعية</h2>
                        <iframe src="documents/droit-primaire.pdf" width="100%" height="300px"></iframe>
                        <div class="buttons">
                            <a href="documents/droit-primaire.pdf" target="_blank" class="view-btn">عرض</a>
                            <a href="documents/droit-primaire.pdf" download="droit-primaire"
                                class="download-btn">تحميل</a>
                        </div>
                    </div>
                    <div class="pdf-item shadow">
                        <h2>بيان التعريف البنكي</h2>
                        <iframe src="documents/identité.pdf" width="100%" height="300px"></iframe>
                        <div class="buttons">
                            <a href="documents/identité.pdf" target="_blank" class="view-btn">عرض</a>
                            <a href="documents/identité.pdf" download="identité" class="download-btn">تحميل</a>
                        </div>
                    </div>
                    <div class="pdf-item shadow">
                        <h2>القانون الداخلي للجمعية</h2>
                        <iframe src="documents/lois-domestiques.pdf" width="100%" height="300px"></iframe>
                        <div class="buttons">
                            <a href="documents/lois-domestiques.pdf" target="_blank" class="view-btn">عرض</a>
                            <a href="documents/lois-domestiques.pdf" download="lois-domestiques"
                                class="download-btn">تحميل</a>
                        </div>
                    </div>
                    <div class="pdf-item shadow">
                        <h2>نموذج إشعار المعرف الضريبي</h2>
                        <iframe src="documents/notification.pdf" width="100%" height="300px"></iframe>
                        <div class="buttons">
                            <a href="documents/notification.pdf" target="_blank" class="view-btn">عرض</a>
                            <a href="documents/notification.pdf" download="notification" class="download-btn">تحميل</a>
                        </div>
                    </div>
                    <div class="pdf-item shadow">
                        <h2>محضر الجمع العام العادي</h2>
                        <iframe src="documents/procès-verbal.pdf" width="100%" height="300px"></iframe>
                        <div class="buttons">
                            <a href="documents/procès-verbal.pdf" target="_blank" class="view-btn">عرض</a>
                            <a href="documents/procès-verbal.pdf" download="procès-verbal"
                                class="download-btn">تحميل</a>
                        </div>
                    </div>
                    <div class="pdf-item shadow">
                        <h2>اشهاد</h2>
                        <iframe src="documents/témoignages.pdf" width="100%" height="300px"></iframe>
                        <div class="buttons">
                            <a href="documents/témoignages.pdf" target="_blank" class="view-btn">عرض</a>
                            <a href="documents/témoignages.pdf" download="Droit_Club4" class="download-btn">تحميل</a>
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

</body>

</html>