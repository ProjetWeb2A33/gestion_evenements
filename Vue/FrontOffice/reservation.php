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
:root {
  --primary-color: #0d3f72;       
  --primary-dark: #08284d;        
  --secondary-color: #0a1d37;    
  --accent-color: #3a5cb3;        /* Bleu vif */
  --light-color: #f8fafc;         /* Fond très légèrement bleuté */
  --dark-color: #2d3748;          /* Texte foncé doux */
  --text-color: #4a5568;          /* Texte principal */
  --section-bg: #f5f7fa;          /* Arrière-plan des sections */
  --card-bg: #ffffff;             /* Fond des cartes */
  --border-color: rgba(0,0,0,0.08); /* Bordures subtiles */
  --gradient: linear-gradient(135deg, var(--primary-color) 0%, var(--accent-color) 100%);
}
    
    /* Header & Navigation */
    .header {
      background: rgba(255, 255, 255, 0.98);
      box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
      backdrop-filter: blur(10px);
    }
    
    .sitename {
  font-family: Arial, sans-serif; /* juste changer la police */
  font-weight: 700;
  color: var(--secondary-color);
  background: linear-gradient(135deg, var(--primary-color) 0%, var(--accent-color) 100%);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}

    
    .navmenu ul li a {
      position: relative;
      color: var(--dark-color);
      font-weight: 500;
      transition: all 0.3s ease;
    }
    
    .navmenu ul li a:hover,
    .navmenu ul li a.active {
      color: var(--primary-color);
    }
    
    .navmenu ul li a:after {
      content: '';
      position: absolute;
      bottom: -5px;
      left: 0;
      width: 0;
      height: 2px;
      background: var(--gradient);
      transition: width 0.3s ease;
    }
    
    .navmenu ul li a:hover:after,
    .navmenu ul li a.active:after {
      width: 100%;
    }
    
    .btn-getstarted {
      background: var(--gradient);
      border: none;
      color: white;
      font-weight: 600;
      padding: 10px 25px;
      border-radius: 50px;
      box-shadow: 0 5px 15px rgba(74, 166, 255, 0.4);
      transition: all 0.3s ease;
    }
    
    .btn-getstarted:hover {
      transform: translateY(-3px);
      box-shadow: 0 8px 20px rgba(74, 166, 255, 0.6);
    }
    
    /* Hero Section */
    .page-title {
      position: relative;
      padding: 180px 0 120px;
      background: linear-gradient(rgba(10, 29, 55, 0.85), rgba(10, 29, 55, 0.85)), url('assets/img/55.png') center/cover no-repeat;
      color: white;
      text-align: center;
    }
    
    .page-title h1 {
      font-family: Arial, sans-serif;
      font-size: 3.5rem;
      font-weight: 700;
      margin-bottom: 20px;
      animation: fadeInDown 1s ease;
      text-shadow: 0 2px 10px rgba(0,0,0,0.2);
    }
    
    .page-title p {
      font-size: 1.2rem;
      max-width: 700px;
      margin: 0 auto 30px;
      animation: fadeInUp 1s ease;
      opacity: 0.9;
    }
    /* Dropdown styling */
    .dropdown-menu {
      display: none;
      position: absolute;
      top: 100%;
      left: 0;
      min-width: 220px;
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 15px 30px rgba(0,0,0,0.1);
      padding: 10px 0;
      opacity: 0;
      transform: translateY(10px);
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      z-index: 1000;
      border: none;
    }
  
    .nav-item.dropdown:hover .dropdown-menu {
      display: block;
      opacity: 1;
      transform: translateY(0);
    }
  
    .dropdown-item {
      padding: 12px 25px;
      color: var(--secondary-color) !important;
      text-decoration: none;
      display: flex;
      align-items: center;
      gap: 12px;
      transition: all 0.3s ease;
    }
  
    .dropdown-item:hover {
      background: rgba(13, 63, 114, 0.05);
      padding-left: 30px;
    }
  
    .dropdown-item i {
      color: var(--primary-color);
      font-size: 1.1em;
      width: 24px;
      text-align: center;
    }

