<?php
include "C:/xampp3/htdocs/ProjetWeb2A33/Controller/evenementE.php";

if (isset($_GET['id'])) {
    $idE = $_GET['id']; // ✅ Récupère l'ID passé dans l'URL
    $evenementE = new evenementE();
    $evenementE->SupprimerEvenement($idE);
}

header('Location: listevenement.php');
exit;
?>
