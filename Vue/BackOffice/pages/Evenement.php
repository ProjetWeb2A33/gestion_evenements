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
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/easyparki.png">
  <title>EasyParki - Dashboard</title>
  
  <!-- Fonts and icons -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,900" />
  <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
  
  <!-- CSS Files -->
  <link id="pagestyle" href="../assets/css/material-dashboard.css?v=3.2.0" rel="stylesheet" />
  <!-- Chart.js -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  
  <style>
   :root {
      --primary-dark: #0f172a;
      --accent-blue: #3b82f6;
      --accent-pink: #ec4899;
      --gradient-primary: linear-gradient(135deg, var(--accent-blue), var(--accent-pink));
    }

    
    body {
      background-color: #f8f9fa !important;
    }

    /* Sidebar submenu styling */
    .sidenav .nav-item.has-submenu {
      position: relative;
    }
    
    .sidenav .submenu {
      position: absolute;
      left: 0;
      top: 100%;
      min-width: 220px;
      background: var(--primary-dark);
      border-radius: 8px;
      padding: 10px 0;
      opacity: 0;
      visibility: hidden;
      transition: all 0.3s ease;
      transform: translateY(-10px);
      z-index: 1000;
      box-shadow: 0 8px 24px rgba(0,0,0,0.15);
    }
    
    .sidenav .nav-item.has-submenu:hover .submenu {
      opacity: 1;
      visibility: visible;
      transform: translateY(0);
    }
    
    .submenu-item {
      padding: 12px 20px;
      color: white !important;
      text-decoration: none;
      display: flex;
      align-items: center;
      transition: all 0.2s ease;
    }
    
    .submenu-item:hover {
      background: rgba(255,255,255,0.1);
      padding-left: 25px;
    }
    
    .submenu-item i {
      margin-right: 12px;
      font-size: 18px;
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
    .bg-rose {
      background-color: var(--accent-blue) !important;
      color: white !important;
    }

    /* Stats Cards */
    .stats-card {
      border-radius: 16px;
      padding: 20px;
      margin-bottom: 24px;
      box-shadow: 0 6px 15px rgba(0, 0, 0, 0.08);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      height: 100%;
      position: relative;
      overflow: hidden;
    }

    .stats-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 12px 20px rgba(0, 0, 0, 0.12);
    }

    .stats-card .card-icon {
      width: 60px;
      height: 60px;
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 24px;
      margin-bottom: 15px;
    }

    .stats-card .card-title {
      font-size: 14px;
      color: #6c757d;
      margin-bottom: 8px;
      font-weight: 600;
    }

    .stats-card .card-value {
      font-size: 28px;
      font-weight: 700;
      margin-bottom: 10px;
      color: #343a40;
    }

    .stats-card .card-change {
      display: flex;
      align-items: center;
      font-size: 13px;
      font-weight: 500;
    }

    .stats-card .card-change.up {
      color: #28a745;
    }

    .stats-card .card-change.down {
      color: #dc3545;
    }

    .stats-card .chart-container {
      position: absolute;
      bottom: 0;
      left: 0;
      right: 0;
      height: 80px;
    }

    /* Notifications Card */
    .notifications-card {
      border-radius: 16px;
      padding: 20px;
      box-shadow: 0 6px 15px rgba(0, 0, 0, 0.08);
      height: 100%;
    }

    .notifications-card .card-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
    }

    .notifications-card .card-title {
      font-size: 18px;
      font-weight: 700;
      color: #343a40;
      margin: 0;
    }

    .notifications-card .badge {
      background-color: var(--accent-blue) !important;
    }

    .notification-item {
      display: flex;
      padding: 12px 0;
      border-bottom: 1px solid #f1f1f1;
      align-items: flex-start;
    }

    .notification-item:last-child {
      border-bottom: none;
    }

    .notification-item .icon {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-right: 15px;
      flex-shrink: 0;
    }

    .notification-item .content {
      flex-grow: 1;
    }

    .notification-item .title {
      font-weight: 600;
      margin-bottom: 4px;
      color: #343a40;
    }

    .notification-item .time {
      font-size: 12px;
      color: #6c757d;
    }

    /* Grid Layout */
    .stats-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 24px;
      margin-top: 24px;
    }

    @media (max-width: 992px) {
      .stats-grid {
        grid-template-columns: repeat(2, 1fr);
      }
    }

    @media (max-width: 768px) {
      .stats-grid {
        grid-template-columns: 1fr;
      }
    }
    .bg-gradient-blue {
  background: linear-gradient(87deg, #1e3c72 0%, #2a5298 100%);
  color: white !important;
}

  </style>
</head>

<body class="g-sidenav-show bg-gray-100">
  <!-- Sidebar -->
  <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 fixed-start" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand px-4 py-3 m-0" href="tables.html">
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
        <!-- Vacances Menu with Submenu -->
        <li class="nav-item">
          <a class="nav-link text-dark" href="../pages/rtl.html">
            <i class="material-symbols-rounded opacity-5">format_textdirection_r_to_l</i>
            <span class="nav-link-text ms-1">Vacances</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="../pages/billing.html">
            <i class="material-symbols-rounded opacity-5">receipt_long</i>
            <span class="nav-link-text ms-1">Covoiturage</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="../pages/virtual-reality.html">
            <i class="material-symbols-rounded opacity-5">view_in_ar</i>
            <span class="nav-link-text ms-1">Service</span>
          </a>
        </li>
        <li class="nav-item has-submenu">
        <a class="nav-link active bg-gradient-blue text-white" href="javascript:;">
          <i class="material-symbols-rounded opacity-5">directions_bus</i>
          <span class="nav-link-text ms-1">Evenements</span>
       </a>
          <div class="submenu">
            <a href="addevenement.php" class="submenu-item">
            <i class="fas fa-plus-circle"></i>
              Ajouter un Evenement
            </a>
            <a href="addparticipation.php" class="submenu-item">
            <i class="fas fa-plus-circle"></i>
              Ajouter un Participant
            </a>
            <a href="listevenement.php" class="submenu-item">
              <i class="fas fa-list"></i>
              Liste des Evenements
            </a>
            <a href="listparticipation.php" class="submenu-item">
            <i class="fas fa-list"></i>
              Liste des Participants
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
        <a class="btn btn-outline-white mt-4 w-100" href="http://localhost/ProjetWeb/View/FrontOffice/Logis/about.php">FrontOffice</a>
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
    
    <!-- Ajout de la barre de recherche -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="input-group">
                <input type="text" id="searchInput" class="form-control" placeholder="Rechercher par nom d'événement...">
                <button class="btn btn-outline-secondary" type="button" id="searchButton">
                    <i class="fas fa-search"></i> Rechercher
                </button>
            </div>
        </div>
    </div>

    <div class="row" id="eventsContainer">
    <?php foreach ($evenements as $event) : ?>
        <div class="col-md-4 mb-4 event-card">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="card-title">ID=><?= htmlspecialchars($event['idE']) ?></h5>
                    <h5 class="card-title event-name">🗓️ <?= htmlspecialchars($event['nomE']) ?></h5>
                    <p class="card-text">📍 Lieu : <?= htmlspecialchars($event['lieu']) ?></p>
                    <p class="card-text">📅 Date : <?= htmlspecialchars($event['date']) ?></p>
                    <p class="card-text">🎟️ Places restantes : <?= $event['nbrPlace_restante'] ?></p>
                    <p class="card-text">🚫 Places occupées : <?= $event['nbrPlace_occupe'] ?></p>
                    <p class="card-text">💰 Prix : <?= $event['tarification'] ?> Dt</p>

                    <!-- Affichage du type de parking -->
                    <p class="card-text">
                        🚗 Type de Parking : 
                        <span class="badge 
                            <?php 
                                // Choisir une couleur de badge en fonction du type de parking
                                switch($event['typeParking']) {
                                    case 'VIP':
                                        echo 'bg-danger'; // Rouge pour VIP
                                        break;
                                    case 'Handicapé':
                                        echo 'bg-warning'; // Jaune pour handicapé
                                        break;
                                    default:
                                        echo 'bg-success'; // Vert pour Standard
                                        break;
                                }
                            ?>
                        ">
                            <?= htmlspecialchars($event['typeParking']) ?>
                        </span>
                    </p>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

</div>

<!-- Ajout du script JavaScript pour la recherche -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const searchButton = document.getElementById('searchButton');
    const eventCards = document.querySelectorAll('.event-card');
    
    function filterEvents() {
        const searchTerm = searchInput.value.toLowerCase();
        
        eventCards.forEach(card => {
            const eventName = card.querySelector('.event-name').textContent.toLowerCase();
            if (eventName.includes(searchTerm)) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    }
    
    searchButton.addEventListener('click', filterEvents);
    
    searchInput.addEventListener('keyup', function(e) {
        if (e.key === 'Enter') {
            filterEvents();
        }
    });
});
</script>
<!--PDF-->
<!-- Ajoutez ce bouton dans votre interface -->
<button id="generatePdfBtn" class="btn btn-primary">
  <i class="bi bi-file-earmark-pdf"></i> Exporter en PDF
</button>
<script>
  const events = <?= json_encode($evenements) ?>;
</script>
<!-- Script jsPDF (ajoutez dans le <head> ou avant </body>) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script>
  document.getElementById('generatePdfBtn').addEventListener('click', function() {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();

    // Titre
    doc.setFontSize(18);
    doc.setTextColor(40);
    doc.text('Liste des Événements', 105, 15, { align: 'center' });

    // Style contenu
    doc.setFontSize(12);
    let y = 30;

    // Génération dynamique des événements
    events.forEach(event => {
      doc.setFont(undefined, 'bold');
      doc.text(`ID = ${event.idE}`, 14, y);
      y += 7;

      doc.setFont(undefined, 'normal');
      doc.text(`* ${event.nomE}`, 20, y);
      y += 7;
      doc.text(`- Lieu : ${event.lieu}`, 20, y);
      y += 7;
      doc.text(`- Date : ${event.date}`, 20, y);
      y += 7;
      doc.text(`- Places restantes : ${event.nbrPlace_restante}`, 20, y);
      y += 7;
      doc.text(`- Places occupées : ${event.nbrPlace_occupe}`, 20, y);
      y += 7;
      doc.text(`- Tarif : ${event.tarification} Dt`, 20, y);
      y += 10;

      // Saut de page si nécessaire
      if (y > 270) {
        doc.addPage();
        y = 20;
      }
    });

    // Pied de page
    doc.setFontSize(10);
    doc.setTextColor(100);
    doc.text(`Généré le ${new Date().toLocaleDateString()}`, 105, 285, { align: 'center' });

    // Enregistrement
    doc.save('liste_evenements.pdf');
  });
</script>


<!-- Style optionnel pour le bouton -->
<style>
  #generatePdfBtn {
    background-color: #d32f2f;
    color: white;
    border: none;
    padding: 10px 15px;
    border-radius: 4px;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 8px;
    margin: 20px 0;
  }
  
  #generatePdfBtn:hover {
    background-color: #b71c1c;
  }
