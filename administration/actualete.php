<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>BizLand Bootstrap Template - Index</title>
    <meta content="" name="description">
    <meta content="" name="keywords">


    <?php
    include "../inc/link.php";
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
                <h2>حوارات و لقاءات
                </h2>
                <h3><span>حوارات و لقاءات
                    </span></h3>
                <p>Ut possimus qui ut temporibus culpa velit eveniet modi omnis est adipisci expedita at voluptas
                    atque vitae autem.</p>
                <div class="container">
                    <div class="row" id="news-list">
                        <!-- Les fiches d'actualités seront insérées dynamiquement ici -->
                    </div>
                </div>
            </div>

        </div>


        <!-- Modal pour afficher l'actualité complète -->
        <div class="modal fade" id="newsModal" tabindex="-1" aria-labelledby="newsModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
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
    const news = [{
            title: "Nouvelle Initiative",
            date: "10 Janvier 2024",
            image: "../assets/img/clients/client-3.png",
            content: "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed... Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed... Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed... Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed...Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed... Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed...Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed...Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed... Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed... Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed... Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed... Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed... "
        },
        {
            title: "Événement à Venir",
            date: "15 Février 2024",
            image: "../assets/img/clients/client-4.png",
            content: "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed... "
        },
        {
            title: "Réunion Importante",
            date: "20 Mars 2024",
            image: "../assets/img/clients/client-5.png",
            content: "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed... "
        }
    ];

    function renderNews() {
        const newsList = document.getElementById('news-list');
        newsList.innerHTML = '';
        news.forEach((item, index) => {
            const newsCard = `
                    <div class="col-md-4 news-card" data-toggle="modal" data-target="#newsModal" data-index="${index}">
                        <div class="card">
                            <img src="${item.image}" class="card-img-top" alt="${item.title}">
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

    function showFullNews(index) {
        const modalTitle = document.querySelector('#newsModal .modal-title');
        const modalImage = document.querySelector('#newsModal .modal-body img');
        const modalContent = document.querySelector('#newsModal .modal-body .news-content');
        const socialIcons = document.querySelector('#newsModal .modal-body .social-icons');

        modalTitle.textContent = news[index].title;
        modalImage.src = news[index].image;
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

<a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
<a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
<a href="#" class="instagram"><i class="bi bi-instagram"></i></a>