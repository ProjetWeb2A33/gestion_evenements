<?php
class config
{
    private static ?PDO $pdo = null;

    public static function getConnexion()
    {
        if (!isset(self::$pdo)) {
            try {
                self::$pdo = new PDO('mysql:host=localhost;dbname=gestion_evenements;charset=utf8', 'root', '');
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die('Erreur de connexion à la base de données : ' . $e->getMessage());
            }
        }
        return self::$pdo;
    }
}
