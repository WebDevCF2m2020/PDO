<?php
require_once "config.php";
require_once "01-connection.php";
require_once "fonctions.php";


// connexion via PDO
$dbPDO = connectPDO();



/*
 * Récupération de tous les articles
 */

// requête MySQL ou MariaDB prioritairement par date, puis dans un second temps par son id
$sql = "SELECT * FROM articles ORDER BY thedate DESC, idarticles DESC";

// on va préparer la requête, même si dans ce cas c'est inutile (pas de marqueurs nommés ou non nommés (?))
$prepare = $dbPDO->prepare($sql);

// on va exécuter la requête préparée
$prepare->execute();

// transformation du résultat de la requête en tableau indexé (toujours pour fetchAll) avec des valeurs de type objets (PDO::FETCH_OBJ)
$recup10LastArticles = $prepare->fetchAll(PDO::FETCH_OBJ);


// Portabilité du code (inutile en mySQL ou MariaDB): remise de la requête à son état initial
$prepare->closeCursor();

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
<h2>Affichage de <?=$prepare->rowCount()?> article(s)</h2>

<?php
foreach ($recup10LastArticles as $item):

?>
<h3><?= $item->idarticles ." | ". $item->thetitle ?></h3>
<p><?= $item->thetext ?></p>
<p><?= $item->thedate ?></p>
<hr>
<?php
endforeach;
?>
</body>
</html>
