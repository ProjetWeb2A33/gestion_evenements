<?php
// Connexion à la base de données
$servername = "localhost";  // Remplace par ton serveur
$username = "root";         // Remplace par ton nom d'utilisateur
$password = "";             // Remplace par ton mot de passe
$dbname = "gestion_evenements";   // Remplace par le nom de ta base de données

$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("La connexion a échoué: " . $conn->connect_error);
}

// Requête pour récupérer les événements
$sql = "SELECT * FROM evenement";
$result = $conn->query($sql);
?>


<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Evenement - Template</title>
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
     .card {
      width: 100%;
      aspect-ratio: 1 / 1; /* Rend le cadre parfaitement carré */
      padding: 15px;
      box-sizing: border-box;
      background-color: #fff;
      border: 1px solid #ccc;
      border-radius: 10px;
      overflow: hidden;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      transition: transform 0.3s ease;
    }

    .event-card {
            display: flex;
            flex-direction: column;
            border: 1px solid #ddd;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .event-details {
            padding: 20px;
        }

        .event-details h3 {
            font-size: 1.5rem;
            color: #333;
        }

        .event-details p {
            color: #666;
        }

        .event-details a {
            margin-top: 10px;
            text-align: center;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border-radius: 5px;
            text-decoration: none;
        }

        .event-details a:hover {
            background-color: #0056b3;
        }

        .event-card img {
            width: 100%;
            height: auto;
            border-top: 1px solid #ddd;
        }
  </style>
</head>

