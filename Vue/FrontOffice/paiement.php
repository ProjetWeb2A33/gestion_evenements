<?php
require_once('../../vendor/stripe/init.php');

// Initialiser Stripe avec votre clé secrète
\Stripe\Stripe::setApiKey('sk_test_51RKhyACxT1l2hSN2x9mQg9N1JTVVB3trSYicLPqBCDQrfuDIXC3n7gRBF92mnCOLChKqawcs6LZx6e28MPudQuk800Xnk682gt');

// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gestion_evenements";

$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("La connexion a échoué: " . $conn->connect_error);
}

$reservation_id = $_GET['id'] ?? '';
$event_id = $_GET['idE'] ?? '';
$parking_type = $_GET['type'] ?? 'Standard';

// Récupérer les détails de l'événement depuis la base de données
$stmt = $conn->prepare("SELECT nomE, date, tarification FROM evenement WHERE idE = ?");
$stmt->bind_param("i", $event_id);
$stmt->execute();
$result = $stmt->get_result();
$event = $result->fetch_assoc();

$event_name = $event['nomE'] ?? '';
$event_date = $event['date'] ?? '';
$base_price = $event['tarification'] ?? 0;

// Calculer le prix selon le type de stationnement
$parking_multipliers = [
    'VIP' => 2.0,        // Prix doublé pour VIP
    'Handicape' => 0.5,  // 50% de réduction pour Handicapé
    'Couvert' => 1.3,    // 30% de plus pour Couvert
    'Electrique' => 1.5, // 50% de plus pour Électrique
    'Standard' => 1.0    // Prix normal pour Standard
];

$multiplier = $parking_multipliers[$parking_type] ?? 1.0;
$price = $base_price * $multiplier;
$price_in_cents = intval($price * 100); // Convertir le prix en centimes pour Stripe

// Si le formulaire est soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Créer l'intention de paiement
        $paymentIntent = \Stripe\PaymentIntent::create([
            'amount' => $price_in_cents,
            'currency' => 'eur',
            'payment_method_types' => ['card'],
            'metadata' => [
                'reservation_id' => $reservation_id
            ]
        ]);

        $output = [
            'clientSecret' => $paymentIntent->client_secret,
        ];

        header('Content-Type: application/json');
        echo json_encode($output);
        exit;
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(['error' => $e->getMessage()]);
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paiement - EasyParki</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://js.stripe.com/v3/"></script>
    <style>
        .payment-form {
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
        }
        #card-element {
            margin: 20px 0;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .error-message {
            color: #dc3545;
            margin-top: 10px;
        }
        .success-message {
            color: #198754;
            margin-top: 10px;
        }
        .spinner {
            display: none;
        }
        .spinner.active {
            display: inline-block;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="payment-form card shadow">
            <div class="card-body">
                <h2 class="text-center mb-4">Paiement pour votre réservation</h2>
                
                <div class="alert alert-info">
                    <h5>Détails de la réservation :</h5>
                    <p>Événement : <?= htmlspecialchars($event_name) ?></p>
                    <p>Date : <?= htmlspecialchars($event_date) ?></p>
                    <p>Montant : <?= htmlspecialchars($price) ?>DT</p>
                </div>

                <form id="payment-form">
                    <div id="card-element"></div>
                    <div id="card-errors" class="error-message" role="alert"></div>
                    <div id="success-message" class="success-message" style="display: none;">
                        Paiement réussi ! Vous allez être redirigé...
                    </div>

                    <button type="submit" class="btn btn-primary w-100" id="submit-button">
                        <span class="spinner-border spinner-border-sm spinner" role="status" aria-hidden="true"></span>
                        Payer <?= htmlspecialchars($price) ?>DT
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        const stripe = Stripe('pk_test_51RKhyACxT1l2hSN2pi9UufjcveIq3ikLjbnImuYDdlYYoGOg7tNxXIQNb0UFkDe9uHk2R3wMsiEIiiXxZgDYcizm00JDOz3iOd');
        const elements = stripe.elements();
        const card = elements.create('card');
        card.mount('#card-element');

        const form = document.getElementById('payment-form');
        const submitButton = document.getElementById('submit-button');
        const spinner = document.querySelector('.spinner');

        card.addEventListener('change', ({error}) => {
            const displayError = document.getElementById('card-errors');
            if (error) {
                displayError.textContent = error.message;
            } else {
                displayError.textContent = '';
            }
        });

        form.addEventListener('submit', async (event) => {
            event.preventDefault();
            submitButton.disabled = true;
            spinner.classList.add('active');

            try {
                const response = await fetch('', {
                    method: 'POST'
                });
                
                const data = await response.json();
                
                if (data.error) {
                    throw new Error(data.error);
                }

                const {paymentIntent, error} = await stripe.confirmCardPayment(data.clientSecret, {
                    payment_method: {
                        card: card
                    }
                });

                if (error) {
                    throw new Error(error.message);
                }

                if (paymentIntent.status === 'succeeded') {
                    document.getElementById('success-message').style.display = 'block';
                    setTimeout(() => {
                        window.location.href = 'evenement.php';
                    }, 2000);
                }
            } catch (error) {
                const errorElement = document.getElementById('card-errors');
                errorElement.textContent = error.message;
            }

            submitButton.disabled = false;
            spinner.classList.remove('active');
        });
    </script>
</body>
</html>