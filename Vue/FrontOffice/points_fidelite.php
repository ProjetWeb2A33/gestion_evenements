<?php
session_start();
require_once '../../config/config.php';
require_once '../../Model/participation.php';
require_once '../../Controller/participationP.php';

$participationC = new ParticipationP();

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        try {
            // Récupérer toutes les participations de l'utilisateur
            $db = config::getConnexion();
            $query = $db->prepare("SELECT p.*, e.nomE, e.tarification 
                                 FROM participation p 
                                 JOIN evenement e ON p.idE = e.idE 
                                 WHERE p.mail_participant = ?");
            $query->execute([$email]);
            $participations = $query->fetchAll(PDO::FETCH_ASSOC);
            
            $totalPoints = 0;
            foreach ($participations as $participation) {
                $points = floor($participation['tarification'] / 10);
                $totalPoints += $points;
            }
            
            $_SESSION['success'] = true;
            $_SESSION['total_points'] = $totalPoints;
            $_SESSION['participations'] = $participations;
            
        } catch (Exception $e) {
            $_SESSION['error'] = "Une erreur est survenue : " . $e->getMessage();
        }
        
        // Redirection pour éviter la soumission multiple
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Points de Fidélité - EasyParki</title>

    <!-- Favicons -->
    <link href="assets/img/logoo.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
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

        .points-form {
            max-width: 500px;
            margin: 20px auto;
            padding: 30px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .points-icon {
            font-size: 48px;
            color: #0d3f72;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .points-display {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            margin: 20px 0;
            text-align: center;
        }

        .points-total {
            font-size: 2em;
            color: #0d3f72;
            font-weight: bold;
        }

        .participation-list {
            margin-top: 20px;
        }

        .participation-item {
            background: white;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 10px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }

        .progress {
            height: 20px;
            margin: 15px 0;
        }

        .progress-bar {
            background-color: #0d3f72;
        }
    </style>
</head>

<body class="page-points">
    <!-- ======= Header ======= -->
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
      <h1>Vos Points de Fidélité</h1>
      <p>Consultez vos points accumulés pour chaque participation.</p>
      <div class="mt-4">
        <a href="index.php" class="btn btn-light btn-lg px-4 me-2">Home</a>
        <a href="evenement.php" class="btn btn-outline-light btn-lg px-4">Evenements</a>
      </div>
    </div>
  </div><!-- End Hero Section -->

        <div class="container">
            <div class="points-form">
                <div class="text-center">
                    <i class="bi bi-star-fill points-icon"></i>
                </div>

                <?php if (isset($_SESSION['error'])): ?>
                    <div class="alert alert-danger mb-4">
                        <?php echo htmlspecialchars($_SESSION['error']); ?>
                        <?php unset($_SESSION['error']); ?>
                    </div>
                <?php endif; ?>

                <?php if (isset($_SESSION['success']) && isset($_SESSION['total_points'])): ?>
                    <div class="points-display">
                        <div class="points-total">
                            <?php echo number_format($_SESSION['total_points']); ?> points
                        </div>
                        
                        <?php
                        $nextLevel = ceil($_SESSION['total_points'] / 100) * 100;
                        $progress = ($_SESSION['total_points'] % 100);
                        ?>
                        
                        <div class="progress mt-3">
                            <div class="progress-bar" role="progressbar" 
                                 style="width: <?php echo $progress; ?>%"
                                 aria-valuenow="<?php echo $progress; ?>" 
                                 aria-valuemin="0" 
                                 aria-valuemax="100">
                            </div>
                        </div>
                        <small class="text-muted">
                            <?php echo $progress; ?>% vers le prochain niveau (<?php echo $nextLevel; ?> points)
                        </small>

                        <?php if (isset($_SESSION['participations']) && !empty($_SESSION['participations'])): ?>
                            <div class="participation-list mt-4">
                                <h4>Historique des participations</h4>
                                <?php foreach ($_SESSION['participations'] as $participation): ?>
                                    <div class="participation-item">
                                        <h5><?php echo htmlspecialchars($participation['nomE']); ?></h5>
                                        <p class="mb-1">Tarif: <?php echo number_format($participation['tarification'], 2); ?> DT</p>
                                        <p class="mb-0">Points gagnés: <?php echo floor($participation['tarification'] / 10); ?></p>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <?php 
                    unset($_SESSION['success']);
                    unset($_SESSION['total_points']);
                    unset($_SESSION['participations']);
                    ?>
                <?php endif; ?>

                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" id="pointsForm">
                    <div class="form-group">
                        <label for="email">Votre adresse email :</label>
                        <input type="email" name="email" id="email" class="form-control" required
                               placeholder="Entrez votre adresse email">
                    </div>

                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-search me-2"></i>Consulter mes points
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="container copyright text-center mt-4">
            <p>© <span>Copyright</span> <strong class="px-1">EasyParki</strong> <span>All Rights Reserved</span></p>
        </div>
    </footer>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/main.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('pointsForm');
            
            form.addEventListener('submit', function(e) {
                const email = document.getElementById('email').value;
                
                if (!email) {
                    e.preventDefault();
                    alert('Veuillez entrer votre adresse email.');
                    return;
                }
            });
        });
    </script>
</body>
</html>