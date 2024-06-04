<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>لائحة الأعضاء</title>
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
                <h2>لائحة الأعضاء</h2>
                <h3>لائحة<span> الأعضاء</span></h3>
                <p>Ut possimus qui ut temporibus culpa velit eveniet modi omnis est adipisci expedita at voluptas
                    atque vitae autem.</p>
                <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card mb-3">
                                <img src="../assets/img/personnel/lbadi.jpg" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Card title</h5>
                                    <p class="card-text">Some quick example text to build .</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card mb-3">
                                <img src="../assets/img/personnel/lbadi.jpg" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Card title</h5>
                                    <p class="card-text">Some quick example text to build
                                        .</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card mb-3">
                                <img src="../assets/img/personnel/lbadi.jpg" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Card title</h5>
                                    <p class="card-text">Some quick example text to build
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card mb-3">
                                <img src="../assets/img/personnel/lbadi.jpg" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Card title</h5>
                                    <p class="card-text">Some quick example text to build
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card mb-3">
                                <img src="../assets/img/personnel/lbadi.jpg" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Card title</h5>
                                    <p class="card-text">Some quick example text to build
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card mb-3">
                                <img src="../assets/img/personnel/lbadi.jpg" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Card title</h5>
                                    <p class="card-text">Some quick example text to build
                                    </p>
                                </div>
                            </div>
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