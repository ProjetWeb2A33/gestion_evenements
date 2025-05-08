<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Confirmation de Réservation - EasyParki</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
            background-color: #f8f9fa;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .confirmation-details {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .success-icon {
            color: #28a745;
            font-size: 48px;
            margin-bottom: 20px;
        }
        .error-message {
            color: #dc3545;
            text-align: center;
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
        if (isset($_GET['data'])) {
            try {
                $decodedData = json_decode(base64_decode($_GET['data']), true);
                
                if ($decodedData && isset($decodedData['email']) && isset($decodedData['telephone'])) {
                    echo '<div class="header">
                            <div class="success-icon">✓</div>
                            <h1>Confirmation de Réservation</h1>
                            <p>Votre réservation a été validée avec succès!</p>
                          </div>
                          <div class="confirmation-details">
                            <h3>Détails de la réservation:</h3>
                            <p><strong>Email:</strong> ' . htmlspecialchars($decodedData['email']) . '</p>
                            <p><strong>Téléphone:</strong> ' . htmlspecialchars($decodedData['telephone']) . '</p>
                            <p><strong>Date de validation:</strong> ' . date('d/m/Y H:i:s') . '</p>
                          </div>
                          <div style="text-align: center;">
                            <p>✅ Accès autorisé</p>
                            <p>Vous pouvez maintenant accéder à votre place de stationnement.</p>
                          </div>';
                } else {
                    throw new Exception('Données de réservation invalides');
                }
            } catch (Exception $e) {
                echo '<div class="error-message">
                        <h2>Erreur</h2>
                        <p>Les données de réservation sont invalides ou ont expiré.</p>
                      </div>';
            }
        } else {
            echo '<div class="error-message">
                    <h2>Erreur</h2>
                    <p>Aucune donnée de réservation fournie.</p>
                  </div>';
        }
        ?>
    </div>
</body>
</html>