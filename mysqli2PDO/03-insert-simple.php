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
$sql = "INSERT INTO articles (thetitle,thetext,users_idusers) VALUES ('".$recup_value['thetitle']."'
,'".$recup_value['thetext']."'
,".$recup_value['users_idusers'].")";

// insertion réelle dans la DB
$insert = mysqli_query($dbMysqli,$sql);
if(!$insert){
    echo mysqli_error($dbMysqli)."<br>";
}
echo "$insert<br>";
echo "Nombre de ligne(s) insérée(s) : ".mysqli_affected_rows($dbMysqli);

/*
 * insertion en PDO
 */

// création d'un article
$recup_value = createDatasArticles();

// requête SQL en texte
$sql = "INSERT INTO articles (thetitle,thetext,users_idusers) VALUES ('".$recup_value['thetitle']."'
,'".$recup_value['thetext']."'
,".$recup_value['users_idusers'].")";

// on utilise $db->exec(sql) pour les insert, delete et update, $insert contient le nombre de lignes insérées
$insert = $dbPDO->exec($sql);

 echo "<br>Nombre de ligne(s) insérée(s) : $insert";
 echo "<hr>";

 /*
  * Affiche grâce à la connexion PDO et une requête les 10 derniers articles
  */

