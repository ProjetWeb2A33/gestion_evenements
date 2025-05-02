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

          <li><a href="covoiturage.php">Covoiturage</a></li>
          <li><a href="contact.php">Contact</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>
      <a class="btn-getstarted" href="creercompte.php">Créer un compte</a>

    </div>
  </header>

  <main class="main">

    <!-- Page Title -->
    <div class="page-title dark-background" data-aos="fade" style="background-image: url(assets/img/page-title-bg.jpg);">
      <div class="container position-relative">
        <h1>Evenement</h1>
        <p>Facilite l’accès et le stationnement lors d’événements sportifs, concerts, salons, etc.</p>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="index.php">Home</a></li>
            <li class="current">Evenement</li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->

    <!-- Featured Services Section -->
    <section id="featured-services" class="featured-services section py-5">

  <div class="container">
    <div class="row gy-4 justify-content-center">
      
      <div class="col-lg-4 col-md-6 service-item d-flex flex-column align-items-center" data-aos="fade-up" data-aos-delay="100">
        <div class="service-icon-container d-flex align-items-center justify-content-center rounded-circle shadow-lg mb-3" style="width: 60px; height: 60px;">
          <i class="fa-solid fa-arrows-spin fs-4 text-primary"></i>
        </div>
        <div class="text-center">
          <h4 class="title text-dark mb-3">Solutions Flexibles</h4>
          <p class="description text-muted" style="font-size: 1.1rem; line-height: 1.6;">Cette page de réservation vous permet de choisir parmi plusieurs types de stationnement adaptés à vos besoins : VIP, handicapé, électrique ou couvert. Chaque option a des avantages uniques pour garantir votre confort et faciliter l'accès à l'événement.</p>
        </div>
      </div>
      <!-- End Service Item -->   

    </div>
  </div>

</section>

      <div class="container mt-5" id="event-list">
    <h2 class="text-center mb-5 fw-bold" style="color: #2c3e50;">Événements Disponibles</h2>
    
    <!-- Barre de recherche ajoutée ici -->
    <div class="row justify-content-center mb-5">
        <div class="col-md-8">
            <div class="input-group input-group-lg shadow-sm rounded-pill">
                <span class="input-group-text bg-white border-end-0"><i class="bi bi-search"></i></span>
                <input type="text" id="eventSearch" class="form-control border-start-0 rounded-pill" placeholder="Rechercher un événement..." aria-label="Rechercher un événement">
                <button class="btn btn-primary rounded-pill px-4" type="button" id="searchBtn">Rechercher</button>
            </div>
        </div>
    </div>
    <?php
    if ($result->num_rows > 0) {
        echo '<div class="row g-4" id="eventsContainer">';
        while ($event = $result->fetch_assoc()) {
    ?>
            <div class="col-md-6 col-lg-4 event-item" data-type="<?= htmlspecialchars($event['typeParking']) ?>">
                <div class="event-card card h-100 shadow-sm border-0 overflow-hidden">
                    <!-- Image de l'événement -->
                    <div class="event-image" style="height: 200px; background: linear-gradient(45deg, #3498db, #2ecc71); display: flex; align-items: center; justify-content: center;">
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
                            <a href="reservationOption.php?id=<?= $event['idE'] ?>" class="btn btn-primary btn-lg rounded-pill">
                                Réserver maintenant <i class="bi bi-arrow-right ms-2"></i>
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

<!-- Ajout du script de recherche et de filtrage -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('eventSearch');
    const searchBtn = document.getElementById('searchBtn');
    const typeParkingSelect = document.getElementById('typeParkingSelect');
    const filterBtn = document.getElementById('filterBtn');
    const eventItems = document.querySelectorAll('.event-item');
    const eventsContainer = document.getElementById('eventsContainer');
    
    function performSearchAndFilter() {
        const searchTerm = searchInput.value.toLowerCase().trim();
        const selectedType = typeParkingSelect.value;
        let hasResults = false;

        eventItems.forEach(item => {
            const eventName = item.querySelector('.event-name').textContent.toLowerCase();
            const eventType = item.getAttribute('data-type');

            // Vérifie si le nom de l'événement et le type de stationnement correspondent
            if (
                eventName.includes(searchTerm) &&
                (selectedType === "" || eventType === selectedType)
            ) {
                item.style.display = 'block';
                hasResults = true;
            } else {
                item.style.display = 'none';
            }
        });

        // Afficher un message si aucun résultat
        if (!hasResults && searchTerm !== '' && selectedType !== '') {
            eventsContainer.innerHTML = `
                <div class="col-12 text-center py-5">
                    <i class="bi bi-exclamation-circle display-4 text-muted mb-3"></i>
                    <h3 class="text-muted">Aucun événement trouvé</h3>
                    <p class="text-muted">Essayez avec d'autres termes de recherche ou un autre type de stationnement</p>
                </div>
            `;
        }
    }
    
    // Écouteurs d'événements
    searchBtn.addEventListener('click', performSearchAndFilter);
    filterBtn.addEventListener('click', performSearchAndFilter);
    searchInput.addEventListener('keyup', function(e) {
        if (e.key === 'Enter') {
            performSearchAndFilter();
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