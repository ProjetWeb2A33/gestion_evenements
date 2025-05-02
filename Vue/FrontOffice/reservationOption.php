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

    .page-title.dark-background h1 {
    color: white;
    text-shadow: 1px 1px 3px rgba(0,0,0,0.5);
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
                
                <li><a href="option.php">Options Stationnements</a></li>
                <li><a href="billets.php">Acces Aux Detenteurs De Billets</a></li>
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

  
    <div class="container py-5" id="reservation-form">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-lg">
                <div class="card-header bg-primary text-white py-3">
                    <h2 class="h4 mb-0 text-center"><i class="bi bi-ticket-perforated me-2"></i>Réservation pour <?= htmlspecialchars($event['nomE']) ?></h2>
                </div>
                
                <div class="card-body p-4 p-md-5">
                    <!-- Progress bar (optionnel) -->
                    <div class="progress mb-4" style="height: 8px;">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    
                    <form id="reservation-form" onsubmit="submitReservation(event)" method="POST">
                        <input type="hidden" name="idE" value="<?= $event['idE'] ?>">
                        
                        <div class="row g-3">
                            <!-- Prénom -->
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="prenom_participant" name="prenom_participant" placeholder=" " required>
                                    <label for="prenom_participant"><i class="bi bi-person me-2"></i>Prénom</label>
                                    <div class="invalid-feedback">
                                        Veuillez entrer votre prénom.
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Nom -->
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="nom_participant" name="nom_participant" placeholder=" " required>
                                    <label for="nom_participant"><i class="bi bi-person-vcard me-2"></i>Nom</label>
                                    <div class="invalid-feedback">
                                        Veuillez entrer votre nom.
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Email -->
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="email" class="form-control" id="mail_participant" name="mail_participant" placeholder=" " required>
                                    <label for="mail_participant"><i class="bi bi-envelope me-2"></i>Email</label>
                                    <div class="invalid-feedback">
                                        Veuillez entrer une adresse email valide.
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Type de stationnement -->
                            <div class="col-12">
                             <div class="form-floating">
                                <select class="form-control" name="typeParking" id="typeParking" required>
                                 <option value="VIP">VIP (+5 DT)</option>
                                 <option value="handicape">Place Handicape (+10 DT)</option>
                                 <option value="couverte">Place Couverte (+15 DT)</option>
                                 <option value="electrique">Electrique (+20 DT)</option>
                                </select>
                                <label for="typeParking"><i class="bi bi-car-front me-2"></i>Type de Stationnement</label>
                                <div class="invalid-feedback">
                                  Veuillez sélectionner un type de stationnement.
                                </div>
                              </div>
                           </div>

                            <!-- Numéro de téléphone -->
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="tel" class="form-control" id="numTel_participant" name="numTel_participant" placeholder=" " required>
                                    <label for="numTel_participant"><i class="bi bi-telephone me-2"></i>Numéro de téléphone</label>
                                    <div class="invalid-feedback">
                                        Veuillez entrer votre numéro de téléphone.
                                    </div>
                                </div>
                            </div>

                            <!-- Bouton de soumission -->
                            <div class="col-12 mt-4">
                                <button type="submit" class="btn btn-success btn-lg w-100 py-3">
                                    <i class="bi bi-check-circle me-2"></i>Confirmer la réservation
                                </button>
                            </div>
                            
                            <!-- Assurance (optionnel) -->
                            <div class="col-12 mt-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="termsCheck" required>
                                    <label class="form-check-label small" for="termsCheck">
                                        Je confirme que les informations fournies sont exactes et j'accepte les conditions générales.
                                    </label>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                
                <!-- Pied de carte avec info supplémentaire -->
                <div class="card-footer bg-light">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="text-muted small">
                            <i class="bi bi-info-circle me-1"></i> Vos données sont sécurisées
                        </div>
                        <div>
                            <span class="badge bg-info">
                                <i class="bi bi-shield-lock me-1"></i>SSL Sécurisé
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<style>
    /* Style personnalisé */
    #reservation-form .card {
        border-radius: 15px;
        overflow: hidden;
    }
    
    #reservation-form .form-control, 
    #reservation-form .form-select {
        border-radius: 8px;
        padding: 16px;
        border: 1px solid #dee2e6;
    }
    
    #reservation-form .form-floating>label {
        padding: 1rem 1.25rem;
        color: #6c757d;
    }
    
    #reservation-form .form-control:focus {
        border-color: #86b7fe;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
    }
    
    #reservation-form .btn-success {
        background-color: #28a745;
        border: none;
        font-weight: 600;
        transition: all 0.3s;
    }
    
    #reservation-form .btn-success:hover {
        background-color: #218838;
        transform: translateY(-2px);
    }
