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

// Traitement de l'ajout d'une information de support
if(isset($_POST['add_support'])){
    $title = $_POST['title'];
    $description = $_POST['description'];
    $badge = $_POST['badge'];

    // Requête SQL pour insérer l'information de support
    $sql = "INSERT INTO support (title, description, badge) VALUES ('$title', '$description', '$badge')";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Nouvelle information de support ajoutée avec succès.');</script>";
    } else {
        echo "Erreur : " . $sql . "<br>" . $conn->error;
    }
}

// Traitement de la suppression d'une information de support
if(isset($_POST['delete_support'])){
    $id = $_POST['id'];

    // Requête SQL pour supprimer l'information de support
    $sql = "DELETE FROM support WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Information de support supprimée avec succès.');</script>";
    } else {
        echo "Erreur : " . $sql . "<br>" . $conn->error;
    }
}

// Traitement de la modification d'une information de support
if(isset($_POST['edit_support'])){
    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $badge = $_POST['badge'];

    // Requête SQL pour mettre à jour l'information de support
    $sql = "UPDATE support SET title='$title', description='$description', badge='$badge' WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Information de support modifiée avec succès.');</script>";
    } else {
        echo "Erreur : " . $sql . "<br>" . $conn->error;
    }
}

// Requête SQL pour sélectionner toutes les informations de support
$sql = "SELECT * FROM support";
$result = $conn->query($sql);

// Fermer la connexion à la base de données
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion du support</title>
    <!-- Inclure Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/style.css">
    <style>
        /* Ajouter des ombres aux cartes */
        .support-item {
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        /* Centrer le contenu des cartes */
        .support-item .card-body {
            text-align: center;
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

            <main class="container text-center mt-5">
        <h2>Gestion du support</h2>
        <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#addSupportModal">Ajouter une information de support</button>
        <div class="row">
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<div class='col-md-4 mb-4'>
                            <div class='card support-item'>
                                <div class='card-body'>
                                    <h5 class='card-title'>" . $row["title"] . "</h5>
                                    <p class='card-text'>" . $row["description"] . "</p>
                                    <span class='badge badge-primary'>" . $row["badge"] . "</span>
                                    <div class='mt-2'>
                                        <button class='btn btn-warning' onclick='editSupport(" . $row["id"] . ", \"" . $row["title"] . "\", \"" . $row["description"] . "\", \"" . $row["badge"] . "\")'>Modifier</button>
                                        <form action='support.php' method='post' style='display:inline-block;'>
                                            <input type='hidden' name='id' value='" . $row["id"] . "'>
                                            <button type='submit' name='delete_support' class='btn btn-danger'>Supprimer</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>";
                }
            } else {
                echo "<p>Aucune information de support trouvée.</p>";
            }
            ?>
        </div>
    </main>

<!-- Modal pour ajouter une information de support -->
<div class="modal fade" id="addSupportModal" tabindex="-1" role="dialog" aria-labelledby="addSupportModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addSupportModalLabel">Ajouter une information de support</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="soutenir.php" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="add-title">Titre :</label>
                        <input type="text" class="form-control" id="add-title" name="title" required>
                    </div>
                    <div class="form-group">
                        <label for="add-description">Description :</label>
                        <textarea class="form-control" id="add-description" name="description" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="add-badge">Badge :</label>
                        <input type="text" class="form-control" id="add-badge" name="badge" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-primary" name="add_support">Ajouter</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal pour modifier une information de support -->
<div class="modal fade" id="editSupportModal" tabindex="-1" role="dialog" aria-labelledby="editSupportModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editSupportModalLabel">Modifier une information de support</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="soutenir.php" method="post">
                <div class="modal-body">
                    <input type="hidden" id="edit-id" name="id">
                    <div class="form-group">
                        <label for="edit-title">Titre :</label>
                        <input type="text" class="form-control" id="edit-title" name="title" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-description">Description :</label>
                        <textarea class="form-control" id="edit-description" name="description" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="edit-badge">Badge :</label>
                        <input type="text" class="form-control" id="edit-badge" name="badge" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-warning" name="edit_support">Modifier</button>
                </div>
            </form>
        </div>
    </div>
</div>


            <a href="#" class="theme-toggle">
                <i class="fa-regular fa-moon"></i>
                <i class="fa-regular fa-sun"></i>
            </a>



        </div>
    </div>
    


    <!-- Inclure Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/script.js"></script>

    <script>
function editSupport(id, title, description, badge) {
    document.getElementById('edit-id').value = id;
    document.getElementById('edit-title').value = title;
    document.getElementById('edit-description').value = description;
    document.getElementById('edit-badge').value = badge;
    $('#editSupportModal').modal('show');
}

    </script>
</body>
</html>
