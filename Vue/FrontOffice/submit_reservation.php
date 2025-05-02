<?php
header('Content-Type: application/json; charset=utf-8');

try {
    // 1. Connexion DB
    $pdo = new PDO('mysql:host=localhost;dbname=gestion_evenements', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec("SET NAMES utf8mb4");

    // 2. Validation
    $required = ['idE', 'nom_participant', 'prenom_participant', 'mail_participant', 'numTel_participant'];
    foreach ($required as $field) {
        if (empty($_POST[$field])) {
            throw new Exception("Le champ $field est requis");
        }
    }

    if (!filter_var($_POST['mail_participant'], FILTER_VALIDATE_EMAIL)) {
        throw new Exception("Email invalide");
    }

    // 3. Nettoyage des données
    $data = [
        ':idE' => (int)$_POST['idE'],
        ':nom' => htmlspecialchars($_POST['nom_participant']),
        ':prenom' => htmlspecialchars($_POST['prenom_participant']),
        ':email' => filter_var($_POST['mail_participant'], FILTER_SANITIZE_EMAIL),
        ':tel' => preg_replace('/[^0-9]/', '', $_POST['numTel_participant'])
    ];

    // 4. Insertion
    $stmt = $pdo->prepare("INSERT INTO participation 
                          (idE, nom_participant, prenom_participant, mail_participant, numTel_participant) 
                          VALUES (:idE, :nom, :prenom, :email, :tel)");
    $stmt->execute($data);

    // 5. Réponse succès
    echo json_encode([
        'success' => true,
        'message' => 'Réservation confirmée avec succès 🎉',
        'reservation_id' => $pdo->lastInsertId() // Optionnel : ID généré
    ]);

} catch (Exception $e) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => 'Erreur : ' . $e->getMessage()
    ]);
}