<?php
// procedural mysqli connection

//function connectDB(){
   // $connect = @mysqli_connect(DB_HOST,DB_USER,DB_PWD,DB_NAME, DB_PORT);
    // if error
    //if(mysqli_connect_errno()){
      //  return false;
    //}
    // change charset
    //mysqli_set_charset($connect,DB_CHARSET);

    //return $connect;
//}

//Connexion PDO
//dependencies
require_once "config.php";

//on va instancier la classe native PDO (si l'extensione est activée)
//pour instancier un élément il faut d'abord créer une variable qui va contenir notre élément 
//pour instancier une class on va toujours utiliser le mot clé new
//dans les parenthèse on va d'abord placer une chaîne de caractères la connexion à la DB avec la création d'un objet
$connexion= new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";port=".DB_PORT.";charset=".DB_CHARSET,DB_USER,DB_PWD);
?>
<pre>
    <?php
    var_dump($connexion);
    ?>
    </pre>