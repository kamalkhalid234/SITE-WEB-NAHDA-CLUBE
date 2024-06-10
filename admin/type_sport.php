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

// Fonction pour gérer l'upload d'images
function uploadImage($file) {
    $file_name = $file['name'];
    $file_tmp = $file['tmp_name'];
    $target_dir = "uploads/image/";

    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    $image_name = uniqid() . '_' . $file_name;
    move_uploaded_file($file_tmp, $target_dir.$image_name);

    return $target_dir.$image_name;
}

// Gestion de la modification des descriptions et des images
if (isset($_POST['update_description'])) {
    $id = $_POST['id'];
    $description = $_POST['description'];
    if (empty($description)) {
        $description = NULL;
    }

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image_path = uploadImage($_FILES['image']);
        $sql = "UPDATE types_photos SET description=?, image=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssi', $description, $image_path, $id);
    } else {
        $sql = "UPDATE types_photos SET description=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('si', $description, $id);
    }

    if ($stmt->execute() === TRUE) {
        echo "<script>alert('Description mise à jour avec succès.')</script>";
    } else {
        echo "Erreur : " . $sql . "<br>" . $conn->error;
    }
}

// Récupérer les types et descriptions existants
$sql = "SELECT * FROM types_photos";
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration des Types de Photos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container shadow p-4 mt-4">
    <h2 class="mb-4">Administration des Types de Photos</h2>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Type</th>
                <th>Description</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['type'] ?></td>
                    <td><?= $row['description'] ?></td>
                    <td>
                        <?php if (!empty($row['image'])): ?>
                            <img src="<?= $row['image'] ?>" alt="Image" style="width: 100px; height: auto;">
                        <?php else: ?>
                            Pas d'image
                        <?php endif; ?>
                    </td>
                    <td>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editModal<?= $row['id'] ?>">Modifier</button>
                    </td>
                </tr>

                <!-- Modal de modification -->
                <div class="modal fade" id="editModal<?= $row['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel<?= $row['id'] ?>" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel<?= $row['id'] ?>">Modifier Description et Image</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="description">Description :</label>
                                        <textarea class="form-control" id="description" name="description" rows="3"><?= $row['description'] ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="image">Image (optionnel) :</label>
                                        <input type="file" class="form-control" id="image" name="image">
                                    </div>
                                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                    <button type="submit" class="btn btn-primary" name="update_description">Modifier</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
