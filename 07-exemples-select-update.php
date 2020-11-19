<?php
// dependencies
require_once "config.php";

// connection
try {
    $connexion = new PDO(DB_TYPE.":host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET.";port=".DB_PORT, DB_LOGIN, DB_PWD);

}catch(PDOException $e){
    die($e->getCode()." : ".$e->getMessage());
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
<h3>$recup->setFetchMode(PDO::FETCH_OBJ);</h3>
<p>Permet de changer le fetch ou le fetchAll d'un c->query, avec un paramètre représenté par une constante de la classe PDO</p>
<h3>$recup->closeCursor();</h3>
<p>Permet la fermeture du jeu de données (le pointeur retourne à son état initial, inutile en mysql et MariaDB, mais c'est une bonne pratique de le garder pour la portabilité du code)</p>
<pre>    PDO::FETCH_ASSOC: retourne un tableau indexé par le nom de la colonne comme retourné dans le jeu de résultats

    PDO::FETCH_BOTH (défaut): retourne un tableau indexé par les noms de colonnes et aussi par les numéros de colonnes, commençant à l'index 0, comme retournés dans le jeu de résultats

    PDO::FETCH_BOUND: retourne TRUE et assigne les valeurs des colonnes de votre jeu de résultats dans les variables PHP à laquelle elles sont liées avec la méthode PDOStatement::bindColumn()

    PDO::FETCH_CLASS: retourne une nouvelle instance de la classe demandée, liant les colonnes du jeu de résultats aux noms des propriétés de la classe et en appelant le constructeur par la suite, sauf si PDO::FETCH_PROPS_LATE est également donné. Si fetch_style inclut PDO::FETCH_CLASS (c'est-à-dire PDO::FETCH_CLASS | PDO::FETCH_CLASSTYPE), alors le nom de la classe est déterminé à partir d'une valeur de la première colonne.

    PDO::FETCH_INTO : met à jour une instance existante de la classe demandée, liant les colonnes du jeu de résultats aux noms des propriétés de la classe

    PDO::FETCH_LAZY : combine PDO::FETCH_BOTH et PDO::FETCH_OBJ, créant ainsi les noms des variables de l'objet, comme elles sont accédées

    PDO::FETCH_NAMED : retourne un tableau de la même forme que PDO::FETCH_ASSOC, excepté que s'il y a plusieurs colonnes avec les mêmes noms, la valeur pointée par cette clé sera un tableau de toutes les valeurs de la ligne qui a ce nom comme colonne

    PDO::FETCH_NUM : retourne un tableau indexé par le numéro de la colonne comme elle est retourné dans votre jeu de résultat, commençant à 0

    PDO::FETCH_OBJ : retourne un objet anonyme avec les noms de propriétés qui correspondent aux noms des colonnes retournés dans le jeu de résultats

    PDO::FETCH_PROPS_LATE : lorsqu'il est utilisé avec PDO::FETCH_CLASS, le constructeur de la classe est appelé avant que les propriétés ne soient assignées à partir des valeurs de colonne respectives.</pre>
<hr>
<?php
foreach($recupUsers as $users):
?>
<h3><?=$users->thelogin?></h3>
<p><?=$users->thename?></p>
<?php
endforeach;
?>
</body>
</html>
