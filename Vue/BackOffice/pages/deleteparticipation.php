<?php
include "C:/xampp3/htdocs/ProjetWeb2A33/Controller/participationP.php";

if (isset($_GET['id'])) {
    $id_participation = $_GET['id']; // ✅ Récupère l'ID passé dans l'URL
    $participationP = new participationP();
    $participationP->SupprimerParticipation($id_participation);
}

header('Location: listparticipation.php');
exit;
?>