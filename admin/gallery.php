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

// Traitement de l'ajout d'une image à la galerie
if(isset($_POST['add_image'])){
    $image = $_FILES['image']['name'];
    $type_id = $_POST['type_id']; // Nouvelle ligne pour récupérer le type_id

    // Upload de l'image
    $target_dir = "uploads/image/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

    // Requête SQL pour insérer l'image avec le type_id
    $sql = "INSERT INTO gallery (image, type_id) VALUES ('$image', '$type_id')";
    if (!$conn->query($sql) === TRUE) {
        echo "Erreur : " . $sql . "<br>" . $conn->error;
    }
}

// Traitement de la suppression d'une image
if(isset($_POST['delete_image'])){
    $id = $_POST['id'];

    // Requête SQL pour supprimer l'image
    $sql = "DELETE FROM gallery WHERE id='$id'";
    if (!$conn->query($sql) === TRUE) {
        echo "Erreur : " . $sql . "<br>" . $conn->error;
    }
}

// Requête SQL pour sélectionner toutes les images avec leurs types
$sql = "SELECT gallery.id, gallery.image, types_photos.type  FROM gallery 
        INNER JOIN types_photos ON gallery.type_id = types_photos.id";
$result = $conn->query($sql);

// Requête SQL pour sélectionner tous les types d'images
$sql_types = "SELECT * FROM types_photos";
$result_types = $conn->query($sql_types);
// Fermer la connexion à la base de données
$conn->close();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galerie</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            margin: 20px;
        }
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
    <div class="container">
        <div class="gallery-container mt-5">
            <div class="header">
                <h2 class="mb-4">Galerie</h2>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addImageModal">
                    Ajouter
                </button>
            </div>
            <div class="row">
                <?php
                // Vérifier s'il y a des résultats
                if ($result->num_rows > 0) {
                    // Afficher les données de chaque image
                    while($row = $result->fetch_assoc()) {
                        echo "<div class='col-md-4'>
                                <div class='card mb-4'>
                                    <img src='uploads/image/" . $row["image"] . "' class='card-img-top gallery-image' alt='Image'>
                                    <div class='card-body'>
                                        <p>Type : " . $row["type"] . "</p>
                                        <form action='gallery.php' method='post' style='display: inline;'>
                                            <input type='hidden' name='id' value='" . $row["id"] . "'>
                                            <button type='submit' name='delete_image' class='btn btn-danger btn-sm'>Supprimer</button>
                                        </form>
                                    </div>
                                </div>
                            </div>";
                    }
                } else {
                    echo "<p>Aucune image trouvée.</p>";
                }
                ?>
            </div>
        </div>
    </div>

    <!-- Modal pour ajouter une image -->
    <div class="modal fade" id="addImageModal" tabindex="-1" role="dialog" aria-labelledby="addImageModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addImageModalLabel">Ajouter une image</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="gallery.php" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="image">Image :</label>
                            <input type="file" class="form-control-file" id="image" name="image" required>
                        </div>
                        <div class="form-group">
                            <label for="type_id">Type :</label>
                            <select class="form-control" id="type_id" name="type_id" required>
                                <?php
                                // Afficher les types d'images
                                if ($result_types->num_rows > 0) {
                                    while($row = $result_types->fetch_assoc()) { ?>
                                        
                                        <option value="<?= $row['id'] ?>"> <?= $row["type"] ?></option>
                                    <?php }
                                    } else {
                                    echo "<option value=''>Aucun type trouvé</option>";
                                    }
                                    ?>
                                    </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-block" name="add_image">Ajouter</button>
                                    </form>
                                    </div>
                                    </div>
                                    </div>
                                    </div>
                        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>