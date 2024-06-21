<?php
session_start();

// Vérification de la session d'administrateur
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

// Vérification de la connexion à la base de données
if ($conn->connect_error) {
    die("Connexion échouée: " . $conn->connect_error);
}

$message = '';

// Ajouter un nouvel administrateur
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_admin'])) {
    $admin_name = $_POST['name'];
    $admin_password = $_POST['password'];
    $role = $_POST['role']; // Nouveau champ pour le rôle
    $hashed_password = password_hash($admin_password, PASSWORD_BCRYPT);

    // Vérifiez que l'administrateur connecté est un administrateur principal s'il essaie d'ajouter un administrateur principal
    if ($role === 'principal' && $_SESSION['role'] !== 'principal') {
        $message = "Vous n'avez pas l'autorisation d'ajouter un administrateur principal.";
    } else {
        $sql = "INSERT INTO admin (name, password, role) VALUES ('$admin_name', '$hashed_password', '$role')";
        
        if ($conn->query($sql) === TRUE) {
            $message = "Nouvel administrateur ajouté avec succès";
        } else {
            $message = "Erreur: " . $conn->error;
        }
    }
}

// Supprimer un administrateur (uniquement si l'administrateur connecté est principal)
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_admin'])) {
    $admin_id = $_POST['admin_id'];

    // Récupérer le rôle de l'administrateur à supprimer
    $sql = "SELECT role FROM admin WHERE id = $admin_id";
    $result = $conn->query($sql);
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $admin_role = $row['role'];

        // Vérifiez que l'administrateur connecté est un administrateur principal
        if ($_SESSION['role'] === 'principal') {
            // Vérifiez si l'administrateur à supprimer n'est pas principal
            if ($admin_role !== 'principal') {
                $sql = "DELETE FROM admin WHERE id = $admin_id";
                
                if ($conn->query($sql) === TRUE) {
                    $message = "Administrateur supprimé avec succès";
                } else {
                    $message = "Erreur: " . $conn->error;
                }
            } else {
                $message = "Vous ne pouvez pas supprimer un administrateur principal.";
            }
        } else {
            $message = "Vous n'avez pas l'autorisation de supprimer des administrateurs.";
        }
    } else {
        $message = "Administrateur non trouvé.";
    }
}

// Récupérer les administrateurs existants
$admins = [];
$sql = "SELECT id, name, role FROM admin";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $admins[] = $row;
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Administrateurs</title>
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
        <div class="container">
            <h1 class="mt-5">Gestion des Administrateurs</h1>
            <?php if (!empty($message)): ?>
                <div class="alert alert-info"><?php echo $message; ?></div>
            <?php endif; ?>
            <div class="content-shadow">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addAdminModal">
                    Ajouter un Administrateur
                </button>
                <!-- Modal pour ajouter un administrateur -->
                <div class="modal fade" id="addAdminModal" tabindex="-1" aria-labelledby="addAdminModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addAdminModalLabel">Ajouter un Administrateur</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="add_admin.php">
                                    <input type="hidden" name="add_admin" value="1">
                                    <div class="form-group">
                                        <label for="name">Nom de l'administrateur</label>
                                        <input type="text" class="form-control" id="name" name="name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Mot de passe</label>
                                        <input type="password" class="form-control" id="password" name="password" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="role">Rôle</label>
                                        <select class="form-control" id="role" name="role" required>
                                            <option value="secondaire">Secondaire</option>
                                            <?php if ($_SESSION['role'] === 'principal'): ?>
                                                <option value="principal">Principal</option>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Ajouter</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <h2 class="mt-5">Administrateurs Existants</h2>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Rôle</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($admins as $admin): ?>
                        <tr>
                            <td><?php echo $admin['id']; ?></td>
                            <td><?php echo $admin['name']; ?></td>
                            <td><?php echo $admin['role']; ?></td>
                            <td>
                                <?php if ($_SESSION['admin_id'] !== $admin['id']): ?>
                                    <?php if ($_SESSION['role'] === 'principal'): ?>
                                        <form method="post" action="add_admin.php" style="display:inline;">
                                            <input type="hidden" name="delete_admin" value="1">
                                            <input type="hidden" name="admin_id" value="<?php echo $admin['id']; ?>">
                                            <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                                        </form>
                                    <?php else: ?>
                                        <button class="btn btn-danger btn-sm" disabled>Supprimer</button>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <a href="#" class="theme-toggle">
            <i class="fa-regular fa-moon"></i>
            <i class="fa-regular fa-sun"></i>
        </a>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/script.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
