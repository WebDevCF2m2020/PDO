<?php
require_once "config.php";
require_once "01-connection.php";

// connexion via mysqli
$dbMysqli = connectMysqli();

// connexion via PDO
$dbPDO = connectPDO();

/*
 * création de données pour l'insertion
 */
function createDatasArticles()
{
// id de l'utilisateur
    $users_idusers = mt_rand(1, 3);
// lettres pour tous
    $lettres = "abcdefoip";
// on mélange les lettres pour le titre str_shuffle
    $thetitle = str_shuffle($lettres);
// on crée un tableau à partir de texte "Lorem Ipsum" divisé par l'espace
    $mots = explode(" ","Lorem ipsum dolor sit amet
consectetur adipisicing elit sed do eiusmod tempor incididunt ut
labore et dolore magna aliqua Ut enim ad minim veniam quis nostrud
exercitation ullamco laboris nisi ut aliquip ex ea commodo
consequat");

}

echo createDatasArticles();