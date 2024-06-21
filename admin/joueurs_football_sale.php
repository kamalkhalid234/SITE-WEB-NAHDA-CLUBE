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
$conne = new mysqli($servername, $username, $password, $dbname);

// Vérification de la connexion
if ($conne->connect_error) {
    die("Échec de la connexion : " . $conne->connect_error);
}

// Traitement de l'ajout, de la suppression et de la modification d'un joueur
if (isset($_POST['add_player'])) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $numero_maillot = $_POST['numero_maillot'];
    $role = $_POST['role'];
    $image_path = uploadImage($_FILES['image']);

    // Requête SQL pour insérer le joueur
    $sql = "INSERT INTO joueurs (nom, prenom, numero_maillot, role, type_sport_id, image) 
            VALUES ('$nom', '$prenom', '$numero_maillot', '$role', 2, '$image_path')";
    if ($conne->query($sql) !== TRUE) {
        echo "Erreur : " . $sql . "<br>" . $conne->error;
    }
}

if (isset($_POST['delete_player'])) {
    $id = $_POST['id'];

    // Requête SQL pour supprimer le joueur
    $sql = "DELETE FROM joueurs WHERE id='$id'";
    if ($conne->query($sql) !== TRUE) {
        echo "Erreur : " . $sql . "<br>" . $conne->error;
    }
}

if (isset($_POST['edit_player'])) {
    $id = $_POST['id'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $numero_maillot = $_POST['numero_maillot'];
    $role = $_POST['role'];
    $image_path = uploadImage($_FILES['image']);

    // Requête SQL pour mettre à jour le joueur
    $sql = "UPDATE joueurs SET nom='$nom', prenom='$prenom', numero_maillot='$numero_maillot', 
            role='$role', image='$image_path' WHERE id='$id'";
    if ($conne->query($sql) !== TRUE) {
        echo "Erreur : " . $sql . "<br>" . $conne->error;
    }
}

// Fonction pour gérer l'upload d'images
function uploadImage($file)
{
    $file_name = $file['name'];
    $file_tmp = $file['tmp_name'];
    $file_type = $file['type'];
    $file_size = $file['size'];

    // Spécifiez le répertoire où vous souhaitez stocker les images
    $target_dir = "uploads/image/";

    // Assurez-vous que le répertoire cible existe
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    // Générez un nom de fichier unique
    $image_name = uniqid() . '_' . $file_name;

    // Déplacez l'image téléchargée vers le répertoire cible
    move_uploaded_file($file_tmp, $target_dir . $image_name);

    // Retournez le chemin de l'image
    return $target_dir . $image_name;
}

// Récupérer la liste des catégories de joueurs
$sql_categories = "SELECT * FROM categories";
$result_categories = $conne->query($sql_categories);

// Vérifiez si la requête pour les catégories est réussie
if (!$result_categories) {
    die("Erreur lors de la récupération des catégories : " . $conne->error);
}

// Récupérer la liste des types de sport
$sql_types_sport = "SELECT * FROM types_photos";
$result_types_sport = $conne->query($sql_types_sport);

// Vérifiez si la requête pour les types de sport est réussie
if (!$result_types_sport) {
    die("Erreur lors de la récupération des types de sport : " . $conne->error);
}

// Récupérer la liste des joueurs de type "كرة السلة" sans prendre en compte la catégorie
$sql_joueurs = "SELECT joueurs.*, types_photos.type AS type_sport 
                FROM joueurs 
                LEFT JOIN types_photos ON joueurs.type_sport_id = types_photos.id
                WHERE types_photos.id = 2";
$result_joueurs = $conne->query($sql_joueurs);

// Vérifiez si la requête pour les joueurs est réussie
if (!$result_joueurs) {
    die("Erreur lors de la récupération des joueurs : " . $conne->error);
}

// Fermer la connexion à la base de données
$conne->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration des joueurs</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .title {
            text-align: center;
            background-color: #f8f9fa;
            padding: 10px;
            border-radius: 5px;
        }
        .category-title {
            text-align: left;
            background-color: #e9ecef;
            padding: 5px;
            border-radius: 3px;
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
            <div class="d-flex justify-content-between align-items-center mt-4">
                <h2>Administration des joueurs</h2>
                <!-- Bouton d'ajout de joueur -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addPlayerModal">Ajouter</button>
            </div>
            <hr>

            <!-- Tableau affichant la liste des joueurs -->
            <h3>Liste des joueurs :</h3>

    <table class="table">
    <thead>
        <tr>
            <th>Image</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Numéro de maillot</th>
            <th>Rôle</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $result_joueurs->fetch_assoc()): ?>
            <tr>
                <td><img src="<?= $row['image'] ?>" width='50' height='50'></td>
                <td><?= $row['nom'] ?></td>
                <td><?= $row['prenom'] ?></td>
                <td><?= $row['numero_maillot'] ?></td>
                <td><?= $row['role'] ?></td>
                <td>
                    <form action='' method='post' style='display:inline-block'>
                        <input type='hidden' name='id' value='<?= $row["id"] ?>'>
                        <button type='submit' class='btn btn-danger' name='delete_player'>Supprimer</button>
                    </form>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editPlayerModal<?= $row['id'] ?>">Modifier</button>
                </td>
            </tr>
                <!-- Modal pour la modification des joueurs -->
                <div class="modal fade" id="editPlayerModal<?= $row['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="editPlayerModalLabel<?= $row['id'] ?>" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editPlayerModalLabel<?= $row['id'] ?>">Modifier le joueur</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="" method="post" enctype="multipart/form-data">
                                                <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                                <div class="form-group">
                                                    <label for="nom">Nom :</label>
                                                    <input type="text" class="form-control" name="nom" value="<?= $row['nom'] ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="prenom">Prénom :</label>
                                                    <input type="text" class="form-control" name="prenom" value="<?= $row['prenom'] ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="numero_maillot">Numéro de maillot :</label>
                                                    <input type="text" class="form-control" name="numero_maillot" value="<?= $row['numero_maillot'] ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="role">Rôle :</label>
                                                    <input type="text" class="form-control" name="role" value="<?= $row['role'] ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="image">Image :</label>
                                                    <input type="file" class="form-control" name="image" value="<?= $row['image'] ?>">
                                                </div>
                                                <button type="submit" class="btn btn-primary" name="edit_player">Enregistrer les modifications</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                </div>
                                <?php endwhile; ?>
        </tbody>
    </table>

        </div>
    </div>
</div>

<!-- Modal pour l'ajout des joueurs -->
<div class="modal fade" id="addPlayerModal" tabindex="-1" role="dialog" aria-labelledby="addPlayerModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPlayerModalLabel">Ajouter un joueur</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="nom">Nom :</label>
                        <input type="text" class="form-control" name="nom" required>
                    </div>
                    <div class="form-group">
                        <label for="prenom">Prénom :</label>
                        <input type="text" class="form-control" name="prenom" required>
                    </div>
                    <div class="form-group">
                        <label for="numero_maillot">Numéro de maillot :</label>
                        <input type="text" class="form-control" name="numero_maillot" required>
                    </div>
                    <div class="form-group">
                        <label for="role">Rôle :</label>
                        <input type="text" class="form-control" name="role" required>
                    </div>
                    <div class="form-group">
                        <label for="image">Image :</label>
                        <input type="file" class="form-control" name="image">
                    </div>
                    <button type="submit" class="btn btn-primary" name="add_player">Ajouter le joueur</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Inclure les fichiers JavaScript nécessaires -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
