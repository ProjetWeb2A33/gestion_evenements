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
  <title>EasyParki - Vacances</title>
  <meta name="description" content="Planifiez vos vacances en toute simplicité avec EasyParki">
  <meta name="keywords" content="vacances, hôtels, réservation, voyage, planification">

  <!-- Favicons -->
  <link href="assets/img/logoo.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">

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
            background-color:rgb(15, 46, 79);
        }

        .event-card img {
            width: 100%;
            height: auto;
            border-top: 1px solid #ddd;
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
                <li><a href="option.php">Options Stationnements</a></li>
                <li><a href="billets.php">Acces Aux Detenteurs De Billets</a></li>
                <li><a href="listparticipation.php">Planification Et Ajustement De la Duree Du Stationnement</a></li>
                <li><a href="addparticipation.php">Notifications De Rappel Avant L'evenement</a></li>
                <li><a href="addparticipation.php">Suggestion De Stationnement Proche</a></li>
                <li><a href="addparticipation.php">Espace De Stationnement Pour Food Trucks Et Exposant</a></li>
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
      <h1>Vos Evenements Sur Mesure</h1>
      <p>Facilite l’accès et le stationnement lors d’événements sportifs, concerts, salons, etc.</p>
      <div class="mt-4">
        <a href="index.php" class="btn btn-light btn-lg px-4 me-2">Home</a>
        <a href="evenement.php" class="btn btn-outline-light btn-lg px-4">Evenements</a>
      </div>
    </div>
  </div><!-- End Hero Section -->

    <!-- Featured Services Section -->
    <section id="featured-services" class="featured-services section">

      <div class="container">

        <div class="row gy-4">

            <div class="col-lg-4 col-md-6 service-item d-flex" data-aos="fade-up" data-aos-delay="100">
                <div class="icon flex-shrink-0"><i class="fa-solid fa-car"></i></div>
                <div>
                  <h4 class="title">Accès simplifié</h4>
                  <p class="description">Le module simplifie la gestion du stationnement, permettant aux participants de trouver rapidement une place proche de l'événement et réduisant le stress.</p>
                </div>
            </div>
              <!-- End Service Item -->

             <div class="col-lg-4 col-md-6 service-item d-flex" data-aos="fade-up" data-aos-delay="100">
                <div class="icon flex-shrink-0"><i class="fa-solid fa-ticket"></i></div>
                <div>
                  <h4 class="title">Réservation à l'avance</h4>
                  <p class="description">La réservation à l'avance garantit un emplacement et évite les files d'attente, optimisant la gestion du stationnement.</p>
                </div>
              </div>
              <!-- End Service Item -->  
              <div class="col-lg-4 col-md-6 service-item d-flex" data-aos="fade-up" data-aos-delay="100">
                <div class="icon flex-shrink-0"><i class="fa-solid fa-arrows-spin"></i></div>
                <div>
                  <h4 class="title">Solutions flexibles</h4>
                  <p class="description">Le module offre flexibilité, alternatives proches et notifications pour une expérience fluide.</p>
                </div>
              </div>
              <!-- End Service Item -->   

        </div>

      </div>


      <div class="container mt-5" id="event-list">
    <h2 class="text-center mb-5 fw-bold" style="color: #2c3e50;">Événements Disponibles</h2>
    
    <!-- Barre de recherche ajoutée ici -->
    <div class="row justify-content-center mb-5">
        <div class="col-md-8">
            <div class="input-group input-group-lg shadow-sm rounded-pill">
                <span class="input-group-text bg-white border-end-0"><i class="bi bi-search"></i></span>
                <input type="text" id="eventSearch" class="form-control border-start-0 rounded-pill" placeholder="Rechercher un événement..." aria-label="Rechercher un événement">
                <button class="btn btn-primary rounded-pill px-4" type="button" id="searchBtn" style="background-color: #6a8fc7; border-color: #6a8fc7; color: white;">Rechercher</button>
            </div>
        </div>
    </div>

    <?php
    if ($result->num_rows > 0) {
        echo '<div class="row g-4" id="eventsContainer">';
        while ($event = $result->fetch_assoc()) {
    ?>
            <div class="col-md-6 col-lg-4 event-item">
                <div class="event-card card h-100 shadow-sm border-0 overflow-hidden">
                    <!-- Image de l'événement -->
                    <div class="event-image" style="height: 200px; background: linear-gradient(45deg, #5d8aa8, #3a5169); display: flex; align-items: center; justify-content: center;">
                        <h3 class="text-white text-center p-3 event-name"><?= htmlspecialchars($event['nomE']) ?></h3>
                    </div>
                    
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <span class="badge bg-primary mb-2">Événement</span>
                                <h4 class="card-title mb-1 event-name"><?= htmlspecialchars($event['nomE']) ?></h4>
                            </div>
                            <div class="text-end">
                                <div class="price-tag bg-success text-white p-2 rounded">
                                    <span class="h5 mb-0"><?= htmlspecialchars($event['tarification']) ?> DT</span>
                                </div>
                                <!-- Bouton Like -->
                                <button class="btn-like border-0 bg-transparent" data-event-id="<?= $event['idE'] ?>">
                                  <i class="bi bi-heart fs-4 text-danger"></i> 
                                  <span class="like-count">0</span>
                                </button>
                            </div>
                        </div>
                        
                        <div class="event-meta mb-3">
                            <p class="mb-2"><i class="bi bi-calendar-event me-2"></i> <?= htmlspecialchars($event['date']) ?></p>
                            <p class="mb-0"><i class="bi bi-geo-alt me-2"></i> <?= htmlspecialchars($event['lieu']) ?></p>
                        </div>
                        
                        <div class="d-grid">
                          <a href="reservation.php?id=<?= $event['idE'] ?>" 
                           class="btn btn-primary btn-lg rounded-pill"style="background-color: #a8d8b9; border-color: #a8d8b9; color: #1a3e29;">Réserver maintenant <i class="bi bi-arrow-right ms-2"></i>
                          </a>
                       </div>
                    </div>
                </div>
            </div>
    <?php
        }
        echo '</div>';
    } else {
        echo '<div class="alert alert-info text-center">Aucun événement disponible pour le moment.</div>';
    }
    ?>
</div>

<!-- Ajout du script de recherche -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('eventSearch');
    const searchBtn = document.getElementById('searchBtn');
    const eventItems = document.querySelectorAll('.event-item');
    const eventsContainer = document.getElementById('eventsContainer');
    
    function performSearch() {
        const searchTerm = searchInput.value.toLowerCase().trim();
        let hasResults = false;
        
        eventItems.forEach(item => {
            const eventName = item.querySelector('.event-name').textContent.toLowerCase();
            if (eventName.includes(searchTerm)) {
                item.style.display = 'block';
                hasResults = true;
            } else {
                item.style.display = 'none';
            }
        });
        
        // Afficher un message si aucun résultat
        if (!hasResults && searchTerm !== '') {
            eventsContainer.innerHTML = `
                <div class="col-12 text-center py-5">
                    <i class="bi bi-exclamation-circle display-4 text-muted mb-3"></i>
                    <h3 class="text-muted">Aucun événement trouvé</h3>
                    <p class="text-muted">Essayez avec d'autres termes de recherche</p>
                </div>
            `;
        }
    }
    
    // Écouteurs d'événements
    searchBtn.addEventListener('click', performSearch);
    searchInput.addEventListener('keyup', function(e) {
        if (e.key === 'Enter') {
            performSearch();
        }
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const likeButtons = document.querySelectorAll('.btn-like');

    likeButtons.forEach(button => {
        button.addEventListener('click', function() {
            const icon = button.querySelector('i');
            const countSpan = button.querySelector('.like-count');
            let currentCount = parseInt(countSpan.textContent, 10);

            if (button.classList.contains('liked')) {
                // Déjà liké → annuler le like
                button.classList.remove('liked');
                icon.classList.replace('bi-heart-fill', 'bi-heart');
                countSpan.textContent = currentCount - 1;
            } else {
                // Pas encore liké → ajouter like
                button.classList.add('liked');
                icon.classList.replace('bi-heart', 'bi-heart-fill');
                countSpan.textContent = currentCount + 1;
            }
        });
    });
});
</script>

<style>

    .btn-like {
      cursor: pointer;
      display: flex;
      align-items: center;
      gap: 5px;
    }
    .btn-like .bi-heart-fill {
      color: red;
      transition: transform 0.3s;
    }
    .btn-like.liked .bi-heart {
      display: none;
    }
    .btn-like.liked .bi-heart-fill {
      display: inline-block;
      transform: scale(1.2);
    }
    .btn-like .bi-heart-fill {
      display: none;
    }
    /* Styles existants */
    .event-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border-radius: 15px !important;
        overflow: hidden;
    }
    
    .event-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1) !important;
    }
    
    .price-tag {
        font-weight: bold;
        min-width: 80px;
        display: inline-block;
    }
    
    .event-meta {
        background-color: #f8f9fa;
        padding: 12px;
        border-radius: 10px;
    }
    
    /* Nouveaux styles pour la recherche */
    .input-group-text {
        background-color: transparent;
    }
    
    #eventSearch:focus {
        box-shadow: none;
        border-color: #ced4da;
    }
</style>
    </section><!-- /Featured Services Section -->

    <!-- Services Section -->
    <section id="services" class="services section">

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