<?php
require_once "config.php";
require_once "01-connection.php";
require_once "fonctions.php";

// connexion via mysqli
$dbMysqli = connectMysqli();

// connexion via PDO
$dbPDO = connectPDO();


/*
 * insertion en mysqli
 */

// création d'un article
$recup_value = createDatasArticles();

// requête SQL en texte
$sql = "INSERT INTO articles (thetitle,thetext,users_idusers) VALUES ('" . $recup_value['thetitle'] . "'
,'" . $recup_value['thetext'] . "'
," . $recup_value['users_idusers'] . ")";

// insertion réelle dans la DB
$insert = mysqli_query($dbMysqli, $sql);
if (!$insert) {
    echo mysqli_error($dbMysqli) . "<br>";
}
echo "$insert<br>";
echo "Nombre de ligne(s) insérée(s) : " . mysqli_affected_rows($dbMysqli);

/*
 * insertion en PDO
 */

// création d'un article
$recup_value = createDatasArticles();

// requête SQL en texte
$sql = "INSERT INTO articles (thetitle,thetext,users_idusers) VALUES ('" . $recup_value['thetitle'] . "'
,'" . $recup_value['thetext'] . "'
," . $recup_value['users_idusers'] . ")";

// on utilise $db->exec(sql) pour les insert, delete et update, $insert contient le nombre de lignes insérées
$insert = $dbPDO->exec($sql);

echo "<br>Nombre de ligne(s) insérée(s) : $insert";
echo "<hr>";

/*
 * Affiche grâce à la connexion PDO et une requête les 10 derniers articles
 */

// requête MySQL ou MariaDB
$sql = "SELECT * FROM articles ORDER BY thedate DESC LIMIT 0,10";

// exécution de la requête (par défaut autocommit est activé => exécution immédiate sur le serveur de DB)
$request = $dbPDO->query($sql);

// Si on n'a pas récupéré de résultat
if (!$request->rowCount()) {
    echo "<h3>Vous n'avez pas récupéré d'articles</h3>";

}

// transformation du résultat de la requête en tableau indexé (toujours pour fetchAll) avec des valeurs de type objets (PDO::FETCH_OBJ)
$recup10LastArticles = $request->fetchAll(PDO::FETCH_OBJ);


// Portabilité du code (inutile en mySQL ou MariaDB): remise de la requête à son état initial
$request->closeCursor();

// affichage du nombre de résultat
echo "<h2>Affichage des {$request->rowCount()} dernier article(s)</h2>";

foreach ($recup10LastArticles as $item):
    ?>
    <h3><?= $item->thetitle ?></h3>
    <p><?= $item->thetext ?></p>
    <p><?= $item->thedate ?></p>
    <hr>
<?php
endforeach;
?>
