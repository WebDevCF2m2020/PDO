<?php
require_once "config.php";
require_once "01-connection.php";

// connexion via mysqli
$dbMysqli = connectMysqli();

// connexion via PDO
$dbPDO = connectPDO();

// simple requête SELECT (sans données utilisateurs => passages de variables)
$sql = "SELECT * FROM users";

// Requête en mysqli
$requestMysqli = mysqli_query($dbMysqli,$sql);
$resultMysqli = mysqli_fetch_all($requestMysqli,MYSQLI_ASSOC);
// vide le jeu de résultats (optionnel,gagne un peu de mémoire)
mysqli_free_result($requestMysqli);

// Requête en PDO, on utilise $db->query QUE pour des SELECT SANS données utilisateurs
$requestPDO =$dbPDO->query($sql);
$resultPDO = $requestPDO->fetchAll(PDO::FETCH_ASSOC);
// remet le jeu de résultat à son état initial (optionnel pour Mysql, mais utile pour d'autres type de DB donc la portabilité du code)
$requestPDO->closeCursor();
/*
 * version courte
 * $resultPDO = $dbPDO->query($sql)->fetchAll(PDO::FETCH_ASSOC);
 */

?>
<pre><?php var_dump($resultMysqli,$resultPDO); ?></pre>

