<?php
// config+connexion
require_once "03-connect-simple.php";

// on récupère tous les users avec $connexion->query("SELECT");
$recup_users = $connexion->query("SELECT * FROM users");

// on récupère les valeurs formatée en tableau indexé contenant des tableaux associatif (dès que l'on doute que l'on peut avoir plus d'un élément, on utilise le fetchAll! Exception si on utilise une boucle while pour afficher le contenu )
$users = $recup_users->fetchAll(PDO::FETCH_ASSOC);

// pour connaître le nombre d'éléments récupérés

$nb = $recup_users->rowCount();

// fermeture du jeu de données (le pointeur retourne à son état initial, inutile en mysql er MariaDB, mais c'est une bonne pratique de le garder pour la portabilité du code)
$recup_users->closeCursor();



?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDO - Query</title>
</head>
<body>
<h1>PDO</h1>
<h2>query</h2>
<h3>On utilise InstancePDO->query("sql") pour les select</h3>
<p>Contrairement à mysqli procédural, les requêtes d'un CRUD ne se font pas avec les mêmes méthodes</p>
<code>$recup_users = $connexion->query("SELECT * FROM users");</code>
<pre><?php var_dump($recup_users);?></pre>
<code>$nb = $recup_users->rowCount();</code>
<p><?=$nb?></p>
<code>$users = $recup_users->fetchAll(PDO::FETCH_ASSOC);</code>
<?php
foreach($users as $item):
?>
<p><?=$item['thename']?></p>
<?php
endforeach;
?>
</body>
</html>
