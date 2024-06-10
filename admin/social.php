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

// Récupérer les informations sociales
$social_sql = "SELECT * FROM social_links";
$social_result = $conn->query($social_sql);
$social_links = [];
while ($row = $social_result->fetch_assoc()) {
    $social_links[$row['platform']] = $row;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration des Liens Sociaux</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container shadow p-4 mt-4">
    <h2 class="mb-4">Administration des Liens Sociaux</h2>
    
    <div class="row">
        <?php 
        $platforms = ['twitter', 'facebook', 'instagram', 'linkedin'];
        
        foreach ($platforms as $platform): 
            $social = isset($social_links[$platform]) ? $social_links[$platform] : null;
        ?>
        <div class="col-lg-6 mb-4">
            <div class="card shadow">
                <div class="card-body">
                    <h5 class="card-title"><?= ucfirst($platform) ?></h5>
                    <?php if ($social): ?>
                        <p class="card-text">URL : <?= $social['url'] ?></p>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editModal<?= $platform ?>">Modifier</button>
                    <?php else: ?>
                        <p class="card-text">Aucun lien disponible.</p>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal<?= $platform ?>">Ajouter</button>
                    <?php endif; ?>
                </div>
            </div>
        </div>

<!-- Modal Ajouter -->
<div class="modal fade" id="addModal<?= $platform ?>" tabindex="-1" role="dialog" aria-labelledby="addModalLabel<?= $platform ?>" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addModalLabel<?= $platform ?>">Ajouter <?= $platform ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post">
                            <div class="form-group">
                                <input type="hidden" name="platform" value="<?= $platform ?>">
                                
                                <input type="hidden" class="form-control" id="icon" name="icon" required>
                            </div>
                            <div class="form-group">
                                <label for="url">URL :</label>
                                <input type="text" class="form-control" id="url" name="url" required>
                            </div>
                            <button type="submit" class="btn btn-primary" name="add">Ajouter</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <!-- Modal Modifier -->
        <div class="modal fade" id="editModal<?= $platform ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel<?= $platform ?>" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel<?= $platform ?>">Modifier <?= $platform ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post">
                            <div class="form-group">
                                <input type="hidden" name="platform" value="<?= $platform ?>">
                                <input type="hidden" name="id" value="<?= $social['id'] ?>">
                                
                                <input type="hidden" class="form-control" id="icon" name="icon" value="<?= $social['icon'] ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="url">URL :</label>
                                <input type="text" class="form-control" id="url" name="url" value="<?= $social['url'] ?>" required>
                            </div>
                            <button type="submit" class="btn btn-primary"name="edit">Modifier</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <?php endforeach; ?>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
