<?php
include "C:/xampp3/htdocs/ProjetWeb2A33/Controller/evenementE.php"; 
include "C:/xampp3/htdocs/ProjetWeb2A33/Model/evenement.php"; 
$error = "";
$evenementE = new evenementE();

if (isset($_POST["id"])) {
    $evenement = $evenementE->showEvenement($_POST["id"]);
    
    if (
        isset($_POST["nomE"]) &&
        isset($_POST["date"]) &&
        isset($_POST["lieu"]) &&
        isset($_POST["nbrPlace_restante"]) &&
        isset($_POST["nbrPlace_occupe"]) &&
        isset($_POST["tarification"])
    ) {
        if (
            !empty($_POST["nomE"]) &&
            !empty($_POST["date"]) &&
            !empty($_POST["lieu"]) &&
            !empty($_POST["nbrPlace_restante"]) &&
            !empty($_POST["nbrPlace_occupe"]) &&
            !empty($_POST["tarification"])
        ) {
            $updatedevenement = new Evenement(
                $_POST['id'],
                $_POST['nomE'],
                $_POST['date'],
                $_POST['lieu'],
                $_POST['nbrPlace_restante'],
                $_POST['nbrPlace_occupe'],
                $_POST['tarification']
            );
            $evenementE->ModifierEvenement($updatedevenement, $_POST['id']);
            header('Location: listevenement.php');
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/easyparki.png">
  
  <title>EasyParki - Modifier Evenement</title>
  
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


    .form-container {
      background: white;
      border-radius: 12px;
      padding: 25px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.05);
      margin: 30px auto;
      max-width: 600px;
    }
    
    .error-message {
      color: red;
      margin-bottom: 15px;
    }
    
    .form-group label {
      font-weight: 500;
      color: var(--primary-dark);
    }
    
    .form-control {
      border-radius: 8px;
      padding: 10px 15px;
      border: 1px solid #dee2e6;
      transition: all 0.3s ease;
    }
    
    .form-control:focus {
      border-color: var(--accent-blue);
      box-shadow: 0 0 0 3px rgba(77, 166, 255, 0.25);
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
          <a class="nav-link" href="../pages/rtl.html">
            <i class="material-symbols-rounded opacity-5">format_textdirection_r_to_l</i>
            <span class="nav-link-text ms-1">Vacances</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../pages/billing.html">
            <i class="material-symbols-rounded opacity-5">receipt_long</i>
            <span class="nav-link-text ms-1">Covoiturage</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../pages/virtual-reality.html">
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
              <i class="fas fa-evenement"></i>
              Ajouter Evenement
            </a>
            <a href="addparticipation.php" class="submenu-item">
              <i class="fas fa-calendar-plus"></i>
              Ajouter Participation
            </a>
            <a href="listevenement.php" class="submenu-item">
              <i class="fas fa-list"></i>
              List Evenement
            </a>
            <a href="listparticipation.php" class="submenu-item">
              <i class="fas fa-clipboard-list"></i>
              List Participation
            </a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../pages/notifications.html">
            <i class="material-symbols-rounded opacity-5">notifications</i>
            <span class="nav-link-text ms-1">Notifications</span>
          </a>
        </li>
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-5">Account pages</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../pages/profile.html">
            <i class="material-symbols-rounded opacity-5">person</i>
            <span class="nav-link-text ms-1">Profile</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../pages/sign-in.html">
            <i class="material-symbols-rounded opacity-5">login</i>
            <span class="nav-link-text ms-1">Sign In</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../pages/sign-up.html">
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
        <?php if(!empty($error)): ?>
          <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>

        <?php if(isset($_POST['id'])): ?>
        <h3 class="mb-4">Modifier Evenement</h3>
        <form method="POST" onsubmit="return validateForm()">
          <input type="hidden" name="id" value="<?= $evenement['idE'] ?>">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Nom Evenement</label>
                <input type="text" name="nomE" class="form-control" value="<?= $evenement['nomE'] ?>">
              </div>
              
              <div class="form-group">
                <label>Date</label>
                <input type="date" name="date" class="form-control" value="<?= $evenement['date'] ?>">
              </div>
              
              <div class="form-group">
                <label>Lieu</label>
                <input type="text" name="lieu" class="form-control" value="<?= $evenement['lieu'] ?>">
              </div>

            </div>
            
            <div class="col-md-6">
              <div class="form-group">
                 <label>Nombre Places Disponibles</label>
                 <input type="number" name="nbrPlace_restante" class="form-control" value="<?= $evenement['nbrPlace_restante'] ?>">
              </div>
              
              <div class="form-group">
                 <label>Nombre Places Occupees</label>
                 <input type="number" name="nbrPlace_occupe" class="form-control" value="<?= $evenement['nbrPlace_occupe'] ?>">
              </div>
            </div>
          </div>

          <div class="form-group">
            <label>Tarification</label>
            <input type="number" name="tarification" class="form-control" value="<?= $evenement['tarification'] ?>">
          </div>

          <div class="text-end mt-4">
            <div class="error-message" id="errorMessage"></div>
            <button type="submit" class="btn btn-primary">
              <i class="fas fa-save me-2"></i> Mettre à jour
            </button>
            <a href="listevenement.php" class="btn btn-secondary">
              <i class="fas fa-times me-2"></i> Annuler
            </a>
          </div>
        </form>
        <?php endif; ?>
      </div>
    </div>
  </main>

  <!-- Validation Script -->
  <script>
  function validateForm() {
    const errorMessage = document.getElementById('errorMessage');
    let errors = [];
    
    // Get form values
    const nomE = document.getElementsByName('nomE')[0].value.trim();
    const date = document.getElementsByName('date')[0].value;
    const lieu = document.getElementsByName('lieu')[0].value.trim();
    const nbrPlace_restante = document.getElementsByName('nbrPlace_restante')[0].value;
    const nbrPlace_occupe = document.getElementsByName('nbrPlace_occupe')[0].value;
    const tarification = document.getElementsByName('tarification')[0].value;

    // Validation rules
    if (!nomE) errors.push("Le nom de l'evenement est obligatoire");
    if (!date) errors.push("La date est obligatoire");
    if (!lieu) errors.push("Le lieu est obligatoire");
    if (!nbrPlace_restante) errors.push("Le nombre de places restantes est obligatoire");
    if (!nbrPlace_occupe) errors.push("Le nombre de places occupe est obligatoire");
    if (!tarification) errors.push("La tarification est obligatoire");

    if (nomE.length < 2) errors.push("Le nom est invalide");
    if (lieu.length < 2) errors.push("Le lieu est invalide");

    // Display errors or submit
    if (errors.length > 0) {
      errorMessage.innerHTML = errors.join('<br>');
      return false;
    }
    return true;
  }
</script>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="../assets/js/bootstrap.min.js"></script>
  <script src="../assets/js/material-dashboard.min.js?v=3.2.0"></script>
</body>
</html>