/*moi*/
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      background-color: #f4f4f4;
    }
    header {
      background-color:rgb(204, 0, 150);
      color: white;
      padding: 20px;
      text-align: center;
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

<body class="evenement-page">

<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="about.php" class="logo d-flex align-items-center me-auto">
        <h1 class="sitename">EasyParki</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="index.html">Accueil</a></li>
          <li><a href="Stationnement.html">Stationnement</a></li>
          <li><a href="transport public.html">Vacances</a></li>
          <li><a href="Covoiturage.html">Covoiturage</a></li>
          <li><a href="Recharge.html">Service</a></li>
          <li class="dropdown">
             <a href="evenement.php"><span>Événements</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
              <ul>
                <li><a href="evenement.php">Page Événement</a></li>                
                <li><a href="billets.php">Vos Billets</a></li>
                <li><a href="durée.php">Let's Talk!</a></li>
                <li><a href="map.php">Map</a></li>
                <li><a href="points_fidelite.php">Fidelite</a></li>
              </ul>
           </li>
          <li><a href="contact.html">Contact</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      <a class="btn-getstarted" href="get-a-quote.html">Créer un compte</a>

    </div>
  </header>

  <main class="main">

    <!-- Hero Section -->
  <div class="page-title dark-background" data-aos="fade" style="background-image: url(assets/image/evenement.jpg);">
    <div class="container position-relative">
      <h1>Réserver Sans Hésiter</h1>
      <div class="mt-4">
        <a href="index.php" class="btn btn-light btn-lg px-4 me-2">Home</a>
        <a href="evenement.php" class="btn btn-outline-light btn-lg px-4">Evenements</a>
      </div>
    </div>
  </div><!-- End Hero Section -->


  
  <div class="container py-5" id="reservation-form">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-lg">
                <div class="card-header bg-primary text-white py-3">
                    <h2 class="h4 mb-0 text-center"><i class="bi bi-ticket-perforated me-2"></i>Réservation pour <?= htmlspecialchars($event['nomE']) ?></h2>
                </div>
                
                <div class="card-body p-4 p-md-5">
                    <div class="progress mb-4" style="height: 8px;">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 50%;"></div>
                    </div>
                    
                    <form id="reservationForm" method="POST">
                        <input type="hidden" name="idE" value="<?= $event['idE'] ?>">
                        
                        <div class="row g-3">
                            <!-- Prénom -->
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="prenom_participant" name="prenom_participant" placeholder=" ">
                                    <label for="prenom_participant"><i class="bi bi-person me-2"></i>Prénom</label>
                                    <div class="error-message text-danger small mt-1" id="prenom_error"></div>
                                </div>
                            </div>
                            
                            <!-- Nom -->
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="nom_participant" name="nom_participant" placeholder=" ">
                                    <label for="nom_participant"><i class="bi bi-person-vcard me-2"></i>Nom</label>
                                    <div class="error-message text-danger small mt-1" id="nom_error"></div>
                                </div>
                            </div>
                            
                            <!-- Email -->
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="mail_participant" name="mail_participant" placeholder=" ">
                                    <label for="mail_participant"><i class="bi bi-envelope me-2"></i>Email</label>
                                    <div class="error-message text-danger small mt-1" id="email_error"></div>
                                </div>
                            </div>
                            
                            <!-- Téléphone -->
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="numTel_participant" name="numTel_participant" placeholder=" " maxlength="8">
                                    <label for="numTel_participant"><i class="bi bi-telephone me-2"></i>Numéro de téléphone</label>
                                    <div class="error-message text-danger small mt-1" id="telephone_error"></div>
                                </div>
                            </div>
                            
                            <!-- Type de stationnement -->
                            <div class="col-12">
                                <div class="form-floating">
                                    <select class="form-select" id="type_stationnement" name="type_stationnement">
                                        <option value="" selected disabled>Choisir un type</option>
                                        <option value="VIP">VIP</option>
                                        <option value="Handicape">Handicapé</option>
                                        <option value="Couvert">Couvert</option>
                                        <option value="Electrique">Électrique</option>
                                        <option value="Standard">Standard</option>
                                    </select>
                                    <label for="type_stationnement"><i class="bi bi-car-front me-2"></i>Type de stationnement</label>
                                    <div class="error-message text-danger small mt-1" id="error-type_stationnement"></div>
                                </div>
                                <!-- Nouveau div pour l'explication du prix -->
                                <div class="alert alert-info mt-2" id="price-explanation" style="display: none;">
                                    <i class="bi bi-info-circle me-2"></i>
                                    <span id="price-details"></span>
                                </div>
                            </div>

                            <!-- Prix de base caché -->
                            <input type="hidden" id="base_price" value="<?= htmlspecialchars($event['tarification']) ?>">

                            <!-- Bouton de soumission -->
                            <div class="col-12 mt-4">
                                <button type="button" class="btn btn-success btn-lg w-100 py-3" onclick="validateAndSubmit()">
                                    <i class="bi bi-check-circle me-2"></i>Confirmer la réservation
                                </button>
                            </div>
                            
                            <!-- Assurance -->
                            <div class="col-12 mt-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="termsCheck">
                                    <label class="form-check-label small" for="termsCheck">
                                        Je confirme que les informations fournies sont exactes et j'accepte les conditions générales.
                                    </label>
                                    <div class="error-message text-danger small mt-1" id="terms_error"></div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                
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

<!-- Popup de confirmation -->
<div class="modal fade" id="confirmationModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow-lg">
      <div class="modal-header border-0 bg-success text-white">
        <h2 class="modal-title fs-3"><i class="bi bi-check-circle-fill me-2"></i> Réservation Confirmée !</h2>
        <button type="button" class="btn-close btn-close-white" onclick="hideModal()"></button>
      </div>
      <div class="modal-body text-center p-5">
        <div class="mb-4 confirmation-icon">
          <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="#28a745" viewBox="0 0 16 16">
            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
          </svg>
        </div>
        <h3 class="h4 mb-3">Merci pour votre réservation !</h3>
        <p class="mb-4">Votre place est confirmée pour <span id="eventNameConfirm" class="fw-bold"></span>.</p>
        
        <div class="reservation-details mb-4 text-start bg-light p-3 rounded">
          <div class="d-flex justify-content-between mb-2">
            <span class="text-muted">Date:</span>
            <span id="eventDateConfirm" class="fw-bold"></span>
          </div>
          <div class="d-flex justify-content-between">
            <span class="text-muted">Référence:</span>
            <span id="reservationId" class="fw-bold text-success"></span>
          </div>
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
// Contrôle de saisie pour le téléphone (uniquement chiffres)
document.getElementById('numTel_participant').addEventListener('input', function(e) {
    this.value = this.value.replace(/[^\d]/g, '');
});

async function validateAndSubmit() {
    // Réinitialiser les messages d'erreur
    document.querySelectorAll('.error-message').forEach(el => el.textContent = '');
    
    let isValid = true;
    const form = document.getElementById('reservationForm');
    
    // Validation prénom (minimum 3 caractères)
    const prenom = document.getElementById('prenom_participant').value.trim();
    if (prenom === '') {
        document.getElementById('prenom_error').textContent = 'Le prénom est requis';
        isValid = false;
    } else if (prenom.length < 3) {
        document.getElementById('prenom_error').textContent = 'Minimum 3 caractères';
        isValid = false;
    }
    
    // Validation nom (minimum 3 caractères)
    const nom = document.getElementById('nom_participant').value.trim();
    if (nom === '') {
        document.getElementById('nom_error').textContent = 'Le nom est requis';
        isValid = false;
    } else if (nom.length < 3) {
        document.getElementById('nom_error').textContent = 'Minimum 3 caractères';
        isValid = false;
    }
    
    // Validation email
    const email = document.getElementById('mail_participant').value.trim();
    if (email === '') {
        document.getElementById('email_error').textContent = 'L\'email est requis';
        isValid = false;
    } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
        document.getElementById('email_error').textContent = 'Email invalide';
        isValid = false;
    }
    
    // Validation téléphone (exactement 8 chiffres)
    const telephone = document.getElementById('numTel_participant').value.trim();
    if (telephone === '') {
        document.getElementById('telephone_error').textContent = 'Le téléphone est requis';
        isValid = false;
    } else if (!/^\d{8}$/.test(telephone)) {
        document.getElementById('telephone_error').textContent = '8 chiffres requis';
        isValid = false;
    }
    
    // Validation checkbox
    if (!document.getElementById('termsCheck').checked) {
        document.getElementById('terms_error').textContent = 'Vous devez accepter les conditions';
        isValid = false;
    }
    
    if (!isValid) return;

    // Afficher le loader
    const submitBtn = document.querySelector('#reservationForm button[type="button"]');
    const originalBtnText = submitBtn.innerHTML;
    submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Traitement...';
    submitBtn.disabled = true;

    try {
        const response = await fetch('submit_reservation.php', {
            method: 'POST',
            body: new FormData(form)
        });
        
        const result = await response.json();
        
        submitBtn.innerHTML = originalBtnText;
        submitBtn.disabled = false;
        
        if (result.success) {
            // Redirection vers la page de paiement
            window.location.href = result.redirect_url;
        } else {
            alert("Erreur: " + (result.message || 'Erreur lors de la réservation'));
        }
    } catch (error) {
        console.error('Erreur:', error);
        submitBtn.innerHTML = originalBtnText;
        submitBtn.disabled = false;
        alert('Une erreur réseau est survenue');
    }
}

