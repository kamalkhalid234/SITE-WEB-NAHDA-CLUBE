<?php
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

// Fonction pour gérer l'upload d'images
function uploadImage($file){
    $file_name = $file['name'];
    $file_tmp = $file['tmp_name'];
    $target_dir = "uploads/image/";

    if(!file_exists($target_dir)){
        mkdir($target_dir, 0777, true);
    }

    $image_name = uniqid() . '_' . $file_name;
    move_uploaded_file($file_tmp, $target_dir.$image_name);

    return $target_dir.$image_name;
}

// Gestion de l'ajout et de la modification d'image
if (isset($_POST['add_image']) || isset($_POST['edit_image'])) {
    $image_path = uploadImage($_FILES['image']);
    $description = isset($_POST['description']) ? $_POST['description'] : null;
    $type = $_POST['type'];
    
    if (isset($_POST['add_image'])) {
        $sql = "INSERT INTO classement ($type, description) VALUES ('$image_path', '$description')";
    } else {
        $id = $_POST['id'];
        $sql = "UPDATE classement SET $type='$image_path', description='$description' WHERE id='$id'";
    }
    
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Image ajoutée/modifiée avec succès.')</script>";
    } else {
        echo "Erreur : " . $sql . "<br>" . $conn->error;
    }
}

// Récupérer les images existantes
$sql = "SELECT * FROM classement ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration du Classement</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container shadow p-4 mt-4">
    <h2 class="mb-4">Administration du Classement</h2>
    
    <!-- Bouton d'ajout d'image -->
    <?php if (empty($row['equipe_image'])): ?>
        <button type="button" class="btn btn-primary mb-4" data-toggle="modal" data-target="#addEquipeImageModal">Ajouter Image Équipe</button>
    <?php endif; ?>
    <?php if (empty($row['classement_image'])): ?>
        <button type="button" class="btn btn-primary mb-4" data-toggle="modal" data-target="#addClassementImageModal">Ajouter Image Classement</button>
    <?php endif; ?>

    <div class="row">
        <!-- Affichage de l'image de l'équipe -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow">
                <?php if (isset($row['equipe_image']) && !empty($row['equipe_image'])): ?>
                    <img src="<?= $row['equipe_image'] ?>" class="card-img-top" alt="Image Équipe">
                    <div class="card-body">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editEquipeImageModal">Modifier Image Équipe</button>
                    </div>
                <?php else: ?>
                    <div class="card-body">
                        <p class="card-text">Aucune image d'équipe trouvée.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Affichage de l'image de classement -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow">
                <?php if (isset($row['classement_image']) && !empty($row['classement_image'])): ?>
                    <img src="<?= $row['classement_image'] ?>" class="card-img-top" alt="Image Classement">
                    <p><?= $row['description'] ?></p>
                    <div class="card-body">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editClassementImageModal">Modifier Image Classement</button>
                    </div>
                <?php else: ?>
                    <div class="card-body">
                        <p class="card-text">Aucune image de classement trouvée.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Modale d'ajout d'image d'équipe -->
<div class="modal fade" id="addEquipeImageModal" tabindex="-1" role="dialog" aria-labelledby="addEquipeImageModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addEquipeImageModalLabel">Ajouter Image Équipe</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="image">Image Équipe :</label>
                        <input type="file" class="form-control" id="image" name="image" required>
                    </div>
                    <input type="hidden" name="type" value="equipe_image">
                    <button type="submit" class="btn btn-primary" name="add_image">Ajouter</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modale d'ajout d'image de classement -->
<div class="modal fade" id="addClassementImageModal" tabindex="-1" role="dialog" aria-labelledby="addClassementImageModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addClassementImageModalLabel">Ajouter Image Classement</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="image">Image Classement :</label>
                        <input type="file" class="form-control" id="image" name="image" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description Classement :</label>
                        <input type="text" class="form-control" id="description" name="description" required>
                    </div>
                    <input type="hidden" name="type" value="classement_image">
                    <button type="submit" class="btn btn-primary" name="add_image">Ajouter</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modale de modification d'image d'équipe -->
<div class="modal fade" id="editEquipeImageModal" tabindex="-1" role="dialog" aria-labelledby="editEquipeImageModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editEquipeImageModalLabel">Modifier Image Équipe</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="image">Image Équipe :</label>
                        <input type="file" class="form-control" id="image" name="image" required>
                    </div>
                    <input type="hidden" name="type" value="equipe_image">
                    <input type="hidden" name="id" value="<?= isset($row['id']) ? $row['id'] : '' ?>">
                    <button type="submit" class="btn btn-primary" name="edit_image">Modifier</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modale de modification d'image de classement -->
<div class="modal fade" id="editClassementImageModal" tabindex="-1" role="dialog" aria-labelledby="editClassementImageModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editClassementImageModalLabel">Modifier Image Classement</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="image">Image Classement :</label>
                        <input type="file" class="form-control" id="image" name="image" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description Classement :</label>
                        <input type="text" class="form-control" id="description" name="description" required>
                    </div>
                    <input type="hidden" name="type" value="classement_image">
                    <input type="hidden" name="id" value="<?= isset($row['id']) ? $row['id'] : '' ?>">
                    <button type="submit" class="btn btn-primary" name="edit_image">Modifier</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
