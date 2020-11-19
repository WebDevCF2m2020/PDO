<?php
// dependencies
require_once "config.php";

// connection
try {
    $connexion = new PDO(DB_TYPE.":host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET.";port=".DB_PORT, DB_LOGIN, DB_PWD);
    // on veut voir les erreurs, on peut les activer avec setAttibute (PDO::ATTR_ERRMODE) et les exceptions (PDO::ERRMODE_EXCEPTION)
    $connexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

}catch(PDOException $e){
    die($e->getCode()." : ".$e->getMessage());
}

// Votre code d'insertion se met ici
// si le formulaire est envoyé
if(!empty($_POST)){
    $thelogin = htmlspecialchars(strip_tags(trim($_POST['thelogin'])),ENT_QUOTES);
    $thepwd= htmlspecialchars(strip_tags(trim($_POST['thelogin'])),ENT_QUOTES);
    $thename = htmlspecialchars(strip_tags(trim($_POST['thelogin'])),ENT_QUOTES);
    if(!empty($thelogin)&&!empty($thepwd)&&!empty($thename)){
        $sql = "INSERT INTO users (thelogin,thepwd,thename) VALUES ('$thelogin','$thepwd','$thename');";
        // insertion avec exec
        try {
            $nb = $connexion->exec($sql);
            $response = "Nouvel utilisateur enregistré";
        }catch (PDOException $e){

            // code PDO pour une erreur
            if($e->getCode()==23000){
                // si le code MySQL 1062 se trouve dans le message d'erreur (pas false)
                if(strpos($e->getMessage(),"1062") ) {
                    // le problème vient d'un duplicate content
                    $response = "Votre login et/ ou votre nom existe déjà!";
                }else{
                    $response = "Erreur : " . $e->getMessage();
                }
            }else {
                $response = "Erreur : " . $e->getMessage();
            }
        }

    }else{
        $response = "Le format des champs doit être respecté!";
    }
}

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
<?php if(isset($response)) echo "<h4>$response</h4>" ?>
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
