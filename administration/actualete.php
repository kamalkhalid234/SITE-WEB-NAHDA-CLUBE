<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>BizLand Bootstrap Template - Index</title>
    <meta content="" name="description">
    <meta content="" name="keywords">


    <?php
    include "../inc/link.php"; // Assurez-vous que ce fichier contient les liens CSS et autres
    ?>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .news-card {
            margin-bottom: 20px;
            cursor: pointer;
        }

        .social-icons {
            margin-top: 20px;
        }

        .social-icons a {
            margin-right: 10px;
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
                <h2>حوارات و لقاءات</h2>
                <h3>حوارات<span> و لقاءات</span></h3>
                <div class="container">
                    <div class="row" id="news-list">
                        <!-- Les fiches d'actualités seront insérées dynamiquement ici -->
                    </div>
                </div>
            </div>

        </div>


        <!-- Modal pour afficher l'actualité complète -->
        <div class="modal fade" id="newsModal" tabindex="-1" aria-labelledby="newsModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg ">
                <div class="modal-content">
                    <div class="modal-header ">
                        <h5 class="modal-title" id="newsModalLabel">Titre de l'Actualité</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <img src="" class="img-fluid mb-2" alt="Image de l'actualité">
                        <p class="news-content"></p>
                        <div class="social-icons">
                            <!-- Ajoutez les liens vers les réseaux sociaux ici -->
                            main
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

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        // Récupération dynamique des actualités depuis la base de données
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

        // Requête SQL pour sélectionner les actualités
        $sql = "SELECT title, date, image, content FROM news";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Convertir les résultats en JSON pour les utiliser en JavaScript
            $news = array();
            while ($row = $result->fetch_assoc()) {
                $news[] = $row;
            }
            echo "const news = " . json_encode($news) . ";";
        } else {
            echo "const news = [];"; // Si aucune actualité n'est trouvée, initialiser un tableau vide
        }

        $conn->close();
        ?>

        // Fonction pour afficher les actualités dynamiquement
        function renderNews() {
            const newsList = document.getElementById('news-list');
            newsList.innerHTML = '';
            news.forEach((item, index) => {
                const newsCard = `
                    <div class="col-md-4 card border-0  shadow" data-toggle="modal" data-target="#newsModal" data-index="${index}">
                        <div class="card">
                            <img src="../admin/uploads/image/${item.image}" class="card-img-top" alt="${item.title}">
                            <div class="card-body">
                                <h5 class="card-title">${item.title}</h5>
                                <p class="card-text">${item.date}</p>
                            </div>
                        </div>
                    </div>
                `;
                newsList.innerHTML += newsCard;
            });
        }

        // Fonction pour afficher une actualité complète dans le modal
        function showFullNews(index) {
            const modalTitle = document.querySelector('#newsModal .modal-title');
            const modalImage = document.querySelector('#newsModal .modal-body img');
            const modalContent = document.querySelector('#newsModal .modal-body .news-content');
            const socialIcons = document.querySelector('#newsModal .modal-body .social-icons');

            modalTitle.textContent = news[index].title;
            modalImage.src = `../admin/uploads/image/${news[index].image}`;
            modalContent.textContent = news[index].content;

            // Ajoutez des liens vers les réseaux sociaux ici
            // Par exemple:
            socialIcons.innerHTML = `
                <a href="#" class="btn btn-primary"><i class="bi bi-twitter"></i></a>
                <a href="#" class="btn btn-info"><i class="bi bi-facebook"></i></a>
                <a href="#" class="btn btn-danger"><i class="bi bi-instagram"></i></a>
            `;
        }

        document.addEventListener('DOMContentLoaded', function() {
            renderNews();

            $('#newsModal').on('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                const index = button.getAttribute('data-index');
                showFullNews(index);
            });
        });
    </script>
</body>

</html>
