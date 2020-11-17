<?php
require_once "03-connect-simple.php";

$sql=" INSERT INTO articles (thetitle,thetext,users_idusers) VALUES('coucou3','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer vel dapibus urna, scelerisque gravida lacus. Mauris at ligula purus. Nunc semper semper pellentesque. Duis at magna dapibus, lobortis lectus lacinia, pulvinar leo. Aliquam dignissim tellus nec eros bibendum dapibus. Nunc dapibus urna sit amet tincidunt condimentum. Cras eleifend a tortor at sollicitudin. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae;Vivamus eget ligula nibh. Suspendisse dapibus quam euismod tortor facilisis condimentum. Duis rutrum tortor ut fermentum condimentum. Suspendisse vestibulum sapien est, vitae dignissim libero fringilla in. Phasellus pretium nibh ac enim tincidunt, nec tincidunt lectus tristique.',2);";

// insertion
$nb = $connexion->exec($sql);

// récupération du dernier id inséré (par cet utilisateur, attention si on insert de multiples articles en une requête, il va nous donner le premier article de cette requête!!! https://www.php.net/manual/fr/pdo.lastinsertid.php)
$lastid = $connexion->lastInsertId();


// update
$nbupdate = $connexion->exec("UPDATE articles SET thetext = 'lalala lala' WHERE idarticles > 7 ");

// delete
$nbdelete = $connexion->exec("DELETE FROM articles WHERE idarticles = 8");


?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDO->exec()</title>
</head>
<body>
<h1>PDO</h1>
<h2>exec</h2>
<h3>On utilise InstancePDO->exec("sql") pour les INSERT, UPDATE et DELETE</h3>
<p>Contrairement à mysqli procédural, les requêtes d'un CRUD ne se font pas avec les mêmes méthodes</p>
<p>$instancePDO->exec() va nous renvoyer le nombre de lignes affectées</p>
<?php echo (isset($erreur))? $erreur : "$nb articles insérés dans la DB<br>$nbupdate article mis à jour<br>$nbdelete article supprimé" ?>
</body>
</html>
