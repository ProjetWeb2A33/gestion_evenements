<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Service Details - Logis Bootstrap Template</title>
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
      font-family: Arial, sans-serif;
      font-weight: 700;
      color: var(--secondary-color);
      background: linear-gradient(135deg, var(--primary-color) 0%, var(--accent-color) 100%);
      background-clip: text;
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
  </style>
</head>

<body class="service-details-page">

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
      <h1>Discutez Avec Nous!</h1>
      <p>Une question ? Notre assistant virtuel est là pour vous aider 24h/24, en toute simplicité !</p>
      <div class="mt-4">
        <a href="index.php" class="btn btn-light btn-lg px-4 me-2">Home</a>
        <a href="evenement.php" class="btn btn-outline-light btn-lg px-4">Evenements</a>
      </div>
    </div>
  </div><!-- End Hero Section -->
    <!-- Chat Section -->
    <section id="chat-section" class="section">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-8">
            <div class="card shadow-lg border-0">
              <div class="card-header bg-primary text-white p-3">
                <div class="d-flex align-items-center">
                  <i class="bi bi-robot fs-4 me-2"></i>
                  <div>
                    <h5 class="mb-0">Assistant EasyParki</h5>
                    <small>En ligne</small>
                  </div>
                </div>
              </div>
              
              <div class="card-body p-4">
                <!-- Chat Messages Container -->
                <div id="chat-messages" class="chat-messages mb-4" style="height: 400px; overflow-y: auto;">
                  <!-- Messages will be added here dynamically -->
                </div>

                <!-- Chat Input -->
                <form id="chat-form" class="chat-input">
                  <div class="input-group">
                    <input type="text" id="user-input" class="form-control" placeholder="Tapez votre message ici..." required>
                    <button class="btn btn-primary" type="submit">
                      <i class="bi bi-send"></i>
                    </button>
                  </div>
                </form>
              </div>
            </div>

            <!-- Suggestions de questions -->
            <div class="suggestions mt-4">
              <h6 class="text-muted mb-3">Questions fréquentes :</h6>
              <div class="d-flex flex-wrap gap-2">
                <button class="btn btn-outline-primary btn-sm suggestion">Comment acheter et utiliser mes billets ?</button>
                <button class="btn btn-outline-primary btn-sm suggestion">Politique d'annulation et remboursement ?</button>
                <button class="btn btn-outline-primary btn-sm suggestion">Moyens de paiement et tarifs ?</button>
                <button class="btn btn-outline-primary btn-sm suggestion">Mesures de sécurité ?</button>
                <button class="btn btn-outline-primary btn-sm suggestion">Comment accéder au parking ?</button>
                <button class="btn btn-outline-primary btn-sm suggestion">Réserver une place couverte ?</button>
                <button class="btn btn-outline-primary btn-sm suggestion">Places PMR et accompagnement ?</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

  <style>
    .chat-messages {
      scroll-behavior: smooth;
    }
    
    .message {
      max-width: 80%;
      margin-bottom: 1rem;
      padding: 1rem;
      border-radius: 15px;
      position: relative;
    }

    .message.bot {
      background-color: #f8f9fa;
      margin-right: auto;
      border-bottom-left-radius: 5px;
    }

    .message.user {
      background-color: #007bff;
      color: white;
      margin-left: auto;
      border-bottom-right-radius: 5px;
    }

    .message.typing {
      background-color: #f8f9fa;
      margin-right: auto;
      border-bottom-left-radius: 5px;
      display: flex;
      align-items: center;
      padding: 0.5rem 1rem;
    }

    .typing-dots {
      display: flex;
      gap: 0.3rem;
    }

    .typing-dots span {
      width: 8px;
      height: 8px;
      background-color: #adb5bd;
      border-radius: 50%;
      animation: typing 1s infinite ease-in-out;
    }

    .typing-dots span:nth-child(1) { animation-delay: 0.1s; }
    .typing-dots span:nth-child(2) { animation-delay: 0.2s; }
    .typing-dots span:nth-child(3) { animation-delay: 0.3s; }

    @keyframes typing {
      0%, 100% { transform: translateY(0); }
      50% { transform: translateY(-5px); }
    }

    .chat-input .form-control {
      border-radius: 20px;
      padding-right: 50px;
    }

    .chat-input .btn {
      border-radius: 20px;
      margin-left: -1px;
    }

    .suggestions .btn {
      border-radius: 20px;
      margin: 0.25rem;
    }
  </style>

  <footer id="footer" class="footer dark-background">

    <div class="container footer-top">
      <div class="row gy-4">
        <div class="col-lg-5 col-md-12 footer-about">
          <a href="index.html" class="logo d-flex align-items-center">
            <span class="sitename">Logis</span>
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
    </div>

    <div class="container copyright text-center mt-4">
      <p>© <span>Copyright</span> <strong class="px-1 sitename">Logis</strong> <span>All Rights Reserved</span></p>
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

  <script>
    // Configuration des réponses du chatbot
    const botResponses = {
      'default': "Je ne suis pas sûr de comprendre. Pouvez-vous reformuler votre question ou choisir une des questions suggérées ?",
      
      'greeting': [
        "Bonjour ! Je suis là pour vous aider avec la réservation et l'accès à votre stationnement. Que puis-je faire pour vous ?",
        "Bienvenue ! Comment puis-je vous assister aujourd'hui avec votre stationnement ?"
      ],

      'billets': [
        "Pour acheter vos billets : 1) Sélectionnez l'événement sur notre plateforme 2) Choisissez votre place de stationnement 3) Procédez au paiement 4) Vous recevrez un QR code par email 5) Présentez ce QR code à l'entrée du parking le jour J",
        "Après l'achat, vous recevrez une confirmation par email avec un QR code unique. C'est votre ticket d'accès au parking. Conservez-le précieusement !",
        "Vous pouvez également retrouver vos billets dans votre espace personnel sur notre site ou application mobile."
      ],

      'annulation': [
        "Notre politique d'annulation vous permet d'être remboursé à 100% jusqu'à 24h avant l'événement. Entre 24h et 2h avant, remboursement à 50%.",
        "Pour annuler, connectez-vous à votre compte et allez dans 'Mes réservations' puis cliquez sur 'Annuler'. Le remboursement est automatique selon les délais.",
        "En cas d'annulation de l'événement par l'organisateur, vous êtes automatiquement remboursé à 100%."
      ],

      'paiement': [
        "Nous acceptons : cartes bancaires, PayPal, Apple Pay et Google Pay. Les tarifs sont calculés selon la durée et le type de place (couverte, non couverte, PMR).",
        "Le tarif de base est de 5 DT/heure en semaine et 7 DT/heure le weekend. Les places couvertes ont un supplément de 2 DT/heure.",
        "Des forfaits sont disponibles pour les longues durées : -20% pour 4h et plus, -30% pour la journée complète."
      ],

      'securite': [
        "Nos parkings sont équipés de : caméras de surveillance 24/7, éclairage LED intelligent, agents de sécurité sur place, bornes d'appel d'urgence tous les 50 mètres.",
        "Un système de contrôle d'accès par QR code et vidéosurveillance assure que seuls les véhicules autorisés peuvent entrer.",
        "En cas d'urgence, des boutons d'alarme sont disponibles et notre équipe de sécurité intervient en moins de 3 minutes."
      ],

      'acces': [
        "Pour accéder au parking : 1) Suivez les panneaux 'EasyParki' 2) À l'entrée, scannez votre QR code sur la borne 3) Le système vous guide vers votre place avec des LED au sol",
        "En cas de problème : Utilisez les bornes d'appel d'urgence ou contactez notre assistance 24/7 au 71 000 000",
        "Notre équipe sur place est disponible pour vous aider à trouver votre place ou résoudre tout problème technique."
      ],

      'couverte': [
        "Les places couvertes offrent une protection optimale contre les intempéries. Tarif : +2 DT/heure par rapport au tarif de base.",
        "Pour réserver : Sélectionnez 'Place couverte' lors de votre réservation. Ces places sont situées aux niveaux -1 et -2.",
        "Les places couvertes comprennent : éclairage renforcé, protection contre la pluie et le soleil, proximité des ascenseurs."
      ],

      'pmr': [
        "Les places PMR sont situées au plus près des entrées/sorties et des ascenseurs. Largeur garantie de 3,3 mètres.",
        "Services d'accompagnement disponibles : assistance pour le stationnement, aide au transport des bagages, fauteuil roulant sur demande.",
        "Pour réserver : Sélectionnez 'Place PMR' et ajoutez les services d'accompagnement souhaités. Un justificatif sera demandé à l'entrée."
      ]
    };

    // Fonction pour ajouter un message au chat
    function addMessage(content, isUser = false) {
      const messagesContainer = document.getElementById('chat-messages');
      const messageDiv = document.createElement('div');
      messageDiv.className = `message ${isUser ? 'user' : 'bot'}`;
      messageDiv.textContent = content;
      messagesContainer.appendChild(messageDiv);
      messagesContainer.scrollTop = messagesContainer.scrollHeight;
    }

    // Fonction pour afficher l'animation de typing
    function showTyping() {
      const messagesContainer = document.getElementById('chat-messages');
      const typingDiv = document.createElement('div');
      typingDiv.className = 'message typing';
      typingDiv.innerHTML = `
        <div class="typing-dots">
          <span></span>
          <span></span>
          <span></span>
        </div>
      `;
      messagesContainer.appendChild(typingDiv);
      messagesContainer.scrollTop = messagesContainer.scrollHeight;
      return typingDiv;
    }

    // Fonction pour obtenir une réponse du bot
    function getBotResponse(input) {
      input = input.toLowerCase();
      
      if (input.includes('bonjour') || input.includes('salut') || input.includes('hello')) {
        return botResponses.greeting[Math.floor(Math.random() * botResponses.greeting.length)];
      }
      if (input.includes('billet') || input.includes('ticket') || input.includes('acheter')) {
        return botResponses.billets[Math.floor(Math.random() * botResponses.billets.length)];
      }
      if (input.includes('annul') || input.includes('rembours')) {
        return botResponses.annulation[Math.floor(Math.random() * botResponses.annulation.length)];
      }
      if (input.includes('paiement') || input.includes('tarif') || input.includes('prix')) {
        return botResponses.paiement[Math.floor(Math.random() * botResponses.paiement.length)];
      }
      if (input.includes('sécurité') || input.includes('surveillance')) {
        return botResponses.securite[Math.floor(Math.random() * botResponses.securite.length)];
      }
      if (input.includes('accès') || input.includes('entrer') || input.includes('problème')) {
        return botResponses.acces[Math.floor(Math.random() * botResponses.acces.length)];
      }
      if (input.includes('couvert') || input.includes('protégé')) {
        return botResponses.couverte[Math.floor(Math.random() * botResponses.couverte.length)];
      }
      if (input.includes('pmr') || input.includes('handicap') || input.includes('mobilité')) {
        return botResponses.pmr[Math.floor(Math.random() * botResponses.pmr.length)];
      }
      
      return botResponses.default;
    }

    // Gestionnaire de soumission du formulaire
    document.getElementById('chat-form').addEventListener('submit', function(e) {
      e.preventDefault();
      const input = document.getElementById('user-input');
      const message = input.value.trim();
      
      if (message) {
        // Ajouter le message de l'utilisateur
        addMessage(message, true);
        input.value = '';

        // Afficher l'animation de typing
        const typingDiv = showTyping();

        // Simuler un délai de réponse
        setTimeout(() => {
          // Supprimer l'animation de typing
          typingDiv.remove();
          
          // Ajouter la réponse du bot
          const response = getBotResponse(message);
          addMessage(response);
        }, 1000);
      }
    });

    // Gestionnaire pour les suggestions de questions
    document.querySelectorAll('.suggestion').forEach(button => {
      button.addEventListener('click', function() {
        const question = this.textContent;
        document.getElementById('user-input').value = question;
        document.getElementById('chat-form').dispatchEvent(new Event('submit'));
      });
    });

    // Message de bienvenue au chargement
    window.addEventListener('load', function() {
      setTimeout(() => {
        addMessage("Bonjour ! Je suis l'assistant EasyParki. Comment puis-je vous aider avec votre stationnement aujourd'hui ?");
      }, 500);
    });
  </script>

</body>

</html>