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
error_reporting(E_ALL);
ini_set('display_errors', 1);
// Création de la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

// Traitement de l'ajout d'une image à la galerie
if(isset($_POST['add_image'])){
    $image = $_FILES['image']['name'];
    $type_id = $_POST['type_id']; // Nouvelle ligne pour récupérer le type_id

    // Upload de l'image
    $target_dir = "uploads/image/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

    // Requête SQL pour insérer l'image avec le type_id
    $sql = "INSERT INTO gallery (image, type_id) VALUES ('$image', '$type_id')";
    if (!$conn->query($sql) === TRUE) {
        echo "Erreur : " . $sql . "<br>" . $conn->error;
    }
}

// Traitement de la suppression d'une image
if(isset($_POST['delete_image'])){
    $id = $_POST['id'];

    // Requête SQL pour supprimer l'image
    $sql = "DELETE FROM gallery WHERE id='$id'";
    if (!$conn->query($sql) === TRUE) {
        echo "Erreur : " . $sql . "<br>" . $conn->error;
    }
}

// Requête SQL pour sélectionner toutes les images avec leurs types
$sql = "SELECT gallery.id, gallery.image, types_photos.type  FROM gallery 
        INNER JOIN types_photos ON gallery.type_id = types_photos.id";
$result = $conn->query($sql);

// Requête SQL pour sélectionner tous les types d'images
$sql_types = "SELECT * FROM types_photos";
$result_types = $conn->query($sql_types);
// Fermer la connexion à la base de données
$conn->close();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galerie</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .gallery-container {
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
                        <a href="classement.php" class="sidebar-link">
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
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#auth" data-bs-toggle="collapse"
                            aria-expanded="false">
                            أكاديمية-الفريق
                        </a>
                        <ul id="auth" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link">كرة القدم</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link">كرة القدم داخل القاعة</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link"> كرة القدم النسوية</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link">كرة السلة </a>
                            </li>
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link"> كرة اليد</a>
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
        <div class="gallery-container mt-5">
            <div class="header">
                <h2 class="mb-4">Galerie</h2>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addImageModal">
                    Ajouter
                </button>
            </div>
            <div class="row">
                <?php
                // Vérifier s'il y a des résultats
                if ($result->num_rows > 0) {
                    // Afficher les données de chaque image
                    while($row = $result->fetch_assoc()) {
                        echo "<div class='col-md-4'>
                                <div class='card mb-4'>
                                    <img src='uploads/image/" . $row["image"] . "' class='card-img-top gallery-image' alt='Image'>
                                    <div class='card-body'>
                                        <p>Type : " . $row["type"] . "</p>
                                        <form action='gallery.php' method='post' style='display: inline;'>
                                            <input type='hidden' name='id' value='" . $row["id"] . "'>
                                            <button type='submit' name='delete_image' class='btn btn-danger btn-sm'>Supprimer</button>
                                        </form>
                                    </div>
                                </div>
                            </div>";
                    }
                } else {
                    echo "<p>Aucune image trouvée.</p>";
                }
                ?>
            </div>
        </div>
    </div>

    <!-- Modal pour ajouter une image -->
    <div class="modal fade" id="addImageModal" tabindex="-1" role="dialog" aria-labelledby="addImageModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addImageModalLabel">Ajouter une image</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="gallery.php" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="image">Image :</label>
                            <input type="file" class="form-control-file" id="image" name="image" required>
                        </div>
                        <div class="form-group">
                            <label for="type_id">Type :</label>
                            <select class="form-control" id="type_id" name="type_id" required>
                                <?php
                                // Afficher les types d'images
                                if ($result_types->num_rows > 0) {
                                    while($row = $result_types->fetch_assoc()) { ?>
                                        
                                        <option value="<?= $row['id'] ?>"> <?= $row["type"] ?></option>
                                    <?php }
                                    } else {
                                    echo "<option value=''>Aucun type trouvé</option>";
                                    }
                                    ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block" name="add_image">Ajouter</button>
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
</body>
</html>