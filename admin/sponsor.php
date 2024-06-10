<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: index.php");
    exit();
}

// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "association";
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

// Traitement de l'ajout d'une image de sponsor
if(isset($_POST['add_sponsor'])){
    // Vérifier si un fichier a été téléchargé
    if(isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK){
        $image_path = $_FILES['image']['name'];
        $target_dir = "uploads/image/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        
        // Déplacer le fichier téléchargé vers le répertoire cible
        move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
        
        // Requête SQL pour insérer l'image du sponsor dans la base de données
        $sql = "INSERT INTO sponsors (image) VALUES ('$image_path')";
        if ($conn->query($sql) === TRUE) {
            echo "<div class='alert alert-success' role='alert'>Image de sponsor ajoutée avec succès.</div>";
        } else {
            echo "<div class='alert alert-danger' role='alert'>Erreur lors de l'ajout de l'image de sponsor: " . $conn->error . "</div>";
        }
    } else {
        echo "Erreur lors du téléchargement de l'image de sponsor.";
    }
}

// Traitement de la suppression d'une image de sponsor
if(isset($_POST['delete_sponsor'])){
    $id = $_POST['id'];
    // Récupérer le chemin de l'image à supprimer
    $sql_select = "SELECT image FROM sponsors WHERE id='$id'";
    $result_select = $conn->query($sql_select);
    if ($result_select->num_rows > 0) {
        $row = $result_select->fetch_assoc();
        $image_path = $row['image'];
        // Supprimer l'image du serveur
        unlink("uploads/image/" . $image_path);
        // Requête SQL pour supprimer l'image du sponsor de la base de données
        $sql_delete = "DELETE FROM sponsors WHERE id='$id'";
        if ($conn->query($sql_delete) === TRUE) {
            echo "<div class='alert alert-success' role='alert'>Image de sponsor supprimée avec succès.</div>";
        } else {
            echo "<div class='alert alert-danger' role='alert'>Erreur lors de la suppression de l'image de sponsor: " . $conn->error . "</div>";
        }
    } else {
        echo "Image de sponsor non trouvée.";
    }
}

// Récupérer la liste des sponsors depuis la base de données
$sql_sponsors = "SELECT * FROM sponsors";
$result_sponsors = $conn->query($sql_sponsors);

// Fermer la connexion à la base de données
$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration des sponsors</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .custom-shadow {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
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


            <div class="container shadow-lg p-3 mb-5 bg-white rounded custom-shadow"> <!-- Ajout de classes shadow-lg et custom-shadow -->
    <h2 class="mt-4">Administration des sponsors
        <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#addSponsorModal">Ajouter</button>
    </h2>
    
    <hr>
    
    <!-- Affichage de la liste des sponsors -->
    <h3>Liste des sponsors :</h3>
    <div class="row">
        <?php
        if ($result_sponsors->num_rows > 0) {
            while ($row = $result_sponsors->fetch_assoc()) {
                echo '<div class="col-lg-3 col-md-4 col-6 mb-4">';
                echo '<div class="card shadow">'; // Ajout de la classe shadow pour les cartes
                echo '<img src="uploads/image/' . $row["image"] . '" class="card-img-top img-fluid" alt="">';
                echo '<div class="card-body text-center">';
                echo '<form action="" method="post">';
                echo '<input type="hidden" name="id" value="' . $row["id"] . '">';
                echo '<button type="submit" class="btn btn-danger" name="delete_sponsor">Supprimer</button>';
                echo '</form>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo "<p>Aucun sponsor trouvé.</p>";
        }
        ?>
    </div>
</div>

<!-- Modal d'ajout de sponsor -->
<div class="modal fade" id="addSponsorModal" tabindex="-1" role="dialog" aria-labelledby="addSponsorModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addSponsorModalLabel">Ajouter un sponsor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formulaire d'ajout d'image de sponsor -->
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="image">Sélectionner une image de sponsor :</label>
                        <input type="file" class="form-control-file" id="image" name="image">
                    </div>
                    <button type="submit" class="btn btn-primary" name="add_sponsor">Ajouter</button>
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


<!-- Chargement de Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/script.js"></script>
</body>
</html>
