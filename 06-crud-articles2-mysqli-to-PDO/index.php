<?php
// front controller

// session for all
session_start();


// dependencies
require_once "config.php";
// mysqli connection
require_once "model/connectDB.php";
// PDO connection
require_once "model/connectDbPDO.php";

// DB connection mysqli
$db = connectDB();

// Db PDO connection
$dbPDO = connectDbPDO();

// var_dump($db,$dbPDO);


// connect mysqli error
if(!$db){
    // view  connect error
    include "view/errorConnectView.php";
    // stop working
    die();
}

// connect PDO error
// $dbPDO vaut une chaîne de caractère en cas d'erreur
if(is_string($dbPDO)){
    // view  connect error
    include "view/errorConnectPDOView.php";
    // stop working
    die();
}

if(isset($_SESSION['identifiant'])&&$_SESSION['identifiant']==session_id()){

    // si on est admin
    if($_SESSION['iddroit']==1){
        require_once "controller/adminController.php";
        exit;
    }
    // si on est rédact.eur.rice
    if($_SESSION['iddroit']==2){
        require_once "controller/redacController.php";
        exit;
    }


}

// loading du contrôleur public si aucune condition ne sont vraies avant
require_once "controller/publicController.php";
