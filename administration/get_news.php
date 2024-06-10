<?php
// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "association";

$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

// Requête SQL pour récupérer les actualités
$sql = "SELECT * FROM news";
$result = $conn->query($sql);

// Convertir les résultats en un tableau associatif
$news = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $news[] = $row;
    }
}

// Fermer la connexion à la base de données
$conn->close();

// Renvoyer les actualités au format JSON
echo json_encode($news);
?>
