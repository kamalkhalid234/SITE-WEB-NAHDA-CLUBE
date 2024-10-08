<?php
session_start();

/* if (!isset($_SESSION['admin_id'])) {
    header("Location: index.php");
    exit();
}
 */
// Informations de connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "association";

// Création de la connexion
$conn = new mysqli($servername, $username, $password, $dbname);
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Vérification de la connexion
if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

// Traitement de l'ajout d'un membre
if(isset($_POST['add_member'])){
    $name = $_POST['name'];
    $role_id = $_POST['role_id'];
    $image = $_FILES['image']['name'];

    // Upload de l'image
    $target_dir = "uploads/personnel/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

    // Requête SQL pour insérer le membre
    $sql = "INSERT INTO members (name, image, role_id) VALUES ('$name', '$image', '$role_id')";
    if (!$conn->query($sql) === TRUE) {
        echo "Erreur : " . $sql . "<br>" . $conn->error;
    }
}

// Traitement de la suppression d'un membre
if(isset($_POST['delete_member'])){
    $id = $_POST['id'];

    // Requête SQL pour supprimer le membre
    $sql = "DELETE FROM members WHERE id='$id'";
    if (!$conn->query($sql) === TRUE) {
        echo "Erreur : " . $sql . "<br>" . $conn->error;
    }
}

// Traitement de la modification d'un membre
if(isset($_POST['edit_member']) && isset($_POST['role_id'])){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $role_id = $_POST['role_id'];
    $image = $_FILES['image']['name'];

    if ($image) {
        // Upload de la nouvelle image
        $target_dir = "uploads/personnel/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

        // Requête SQL pour mettre à jour le membre avec la nouvelle image
        $sql = "UPDATE members SET name='$name', image='$image', role_id='$role_id' WHERE id='$id'";
    } else {
        // Requête SQL pour mettre à jour le membre sans changer l'image
        $sql = "UPDATE members SET name='$name', role_id='$role_id' WHERE id='$id'";
    }

    if (!$conn->query($sql) === TRUE) {
        echo "Erreur : " . $sql . "<br>" . $conn->error;
    }
}

// Requête SQL pour sélectionner les membres et leurs rôles
$sql = "SELECT members.id, members.name, members.image, member_roles.role_name 
        FROM members 
        JOIN member_roles ON members.role_id = member_roles.id";
$result = $conn->query($sql);

// Requête SQL pour sélectionner tous les rôles
$sql_roles = "SELECT * FROM member_roles";
$result_roles = $conn->query($sql_roles);
$result_roles1 = $conn->query($sql_roles);

// Fermer la connexion à la base de données
$conn->close();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des membres</title>
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
        <div class="gallery-container mt-5">
            <div class="header">
                <h2 class="mb-4">Gestion des membres</h2>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addMemberModal">
                    Ajouter
                </button>
            </div>
            <div class="row">
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<div class='col-md-4'>
                        <div class='card mb-4'>
                            <img src='uploads/personnel/" . $row["image"] . "' class='card-img-top gallery-image' alt='" . $row["name"] . "'>
                            <div class='card-body'>
                                <h5 class='card-title'>" . $row["name"] . "</h5>
                                <p class='card-text'>" . $row["role_name"] . "</p>
                                <form action='admin_members.php' method='post' style='display: inline;'>
                                    <input type='hidden' name='id' value='" . $row["id"] . "'>
                                    <button type='submit' name='delete_member' class='btn btn-danger btn-sm'>Supprimer</button>
                                </form>
                                <button type='button' class='btn btn-warning btn-sm' data-toggle='modal' data-target='#editMemberModal' data-id='" . $row["id"] . "' data-name='" . $row["name"] . "' " . (isset($row["role_id"]) ? "data-role_id='" . $row["role_id"] . "'" : "") . " data-image='" . $row["image"] . "'>Modifier</button>
                            </div>
                        </div>
                    </div>";
                
                    }
                } else {
                    echo "<p>Aucun membre trouvé.</p>";
                }
                ?>
            </div>
        </div>
    </div>

    <!-- Modal pour ajouter un membre -->
    <div class="modal fade" id="addMemberModal" tabindex="-1" role="dialog" aria-labelledby="addMemberModalLabel" aria-hidden="true">
        <!-- Le contenu du modal pour ajouter un membre -->
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addMemberModalLabel">Ajouter un membre</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="admin_members.php" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="name">Nom :</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="role_id">Rôle :</label>
                            <select class="form-control" id="role_id" name="role_id">
                                <?php
                                if ($result_roles->num_rows > 0) {
                                    while ($row = $result_roles->fetch_assoc()) {
                                        echo "<option value='" . $row['id'] . "'>" . $row['role_name'] . "</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="image">Image :</label>
                            <input type="file" class="form-control-file" id="image" name="image" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block" name="add_member">Ajouter</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal pour modifier un membre -->
<div class="modal fade" id="editMemberModal" tabindex="-1" role="dialog" aria-labelledby="editMemberModalLabel" aria-hidden="true">
    <!-- Le contenu du modal pour modifier un membre -->
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editMemberModalLabel">Modifier un membre</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="admin_members.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" id="edit_id" name="id">
                    <div class="form-group">
                        <label for="edit_name">Nom :</label>
                        <input type="text" class="form-control" id="edit_name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_role_id">Rôle :</label>
                        <select class="form-control" id="edit_role_id" name="role_id">
                            <?php
                            if ($result_roles1->num_rows > 0) {
                                while ($row = $result_roles1->fetch_assoc()) {
                                    $selected = ($row['id'] == $role_id) ? "selected" : "";
                                    echo "<option value='" . $row['id'] . "' $selected>" . $row['role_name'] . "</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit_image">Image :</label>
                        <input type="file" class="form-control-file" id="edit_image" name="image">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block" name="edit_member">Modifier</button>
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



    <!-- Les scripts JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/script.js"></script>

    <!-- Script pour pré-remplir le formulaire de modification -->
    <script>
    $('#editMemberModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var name = button.data('name')
        var role_id = button.data('role_id')
        var image = button.data('image')

        var modal = $(this)
        modal.find('.modal-body #edit_id').val(id)
        modal.find('.modal-body #edit_name').val(name)
        modal.find('.modal-body #edit_role_id').val(role_id).change();
        modal.find('.modal-body #edit_image').val('')
    })
    </script>
</body>
</html>
