<?php
// dependencies
require_once "config.php";

// on va instancier dans $connexion la classe native PDO (si l'extension est activée) avec le mot clef "new", suivi du nom de la classe et de ses arguments.
$connexion = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=".DB_CHARSET.";port=".DB_PORT,DB_LOGIN,DB_PWD);
?>
<pre>
    <?php
    var_dump($connexion);
    ?>
</pre>
