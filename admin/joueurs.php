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

// Traitement de l'ajout, de la suppression et de la modification d'un joueur
if (isset($_POST['add_player'])) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $numero_maillot = $_POST['numero_maillot'];
    $role = $_POST['role'];
    $id_categorie = $_POST['id_categorie'];
    $id_type_sport = $_POST['id_type_sport'];
    $image_path = uploadImage($_FILES['image']);

    // Requête SQL pour insérer le joueur
    $sql = "INSERT INTO joueurs (nom, prenom, numero_maillot, role, categorie_id, type_sport_id, image) 
            VALUES ('$nom', '$prenom', '$numero_maillot', '$role', '$id_categorie', '$id_type_sport', '$image_path')";
    if ($conn->query($sql) !== TRUE) {
        echo "Erreur : " . $sql . "<br>" . $conn->error;
    }
}

if (isset($_POST['delete_player'])) {
    $id = $_POST['id'];

    // Requête SQL pour supprimer le joueur
    $sql = "DELETE FROM joueurs WHERE id='$id'";
    if ($conn->query($sql) !== TRUE) {
        echo "Erreur : " . $sql . "<br>" . $conn->error;
    }
}

if (isset($_POST['edit_player'])) {
    $id = $_POST['id'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $numero_maillot = $_POST['numero_maillot'];
    $role = $_POST['role'];
    $id_categorie = $_POST['id_categorie'];
    $id_type_sport = $_POST['id_type_sport'];
    $image_path = uploadImage($_FILES['image']);

    // Requête SQL pour mettre à jour le joueur
    $sql = "UPDATE joueurs SET nom='$nom', prenom='$prenom', numero_maillot='$numero_maillot', 
            role='$role', categorie_id='$id_categorie', type_sport_id='$id_type_sport', image='$image_path' WHERE id='$id'";
    if ($conn->query($sql) !== TRUE) {
        echo "Erreur : " . $sql . "<br>" . $conn->error;
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
$result_categories = $conn->query($sql_categories);

// Vérifiez si la requête pour les catégories est réussie
if (!$result_categories) {
    die("Erreur lors de la récupération des catégories : " . $conn->error);
}

// Récupérer la liste des types de sport
$sql_types_sport = "SELECT * FROM types_photos";
$result_types_sport = $conn->query($sql_types_sport);

// Vérifiez si la requête pour les types de sport est réussie
if (!$result_types_sport) {
    die("Erreur lors de la récupération des types de sport : " . $conn->error);
}

// Récupérer la liste des joueurs avec les noms des catégories et des types de sport
$sql_joueurs = "SELECT joueurs.*, categories.nom_categorie AS nom_categorie, types_photos.type AS type_sport 
                FROM joueurs 
                LEFT JOIN categories ON joueurs.categorie_id = categories.id 
                LEFT JOIN types_photos ON joueurs.type_sport_id = types_photos.id";
$result_joueurs = $conn->query($sql_joueurs);

// Vérifiez si la requête pour les joueurs est réussie
if (!$result_joueurs) {
    die("Erreur lors de la récupération des joueurs : " . $conn->error);
}

// Fermer la connexion à la base de données
$conn->close();
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
                <th>Catégorie</th>
                <th>Type de sport</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php
        if ($result_joueurs->num_rows > 0) {
            while ($row = $result_joueurs->fetch_assoc()) { ?>
                <tr>
                    <td><img src="<?= $row['image'] ?>" width='50' height='50'></td>
                    <td><?= $row['nom'] ?></td>
                    <td><?= $row['prenom'] ?></td>
                    <td><?= $row['numero_maillot'] ?></td>
                    <td><?= $row['role'] ?></td>
                    <td><?= $row['nom_categorie'] ?></td>
                    <td><?= $row['type_sport'] ?></td>
                    <td>
                        <form action='' method='post' style='display:inline-block'>
                            <input type='hidden' name='id' value='<?= $row["id"] ?>'>
                            <button type='submit' class='btn btn-danger' name='delete_player'>Supprimer</button>
                        </form>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editPlayerModal<?= $row['id']; ?>">Modifier</button>
                    </td>
                </tr>
            <?php }
        } else {
            echo "<tr><td colspan='8'>Aucun joueur trouvé.</td></tr>";
        }
        ?>
        </tbody>
    </table>

    <!-- Modal pour ajouter un joueur -->
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
                    <!-- Formulaire pour ajouter un joueur -->
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="nom">Nom:</label>
                            <input type="text" class="form-control" id="nom" name="nom" required>
                        </div>
                        <div class="form-group">
                            <label for="prenom">Prénom:</label>
                            <input type="text" class="form-control" id="prenom" name="prenom" required>
                        </div>
                        <div class="form-group">
                            <label for="numero_maillot">Numéro de maillot:</label>
                            <input type="text" class="form-control" id="numero_maillot" name="numero_maillot" required>
                        </div>
                        <div class="form-group">
                            <label for="role">Rôle:</label>
                            <input type="text" class="form-control" id="role" name="role" required>
                        </div>
                        <div class="form-group">
                            <label for="id_type_sport">Type de sport:</label>
                            <select class="form-control" id="id_type_sport" name="id_type_sport" required onchange="handleSportChange(this)">
                                <!-- Options pour les types de sport -->
                                <?php
                                if ($result_types_sport->num_rows > 0) {
                                    $result_types_sport->data_seek(0); // Réinitialiser l'index de résultat
                                    while ($row = $result_types_sport->fetch_assoc()) { ?>
                                        <option value="<?= $row['id']; ?>"><?= $row['type']; ?></option>
                                    <?php }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group" id="categoryDiv" style="display:none;">
                            <label for="id_categorie">Catégorie:</label>
                            <select class="form-control" id="id_categorie" name="id_categorie">
                                <!-- Options pour les catégories de joueurs -->
                                <?php
                                if ($result_categories->num_rows > 0) {
                                    $result_categories->data_seek(0); // Réinitialiser l'index de résultat
                                    while ($row = $result_categories->fetch_assoc()) { ?>
                                        <option value="<?= $row['id']; ?>"><?= $row['nom_categorie']; ?></option>
                                    <?php }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="image">Image:</label>
                            <input type="file" class="form-control-file" id="image" name="image" required>
                        </div>
                        <button type="submit" class="btn btn-primary" name="add_player">Ajouter</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php
    // Affichage des modals de modification pour chaque joueur
    if ($result_joueurs->num_rows > 0) {
        $result_joueurs->data_seek(0); // Réinitialiser l'index de résultat des joueurs
        while ($row = $result_joueurs->fetch_assoc()) { ?>
            <!-- Modal pour modifier un joueur -->
            <div class="modal fade" id="editPlayerModal<?= $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editPlayerModalLabel<?= $row['id']; ?>" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editPlayerModalLabel<?= $row['id']; ?>">Modifier un joueur</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- Formulaire pour modifier un joueur -->
                            <form action="" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="id" value="<?= $row['id']; ?>">
                                <div class="form-group">
                                    <label for="nom">Nom:</label>
                                    <input type="text" class="form-control" id="nom" name="nom" value="<?= $row['nom']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="prenom">Prénom:</label>
                                    <input type="text" class="form-control" id="prenom" name="prenom" value="<?= $row['prenom']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="numero_maillot">Numéro de maillot:</label>
                                    <input type="text" class="form-control" id="numero_maillot" name="numero_maillot" value="<?= $row['numero_maillot']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="role">Rôle:</label>
                                    <input type="text" class="form-control" id="role" name="role" value="<?= $row['role']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="id_type_sport">Type de sport:</label>
                                    <select class="form-control" id="id_type_sport" name="id_type_sport" required onchange="handleSportChange(this)">
                                        <!-- Options pour les types de sport -->
                                        <?php
                                        $selected_type_sport_id = $row['type_sport_id'];
                                        if ($result_types_sport->num_rows > 0) {
                                            $result_types_sport->data_seek(0); // Réinitialiser l'index de résultat
                                            while ($type_sport_row = $result_types_sport->fetch_assoc()) { ?>
                                                <option value="<?= $type_sport_row['id']; ?>" <?php if ($type_sport_row['id'] == $selected_type_sport_id) echo "selected"; ?>><?= $type_sport_row['type']; ?></option>
                                            <?php }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group" id="categoryDiv" style="display:none;">
                                    <label for="id_categorie">Catégorie:</label>
                                    <select class="form-control" id="id_categorie" name="id_categorie">
                                        <!-- Options pour les catégories de joueurs -->
                                        <?php
                                        if ($result_categories->num_rows > 0) {
                                            $result_categories->data_seek(0); // Réinitialiser l'index de résultat
                                            while ($row = $result_categories->fetch_assoc()) { ?>
                                                <option value="<?= $row['id']; ?>"><?= $row['nom_categorie']; ?></option>
                                            <?php }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="image">Image:</label>
                                    <input type="file" class="form-control-file" id="image" name="image">
                                    <img src="<?= $row['image']; ?>" width="100" height="100" alt="Image actuelle">
                                </div>
                                <button type="submit" class="btn btn-primary" name="edit_player">Modifier</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php }
    }
    ?>


            <a href="#" class="theme-toggle">
                <i class="fa-regular fa-moon"></i>
                <i class="fa-regular fa-sun"></i>
            </a>



        </div>
    </div>



<script>
function handleSportChange(selectElement) {
    const categoryDiv = document.getElementById('categoryDiv');
    const categorySelect = document.getElementById('id_categorie');

    // Récupérer la valeur de l'option sélectionnée (l'ID du type de sport)
    const selectedTypeId = selectElement.value;

    // Si l'ID correspond à celui du football (1), afficher les catégories
    if (selectedTypeId === '1') { // Assurez-vous que '1' correspond à l'ID du football dans votre base de données
        categoryDiv.style.display = 'block';
    } else {
        categoryDiv.style.display = 'none';
        // Sélectionner automatiquement "الكبار" pour les autres sports
        for (let i = 0; i < categorySelect.options.length; i++) {
            if (categorySelect.options[i].text === 'الكبار') {
                categorySelect.selectedIndex = i;
                break;
            }
        }
    }
}

        document.addEventListener('DOMContentLoaded', (event) => {
            const sportSelect = document.getElementById('id_type_sport');
            handleSportChange(sportSelect); // Appeler la fonction au chargement de la page
            sportSelect.addEventListener('change', () => handleSportChange(sportSelect));
        });
    </script>

    <!-- Chargement de Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/script.js"></script>
</div>
</body>
</html>
