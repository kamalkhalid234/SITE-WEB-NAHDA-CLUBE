<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "association";

// Création de la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Récupérer les informations de contact
$address_sql = "SELECT * FROM contact_info WHERE type = 'address'";
$address_result = $conn->query($address_sql);

$email_sql = "SELECT * FROM contact_info WHERE type = 'email'";
$email_result = $conn->query($email_sql);

$phone_sql = "SELECT * FROM contact_info WHERE type = 'phone'";
$phone_result = $conn->query($phone_sql);

// Récupérer les liens sociaux
$social_sql = "SELECT * FROM social_links";
$social_result = $conn->query($social_sql);

$conn->close();
?>


<!-- ======= Footer ======= -->
<footer id="footer">
    <div class="footer-top">
        <div class="container">
            <div class="row">

                <div class="col-lg-3 col-md-6">
                    <div class="footer-info">
                        <h3>Groovin</h3>
                        
                        <p>
                            <?php while ($address_row = $address_result->fetch_assoc()): ?>
                                <?= $address_row['value'] ?>
                            <?php endwhile; ?>
                            <br>
                            <?php while ($phone_row = $phone_result->fetch_assoc()): ?>
                            <strong>Phone:</strong> <?= $phone_row['value'] ?><br>
                            <?php endwhile; ?>
                            <?php while ($email_row = $email_result->fetch_assoc()): ?>
                            <strong>Email:</strong> <?= $email_row['value'] ?><br>
                            <?php endwhile; ?>
                        </p>
                    
                        <div class="social-links mt-3">
                            <?php while ($social_row = $social_result->fetch_assoc()): ?>
                                <a href="<?= $social_row['url'] ?>" class="<?= $social_row['platform'] ?>">
                                    <i class="<?= $social_row['icon'] ?>"></i>
                                </a>
                            <?php endwhile; ?>
                        </div>
                    </div>
                </div>

                <div class="col-lg-2 col-md-6 footer-links">
                    <h4>Useful Links</h4>
                    <ul>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Home</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">About us</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Services</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Terms of service</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Privacy policy</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6 footer-links">
                    <h4>Our Services</h4>
                    <ul>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Web Design</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Web Development</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Product Management</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Marketing</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Graphic Design</a></li>
                    </ul>
                </div>

                <div class="col-lg-4 col-md-6 footer-newsletter">
                    <h4>Our Newsletter</h4>
                    <p>Tamen quem nulla quae legam multos aute sint culpa legam noster magna</p>
                    <form action="" method="post">
                        <input type="email" name="email"><input type="submit" value="Subscribe">
                    </form>

                </div>

            </div>
        </div>
    </div>

    <div class="container">
        <div class="copyright">
            &copy; Copyright <strong><span>Groovin</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
            <!-- All the links in the footer should remain intact. -->
            <!-- You can delete the links only if you purchased the pro version. -->
            <!-- Licensing information: https://bootstrapmade.com/license/ -->
            <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/groovin-free-bootstrap-theme/ -->
            Designed by <a href="../admin/index.php">admin</a>
        </div>
    </div>
</footer><!-- End Footer -->