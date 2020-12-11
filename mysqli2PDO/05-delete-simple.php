<?php
require_once "config.php";
require_once "01-connection.php";

// connexion via mysqli
// $dbMysqli = connectMysqli();

// connexion via PDO
$dbPDO = connectPDO();

/*
 * suppression d'articles au hasard
 */

// variables pour supprimer maximum 3 articles (si ils existent)
$un = mt_rand(1,83);
$deux = mt_rand(1,83);
$trois = mt_rand(1,83);


$sql = "DELETE FROM articles WHERE idarticles IN ($un,$deux,$trois)";

// suppression de 0 à 3 articles
$nbDelete = $dbPDO->exec($sql);

/*
 * Récupération de tous les articles
 */

// requête MySQL ou MariaDB prioritairement par date, puis dans un second temps par son id
$sql = "SELECT * FROM articles ORDER BY thedate DESC, idarticles DESC";

// exécution de la requête (par défaut autocommit est activé => exécution immédiate sur le serveur de DB)
$request = $dbPDO->query($sql);

// transformation du résultat de la requête en tableau indexé (toujours pour fetchAll) avec des valeurs de type objets (PDO::FETCH_OBJ)
$recup10LastArticles = $request->fetchAll(PDO::FETCH_OBJ);


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
    <title>Suppression au hasard de certains articles</title>
</head>
<body>
<h2>Affichage de <?=$request->rowCount()?> article(s)</h2>
<h3><?=$nbDelete?> articles ont été supprimés au chargement de cette page</h3>

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
