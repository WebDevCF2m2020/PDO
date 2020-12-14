<?php
require_once "config.php";
require_once "01-connection.php";


// connexion via PDO
$dbPDO = connectPDO();

/*
 * Si on veut insérer un article
 * Insertion avec marqueurs non nommés et bindValue
 */
if(isset($_POST['thetitle'])){

    // important de traiter les variables, les requêtes préparées préviennent des injection SQL, mais pas de la validité des données insérées !
    $thetitle = strip_tags(trim($_POST['thetitle']));
    $thetext = strip_tags(trim($_POST['thetext']));
    $users_idusers = (int) $_POST['users_idusers'];

    // Si pas d'erreurs de la part de l'utilisateur
    if(!empty($thetitle)&&!empty($thetext)&&!empty($users_idusers)) {

        // les marqueurs non nommés se lisent dans le sens de la lecture (gauche à droite): 1, 2, 3
        $sql = "INSERT INTO articles (thetitle,thetext,users_idusers) VALUES (?,?,?)";

        // on prépare la requête
        $prepare = $dbPDO->prepare($sql);

        // on attribue les valeurs grâce au bindValue()
        $prepare->bindValue(1, $thetitle, PDO::PARAM_STR);
        $prepare->bindValue(2, $_POST['thetext'], PDO::PARAM_STR);
        $prepare->bindValue(3, $_POST['users_idusers'], PDO::PARAM_INT);

        try {
            // exécution de la requête
            $prepare->execute();
            $message = "Article inséré";
        } catch (PDOException $e) {
            $message = "Erreur lors de l'insertion: " . $e->getMessage();
        }

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
    <title>Insertion préparée et affichage des articles</title>
</head>
<body>
<h2>Insertion d'un nouvel article</h2>
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
