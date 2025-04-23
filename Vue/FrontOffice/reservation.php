<?php
// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gestion_evenements";

$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("La connexion a échoué: " . $conn->connect_error);
}

// Vérifie que l'ID existe et qu'il est bien un entier
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $idE = intval($_GET['id']); // Protection contre les injections SQL

    // Requête préparée pour récupérer les détails de l'événement
    $stmt = $conn->prepare("SELECT * FROM evenement WHERE idE = ?");
    $stmt->bind_param("i", $idE);
    $stmt->execute();
    $result = $stmt->get_result();

    // Vérifie que l'événement existe
    if ($result->num_rows > 0) {
        $event = $result->fetch_assoc();
    } else {
        die("Événement introuvable.");
    }

    $stmt->close();
} else {
    die("ID de l'événement invalide.");
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Service Details - Résèrver votre place</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Logis
  * Template URL: https://bootstrapmade.com/logis-bootstrap-logistics-website-template/
  * Updated: Aug 07 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      background-color: #f4f4f4;
    }
    header {
      background-color: #0077cc;
      color: white;
      padding: 20px;
      text-align: center;
    }
    .container {
      max-width: 1000px;
      margin: 30px auto;
      padding: 20px;
      background:lightgrey;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    .event-card {
      border: 1px solid #ddd;
      border-radius: 8px;
      padding: 15px;
      margin-bottom: 20px;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }
    .event-card img {
      width: 145px;
      height: 170px;
      object-fit: cover;
      margin-right: 15px;
      border-radius: 5px;
    }
    .event-details {
      flex: 1;
    }
    .event-details h3 {
      margin-top: 0;
    }
    .btn {
      background-color: #0077cc;
      color: white;
      padding: 10px 15px;
      text-decoration: none;
      border-radius: 5px;
      display: inline-block;
    }
    .form-group {
      margin-bottom: 15px;
    }
    label {
      display: block;
      font-weight: bold;
    }
    input, select {
      width: 100%;
      padding: 8px;
      margin-top: 5px;
      border-radius: 5px;
      border: 1px solid #ccc;
    }
    .confirmation {
      text-align: center;
      padding: 30px;
    }
  </style>

</head>

<body class="service-details-page">

  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="index.html" class="logo d-flex align-items-center me-auto">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <h1 class="sitename">EasyParki</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="index.php">Home<br></a></li>
          <li><a href="Stationement.php">Stationnement</a></li>
          <li><a href="services.php">Services</a></li>
          <li><a href="vacance.php">Vacances</a></li>
          <li class="dropdown">
             <a href="evenement.php"><span>Événement</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
              <ul>
                <li><a href="evenement.php">Page Événement</a></li>
                
                <li><a href="listevenement.php">Option Stationnement VIP</a></li>
                <li><a href="addevenement.php">Acces Aux Detenteurs De Billets</a></li>
                <li><a href="listparticipation.php">Planification Et Ajustement De la Duree Du Stationnement</a></li>
                <li><a href="addparticipation.php">Notifications De Rappel Avant L'evenement</a></li>
                <li><a href="addparticipation.php">Suggestion De Stationnement Proche</a></li>
                <li><a href="addparticipation.php">Espace De Stationnement Pour Food Trucks Et Exposant</a></li>
              </ul>
           </li>

          <li><a href="covoiturage.php">Covoiturage</a></li>
          <li><a href="contact.php">Contact</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      <a class="btn-getstarted" href="creercompte.">Créer un compte</a>

    </div>

  </header>

  <main class="main">
    <!-- Page Title -->
    <div class="page-title dark-background" data-aos="fade" style="background-image: url(assets/image/events.jpeg);">
        <h1>Réservation de Stationnement Spécifique pour les Événements</h1>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="index.html">Home</a></li>
            <li class="current">Service</li>
          </ol>
        </nav>
      
    </div><!-- End Page Title -->

  
    <div class="container" id="reservation-form">
    <h2>Réservation pour <?= htmlspecialchars($event['nomE']) ?></h2>
    
    <!-- Formulaire de réservation -->
    <form action="submit_reservation.php" method="POST">
        <!-- ID de l'événement caché -->
          <input type="hidden" name="idE" value="<?= $event['idE'] ?>">
        <!-- Nom du participant -->
        <div class="mb-3">
            <label for="nom_participant" class="form-label">Nom</label>
            <input type="text" class="form-control" id="nom_participant" name="nom_participant" required>
        </div>
        
        <!-- Prénom du participant -->
        <div class="mb-3">
            <label for="prenom_participant" class="form-label">Prénom</label>
            <input type="text" class="form-control" id="prenom_participant" name="prenom_participant" required>
        </div>
        
        <!-- Email -->
        <div class="mb-3">
            <label for="mail_participant" class="form-label">Email</label>
            <input type="email" class="form-control" id="mail_participant" name="mail_participant" required>
        </div>

        <!-- Numéro de téléphone -->
        <div class="mb-3">
            <label for="numTel_participant" class="form-label">Numéro de téléphone</label>
            <input type="text" class="form-control" id="numTel_participant" name="numTel_participant" required>
        </div>
        
        <!-- Bouton de soumission -->
        <button type="submit" class="btn btn-primary">Confirmer la réservation</button>
    </form>
</div>



    <div class="container confirmation" id="confirmation" style="display: none;">
      <h2>🎉 Réservation Confirmée !</h2>
      <p>Merci pour votre réservation. Votre place est confirmée pour l'événement choisi.</p>
      <p>Un email de confirmation vous a été envoyé.</p>
      <a href="evenement.php" class="btn">Retour aux événements</a>
    </div>
  
    <script>
      function showConfirmation(event) {
        event.preventDefault();
        document.getElementById('reservation').style.display = 'none';
        document.getElementById('confirmation').style.display = 'block';
      }
    </script>
    
  </main>

  <footer id="footer" class="footer dark-background">    
      <div class="row gy-4">
        <div class="col-lg-5 col-md-12 footer-about">
          <a href="index.html" class="logo d-flex align-items-center">
            <span class="sitename">EasyParki</span>
          </a>
          <p>Cras fermentum odio eu feugiat lide par naso tierra. Justo eget nada terra videa magna derita valies darta donna mare fermentum iaculis eu non diam phasellus.</p>
          <div class="social-links d-flex mt-4">
            <a href=""><i class="bi bi-twitter-x"></i></a>
            <a href=""><i class="bi bi-facebook"></i></a>
            <a href=""><i class="bi bi-instagram"></i></a>
            <a href=""><i class="bi bi-linkedin"></i></a>
          </div>
        </div>

        <div class="col-lg-2 col-6 footer-links">
          <h4>Useful Links</h4>
          <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">About us</a></li>
            <li><a href="#">Services</a></li>
            <li><a href="#">Terms of service</a></li>
            <li><a href="#">Privacy policy</a></li>
          </ul>
        </div>

        <div class="col-lg-2 col-6 footer-links">
          <h4>Our Services</h4>
          <ul>
            <li><a href="#">Web Design</a></li>
            <li><a href="#">Web Development</a></li>
            <li><a href="#">Product Management</a></li>
            <li><a href="#">Marketing</a></li>
            <li><a href="#">Graphic Design</a></li>
          </ul>
        </div>

        <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
          <h4>Contact Us</h4>
          <p>A108 Adam Street</p>
          <p>New York, NY 535022</p>
          <p>United States</p>
          <p class="mt-4"><strong>Phone:</strong> <span>+1 5589 55488 55</span></p>
          <p><strong>Email:</strong> <span>info@example.com</span></p>
        </div>

      </div>
    

    <div class="container copyright text-center mt-4">
      <p>© <span>Copyright</span> <strong class="px-1 sitename">EasyParki</strong> <span>All Rights Reserved</span></p>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you've purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div>

  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>