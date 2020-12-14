<?php
require_once "config.php";
require_once "01-connection.php";


// connexion via PDO
$dbPDO = connectPDO();

/*
 * Si on veut insérer un article
 * Insertion avec marqueurs nommés ou paramètres
 */
if(isset($_POST['thetitle'])){

    // important de traiter les variables, les requêtes préparées préviennent des injection SQL, mais pas de la validité des données insérées !
    $thetitle = strip_tags(trim($_POST['thetitle']));
    $thetext = strip_tags(trim($_POST['thetext']));
    $users_idusers = (int) $_POST['users_idusers'];

    // Si pas d'erreurs de la part de l'utilisateur
    if(!empty($thetitle)&&!empty($thetext)&&!empty($users_idusers)) {

        // les paramètres nommés (marqueurs) n'ont pas d'ordres de lectures format -> :nom (respect de nommage des variables)
        $sql = "INSERT INTO articles (thetitle,thetext,users_idusers) VALUES (:title,:text,:iduser)";

        // on prépare la requête
        $prepare = $dbPDO->prepare($sql);


        // exécution de la requête préparée avec passage immédiat des paramètres dans execute([]) (! pas de conversion de type, il faut vraiment avoir protégé ses variables avant)
        $prepare->execute([":title"=>$thetitle,
                           ":text"=>$thetext,
                           ":iduser"=>$users_idusers,
            ]);

        // la modification des variables du prepare après l'exécute fonctionne car on a utilisé un bindParam()
        $thetitle.=" c'est mieux bindParam! ";
        $thetext.=" encore du blabla";

        // exécution de la requête préparée, on doit repasser les éléments
        $prepare->execute(array(":title"=>"A".$thetitle,
            ":text"=>"A".$thetext,
            ":iduser"=>$users_idusers,
        ));

        // ne fonctionne pas avec le raccourci
        //$thetitle="Totalement arbitraire!";
        //$thetext="J'adore";
        //$prepare->execute();

        $message = "Article inséré";


    }else{
        $message = "Vos données ne sont pas au format adéquat";
    }
}

/*
 * Récupération de tous les utilisateurs
 */

$sql="SELECT idusers, thelogin FROM users ORDER BY thelogin ASC";

$request = $dbPDO->query($sql);

$users = $request->fetchAll(PDO::FETCH_OBJ);

$request->closeCursor();

/*
 * Récupération des 20 derniers articles
 */

// requête MySQL ou MariaDB prioritairement par date, puis dans un second temps par son id
$sql = "SELECT idarticles, thetitle, thetext, thedate 
            FROM articles ORDER BY thedate DESC, idarticles DESC 
        LIMIT 0,20";

// on va préparer la requête, même si dans ce cas c'est inutile (pas de marqueurs nommés ou non nommés (?))
$request= $dbPDO->query($sql);

// transformation du résultat de la requête en tableau indexé (toujours pour fetchAll) avec des valeurs de type objets (PDO::FETCH_OBJ)
$recupAllArticles = $request->fetchAll(PDO::FETCH_OBJ);


// Portabilité du code (inutile en mySQL ou MariaDB): remise de la requête à son état initial
$request->closeCursor();

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Exécution de la requête préparée avec passage immédiat des paramètres dans execute([])</title>
</head>
<body>
<h2>exécution de la requête préparée avec passage immédiat des paramètres dans execute([]), utilisation array(":param1"=>"value", ...)</h2>
<?php
if(isset($message)) echo "<h3>$message</h3>";
?>
<form action="" name="insert" method="post">
    <input type="text" name="thetitle" placeholder="Votre titre" required><br>
    <textarea name="thetext" placeholder="Votre texte" required></textarea><br>
    <select name="users_idusers" required>
        <?php
        foreach ($users as $user):
        ?>
        <option value="<?=$user->idusers?>"><?=$user->thelogin?></option>
        <?php
        endforeach;
        ?>
    </select><br>
    <input type="submit" value="Insérer l'article">
</form>
<h2>Affichage des <?=$request->rowCount()?> dernier articles</h2>
<p>
<?php
// var_dump($_POST);

foreach ($recupAllArticles as $item):
?>
<h4><?=$item->idarticles?> | <?=$item->thetitle ?> | <?=$item->thedate ?></h4>
<p><?=$item->thetext ?></p>
<?php
endforeach;
?></p>
<hr>
</body>
</html>
