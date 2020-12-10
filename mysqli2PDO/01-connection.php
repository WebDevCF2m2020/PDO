<?php
require_once "config.php";


/**
 * connexion Mysqli procédural
 * @return false|mysqli
 */
function connectMysqli()
{
    // connexion mysqli, l'@ sert à ne pas afficher l'erreur par défaut (Est déconseillé en PHP8)
    $db = @mysqli_connect(DB_HOST, DB_LOGIN, DB_PWD, DB_NAME, DB_PORT);
    // si on a une erreur
    if (mysqli_connect_error($db)) {
        // affichage de l'erreur et arrêt du script
        die(utf8_encode(mysqli_connect_error($db) . "\n" . mysqli_connect_errno()));
    }
    // on communique en utf8 entre nos pages et la DB
    mysqli_set_charset($db, DB_CHARSET);
    // retour de la connexion
    return $db;
}

/**
 * Connexion PDO orientée objet
 * @return PDO
 */
function connectPDO()
{
    // Essais / erreurs
    try {
        // création de notre connexion PDO (instanciation de la classe PDO) sans les arguments non obligatoires
        $db = new PDO(DB_TYPE . ":host=" . DB_HOST . ";dbname=" . DB_NAME . ";port=" . DB_PORT . ";charset=" . DB_CHARSET, DB_LOGIN, DB_PWD);

        // si on pas est en production (activation de l'affichage des erreurs)
        if (PROD === false) {
            // on va activer en dehors de notre connexion l'affichage des erreurs (par défaut une erreur PDO SQL de requête ne s'affiche pas)
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        // retour de la connexion
        return $db;

        // en cas d'erreur on capture celle-ci dans $e
    } catch (PDOException $e) {
        // arrêt et affiche de l'erreur de connexion
        die($e->getMessage() . "\n" . $e->getCode());
    }
}