<?php
require_once "config.php";



/**
 * connexion Mysqli procédural
 * @return false|mysqli
 */
function connectMysqli(){
    // connexion mysqli, l'@ sert à ne pas afficher l'erreur par défaut (Est déconseillé en PHP8)
    $db = @mysqli_connect(DB_HOST,DB_LOGIN,DB_PWD,DB_NAME,DB_PORT);
    // si on a une erreur
    if(mysqli_connect_error($db)){
        // affichage de l'erreur et arrêt du script
        die(utf8_encode(mysqli_connect_error($db)."\n".mysqli_connect_errno()));
    }
    // retour de la connexion
    return $db;
}