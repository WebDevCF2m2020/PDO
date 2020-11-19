<?php
// dependencies
require_once "config.php";

// connection
try {
    $connexion = new PDO(DB_TYPE.":host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET.";port=".DB_PORT, DB_LOGIN, DB_PWD);

}catch(PDOException $e){
    die($e->getCode()." : ".$e->getMessage());
}

// Votre code d'insertion se met ici


// récupération de données
$sql="SELECT * FROM users;";
$recup = $connexion->query($sql);
// on peut dire à notre connexion quel genre de fetch on veut utiliser pour notre requête (version longue)
$recup->setFetchMode(PDO::FETCH_OBJ);


// transformation en données exploitables par PHP (ici tableau indexé contenant des objets de type stdClass)
$recupUsers = $recup->fetchAll();
// convention closeCursor
$recup->closeCursor();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h3>Exercice d'insertion d'utilisateurs</h3>
<p>Essayez d'insérer un utilisateur avec le formulaire ci-dessous</p>
<hr>
<form action="" name="forInsert" method="POST">
    <input type="text" name="thelogin" required placeholder="Le login"><br>
    <input type="text" name="thepwd" required placeholder="Le mot de passe"><br>
    <input type="text" name="thename" required placeholder="Le login"><br>
    <input type="submit" value="Insérez">
</form>
<hr>
<?php

var_dump($_POST);

foreach($recupUsers as $users):
?>
<h3><?=$users->thelogin?></h3>
<p><?=$users->thename?></p>
<?php
endforeach;
?>
</body>
</html>
