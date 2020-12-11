<?php
// dependencies
require_once "config.php";

// connection
try {
    // les erreurs sont immédiatement activées dans la connexion
    $connexion = new PDO(DB_TYPE.":host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET.";port=".DB_PORT, DB_LOGIN, DB_PWD,[PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION]);

}catch(PDOException $e){
    die($e->getCode()." : ".$e->getMessage());
}

// on essaye d'insérer le formulaire (donc données utilisateur)
if(!empty($_POST)){
    // protection procédurale
    $thelogin = htmlspecialchars(strip_tags(trim($_POST['thelogin'])),ENT_QUOTES);
    $thepwd= htmlspecialchars(strip_tags(trim($_POST['thepwd'])),ENT_QUOTES);
    $thename = htmlspecialchars(strip_tags(trim($_POST['thename'])),ENT_QUOTES);


        // requête préparée avec les marqueurs ?
        $sql = "INSERT INTO users (thelogin,thepwd,thename) VALUES (?,?,?);";

        // prepare prépare réellement la requête stockée dans une variable
        $prepareInsertUsers = $connexion->prepare($sql);

        // attribution des valeurs avec des numériques représentant les ? de la requête préparée en la lisant de gauche à droite (et en commençant par 1), PDO::PARAM_STR :  string, PDO::PARAM_INT : int
        $prepareInsertUsers->bindValue(1,$thelogin,PDO::PARAM_STR);
        $prepareInsertUsers->bindValue(2,$thepwd,PDO::PARAM_STR);
        $prepareInsertUsers->bindValue(3,$thename,PDO::PARAM_STR);



        // insertion avec execute
            $nbInsert = $prepareInsertUsers->execute();
            if($nbInsert){
                $response = "Nouvel utilisateur enregistré";
            }else{

            $response = "Erreur lors de l'insertion";
        }
}

// si on a cliqué sur un utilisateur et que c'est bien un numérique non signé dans le string de la variable get
if(isset($_GET['idusers'])){
    // création d'un marqueur de paramètre non nommé (?) dans la requête
    $sql = "SELECT * FROM users WHERE idusers=? ;";

    // on signifie à PDO qu'on protège la requête en la préparant (autre avantage que la protection: la répétition rapide du code car il reste en mémoi
    //re)
    $prepareUsers = $connexion->prepare($sql);

    // on place la valeur dans la requête préparée, 1 est le premier "?" de la requête lue de gauche à droite, suivi de la valeur que l'on souhaite insérée, puis de manière optionnelle mais recommandée la reconversion dans le type accepté
    $prepareUsers->bindValue(1,$_GET['idusers'],PDO::PARAM_INT);

    // exécution de la requête et récupération de la valeur
    $prepareUsers->execute();

    // on a récupéré un utilisateur
    if($prepareUsers->rowCount()){
        $recupUsers = $prepareUsers->fetch(PDO::FETCH_ASSOC);
        $response = "Vous avez sélectionné ".$recupUsers["thename"];
    }
}

// récupération de données
$sql="SELECT * FROM users;";
$recup = $connexion->query($sql);


// transformation en données exploitables par PHP (ici tableau indexé contenant des objets de type stdClass)
$recupUsers = $recup->fetchAll(PDO::FETCH_OBJ);
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
    <title>prepare</title>
</head>
<body>
<h3>prepare</h3>
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

//var_dump($_POST,$_GET);

foreach($recupUsers as $users):
?>
<h3><?=$users->thelogin?></h3>
    <p><?=$users->thename?> | <a href="?idusers=<?=$users->idusers?>">détail</a></p>
<?php
endforeach;
?>
</body>
</html>
