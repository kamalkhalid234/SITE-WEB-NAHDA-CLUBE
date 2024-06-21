<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: index.php");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "association";

// Création de la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

// Traitement de l'ajout d'une actualité
if(isset($_POST['add_news'])){
    $title = $_POST['title'];
    $date = $_POST['date'];
    $image = $_FILES['image']['name'];
    $content = $_POST['content'];

    // Upload de l'image
    $target_dir = "uploads/image/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

    // Requête SQL pour insérer l'actualité
    $sql = "INSERT INTO news (title, date, image, content) VALUES ('$title', '$date', '$image', '$content')";
    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-info' role='alert'> Nouvelle actualité ajoutée avec succès. </div>";
    } else {
        echo "<div class='alert alert-danger' role='alert'> Erreur : " . $sql . "<br>" . $conn->error . "</div>";
    }
}

// Traitement de la suppression d'une actualité
if(isset($_POST['delete_news'])){
    $id = $_POST['id'];

    // Requête SQL pour supprimer l'actualité
    $sql = "DELETE FROM news WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-info' role='alert'> Actualité supprimée avec succès. </div>";
    } else {
        echo "<div class='alert alert-danger' role='alert'> Erreur : " . $sql . "<br>" . $conn->error . "</div>";
    }
}

// Traitement de la modification d'une actualité
if(isset($_POST['edit_news'])){
    $id = $_POST['id'];
    $title = $_POST['title'];
    $date = $_POST['date'];
    $content = $_POST['content'];

    // Gestion de l'image
    if(isset($_FILES['image']['name']) && $_FILES['image']['name'] != ""){
        $image = $_FILES['image']['name'];
        $target_dir = "uploads/image/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
        $sql = "UPDATE news SET title='$title', date='$date', image='$image', content='$content' WHERE id='$id'";
    } else {
        $sql = "UPDATE news SET title='$title', date='$date', content='$content' WHERE id='$id'";
    }

    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-info' role='alert'> Actualité mise à jour avec succès. </div>";
    } else {
        echo "<div class='alert alert-danger' role='alert'> Erreur : " . $sql . "<br>" . $conn->error . "</div>";
    }
}

// Requête SQL pour sélectionner toutes les actualités
$sql = "SELECT id, title, date, image, content FROM news";
$result = $conn->query($sql);

