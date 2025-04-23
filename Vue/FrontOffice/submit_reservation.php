<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gestion_evenements";

// Connexion
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Erreur de connexion : " . $conn->connect_error);
}

// Récupération des données du formulaire
$idE = $_POST['idE'];
$nom = $_POST['nom_participant'];
$prenom = $_POST['prenom_participant'];
$email = $_POST['mail_participant'];
$tel = $_POST['numTel_participant'];

// Requête préparée
$stmt = $conn->prepare("INSERT INTO participation (idE,nom_participant, prenom_participant, mail_participant, numTel_participant) VALUES (?, ?, ?, ?, ?)");

if (!$stmt) {
    die("Erreur lors de la préparation de la requête : " . $conn->error);
}

// Lier les paramètres
$stmt->bind_param("issss", $idE, $nom, $prenom, $email, $tel);

// Exécuter
if ($stmt->execute()) {
    echo "🎉 Réservation enregistrée avec succès.";
} else {
    echo "Erreur lors de l'enregistrement : " . $stmt->error;
}

$stmt->close();
$conn->close();
?>

