<?php
// Inclure le fichier de connexion à la base de données
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

// Traitement du formulaire d'ajout ou de modification de match
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ajout d'un nouveau match
    if (isset($_POST['add_match'])) {
    
        // Vérifier si les clés 'team1_logo' et 'team2_logo' existent dans $_FILES et si les fichiers ont été téléchargés avec succès
        if (isset($_FILES['team1_logo']['name']) && isset($_FILES['team2_logo']['name']) && $_FILES['team1_logo']['error'] === 0 && $_FILES['team2_logo']['error'] === 0) {
            $team1_logo = basename($_FILES['team1_logo']['name']);
            $team2_logo = basename($_FILES['team2_logo']['name']);
            $score = $conne->real_escape_string($_POST['score']);
            $date = $conne->real_escape_string($_POST['date']);
            $time = $conne->real_escape_string($_POST['time']);
            $location = $conne->real_escape_string($_POST['location']);
            $type_sport_id = 3; // Store the constant value in a variable
    
            // Répertoire de stockage des fichiers téléchargés
            $upload_directory = "uploads/";
    
            // Déplacer les fichiers téléchargés vers le répertoire de stockage
            move_uploaded_file($_FILES['team1_logo']['tmp_name'], $upload_directory . $team1_logo);
            move_uploaded_file($_FILES['team2_logo']['tmp_name'], $upload_directory . $team2_logo);
    
            // Insertion des chemins d'accès aux fichiers dans la base de données
            $team1_logo_path = $upload_directory . $team1_logo;
            $team2_logo_path = $upload_directory . $team2_logo;
            $sql = "INSERT INTO matches (type_sport_id, team1_logo, team2_logo, score, date, time, location, categorie_id) VALUES (?, ?, ?, ?, ?, ?, ?, NULL)";
            $stmt = $conne->prepare($sql);
            $stmt->bind_param('issssss', $type_sport_id, $team1_logo_path, $team2_logo_path, $score, $date, $time, $location);
    
            if ($stmt->execute() === TRUE) {
                echo "Nouveau match ajouté avec succès";
            } else {
                echo "Erreur: " . $stmt->error;
            }
            $stmt->close();
        } else {
            // Si les fichiers n'ont pas été téléchargés avec succès
            echo "Veuillez sélectionner les logos des deux équipes.";
        }
    }    

    // Modification d'un match existant
    if (isset($_POST['edit_match'])) {
        // Récupération des données du formulaire
        $id = $_POST['id'];
        $score = $conne->real_escape_string($_POST['score']);
        $date = $conne->real_escape_string($_POST['date']);
        $time = $conne->real_escape_string($_POST['time']);
        $location = $conne->real_escape_string($_POST['location']);
    
        // Initialiser les chemins des fichiers
        $team1_logo_path = $_POST['existing_team1_logo'];
        $team2_logo_path = $_POST['existing_team2_logo'];
    
        // Répertoire de stockage des fichiers téléchargés
        $upload_directory = "uploads/";
    
        // Vérifier si de nouveaux fichiers ont été téléchargés et déplacer les fichiers téléchargés vers le répertoire de stockage
        if (isset($_FILES['team1_logo']['name']) && $_FILES['team1_logo']['error'] === 0) {
            $team1_logo = basename($_FILES['team1_logo']['name']);
            move_uploaded_file($_FILES['team1_logo']['tmp_name'], $upload_directory . $team1_logo);
            $team1_logo_path = $upload_directory . $team1_logo;
        }
    
        if (isset($_FILES['team2_logo']['name']) && $_FILES['team2_logo']['error'] === 0) {
            $team2_logo = basename($_FILES['team2_logo']['name']);
            move_uploaded_file($_FILES['team2_logo']['tmp_name'], $upload_directory . $team2_logo);
            $team2_logo_path = $upload_directory . $team2_logo;
        }
    
        // Mise à jour des chemins d'accès aux fichiers dans la base de données
        $sql = "UPDATE matches SET team1_logo=?, team2_logo=?, score=?, date=?, time=?, location=? WHERE id=?";
        $stmt = $conne->prepare($sql);
        $stmt->bind_param('ssssssi', $team1_logo_path, $team2_logo_path, $score, $date, $time, $location, $id);
        
        if ($stmt->execute() === TRUE) {
            echo "Match mis à jour avec succès";
        } else {
            echo "Erreur lors de la mise à jour du match: " . $stmt->error;
        }
        $stmt->close();
    }    
}