// Fermer la connexion à la base de données
$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration des Actualités</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .news-container {
            border: 1px solid #ccc;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .gallery-image {
            width: 100%;
            height: auto;
        }
        .card-body {
            text-align: center;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<div class="wrapper">
<aside id="sidebar" class="js-sidebar">
            <!-- Content For Sidebar -->
            <div class="h-100">
                <div class="sidebar-logo">
                    <a href="#">CodzSword</a>
                </div>
                <ul class="sidebar-nav">
                    <li class="sidebar-header">
                        Admin
                    </li>
                    <li class="sidebar-item">
                        <a href="index.php" class="sidebar-link">
                            الرئيسية
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="documents.php" class="sidebar-link collapsed">
                            إدارة

                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="gallery.php" class="sidebar-link">
                            أرشيف الجمعية
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="actualete.php" class="sidebar-link">
                            حوارات و لقاءات
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="soutenir.php" class="sidebar-link">
                            دعم الجمعية
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="contact.php" class="sidebar-link">
                            معلومات التواصل
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="message.php" class="sidebar-link">
                            الرسائل
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="social.php" class="sidebar-link">
                            مواقع التواصل
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="add_admin.php" class="sidebar-link">
                            المستخدمين
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="admin_members.php" class="sidebar-link">
                            اعضاء المكتب
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="classement_foot.php" class="sidebar-link">
                            الترتيب
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="joueurs.php" class="sidebar-link">
                            اللاعبين
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="sponsor.php" class="sidebar-link">
                            الشركاء 
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="type_sport.php" class="sidebar-link">
                            الرياضات المتاحة
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#auth-m" data-bs-toggle="collapse"
                            aria-expanded="false">
                            المقابلات
                        </a>
                        <ul id="auth-m" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebare">
                            <li class="sidebar-item">
                                <a href="matche_foot.php" class="sidebar-link">كرة القدم</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="matche_football_sale.php" class="sidebar-link">كرة القدم داخل القاعة</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="matche_football_F.php" class="sidebar-link"> كرة القدم النسوية</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="matche_basketball.php" class="sidebar-link">كرة السلة </a>
                            </li>
                            <li class="sidebar-item">
                                <a href="matche_handball.php" class="sidebar-link"> كرة اليد</a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#auth-j" data-bs-toggle="collapse"
                            aria-expanded="false">
                            اللاعبين
                        </a>
                        <ul id="auth-j" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebare">
                            <li class="sidebar-item">
                                <a href="joueurs_foot.php" class="sidebar-link">كرة القدم</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="joueurs_football_sale.php" class="sidebar-link">كرة القدم داخل القاعة</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="joueurs_football_F.php" class="sidebar-link"> كرة القدم النسوية</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="joueurs_basketball.php" class="sidebar-link">كرة السلة </a>
                            </li>
                            <li class="sidebar-item">
                                <a href="joueurs_handball.php" class="sidebar-link"> كرة اليد</a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#auth-j" data-bs-toggle="collapse"
                            aria-expanded="false">
                            ارشيف الصور
                        </a>
                        <ul id="auth-j" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebare">
                            <li class="sidebar-item">
                                <a href="gallery_foot.php" class="sidebar-link">كرة القدم</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="gallery_football_sale.php" class="sidebar-link">كرة القدم داخل القاعة</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="gallery_football_F.php" class="sidebar-link"> كرة القدم النسوية</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="gallery_basketball.php" class="sidebar-link">كرة السلة </a>
                            </li>
                            <li class="sidebar-item">
                                <a href="gallery_handball.php" class="sidebar-link"> كرة اليد</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </aside>
        <div class="main">
            <nav class="navbar navbar-expand px-3 border-bottom">
                <button class="btn" id="sidebar-toggle" type="button">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="navbar-collapse navbar">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a href="#" data-bs-toggle="dropdown" class="nav-icon pe-md-0">
                                <a href="#" class="btn button">Logout</a>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="container">
        <div class="news-container mt-5">
            <div class="header">
                <h2 class="mb-4">Actualités existantes</h2>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addNewsModal">
                    Ajouter
                </button>
            </div>
            <div class="row">
                <?php
                // Afficher les actualités existantes
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<div class='col-md-4'>
                                <div class='card mb-4'>
                                    <img src='uploads/image/" . $row['image'] . "' class='card-img-top gallery-image' alt='Actualité'>
                                    <div class='card-body'>
                                        <h5 class='card-title'>" . $row['title'] . "</h5>
                                        <p class='card-text'>" . $row['date'] . "</p>
                                        <p class='card-text'>" . $row['content'] . "</p>
                                        <button class='btn btn-warning btn-sm' data-toggle='modal' data-target='#editNewsModal' data-id='" . $row['id'] . "' data-title='" . $row['title'] . "' data-date='" . $row['date'] . "' data-content='" . $row['content'] . "'>Éditer</button>
                                        <form action='admin.php' method='post' style='display:inline-block;'>
                                            <input type='hidden' name='id' value='" . $row['id'] . "'>
                                            <button type='submit' name='delete_news' class='btn btn-danger btn-sm'>Supprimer</button>
                                        </form>
                                    </div>
                                </div>
                            </div>";
                    }
                } else {
                    echo "<p>Aucune actualité trouvée.</p>";
                }
                ?>
            </div>
        </div>
    </div>

    <!-- Modal pour ajouter une actualité -->
    <div class="modal fade" id="addNewsModal" tabindex="-1" role="dialog" aria-labelledby="addNewsModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addNewsModalLabel">Ajouter une actualité</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="admin.php" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="title">Titre :</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        <div class="form-group">
                            <label for="date">Date :</label>
                            <input type="date" class="form-control" id="date" name="date" required>
                        </div>
                        <div class="form-group">
                            <label for="image">Image :</label>
                            <input type="file" class="form-control-file" id="image" name="image" required>
                        </div>
                        <div class="form-group">
                            <label for="content">Contenu :</label>
                            <textarea class="form-control" id="content" name="content" rows="4" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block" name="add_news">Ajouter</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal pour éditer une actualité -->
    <div class="modal fade" id="editNewsModal" tabindex="-1" role="dialog" aria-labelledby="editNewsModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editNewsModalLabel">Modifier une actualité</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="admin.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" id="edit-id" name="id">
                        <div class="form-group">
                            <label for="edit-title">Titre :</label>
                            <input type="text" class="form-control" id="edit-title" name="title" required>
                        </div>
                        <div class="form-group">
                        <label for="edit-date">Date :</label>
                            <input type="date" class="form-control" id="edit-date" name="date" required>
                        </div>
                        <div class="form-group">
                            <label for="edit-image">Image :</label>
                            <input type="file" class="form-control-file" id="edit-image" name="image">
                        </div>
                        <div class="form-group">
                            <label for="edit-content">Contenu :</label>
                            <textarea class="form-control" id="edit-content" name="content" rows="4" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block" name="edit_news">Modifier</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


            <a href="#" class="theme-toggle">
                <i class="fa-regular fa-moon"></i>
                <i class="fa-regular fa-sun"></i>
            </a>



        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/script.js"></script>

    <script>
        // Script pour pré-remplir le formulaire de modification avec les données de l'actualité sélectionnée
        $('#editNewsModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var title = button.data('title');
            var date = button.data('date');
            var content = button.data('content');

            var modal = $(this);
            modal.find('#edit-id').val(id);
            modal.find('#edit-title').val(title);
            modal.find('#edit-date').val(date);
            modal.find('#edit-content').val(content);
        });
    </script>
</body>
</html>
