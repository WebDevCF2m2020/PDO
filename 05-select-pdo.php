<?php
require_once "03-connect-simple.php";

$sql = "SELECT  a.* , u.thename
FROM articles a
	INNER JOIN users u
    ON a.users_idusers = u.idusers
 ORDER BY a.thedate DESC;   ";

// utilisation de query sur l'instance PDO $connexion car SELECT
$recup = $connexion->query($sql);

// si je n'ai pas de résultats
if (!$recup->rowCount()) $erreur = "Pas encore d'articles";

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDO QUERY et fetch dans while</title>
</head>
<body>
<h1>PDO->query et fetch dans un while</h1>
<?php
if (isset($erreur)):
    echo "<h2>$erreur</h2>";
else:
    ?>
    <h2>Nous avons <?= $recup->rowCount() ?> articles</h2>
    <?php
    // $recup->fetch dans un while va lister les résultats un par 1 et transformer $item en alias d'un objet PDO::FETCH_OBJ
    while ($item = $recup->fetch(PDO::FETCH_OBJ)):
        ?>
    <hr>
    <h3><?=$item->thetitle?></h3>
    <p><?=$item->thetext?></p>
    <p>Ecrit par <?=$item->thename?> le <?=$item->thedate?></p>
    <?php
    endwhile;
    ?>
    <hr>
<?php
endif;
?>
</body>
</html>