<body class="services-page">

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
      <h1>Obtenez Vos Billets!</h1>
      <p>Réservez vos billets en un clic et vivez l’événement sans attendre !</p>
      <div class="mt-4">
        <a href="index.php" class="btn btn-light btn-lg px-4 me-2">Home</a>
        <a href="evenement.php" class="btn btn-outline-light btn-lg px-4">Evenements</a>
      </div>
    </div>
  </div><!-- End Hero Section -->

    <!-- Services Section -->
    <section id="services" class="services section">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-8">
            <div class="card shadow">
              <div class="card-header bg-primary text-white">
                <h3 class="card-title mb-0">Accès au stationnement</h3>
              </div>
              <div class="card-body">
                <form id="accessForm" class="needs-validation" novalidate>
                  <div class="mb-3">
                    <label for="email" class="form-label">Email de réservation</label>
                    <input type="email" class="form-control" id="email" required>
                    <div class="invalid-feedback">
                      Veuillez entrer votre email de réservation.
                    </div>
                  </div>
                  <div class="mb-3">
                    <label for="telephone" class="form-label">Numéro de téléphone</label>
                    <input type="tel" class="form-control" id="telephone" maxlength="8" required>
                    <div class="invalid-feedback">
                      Veuillez entrer votre numéro de téléphone (8 chiffres).
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary w-100">
                    Générer mon QR Code d'accès
                  </button>
                </form>

                <div id="qrResult" class="mt-4 text-center" style="display: none;">
                  <div class="alert alert-success">
                    <h4 class="alert-heading">Votre QR Code est prêt !</h4>
                    <p>Présentez ce QR Code à l'entrée du parking pour accéder à votre place.</p>
                  </div>
                  <div id="qrcode" class="mb-3"></div>
                  <button class="btn btn-secondary mt-3" onclick="window.print()">
                    <i class="bi bi-printer"></i> Imprimer le QR Code
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Ajout de la bibliothèque QR Code -->
    <script src="https://cdn.jsdelivr.net/npm/qrcode-generator@1.4.4/qrcode.min.js"></script>
    
    <script>
    // Contrôle de saisie pour le téléphone (uniquement chiffres)
    document.getElementById('telephone').addEventListener('input', function(e) {
        this.value = this.value.replace(/[^\d]/g, '');
    });

    document.getElementById('accessForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const email = document.getElementById('email').value;
        const telephone = document.getElementById('telephone').value;
        
        // Vérification de base des entrées
        if (!email || !telephone) {
            alert('Veuillez remplir tous les champs');
            return;
        }

        // Vérification du format du numéro de téléphone
        if (!/^\d{8}$/.test(telephone)) {
            alert('Le numéro de téléphone doit contenir exactement 8 chiffres');
            return;
        }

        // Création du contenu du QR code au format vCard
        const currentDate = new Date().toLocaleString('fr-FR');
        const qrContent = `BEGIN:VCARD
VERSION:3.0
FN:Réservation EasyParki
EMAIL:${email}
TEL:${telephone}
NOTE:Réservation validée le ${currentDate}
STATUS:CONFIRMED
END:VCARD`;
        
        // Génération du QR Code
        const qr = qrcode(0, 'M');
        qr.addData(qrContent);
        qr.make();

        // Affichage du QR Code
        const qrDiv = document.getElementById('qrcode');
        qrDiv.innerHTML = qr.createImgTag(5, 10);
        
        // Affichage du conteneur de résultat
        const qrResult = document.getElementById('qrResult');
        qrResult.style.display = 'block';
        
        // Ajout des détails de la réservation
        const detailsDiv = document.createElement('div');
        detailsDiv.className = 'mt-3 alert alert-success';
        detailsDiv.innerHTML = `
            <h4>Détails de votre réservation :</h4>
            <p><strong>Email :</strong> ${email}</p>
            <p><strong>Téléphone :</strong> ${telephone}</p>
            <p><strong>Date de validation :</strong> ${currentDate}</p>
            <p><strong>Statut :</strong> Confirmé ✅</p>
        `;
        qrDiv.appendChild(detailsDiv);

        // Ajout du bouton de téléchargement
        const downloadBtn = document.createElement('button');
        downloadBtn.className = 'btn btn-primary mt-3';
        downloadBtn.innerHTML = '<i class="bi bi-download"></i> Télécharger le QR Code';
        downloadBtn.onclick = function() {
            const canvas = qrDiv.querySelector('img');
            const link = document.createElement('a');
            link.download = 'reservation-qr-code.png';
            link.href = canvas.src;
            link.click();
        };
        qrDiv.appendChild(downloadBtn);

        // Scroll vers le QR Code
        qrDiv.scrollIntoView({ behavior: 'smooth' });
    });
    </script>

    <!-- Testimonials Section -->
    <section id="testimonials" class="testimonials section dark-background">

      <img src="assets/image/bg.jpg" class="testimonials-bg" alt="">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="swiper init-swiper">
          <script type="application/json" class="swiper-config">
            {
              "loop": true,
              "speed": 600,
              "autoplay": {
                "delay": 5000
              },
              "slidesPerView": "auto",
              "pagination": {
                "el": ".swiper-pagination",
                "type": "bullets",
                "clickable": true
              }
            }
          </script>
          <div class="swiper-wrapper">

            <div class="swiper-slide">
              <div class="testimonial-item">
                <img src="assets/img/testimonials/testimonials-1.jpg" class="testimonial-img" alt="">
                <h3>Saul Goodman</h3>
                <h4>Ceo &amp; Founder</h4>
                <div class="stars">
                  <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                </div>
                <p>
                  <i class="bi bi-quote quote-icon-left"></i>
                  <span>Une solution de stationnement intelligente et pratique qui rend chaque événement beaucoup plus agréable !</span>
                  <i class="bi bi-quote quote-icon-right"></i>
                </p>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-item">
                <img src="assets/img/testimonials/testimonials-2.jpg" class="testimonial-img" alt="">
                <h3>Sara Wilsson</h3>
                <h4>Designer</h4>
                <div class="stars">
                  <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                </div>
                <p>
                  <i class="bi bi-quote quote-icon-left"></i>
                  <span>Grâce à EasyParki, plus de stress pour trouver une place ! Réservation rapide et gestion facile des places.</span>
                  <i class="bi bi-quote quote-icon-right"></i>
                </p>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-item">
                <img src="assets/img/testimonials/testimonials-3.jpg" class="testimonial-img" alt="">
                <h3>Jena Karlis</h3>
                <h4>Store Owner</h4>
                <div class="stars">
                  <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                </div>
                <p>
                  <i class="bi bi-quote quote-icon-left"></i>
                  <span>Un véritable gain de temps ! Réserver à l'avance et ajuster la durée de stationnement en temps réel est une fonctionnalité incontournable.</span>
                  <i class="bi bi-quote quote-icon-right"></i>
                </p>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-item">
                <img src="assets/img/testimonials/testimonials-4.jpg" class="testimonial-img" alt="">
                <h3>Matt Brandon</h3>
                <h4>Freelancer</h4>
                <div class="stars">
                  <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                </div>
                <p>
                  <i class="bi bi-quote quote-icon-left"></i>
                  <span>Les alternatives de stationnement proches en cas de pleine capacité sont un vrai plus. Une expérience sans accroc.</span>
                  <i class="bi bi-quote quote-icon-right"></i>
                </p>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-item">
                <img src="assets/img/testimonials/testimonials-5.jpg" class="testimonial-img" alt="">
                <h3>John Larson</h3>
                <h4>Entrepreneur</h4>
                <div class="stars">
                  <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                </div>
                <p>
                  <i class="bi bi-quote quote-icon-left"></i>
                  <span>Un service efficace et flexible qui rend la gestion du stationnement pendant les événements bien plus fluide.</span>
                  <i class="bi bi-quote quote-icon-right"></i>
                </p>
              </div>
            </div><!-- End testimonial item -->

          </div>
          <div class="swiper-pagination"></div>
        </div>

      </div>

    </section><!-- /Testimonials Section -->

    <!-- Faq Section -->
    <section id="faq" class="faq section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <span>Questions Fréquentes</span>
        <h2>Questions Fréquentes</h2>
        <p>"Des questions sur le stationnement pour vos événements ? Découvrez nos réponses rapides pour une expérience de stationnement fluide et sans stress !"</p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row justify-content-center">

          <div class="col-lg-10">

            <div class="faq-container">

              <div class="faq-item faq-active" data-aos="fade-up" data-aos-delay="200">
                <i class="faq-icon bi bi-question-circle"></i>
                <h3>Comment puis-je réserver une place de stationnement pour un événement ?</h3>
                <div class="faq-content">
                  <p>Vous pouvez réserver une place de stationnement directement sur notre plateforme en ligne. Sélectionnez l'événement auquel vous souhaitez assister, choisissez votre emplacement et effectuez votre réservation en quelques clics.</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div><!-- End Faq item-->

              <div class="faq-item" data-aos="fade-up" data-aos-delay="300">
                <i class="faq-icon bi bi-question-circle"></i>
                <h3> Puis-je modifier ma réservation après l'avoir confirmée ?</h3>
                <div class="faq-content">
                  <p>Oui, vous pouvez ajuster la durée de votre stationnement ou modifier votre réservation en temps réel, selon la disponibilité des places. Vous recevrez une confirmation instantanée de toute modification.</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div><!-- End Faq item-->

              <div class="faq-item" data-aos="fade-up" data-aos-delay="400">
                <i class="faq-icon bi bi-question-circle"></i>
                <h3>Que faire si le stationnement réservé est complet ?</h3>
                <div class="faq-content">
                  <p>Si le stationnement réservé est complet, le module vous proposera des alternatives proches avec des informations sur la distance et le temps de trajet à pied jusqu'à l'événement.</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div><!-- End Faq item-->

              <div class="faq-item" data-aos="fade-up" data-aos-delay="500">
                <i class="faq-icon bi bi-question-circle"></i>
                <h3> Le service de stationnement est-il disponible pour tous les types d'événements ?</h3>
                <div class="faq-content">
                  <p>Oui, le module EasyParki est conçu pour fonctionner avec une variété d'événements, y compris les concerts, les compétitions sportives, les salons et autres événements de grande envergure.</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div><!-- End Faq item-->

              <div class="faq-item" data-aos="fade-up" data-aos-delay="600">
                <i class="faq-icon bi bi-question-circle"></i>
                <h3>Est-ce que le stationnement est garanti même si j'arrive en retard ?</h3>
                <div class="faq-content">
                  <p>Oui, une fois votre réservation confirmée, votre place de stationnement est garantie, peu importe votre heure d'arrivée. Vous pouvez également ajuster la durée de stationnement si nécessaire.</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div><!-- End Faq item-->

            </div>

          </div>

        </div>

      </div>

    </section><!-- /Faq Section -->

  </main>

  <footer id="footer" class="footer dark-background">

    <div class="container footer-top">
      <div class="row gy-4">
        <div class="col-lg-5 col-md-12 footer-about">
          <a href="index.html" class="logo d-flex align-items-center">
            <span class="sitename">EasyParki</span>
          </a>
          <p>EasyParki simplifie le stationnement avec paiement en ligne, gestion à distance et optimisation des places, améliorant ainsi la mobilité urbaine.</p>
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
            <li><a href="#">Stationnement</a></li>
            <li><a href="#">Service</a></li>
            <li><a href="#">Vacance</a></li>
            <li><a href="#">Evenement</a></li>
            <li><a href="#">Covoiturage</a></li>
            <li><a href="#">Contact</a></li>
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
          <p>La gazelle</p>
          <p>Marsa</p>
          <p>Sidi Bou Said</p>
          <p class="mt-4"><strong>Phone:</strong> <span>+1 5589 55488 55</span></p>
          <p><strong>Email:</strong> <span>EasyParki@gmail.com</span></p>
        </div>

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