// Suppression d'un match
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    // Suppression du match de la base de données
    $sql = "DELETE FROM matches WHERE id=?";
    $stmt = $conne->prepare($sql);
    $stmt->bind_param('i', $id);
    
    if ($stmt->execute() !== TRUE) {
        echo "Erreur lors de la suppression du match: " . $stmt->error;
    }
    $stmt->close();
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Matches</title>
    <!-- Intégration de Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="bg-gray-100">
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
        <div class="container mx-auto p-4">
            <h2 class="text-2xl font-bold mb-4">Liste des matchs</h2>
            <!-- Bouton pour ouvrir le modal d'ajout de match -->
            <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 mb-4" data-toggle="modal" data-target="#addMatchModal">Ajouter un match</button>

            <!-- Afficher les matchs par type -->
            
                <div class="mb-6">
                    <table class="w-full bg-white shadow-lg">
                        <thead>
                        <th class="py-2 px-4">ID</th>
                                <th class="py-2 px-4">Equipe 1</th>
                                <th class="py-2 px-4">Equipe 2</th>
                                <th class="py-2 px-4">Score</th>
                                <th class="py-2 px-4">Date</th>
                                <th class="py-2 px-4">Heure</th>
                                <th class="py-2 px-4">Lieu</th>
                                <th class="py-2 px-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Récupérer les matchs par type
                            $sql_matches = "SELECT * FROM matches WHERE type_sport_id IN (SELECT id FROM types_photos WHERE id=3)";
                            $stmt = $conne->prepare($sql_matches);
                            $stmt->execute();
                            $result_matches = $stmt->get_result();
                            while($row_match = $result_matches->fetch_assoc()): ?>
                                <tr>
                                    <td class="border px-4 py-2"><?php echo $row_match['id']; ?></td>
                                    <td class="border px-4 py-2"><img src="<?php echo $row_match['team1_logo']; ?>" alt="Logo Equipe 1" width="50"></td>
                                    <td class="border px-4 py-2"><img src="<?php echo $row_match['team2_logo']; ?>" alt="Logo Equipe 2" width="50"></td>
                                    <td class="border px-4 py-2"><?php echo $row_match['score']; ?></td>
                                    <td class="border px-4 py-2"><?php echo $row_match['date']; ?></td>
                                    <td class="border px-4 py-2"><?php echo $row_match['time']; ?></td>
                                    <td class="border px-4 py-2"><?php echo $row_match['location']; ?></td>
                                    <td class="border px-4 py-2">
                                    <button class="bg-green-500 text-white px-2 py-1 rounded hover:bg-green-600 edit-match-button" data-toggle="modal" data-target="#editMatchModal" data-id="<?php echo $row_match['id']; ?>" data-team1_logo="<?php echo $row_match['team1_logo']; ?>" data-team2_logo="<?php echo $row_match['team2_logo']; ?>" data-score="<?php echo $row_match['score']; ?>" data-date="<?php echo $row_match['date']; ?>" data-time="<?php echo $row_match['time']; ?>" data-location="<?php echo $row_match['location']; ?>">Modifier</button>
                                        <a href="matche_football_F.php?delete=<?php echo $row_match['id']; ?>" class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce match ?');">Supprimer</a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                            <?php $stmt->close(); ?>
                        </tbody>
                    </table>
                </div>
        </div>
    </div>
</div>

<!-- Modal d'ajout de match -->
<div class="modal fade" id="addMatchModal" tabindex="-1" role="dialog" aria-labelledby="addMatchModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addMatchModalLabel">Ajouter un match</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addMatchForm" method="post" action="matche_football_F.php" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="team1_logo">Logo Equipe 1</label>
                        <input type="file" class="form-control-file" id="team1_logo" name="team1_logo" required>
                    </div>
                    <div class="form-group">
                        <label for="team2_logo">Logo Equipe 2</label>
                        <input type="file" class="form-control-file" id="team2_logo" name="team2_logo" required>
                    </div>
                    <div class="form-group">
                        <label for="score">Score</label>
                        <input type="text" class="form-control" id="score" name="score" required>
                    </div>
                    <div class="form-group">
                        <label for="date">Date</label>
                        <input type="date" class="form-control" id="date" name="date" required>
                    </div>
                    <div class="form-group">
                        <label for="time">Heure</label>
                        <input type="time" class="form-control" id="time" name="time" required>
                    </div>
                    <div class="form-group">
                        <label for="location">Lieu</label>
                        <input type="text" class="form-control" id="location" name="location" required>
                    </div>
                    <button type="submit" name="add_match" class="btn btn-primary">Ajouter</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal de modification de match -->
<div class="modal fade" id="editMatchModal" tabindex="-1" role="dialog" aria-labelledby="editMatchModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editMatchModalLabel">Modifier un match</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editMatchForm" method="post" action="matche_football_F.php" enctype="multipart/form-data">
                    <input type="hidden" id="edit_id" name="id">
                    <div class="form-group">
                        <label for="edit_team1_logo">Logo Equipe 1</label>
                        <input type="file" class="form-control-file" id="edit_team1_logo" name="team1_logo">
                        <input type="hidden" id="existing_team1_logo" name="existing_team1_logo">
                    </div>
                    <div class="form-group">
                        <label for="edit_team2_logo">Logo Equipe 2</label>
                        <input type="file" class="form-control-file" id="edit_team2_logo" name="team2_logo">
                        <input type="hidden" id="existing_team2_logo" name="existing_team2_logo">
                    </div>
                    <div class="form-group">
                        <label for="edit_score">Score</label>
                        <input type="text" class="form-control" id="edit_score" name="score" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_date">Date</label>
                        <input type="date" class="form-control" id="edit_date" name="date" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_time">Heure</label>
                        <input type="time" class="form-control" id="edit_time" name="time" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_location">Lieu</label>
                        <input type="text" class="form-control" id="edit_location" name="location" required>
                    </div>
                    <button type="submit" name="edit_match" class="btn btn-primary">Modifier</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/script.js"></script>

<script>
$(document).ready(function() {
    // Pré-remplir le formulaire de modification avec les données du match
    $('.edit-match-button').click(function() {
        var id = $(this).data('id');
        var team1_logo = $(this).data('team1_logo');
        var team2_logo = $(this).data('team2_logo');
        var score = $(this).data('score');
        var date = $(this).data('date');
        var time = $(this).data('time');
        var location = $(this).data('location');

        $('#edit_id').val(id);
        $('#existing_team1_logo').val(team1_logo);
        $('#existing_team2_logo').val(team2_logo);
        $('#edit_score').val(score);
        $('#edit_date').val(date);
        $('#edit_time').val(time);
        $('#edit_location').val(location);
    });
});
</script>

</body>
</html>
