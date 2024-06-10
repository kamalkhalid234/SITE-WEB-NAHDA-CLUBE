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
// Gestion des erreurs PHP
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Traitement de l'ajout d'un fichier PDF
if(isset($_POST['add_pdf'])){
    $title = $_POST['title'];
    $type_id = $_POST['type_id'];
    $pdf = $_FILES['pdf']['name'];

    // Upload du fichier PDF
    $target_dir = "uploads/documents/";
    $target_file = $target_dir . basename($_FILES["pdf"]["name"]);
    move_uploaded_file($_FILES["pdf"]["tmp_name"], $target_file);

    // Requête SQL pour insérer le fichier PDF
    $sql = "INSERT INTO documents (title, pdf, type_id) VALUES ('$title', '$pdf', '$type_id')";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Nouveau fichier PDF ajouté avec succès.');</script>";
    } else {
        echo "Erreur : " . $sql . "<br>" . $conn->error;
    }
}

// Traitement de la suppression d'un fichier PDF
if(isset($_POST['delete_pdf'])){
    $id = $_POST['id'];

    // Requête SQL pour supprimer le fichier PDF
    $sql = "DELETE FROM documents WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Fichier PDF supprimé avec succès.');</script>";
    } else {
        echo "Erreur : " . $sql . "<br>" . $conn->error;
    }
}

// Traitement de la modification d'un fichier PDF
if(isset($_POST['edit_pdf'])){
    $id = $_POST['id'];
    $title = $_POST['title'];
    $type_id = $_POST['type_id'];
    $pdf = $_FILES['pdf']['name'];

    // Upload du nouveau fichier PDF
    if($pdf != ""){
        $target_dir = "uploads/documents/";
        $target_file = $target_dir . basename($_FILES["pdf"]["name"]);
        move_uploaded_file($_FILES["pdf"]["tmp_name"], $target_file);
        $sql = "UPDATE documents SET title='$title', pdf='$pdf', type_id='$type_id' WHERE id='$id'";
    } else {
        $sql = "UPDATE documents SET title='$title', type_id='$type_id' WHERE id='$id'";
    }

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Fichier PDF modifié avec succès.');</script>";
    } else {
        echo "Erreur : " . $sql . "<br>" . $conn->error;
    }

    // Réinitialiser le résultat de la requête pour les types de PDF
    $type_sql = "SELECT id, name FROM types";
    $type_result = $conn->query($type_sql);
}

// Requête SQL pour sélectionner tous les fichiers PDF
$sql = "SELECT documents.id, documents.title, documents.pdf, documents.type_id, types.name as type_name 
        FROM documents 
        JOIN types ON documents.type_id = types.id";
$result = $conn->query($sql);

// Requête SQL pour sélectionner tous les types de PDF
$type_sql = "SELECT id, name FROM types";
$type_result = $conn->query($type_sql);
$type_result1 = $conn->query($type_sql);
// Fermer la connexion à la base de données
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Gestion des PDF</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <!-- Inclure Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* Ajouter des ombres aux cartes */
        .pdf-item {
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        /* Centrer le contenu des cartes */
        .pdf-item .card-body {
            text-align: center;
        }
        /* Bouton à côté du titre */
        .pdf-item .btn {
            margin-top: 10px;
        }
    </style>
</head>

<body>

    <main class="container text-center mt-5">
        <h2>Gestion des PDF</h2>
        <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#addPDFModal">Ajouter un PDF</button>
        <div class="row">
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<div class='col-md-4 mb-4'>
                            <div class='card pdf-item'>
                                <div class='card-body'>
                                    <h5 class='card-title'>" . $row["title"] . "</h5>
                                    <h6 class='card-subtitle mb-2 text-muted'>" . $row["type_name"] . "</h6>
                                    <iframe src='uploads/documents/" . $row["pdf"] . "' class='w-100' height='200'></iframe>
                                    <div class='mt-2'>
                                        <a href='uploads/documents/" . $row["pdf"] . "' target='_blank' class='btn btn-success'>عرض</a>
                                        <a href='uploads/documents/" . $row["pdf"] . "' download class='btn btn-primary'>تحميل</a>
                                        <button class='btn btn-warning' onclick='editPDF(" . $row["id"] . ", \"" . $row["title"] . "\", " . $row["type_id"] . ")'>تعديل</button>
                                        <form action='documents.php' method='post' style='display:inline-block;'>
                                            <input type='hidden' name='id' value='" . $row["id"] . "'>
                                            <button type='submit' name='delete_pdf' class='btn btn-danger'>حذف</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>";
                }
            } else {
                echo "<p>Aucun fichier PDF trouvé.</p>";
            }
            ?>
        </div>
    </main>


    <!-- Modal pour ajouter un PDF -->
    <div class="modal fade" id="addPDFModal" tabindex="-1" role="dialog" aria-labelledby="addPDFModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addPDFModalLabel">Ajouter un PDF</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="documents.php" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="title">Titre :</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        <div class="form-group">
                            <label for="type_id">Type :</label>
                            <select class="form-control" id="type_id" name="type_id" required>
                                <?php
                                if ($type_result->num_rows > 0) {
                                    while($type_row = $type_result->fetch_assoc()) {
                                        echo "<option value='" . $type_row["id"] . "'>" . $type_row["name"] . "</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="pdf">Fichier PDF :</label>
                            <input type="file" class="form-control-file" id="pdf" name="pdf" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-primary" name="add_pdf">Ajouter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal pour modifier un PDF -->
    <div class="modal fade" id="editPDFModal" tabindex="-1" role="dialog" aria-labelledby="editPDFModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPDFModalLabel">Modifier un PDF</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="ensemble-generale.php" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="hidden" id="edit-id" name="id">
                        <div class="form-group">
                            <label for="edit-title">Titre :</label>
                            <input type="text" class="form-control" id="edit-title" name="title" required>
                        </div>
                        <div class="form-group">
                            <label for="edit-type_id">Type :</label>
                            <select class="form-control" id="edit-type_id" name="type_id" required>
                                <?php
                                if ($type_result1->num_rows > 0) {
                                    while($type_row = $type_result1->fetch_assoc()) {
                                        echo "<option value='" . $type_row["id"] . "'>" . $type_row["name"] . "</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="edit-pdf">Nouveau fichier PDF (laisser vide pour garder l'actuel) :</label>
                            <input type="file" class="form-control-file" id="edit-pdf" name="pdf">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-warning" name="edit_pdf">Modifier</button>
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
        function editPDF(id, title, type_id) {
            document.getElementById('edit-id').value = id;
            document.getElementById('edit-title').value = title;
            document.getElementById('edit-type_id').value = type_id;
            $('#editPDFModal').modal('show');
        }
    </script>
</body>
</html>
