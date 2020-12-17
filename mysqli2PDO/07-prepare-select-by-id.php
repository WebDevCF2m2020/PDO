<?php
require_once "config.php";
require_once "01-connection.php";


// connexion via PDO
$dbPDO = connectPDO();

/*
 * Récupération d'un article si on a cliqué dessus
 */
// ces protection ctype_digit et la conversion en (int) ne sont en principe pas utiles lorsque la requête est préparée, mais si la requête se trouve dans un modèle, cette partie de code sera dans le contrôleur, et il vaut mieux protéger les variables à tous les niveaux
if(isset($_GET['idArt'])&&ctype_digit($_GET['idArt'])){
    $idart = (int) $_GET['idArt'];

    // requête préparée avec marqueur non nominatif (?)
    $sql = "SELECT * FROM articles WHERE idarticles=?";

    // préparation réelle de la requête
    $prepare = $dbPDO->prepare($sql);

    // attribution des valeurs à notre requête préparée et transformation au format souhaité, injection SQL impossible
    $prepare->bindValue(1,$idart,PDO::PARAM_INT);

    // exécution de la requête préparée
    $prepare->execute();

    // si on a pas récupéré un article
    if(!$prepare->rowCount()){
        $error = "Cet article n'existe plus";
    }
    // création de l'objet d'affichage de l'article
    $recupArticlesById= $prepare->fetch(PDO::FETCH_OBJ);

    // on réinitialise les données
    $prepare->closeCursor();
}


/*
 * Récupération de tous les articles pour le menu
 */

// requête MySQL ou MariaDB prioritairement par date, puis dans un second temps par son id
$sql = "SELECT idarticles, thetitle FROM articles ORDER BY thedate DESC, idarticles DESC";

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
    <title>prepare pour affichage des articles, inutile dans ce cas</title>
</head>
<body>
<h2>Affichage de <?=$request->rowCount()?> article(s)</h2>
<p>
<?php
foreach ($recupAllArticles as $item):

?>
<a href="?idArt=<?=$item->idarticles?>"><?=$item->thetitle ?></a>
<?php
endforeach;
?></p>
<p>
    <?php
    // on a cliqué sur un article mais qu'on en a pas récupéré
    if(isset($error)): echo "<h3>$error</h3>";
    // on a cliqué sur un article valide
    elseif(isset($recupArticlesById)):
    ?>
<h3><?= $recupArticlesById->idarticles ." | ". $recupArticlesById->thetitle ?></h3>
<p><?= $recupArticlesById->thetext ?></p>
<p><?= $recupArticlesById->thedate ?></p>
<hr>
    <?php
    endif;
    ?>
</p>
</body>
</html>
