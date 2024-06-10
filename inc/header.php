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

// Récupérer les informations de contact
$email_sql = "SELECT * FROM contact_info WHERE type = 'email'";
$email_result = $conn->query($email_sql);

// Récupérer les informations de contact
$phone_sql = "SELECT * FROM contact_info WHERE type = 'phone'";
$phone_result = $conn->query($phone_sql);

// Récupérer les liens sociaux
$social_sql = "SELECT * FROM social_links";
$social_result = $conn->query($social_sql);

$conn->close();
?>
<!-- ======= Top Bar ======= -->
<section id="topbar" class="d-flex align-items-center">
    <div class="container d-flex justify-content-center justify-content-md-between">
        <div class="contact-info d-flex align-items-center">
        <?php while ($email_row = $email_result->fetch_assoc()): ?>
            <i class="bi bi-envelope d-flex align-items-center"><a href="mailto:contact@example.com"><?= $email_row['value'] ?></a></i>
        <?php endwhile; ?>
        <?php while ($phone_row = $phone_result->fetch_assoc()): ?>
            <i class="bi bi-phone d-flex align-items-center ms-4"><span><?= $phone_row['value'] ?></span></i>
        <?php endwhile; ?>
        </div>
        <div class="social-links d-none d-md-flex align-items-center">
        <?php while ($social_row = $social_result->fetch_assoc()): ?>
            <a href="<?= $social_row['url'] ?>" class="<?= $social_row['platform'] ?>">
                <i class="<?= $social_row['icon'] ?>"></i>
            </a>
        <?php endwhile; ?>
    </div>
    </div>
</section>

<!-- ======= Header ======= -->
<header id="header" class="d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">

        <h1 class="logo"><a href="index.html"><span>R.S.C</span></a>
        </h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html" class="logo"><img src="assets/img/logo.png" alt=""></a>-->

        <nav id="navbar" class="navbar">
            <ul>
                <li><a class="nav-link scrollto active" href="index.php">الرئيسية</a></li>
                <li class="dropdown"><a href="#"><span>أكاديمية-الفريق</span> <i class="bi bi-chevron-down"></i></a>
                    <ul>
                        <li><a href="#"></a></li>
                        <li class="dropdown"><a href="#"><span>كرة القدم </span> <i class="bi bi-chevron-right"></i></a>
                            <ul>
                                <li><a href="../administration/sinior.php">الكبار</a></li>
                                <li><a href="../administration/jinior.php">الشبان</a></li>
                                <li><a href="../administration/cadi.php">الفتيان</a></li>
                                <li><a href="../administration/mini.php">الصغار</a></li>
                                <li><a href="../administration/se_mini.php">البراعم</a></li>
                            </ul>
                        </li>
                        <li><a href="../administration/football_sale.php">كرة القدم داخل القاعة</a></li>
                        <li><a href="../administration/football_F.php">كرة القدم النسوية</a></li>
                        <li><a href="../administration/basketball.php">كرة السلة</a></li>
                        <li><a href="../administration/handball.php"> كرة اليد</a></li>
                    </ul>
                </li>
                <li><a class="nav-link scrollto" href="archife.php">أرشيف الجمعية</a></li>
                <li><a class="nav-link scrollto" href="actualete.php">حوارات و لقاءات</a></li>
                <li><a class="nav-link scrollto" href="soutenir.php">دعم الجمعية</a></li>
                <li class="dropdown"><a href="#"><span>إدارة</span> <i class="bi bi-chevron-down"></i></a>
                    <ul>
                        <li><a href="dossier-juridique.php">الملف القانوني للجمعية </a></li>
                        <li><a href="enesemble-generale.php">الجموع العامة</a></li>
                        <li><a href="ensemble-exceptionnels.php">الجموع الإستتنائية</a></li>
                        <li><a href="mebre.php">لائحة الأعضاء</a></li>

                    </ul>
                </li>
                <li><a class="nav-link scrollto " href="contact.php">تواصل معنا</a></li>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->

    </div>
</header><!-- End Header -->