</style>

<div class="container mt-5">
    <h2 class="mb-4">📋 Tri Des Evenments</h2>
    
    <!-- Ajout du bouton de tri -->
    <div class="mb-4">
        <form method="get" action="evenement.php" class="form-inline">
            <label class="my-1 mr-2" for="sort">Trier par :</label>
            <select class="custom-select my-1 mr-sm-2" id="sort" name="sort">
                <option value="asc" <?= (isset($_GET['sort']) && $_GET['sort'] == 'asc') ? 'selected' : '' ?>>Prix croissant</option>
                <option value="desc" <?= (isset($_GET['sort']) && $_GET['sort'] == 'desc') ? 'selected' : '' ?>>Prix décroissant</option>
            </select>
            <button type="submit" class="btn btn-primary my-1">Trier</button>
        </form>
    </div>

    <div class="row">
        <?php 
        // Tri des événements selon le paramètre
        if (isset($_GET['sort'])) {
            usort($evenements, function($a, $b) {
                if ($_GET['sort'] == 'asc') {
                    return $a['tarification'] <=> $b['tarification'];
                } else {
                    return $b['tarification'] <=> $a['tarification'];
                }
            });
        }
        
        foreach ($evenements as $event) : ?>
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h5 class="card-title">ID=><?= htmlspecialchars($event['idE']) ?></h5>
                        <h5 class="card-title">🗓️ <?= htmlspecialchars($event['nomE']) ?></h5>
                        <p class="card-text">📍 Lieu : <?= htmlspecialchars($event['lieu']) ?></p>
                        <p class="card-text">📅 Date : <?= htmlspecialchars($event['date']) ?></p>
                        <p class="card-text">🎟️ Places restantes : <?= $event['nbrPlace_restante'] ?></p>
                        <p class="card-text">🚫 Places occupées : <?= $event['nbrPlace_occupe'] ?></p>
                        <p class="card-text">💰 Prix : <?= $event['tarification'] ?> Dt</p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
</body>
</html>