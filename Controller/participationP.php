<?php 

include_once ("C:/xampp2/htdocs/ProjetWeb2A33/config/config.php");

class ParticipationP {

    // Lister toutes les participations
    public function ListeParticipations() {
        $db = config::getConnexion();
        try {
            $liste = $db->query('SELECT * FROM participation');
            return $liste;
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    // Ajouter une participation
    public function AjouterParticipation($p) {
        $db = config::getConnexion();
        try {
            $req = $db->prepare('
                INSERT INTO participation (idE, nom_participant, prenom_participant, numTel_participant, mail_participant)
                VALUES (:idE, :nom, :prenom, :tel, :mail)
            ');
            $req->execute([
                'idE' => $p->getIdE(),
                'nom' => $p->getNomParticipant(),
                'prenom' => $p->getPrenomParticipant(),
                'tel' => $p->getNumTelParticipant(),
                'mail' => $p->getMailParticipant()
            ]);
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    // Supprimer une participation
    public function SupprimerParticipation($id) {
        $db = config::getConnexion();
        try {
            $req = $db->prepare('DELETE FROM participation WHERE id_participation = :id');
            $req->execute(['id' => $id]);
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    // Récupérer une participation par ID
    public function getParticipationById($id_participation) {
        $db = config::getConnexion();
        try {
            $req = $db->prepare('SELECT * FROM participation WHERE id_participation = :id');
            $req->execute(['id' => $id_participation]);
            $result = $req->fetch(PDO::FETCH_ASSOC);
            return $result ?: null;
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    function showParticipation($id)
    {
        $sql = "SELECT * from participation where id_participation = $id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();
            return $query->fetch();
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    // Modifier une participation
    public function ModifierParticipation($p ,$id) {
        $db = config::getConnexion();
        try {
            $req = $db->prepare(
                'UPDATE participation SET
                    idE = :idE,
                    nom_participant = :nom,
                    prenom_participant = :prenom,
                    numTel_participant = :tel,
                    mail_participant = :mail
                WHERE id_participation = :id
            ');
            $req->execute([
                'idE' => $p->getIdE(),
                'nom' => $p->getNomParticipant(),
                'prenom' => $p->getPrenomParticipant(),
                'tel' => $p->getNumTelParticipant(),
                'mail' => $p->getMailParticipant(),
                'id' => $id
            ]);
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
}
