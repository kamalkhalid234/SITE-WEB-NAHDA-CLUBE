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


    <!-- Inclure Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

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
