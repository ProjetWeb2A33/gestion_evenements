<?php
// Connexion à la base
$host = 'localhost';
$db = 'gestion_evenements';
$user = 'root';
$pass = '';
try {
    $conn = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Récupération des événements
    $sql = "SELECT * FROM evenement";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $evenements = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/easyparki.png">
  <title>EasyParki - Dashboard</title>
  
  <!-- Fonts and icons -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,900" />
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
  
  <!-- CSS Files -->
  <link id="pagestyle" href="../assets/css/material-dashboard.css?v=3.2.0" rel="stylesheet" />
  
  <style>
    :root {
      --primary-dark: #0a1d37;
      --accent-blue: #4da6ff;
    }
    
    body {
      background-color: #f8f9fa !important;
    }
    
    .sidenav {
      background-color: var(--primary-dark) !important;
    }
    
    .sidenav .nav-link,
    .sidenav .nav-link-text,
    .sidenav .navbar-brand span,
    .sidenav .material-symbols-rounded {
      color: white !important;
    }
    
    .navbar-main {
      background-color: var(--primary-dark) !important;
      border-bottom: 2px solid var(--accent-blue) !important;
    }
    
    .form-container {
      background: white;
      border-radius: 12px;
      padding: 25px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.05);
      margin-bottom: 30px;
    }
    
    .table-responsive {
      background: white;
      border-radius: 12px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.05);
      padding: 15px;
    }
    
    #transport-tab {
      border: 2px solid var(--accent-blue);
      border-radius: 8px;
      margin-right: 10px;
      padding: 8px 20px;
      background-color: rgba(77, 166, 255, 0.1);
      transition: all 0.3s ease;
    }
    
    #transport-tab.active {
      background-color: var(--accent-blue) !important;
      color: white !important;
    }
    
    #transport-tab:hover:not(.active) {
      background-color: rgba(77, 166, 255, 0.2);
    }
    
    .bg-gradient-primary {
      background: linear-gradient(195deg, var(--accent-blue), #3a8df1) !important;
    }
    
    .btn-primary {
      background-color: var(--accent-blue) !important;
    }
    
    .badge.bg-success {
      background-color: var(--accent-blue) !important;
    }

    /* Updated dropdown styles */
    .nav-item.dropdown-menu-container {
      position: relative;
      margin-bottom: 15px;
    }

    .vacances-dropdown {
      position: absolute;
      left: 0;
      top: 100%;
      min-width: 100%;
      background: white;
      border-radius: 8px;
      box-shadow: 0 8px 24px rgba(0,0,0,0.1);
      opacity: 0;
      transform: translateY(-10px);
      visibility: hidden;
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      z-index: 1000;
      margin-top: 5px;
    }

    .nav-item.dropdown-menu-container:hover .vacances-dropdown {
      opacity: 1;
      transform: translateY(0);
      visibility: visible;
    }

    .dropdown-item {
      padding: 12px 20px;
      color: var(--primary-dark);
      text-decoration: none;
      display: flex;
      align-items: center;
      gap: 12px;
      transition: all 0.2s ease;
      border-bottom: 1px solid rgba(0,0,0,0.05);
    }

    .dropdown-item:last-child {
      border-bottom: none;
    }

    .dropdown-item:hover {
      background: rgba(77, 166, 255, 0.08);
      padding-left: 24px;
      color: var(--accent-blue);
    }

    .dropdown-item .material-symbols-rounded {
      font-size: 20px;
    }
  </style>
</head>
<body class="g-sidenav-show bg-gray-100">
  <!-- Sidebar -->
  <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 fixed-start" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand px-4 py-3 m-0" href="#">
        <img src="../assets/img/easyparki.png" class="navbar-brand-img" width="50">
        <span class="ms-1 text-white">EasyParki</span>
      </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="../pages/dashboard.html">
            <i class="material-symbols-rounded opacity-5">dashboard</i>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../pages/billing.html">
            <i class="material-symbols-rounded opacity-5">receipt_long</i>
            <span class="nav-link-text ms-1">Stationnement</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="../pages/rtl.html">
            <i class="material-symbols-rounded opacity-5">format_textdirection_r_to_l</i>
            <span class="nav-link-text ms-1">Vacances</span>
          </a>
        </li>
        <!-- Covoiturage with spacing -->
        <li class="nav-item" style="margin-top: 10px;">
          <a class="nav-link text-dark" href="../pages/billing.html">
            <i class="material-symbols-rounded opacity-5">receipt_long</i>
            <span class="nav-link-text ms-1">Covoiturage</span>
          </a>
        </li>

        <!-- Rest of menu items -->
        <li class="nav-item">
          <a class="nav-link text-dark" href="../pages/virtual-reality.html">
            <i class="material-symbols-rounded opacity-5">view_in_ar</i>
            <span class="nav-link-text ms-1">Recharge électrique</span>
          </a>
        </li>
        <!-- Vacances Menu with Dropdown -->
        <li class="nav-item dropdown-menu-container">
          <a class="nav-link active bg-gradient-primary text-white" href="javascript:;">
            <i class="material-symbols-rounded opacity-5">directions_bus</i>
            <span class="nav-link-text ms-1">Evenements</span>
          </a>
          <div class="vacances-dropdown">
            <a href="addevenement.php" class="dropdown-item">
              <span class="material-symbols-rounded">add_circle</span>
              Ajouter un Evenement
            </a>
            <a href="addparticipation.php" class="dropdown-item">
              <span class="material-symbols-rounded"></span>
              Ajouter un Participant
            </a>
            <a href="listevenement.php" class="dropdown-item">
              <span class="material-symbols-rounded">list</span>
              List des Evenements
            </a>
            <a href="listparticipation.php" class="dropdown-item">
              <span class="material-symbols-rounded">calendar_month</span>
              List des Participants
            </a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="../pages/notifications.html">
            <i class="material-symbols-rounded opacity-5">notifications</i>
            <span class="nav-link-text ms-1">Notifications</span>
          </a>
        </li>
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-5">Account pages</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="../pages/profile.html">
            <i class="material-symbols-rounded opacity-5">person</i>
            <span class="nav-link-text ms-1">Profile</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="../pages/sign-in.html">
            <i class="material-symbols-rounded opacity-5">login</i>
            <span class="nav-link-text ms-1">Sign In</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="../pages/sign-up.html">
            <i class="material-symbols-rounded opacity-5">assignment</i>
            <span class="nav-link-text ms-1">Sign Up</span>
          </a>
        </li>
      </ul>
    </div>
    <div class="sidenav-footer position-absolute w-100 bottom-0">
    <div class="mx-3">
      <a class="btn btn-outline-white mt-4 w-100" href="../front/index.php">Retour au Site</a>
    </div>

    </div>
  </aside>

  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-3 shadow-none border-radius-xl" id="navbarBlur">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-white active">Evenements</li>
          </ol>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            <div class="input-group input-group-outline">
              <label class="form-label">Rechercher...</label>
              <input type="text" class="form-control">
            </div>
          </div>
        </div>
      </div>
    </nav>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="../assets/js/bootstrap.min.js"></script>
  <script src="../assets/js/material-dashboard.min.js?v=3.2.0"></script>
  
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      var tabEls = document.querySelectorAll('button[data-bs-toggle="tab"]');
      tabEls.forEach(function(tabEl) {
        tabEl.addEventListener('click', function(event) {
          event.preventDefault();
          var tab = new bootstrap.Tab(tabEl);
          tab.show();
        });
      });
      
      document.querySelectorAll('form').forEach(function(form) {
        form.addEventListener('submit', function(event) {
          if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
          }
          form.classList.add('was-validated');
        }, false);
      });
    });
  </script>
  <div class="container mt-5">
    <h2 class="mb-4">📋 Liste des Événements</h2>
    <div class="row">

        <?php foreach ($evenements as $event) : ?>
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h5 class="card-title">ID=><?= htmlspecialchars($event['idE']) ?></h5>
                        <h5 class="card-title">🗓️ <?= htmlspecialchars($event['nomE']) ?></h5>
                        <p class="card-text">📍 Lieu : <?= htmlspecialchars($event['lieu']) ?></p>
                        <p class="card-text">📅 Date : <?= htmlspecialchars($event['date']) ?></p>
                        <p class="card-text">🎟️ Places restantes : <?= $event['nbrPlace_restante'] ?></p>
                        <p class="card-text">🚫 Places occupées : <?= $event['nbrPlace_occupe'] ?></p>
                        <p class="card-text">💰 Tarif : <?= $event['tarification'] ?> Dt</p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

    </div>
</div>
</body>
</html>