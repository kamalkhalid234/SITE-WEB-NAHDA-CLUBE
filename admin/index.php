<?php
session_start();

// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "association";

$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connexion échouée: " . $conn->connect_error);
}
error_reporting(E_ALL);
ini_set('display_errors', 1);

$message = '';

if (isset($_POST['login'])) {
    $admin_name = $_POST['admin_name'];
    $admin_pass = $_POST['admin_pass'];

    // Requête pour sélectionner l'administrateur par nom
    $sql = "SELECT * FROM admin WHERE name = '$admin_name'";
    $result = $conn->query($sql);

    if ($result->num_rows === 1) {
        $admin = $result->fetch_assoc();
        // Vérifier le mot de passe haché
        if (password_verify($admin_pass, $admin['password'])) {
            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['admin_name'] = $admin['name'];
            $_SESSION['role'] = $admin['role'];
            header("Location: add_admin.php");
            exit();
        } else {
            $message = "Nom d'utilisateur ou mot de passe incorrect.";
            var_dump($admin_name);
            var_dump($admin_pass);
        }
    } else {
        $message = "Nom d'utilisateur ou mot de passe incorrect.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login Panel</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
    div.login-form {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 450px;
    }

    .custom-alert {
        position: fixed;
        top: 25px;
        right: 25px;
    }
    </style>
</head>

<body class="bg-light">

    <div class="login-form text-center rounded bg-white shadow overflow-hidden">
        <form method="POST">
            <h4 class="bg-dark text-white py-3">ADMIN LOGIN PANEL</h4>
            <div class="p-5">
                <?php if (!empty($message)): ?>
                    <div class="alert alert-danger custom-alert"><?php echo $message; ?></div>
                <?php endif; ?>
                <div class="mb-3">
                    <input name="admin_name" required type="text" class="form-control shadow-none text-center"
                        placeholder="Admin Name">
                </div>
                <div class="mb-4">
                    <input name="admin_pass" required type="password" class="form-control shadow-none text-center"
                        placeholder="Password">
                </div>
                <button name="login" type="submit" class="btn shadow-none"
                    style="background-color: #dc3545; color: white;">LOGIN</button>
            </div>
        </form>
    </div>
</body>

</html>
