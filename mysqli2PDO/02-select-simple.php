<?php
require_once "config.php";
require_once "01-connection.php";

// connexion via mysqli
$dbMysqli = connectMysqli();

$dbPDO = connectPDO();

?>
<pre><?php var_dump($dbMysqli,$dbPDO); ?></pre>