</style>

<script>
    async function submitReservation(event) {
  event.preventDefault();
  const form = event.target;
  
  // Validation Bootstrap
  if (!form.checkValidity()) {
    form.classList.add('was-validated');
    return;
  }

  try {
    // Envoi AJAX
    const response = await fetch('submit_reservation.php', {
      method: 'POST',
      body: new FormData(form)
    });
    
    const result = await response.json();
    
    if (result.success) {
      // Afficher le popup
      const modal = new bootstrap.Modal('#confirmationModal');
      modal.show();
      
      // Reset du formulaire
      form.reset();
      form.classList.remove('was-validated');
    } else {
      alert("Erreur: " + result.message);
    }
  } catch (error) {
    console.error('Erreur:', error);
    alert('Une erreur réseau est survenue');
  }
}
</script>

    <!-- Popup de confirmation -->
<div class="modal fade" id="confirmationModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow-lg">
      <div class="modal-header border-0 bg-success text-white">
        <h2 class="modal-title fs-3"><i class="bi bi-check-circle-fill me-2"></i> Réservation Confirmée !</h2>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center p-5">
        <div class="mb-4">
          <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="#28a745" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
          </svg>
        </div>
        <h3 class="h4 mb-3">Merci pour votre réservation !</h3>
        <p class="mb-4">Votre place est confirmée pour l'événement choisi. Un email de confirmation avec tous les détails vous a été envoyé.</p>
        
        <div class="alert alert-info text-start">
          <i class="bi bi-info-circle-fill me-2"></i>
          <strong>Important :</strong> Conservez bien votre email de confirmation, il vous sera demandé à l'entrée de l'événement.
        </div>
        
        <div class="d-flex justify-content-center gap-3 mt-4">
          <a href="evenement.php" class="btn btn-outline-primary px-4">
            <i class="bi bi-calendar-event me-2"></i>Voir d'autres événements
          </a>
          <button type="button" class="btn btn-primary px-4" data-bs-dismiss="modal">
            <i class="bi bi-printer me-2"></i>Imprimer le billet
          </button>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
function showConfirmation(event) {
  event.preventDefault();
  
  // Ici vous devriez envoyer le formulaire via AJAX ou le soumettre normalement
  // Après validation côté serveur, afficher le modal:
  
  var confirmationModal = new bootstrap.Modal(document.getElementById('confirmationModal'));
  confirmationModal.show();
  
  // Optionnel: Reset le formulaire après confirmation
  document.getElementById('reservation-form').reset();
}
</script>

<style>
  .confirmation-animation {
    animation: bounceIn 0.6s;
  }
  
  @keyframes bounceIn {
    0% { transform: scale(0.8); opacity: 0; }
    50% { transform: scale(1.05); }
    100% { transform: scale(1); opacity: 1; }
  }
  
  #confirmationModal .modal-content {
    border-radius: 15px;
    overflow: hidden;
  }
  
  #confirmationModal .modal-header {
    border-top-left-radius: 15px;
    border-top-right-radius: 15px;
  }
  
  #confirmationModal .btn-close {
    font-size: 0.8rem;
  }
</style>
    
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