<?php 
// Récupération des événements depuis la base
try {
    $pdo = new PDO("mysql:host=localhost;dbname=gestion_evenements", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->query("SELECT idE, nomE FROM evenement");
    $evenements = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
    $evenements = [];
}

// Traitement du formulaire
$error = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include 'C:/xampp3/htdocs/ProjetWeb2A33/Controller/participationP.php';
    include 'C:/xampp3/htdocs/ProjetWeb2A33/Model/participation.php';

    $pc = new participationP();
    $p = new Participation(
      (int)$_POST['idE'],
      $_POST['nom_participant'],
      $_POST['prenom_participant'],
      $_POST['numTel_participant'],
      $_POST['mail_participant'],
      $_POST['type_stationnement']  // Nouveau champ ajouté ici
  );
  
    $pc->AjouterParticipation($p);

    header('Location: listparticipation.php');
    exit();
}
?>



<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/easyparki.png">
  <title>EasyParki - Ajouter Participation</title>
  
  <!-- Fonts and icons -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,900" />
  <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
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
    .nav-item.has-submenu {
      position: relative;
    }
    
    .submenu {
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
    
    .nav-item.has-submenu:hover .submenu {
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

    .form-container {
      background: white;
      border-radius: 12px;
      padding: 25px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.05);
      margin: 30px auto;
      max-width: 600px;
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
    
    .error-message {
  color: red;
  font-size: 0.9em;
  margin-top: 4px;
}

.invalid {
  border: 1px solid red !important;
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
        <li class="nav-item">
          <a class="nav-link" href="../pages/billing.html">
            <i class="material-symbols-rounded opacity-5">receipt_long</i>
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
            <span class="nav-link-text ms-1">Recharge électrique</span>
          </a>
        </li>
        <li class="nav-item has-submenu">
          <a class="nav-link active bg-gradient-primary text-white" href="javascript:;">
            <i class="material-symbols-rounded opacity-5">directions_bus</i>
            <span class="nav-link-text ms-1">Evenements</span>
          </a>
          <div class="submenu">
            <a href="addevenement.php" class="submenu-item">
              <i class="fas fa-hotel"></i>
              Ajouter Evenement
            </a>
            <a href="addparticipation.php" class="submenu-item">
              <i class="fas fa-calendar-plus"></i>
              Ajouter Participant
            </a>
            <a href="listevenement.php" class="submenu-item">
              <i class="fas fa-list"></i>
              List Evenements
            </a>
            <a href="listparticipation.php" class="submenu-item">
              <i class="fas fa-clipboard-list"></i>
              List Participation
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
        <a class="btn btn-outline-white mt-4 w-100" href="#">FrontOffice</a>
      </div>
    </div>
  </aside>

  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
    <div class="container-fluid py-4">
      <div class="form-container">
        <h2>Ajouter Participation</h2>
        <div class="error-message" id="errorMessage"><?php echo $error; ?></div>
        
        <form method="POST" onsubmit="return validateForm()" novalidate>
        <div class="mb-3">
         <label class="form-label">ID Événement</label>
          <select class="form-control" name="idE" id="idE" required>
           <option value="">-- Sélectionner un événement --</option>
            <?php foreach ($evenements as $event): ?>
             <option value="<?= htmlspecialchars($event['idE']) ?>">
               <?= htmlspecialchars($event['idE']) ?> - <?= htmlspecialchars($event['nomE']) ?>
              </option>
            <?php endforeach; ?>
          </select>
          <span id="error-idE" class="error-message"></span>
       </div>

          <div class="mb-3">
            <label class="form-label">Nom</label>
            <input type="text" class="form-control" name="nom_participant" id="nom_participant" />
            <span id="error-nom_participant" class="error-message"></span>
          </div>

          <div class="mb-3">
            <label class="form-label">Prénom</label>
            <input type="text" class="form-control" name="prenom_participant" id="prenom_participant" />
            <span id="error-prenom_participant" class="error-message"></span>
          </div>

          <div class="mb-3">
           <label class="form-label">Num Tel</label>
           <input type="tel" class="form-control" name="numTel_participant" id="numTel_participant" />
           <span id="error-numTel_participant" class="error-message"></span>
          </div>

          <div class="mb-3">
            <label class="form-label">Mail</label>
            <input type="text" class="form-control" name="mail_participant" id="mail_participant" />
            <span id="error-mail_participant" class="error-message"></span>
          </div>

          <div class="mb-3">
            <label class="form-label">Type de stationnement</label>
            <select class="form-control" name="type_stationnement" id="type_stationnement">
              <option value="" disabled selected>-- Sélectionnez un type --</option>
              <option value="VIP">VIP</option>
              <option value="Handicape">Handicapé</option>
              <option value="Couvert">Couvert</option>
              <option value="Electrique">Électrique</option>
              <option value="Standard">Standard</option>
            </select>
            <span id="error-type_stationnement" class="error-message"></span>
          </div>


          <div class="d-flex justify-content-between">
           <a href="Evenement.php" class="btn btn-secondary">Page Principale</a>
           <button type="submit" class="btn btn-primary">Soumettre</button>
          </div>
       </form>

      </div>
    </div>
  </main>

  <!-- Validation Script -->
  <script>
function validateForm() {
  const fields = [
    'idE',
    'nom_participant',
    'prenom_participant',
    'numTel_participant',
    'mail_participant',
    'type_stationnement'
  ];

  let hasErrors = false;

  // Nettoyage des erreurs précédentes
  fields.forEach(field => {
    document.getElementById(`error-${field}`).innerText = "";
    document.getElementById(field).classList.remove('invalid');
  });

  // Récupération des valeurs
  const idE = document.getElementById('idE').value.trim();
  const nom = document.getElementById('nom_participant').value.trim();
  const prenom = document.getElementById('prenom_participant').value.trim();
  const tel = document.getElementById('numTel_participant').value.trim();
  const mail = document.getElementById('mail_participant').value.trim();
  const typeStationnement = document.getElementById('type_stationnement').value.trim(); // Ajout ici

  // Validation
  if (!idE) {
    showError('idE', "ID Événement requis");
  }

  if (!nom || nom.length <= 2) {
    showError('nom_participant', "Nom invalide (min 2 caractères)");
  }

  if (!prenom || prenom.length <= 2) {
    showError('prenom_participant', "Prénom invalide (min 2 caractères)");
  }

  if (!tel || !/^[0-9]{8,}$/.test(tel)) {
    showError('numTel_participant', "Numéro invalide (min 8 chiffres)");
  }

  if (!mail || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(mail)) {
    showError('mail_participant', "Adresse email invalide");
  }

  return !hasErrors;

  function showError(field, message) {
    document.getElementById(`error-${field}`).innerText = message;
    document.getElementById(field).classList.add('invalid');
    hasErrors = true;
  }
}
</script>
<!-- Scripts -->

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="../assets/js/bootstrap.min.js"></script>
  <script src="../assets/js/material-dashboard.min.js?v=3.2.0"></script>
</body>
</html>