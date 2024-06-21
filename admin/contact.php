<?php
session_start();

/* if (!isset($_SESSION['admin_id'])) {
    header("Location: index.php");
    exit();
} */

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

// Récupérer les informations de contact
$contact_sql = "SELECT * FROM contact_info";
$contact_result = $conn->query($contact_sql);
$contacts = [];
while ($row = $contact_result->fetch_assoc()) {
    $contacts[$row['type']] = $row;
}

// Gestion de l'ajout et de la modification
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $type = $_POST['type'];
    $icon = $_POST['icon'];
    $title = $_POST['title'];
    $value = $_POST['value'];
    $map_url = isset($_POST['map_url']) ? $_POST['map_url'] : null;
    
    if (isset($_POST['add'])) {
        $sql = "INSERT INTO contact_info (type, icon, title, value) VALUES ('$type', '$icon', '$title', '$value', '$map_url')";
    } else if (isset($_POST['edit'])) {
        $id = $_POST['id'];
        $sql = "UPDATE contact_info SET icon='$icon', title='$title', value='$value', map_url='$map_url' WHERE id='$id'";
    }
    
    if ($conn->query($sql) === TRUE) {
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    } else {
        echo "Erreur : " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration des Informations de Contact</title>
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

            <div class="container shadow p-4 mt-4">
    <h2 class="mb-4">Administration des Informations de Contact</h2>
    
    <div class="row">
        <?php 
        $info_types = [
            'address' => 'Adresse',
            'email' => 'Email',
            'phone' => 'Téléphone',
            'map' => 'Carte'
        ];
        
        foreach ($info_types as $type => $label): 
            $contact = isset($contacts[$type]) ? $contacts[$type] : null;
        ?>
        <div class="col-lg-6 mb-4">
            <div class="card shadow">
                <div class="card-body">
                    <h5 class="card-title"><?= $label ?></h5>
                    <?php if ($contact): ?>
                        <p class="card-text"><?= $contact['value'] ?></p>
                        <?php if ($type == 'map' && $contact['map_url']): ?>
                            <iframe class="mb-4 mb-lg-0 shadow"
                                    src="<?= $contact['map_url'] ?>"
                                    frameborder="0" style="border:0; width: 100%; height: 200px;" allowfullscreen></iframe>
                        <?php endif; ?>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editModal<?= $type ?>">Modifier</button>
                    <?php else: ?>
                        <p class="card-text">Aucune information disponible.</p>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal<?= $type ?>">Ajouter</button>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Modal Ajouter -->
        <div class="modal fade" id="addModal<?= $type ?>" tabindex="-1" role="dialog" aria-labelledby="addModalLabel<?= $type ?>" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addModalLabel<?= $type ?>">Ajouter <?= $label ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post">
                            <div class="form-group">
                                <input type="hidden" class="form-control" id="icon" name="icon" required>
                            </div>
                            <div class="form-group">
                                <label for="title">Titre :</label>
                                <input type="text" class="form-control" id="title" name="title" required>
                            </div>
                            <div class="form-group">
                                <label for="value">Valeur :</label>
                                <input type="text" class="form-control" id="value" name="value" required>
                            </div>
                            <?php if ($type == 'map'): ?>
                                <div class="form-group">
                                    <label for="map_url">URL de la carte :</label>
                                    <input type="text" class="form-control" id="map_url" name="map_url">
                                </div>
                            <?php endif; ?>
                            <input type="hidden" name="type" value="<?= $type ?>">
                            <button type="submit" class="btn btn-primary" name="add">Ajouter</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Modifier -->
        <div class="modal fade" id="editModal<?= $type ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel<?= $type ?>" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel<?= $type ?>">Modifier <?= $label ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post">
                            <div class="form-group">
                                <input type="hidden" class="form-control" id="icon" name="icon" value="<?= $contact['icon'] ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="title">Titre :</label>
                                <input type="text" class="form-control" id="title" name="title" value="<?= $contact['title'] ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="value">Valeur :</label>
                                <input type="text" class="form-control" id="value" name="value" value="<?= $contact['value'] ?>" required>
                            </div>
                            <?php if ($type == 'map'): ?>
                                <div class="form-group">
                                    <label for="map_url">URL de la carte :</label>
                                    <input type="text" class="form-control" id="map_url" name="map_url" value="<?= $contact['map_url'] ?>">
                                </div>
                            <?php endif; ?>
                            <input type="hidden" name="type" value="<?= $type ?>">
                            <input type="hidden" name="id" value="<?= $contact['id'] ?>">
                            <button type="submit" class="btn btn-primary" name="edit">Modifier</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <?php endforeach; ?>
    </div>
</div>


            <a href="#" class="theme-toggle">
                <i class="fa-regular fa-moon"></i>
                <i class="fa-regular fa-sun"></i>
            </a>



        </div>
    </div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/script.js"></script>

</body>
</html>
