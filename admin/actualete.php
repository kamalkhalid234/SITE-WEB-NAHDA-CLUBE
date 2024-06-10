<?php
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

// Traitement de l'ajout d'une actualité
if(isset($_POST['add_news'])){
    $title = $_POST['title'];
    $date = $_POST['date'];
    $image = $_FILES['image']['name'];
    $content = $_POST['content'];

    // Upload de l'image
    $target_dir = "uploads/image/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

    // Requête SQL pour insérer l'actualité
    $sql = "INSERT INTO news (title, date, image, content) VALUES ('$title', '$date', '$image', '$content')";
    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-info' role='alert'> Nouvelle actualité ajoutée avec succès. </div>";
    } else {
        echo "<div class='alert alert-danger' role='alert'> Erreur : " . $sql . "<br>" . $conn->error . "</div>";
    }
}

// Traitement de la suppression d'une actualité
if(isset($_POST['delete_news'])){
    $id = $_POST['id'];

    // Requête SQL pour supprimer l'actualité
    $sql = "DELETE FROM news WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-info' role='alert'> Actualité supprimée avec succès. </div>";
    } else {
        echo "<div class='alert alert-danger' role='alert'> Erreur : " . $sql . "<br>" . $conn->error . "</div>";
    }
}

// Traitement de la modification d'une actualité
if(isset($_POST['edit_news'])){
    $id = $_POST['id'];
    $title = $_POST['title'];
    $date = $_POST['date'];
    $content = $_POST['content'];

    // Gestion de l'image
    if(isset($_FILES['image']['name']) && $_FILES['image']['name'] != ""){
        $image = $_FILES['image']['name'];
        $target_dir = "uploads/image/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
        $sql = "UPDATE news SET title='$title', date='$date', image='$image', content='$content' WHERE id='$id'";
    } else {
        $sql = "UPDATE news SET title='$title', date='$date', content='$content' WHERE id='$id'";
    }

    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-info' role='alert'> Actualité mise à jour avec succès. </div>";
    } else {
        echo "<div class='alert alert-danger' role='alert'> Erreur : " . $sql . "<br>" . $conn->error . "</div>";
    }
}

// Requête SQL pour sélectionner toutes les actualités
$sql = "SELECT id, title, date, image, content FROM news";
$result = $conn->query($sql);

// Fermer la connexion à la base de données
$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration des Actualités</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            margin: 20px;
        }
        .news-container {
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
        <div class="news-container mt-5">
            <div class="header">
                <h2 class="mb-4">Actualités existantes</h2>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addNewsModal">
                    Ajouter
                </button>
            </div>
            <div class="row">
                <?php
                // Afficher les actualités existantes
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<div class='col-md-4'>
                                <div class='card mb-4'>
                                    <img src='uploads/image/" . $row['image'] . "' class='card-img-top gallery-image' alt='Actualité'>
                                    <div class='card-body'>
                                        <h5 class='card-title'>" . $row['title'] . "</h5>
                                        <p class='card-text'>" . $row['date'] . "</p>
                                        <p class='card-text'>" . $row['content'] . "</p>
                                        <button class='btn btn-warning btn-sm' data-toggle='modal' data-target='#editNewsModal' data-id='" . $row['id'] . "' data-title='" . $row['title'] . "' data-date='" . $row['date'] . "' data-content='" . $row['content'] . "'>Éditer</button>
                                        <form action='admin.php' method='post' style='display:inline-block;'>
                                            <input type='hidden' name='id' value='" . $row['id'] . "'>
                                            <button type='submit' name='delete_news' class='btn btn-danger btn-sm'>Supprimer</button>
                                        </form>
                                    </div>
                                </div>
                            </div>";
                    }
                } else {
                    echo "<p>Aucune actualité trouvée.</p>";
                }
                ?>
            </div>
        </div>
    </div>

    <!-- Modal pour ajouter une actualité -->
    <div class="modal fade" id="addNewsModal" tabindex="-1" role="dialog" aria-labelledby="addNewsModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addNewsModalLabel">Ajouter une actualité</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="admin.php" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="title">Titre :</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        <div class="form-group">
                            <label for="date">Date :</label>
                            <input type="date" class="form-control" id="date" name="date" required>
                        </div>
                        <div class="form-group">
                            <label for="image">Image :</label>
                            <input type="file" class="form-control-file" id="image" name="image" required>
                        </div>
                        <div class="form-group">
                            <label for="content">Contenu :</label>
                            <textarea class="form-control" id="content" name="content" rows="4" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block" name="add_news">Ajouter</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal pour éditer une actualité -->
    <div class="modal fade" id="editNewsModal" tabindex="-1" role="dialog" aria-labelledby="editNewsModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editNewsModalLabel">Modifier une actualité</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="admin.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" id="edit-id" name="id">
                        <div class="form-group">
                            <label for="edit-title">Titre :</label>
                            <input type="text" class="form-control" id="edit-title" name="title" required>
                        </div>
                        <div class="form-group">
                        <label for="edit-date">Date :</label>
                            <input type="date" class="form-control" id="edit-date" name="date" required>
                        </div>
                        <div class="form-group">
                            <label for="edit-image">Image :</label>
                            <input type="file" class="form-control-file" id="edit-image" name="image">
                        </div>
                        <div class="form-group">
                            <label for="edit-content">Contenu :</label>
                            <textarea class="form-control" id="edit-content" name="content" rows="4" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block" name="edit_news">Modifier</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        // Script pour pré-remplir le formulaire de modification avec les données de l'actualité sélectionnée
        $('#editNewsModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var title = button.data('title');
            var date = button.data('date');
            var content = button.data('content');

            var modal = $(this);
            modal.find('#edit-id').val(id);
            modal.find('#edit-title').val(title);
            modal.find('#edit-date').val(date);
            modal.find('#edit-content').val(content);
        });
    </script>
</body>
</html>
