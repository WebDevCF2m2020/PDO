<?php
// PDO object connection

/**
 * @return PDO|string
 */
function connectDbPDO(){
    // Essais / erreurs
    try {
        // création de notre connexion PDO (instanciation de la classe PDO) avec les arguments d'affichage d'erreurs
        $db = new PDO(DB_TYPE . ":host==" . DB_HOST . ";dbname=" . DB_NAME . ";port=" . DB_PORT . ";charset=" . DB_CHARSET, DB_USER, DB_PWD,[PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION]);
        // retour de la connexion
        return $db;

        // en cas d'erreur on capture celle-ci dans $e
    } catch (PDOException $e) {
        // envoie l'erreur de connexion
        return utf8_encode($e->getMessage() . "\n" . $e->getCode());
    }
}