// Gestion du modal
function showModal() {
    const modal = new bootstrap.Modal(document.getElementById('confirmationModal'));
    modal.show();
}

function hideModal() {
    const modal = bootstrap.Modal.getInstance(document.getElementById('confirmationModal'));
    modal.hide();
}

function redirectToEvents() {
    window.location.href = 'evenements.php';
}

function printTicket() {
    // Implémentation de l'impression ici
    alert('Fonctionnalité d\'impression à implémenter');
}

// Ajout de l'écouteur d'événements pour le changement de type de stationnement
document.getElementById('type_stationnement').addEventListener('change', function() {
    const basePrice = parseFloat(document.getElementById('base_price').value);
    const selectedType = this.value;
    const priceExplanation = document.getElementById('price-explanation');
    const priceDetails = document.getElementById('price-details');
    
    // Définition des multiplicateurs et des explications
    const parkingTypes = {
        'VIP': {
            multiplier: 2.0,
            explanation: 'Prix doublé pour un stationnement VIP premium avec service voiturier'
        },
        'Handicape': {
            multiplier: 0.5,
            explanation: '50% de réduction pour les personnes à mobilité réduite'
        },
        'Couvert': {
            multiplier: 1.3,
            explanation: '30% supplémentaire pour un stationnement couvert et protégé'
        },
        'Electrique': {
            multiplier: 1.5,
            explanation: '50% supplémentaire incluant la recharge électrique'
        },
        'Standard': {
            multiplier: 1.0,
            explanation: 'Tarif standard de base'
        }
    };

    if (selectedType && parkingTypes[selectedType]) {
        const finalPrice = basePrice * parkingTypes[selectedType].multiplier;
        priceDetails.innerHTML = `
            <strong>${selectedType}</strong> : ${parkingTypes[selectedType].explanation}<br>
            Prix de base : ${basePrice} DT<br>
            Prix final : <strong>${finalPrice.toFixed(2)} DT</strong>
        `;
        priceExplanation.style.display = 'block';
    } else {
        priceExplanation.style.display = 'none';
    }
});
</script>

<style>
#reservation-form .card {
    border-radius: 15px;
    overflow: hidden;
}

.error-message {
    font-size: 0.85rem;
    margin-top: 0.25rem;
}

.confirmation-icon {
    animation: bounceIn 0.6s;
}

@keyframes bounceIn {
    0% { transform: scale(0.8); opacity: 0; }
    50% { transform: scale(1.05); }
    100% { transform: scale(1); opacity: 1; }
}

.reservation-details {
    border-left: 4px solid #28a745;
    background-color: #f8f9fa;
}

#confirmationModal .modal-header {
    border-top-left-radius: 15px;
    border-top-right-radius: 15px;
    padding: 1.5rem;
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