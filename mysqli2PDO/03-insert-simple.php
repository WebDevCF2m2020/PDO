<?php
require_once "config.php";
require_once "01-connection.php";
require_once "fonctions.php";

// connexion via mysqli
$dbMysqli = connectMysqli();

// connexion via PDO
$dbPDO = connectPDO();


