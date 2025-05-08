<?php
require_once '../../config/config.php';
require_once '../../Controller/evenementE.php';

session_start();

// Vérifier si l'ID de l'événement est passé
if (!isset($_SESSION['event_id'])) {
    header('Location: evenement.php');
    exit();
}

$eventC = new evenementE();
$event = $eventC->showEvenement($_SESSION['event_id']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $telephone = filter_var($_POST['telephone'], FILTER_SANITIZE_STRING);
    
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Préparer l'email de confirmation
        $subject = "Confirmation de réservation - " . $event['nomE'];
        
        $message = "
        <html>
        <head>
            <style>
                body { font-family: Arial, sans-serif; line-height: 1.6; }
                .confirmation { background: #f9f9f9; padding: 20px; border-radius: 5px; }
                .event-name { color: #0d3f72; font-size: 24px; margin-bottom: 15px; }
                .details { margin: 15px 0; }
            </style>
        </head>
        <body>
            <div class='confirmation'>
                <h1 class='event-name'>Confirmation de réservation</h1>
                <p>Cher(e) participant(e),</p>
                <p>Votre réservation pour l'événement suivant a été confirmée :</p>
                
                <div class='details'>
                    <p><strong>Événement :</strong> " . htmlspecialchars($event['nomE']) . "</p>
                    <p><strong>Date :</strong> " . htmlspecialchars($event['date']) . "</p>
                    <p><strong>Lieu :</strong> " . htmlspecialchars($event['lieu']) . "</p>
                    <p><strong>Tarif :</strong> " . htmlspecialchars($event['tarification']) . " €</p>
                </div>
                
                <p>Vos informations de contact :</p>
                <p>Email : " . htmlspecialchars($email) . "</p>
                <p>Téléphone : " . htmlspecialchars($telephone) . "</p>
                
                <p>Merci de votre confiance !</p>
                <p>L'équipe EasyParki</p>
            </div>
        </body>
        </html>";

        // Headers pour l'email HTML
        $headers = "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
        $headers .= "From: EasyParki <noreply@easyparki.com>\r\n";
        $headers .= "Reply-To: noreply@easyparki.com\r\n";
        $headers .= "X-Mailer: PHP/" . phpversion();

        // Envoyer l'email
        if (mail($email, $subject, $message, $headers)) {
            $_SESSION['notification_success'] = true;
        } else {
            $_SESSION['notification_error'] = true;
        }
        
        // Rediriger pour éviter la soumission multiple du formulaire
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Confirmation de réservation - EasyParki</title>

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
        .notification-form {
            max-width: 500px;
            margin: 20px auto;
            padding: 30px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .confirmation-icon {
            font-size: 48px;
            color: #0d3f72;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .event-details {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .event-details h3 {
            color: #0d3f72;
            font-size: 1.2rem;
            margin-bottom: 15px;
        }
    </style>
</head>

<body class="page-notification">
    <!-- ======= Header ======= -->
    <header id="header" class="header d-flex align-items-center fixed-top">
        <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
            <a href="index.html" class="logo d-flex align-items-center">
                <h1>EasyParki</h1>
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="index.html">Accueil</a></li>
                    <li><a href="Stationnement.html">Stationnement</a></li>
                    <li><a href="transport public.html">Vacances</a></li>
                    <li><a href="Covoiturage.html">Covoiturage</a></li>
                    <li><a href="Recharge.html">Service</a></li>
                    <li class="dropdown">
                        <a href="evenement.php" class="active"><span>Événements</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
                        <ul>
                            <li><a href="evenement.php">Page Événement</a></li>
                            <li><a href="billets.php">Vos Billets</a></li>
                            <li><a href="durée.php">Let's Talk!</a></li>
                            <li><a href="map.php">Map</a></li>
                            <li><a href="notification.php">Rappel</a></li>
                        </ul>
                    </li>
                    <li><a href="contact.html">Contact</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main id="main">
        <!-- Page Title Section -->
        <div class="page-title" style="margin-top: 80px;">
            <div class="container position-relative">
                <div class="row">
                    <div class="col-lg-8 mx-auto text-center">
                        <h1>Confirmation de réservation</h1>
                        <p>Recevez votre confirmation par email</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="notification-form">
                <div class="text-center">
                    <i class="bi bi-envelope-check confirmation-icon"></i>
                </div>

                <?php if (isset($_SESSION['notification_success'])): ?>
                    <div class="alert alert-success mb-4">
                        <i class="bi bi-check-circle me-2"></i>
                        Votre confirmation a été envoyée par email !
                    </div>
                    <?php unset($_SESSION['notification_success']); ?>
                <?php endif; ?>

                <?php if (isset($_SESSION['notification_error'])): ?>
                    <div class="alert alert-danger mb-4">
                        <i class="bi bi-exclamation-circle me-2"></i>
                        Une erreur est survenue lors de l'envoi de l'email.
                    </div>
                    <?php unset($_SESSION['notification_error']); ?>
                <?php endif; ?>

                <div class="event-details">
                    <h3>Détails de l'événement</h3>
                    <p><strong>Nom :</strong> <?php echo htmlspecialchars($event['nomE']); ?></p>
                    <p><strong>Date :</strong> <?php echo htmlspecialchars($event['date']); ?></p>
                    <p><strong>Lieu :</strong> <?php echo htmlspecialchars($event['lieu']); ?></p>
                    <p><strong>Tarif :</strong> <?php echo htmlspecialchars($event['tarification']); ?> €</p>
                </div>

                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" id="notificationForm">
                    <div class="form-group">
                        <label for="email">Adresse email :</label>
                        <input type="email" name="email" id="email" class="form-control" required
                               placeholder="Entrez votre adresse email">
                    </div>

                    <div class="form-group">
                        <label for="telephone">Numéro de téléphone :</label>
                        <input type="tel" name="telephone" id="telephone" class="form-control" required
                               placeholder="Entrez votre numéro de téléphone"
                               pattern="[0-9]{8,}" title="Veuillez entrer un numéro de téléphone valide">
                    </div>

                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-send me-2"></i>Recevoir la confirmation
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
            // Validation du formulaire
            const form = document.getElementById('notificationForm');
            
            form.addEventListener('submit', function(e) {
                const email = document.getElementById('email').value;
                const telephone = document.getElementById('telephone').value;
                
                if (!email || !telephone) {
                    e.preventDefault();
                    alert('Veuillez remplir tous les champs.');
                    return;
                }
                
                if (telephone.length < 8) {
                    e.preventDefault();
                    alert('Veuillez entrer un numéro de téléphone valide.');
                    return;
                }
            });
        });
    </script>
</body>
</html>