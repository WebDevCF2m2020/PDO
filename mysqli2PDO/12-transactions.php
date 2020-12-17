<?php
// dependances
require_once "config.php";

// connexion PDO
try {

    // connexion réelle à PDO avec le driver PDO_MYSQL, nous n'avons pas activé l'affichage d'erreurs
    $db = new PDO(DB_TYPE . ":host=" . DB_HOST . ";dbname=" . DB_NAME . ";port=" . DB_PORT . ";charset=" . DB_CHARSET, DB_LOGIN, DB_PWD);

// en cas d'erreur on capture celle-ci dans $e
} catch (PDOException $e) {
    // arrêt et affiche de l'erreur de connexion
    die($e->getMessage() . "\n" . $e->getCode());
}



/*
 * Si on veut insérer un article
 * Insertion avec marqueurs nommés ou paramètres
 */
if(isset($_POST['thetitle'])){

    // important de traiter les variables, les requêtes préparées préviennent des injection SQL, mais pas de la validité des données insérées !
    $thetitle = strip_tags(trim($_POST['thetitle']));
    $thetext = strip_tags(trim($_POST['thetext']));
    $users_idusers = (int) $_POST['users_idusers'];

    // Si pas d'erreurs de la part de l'utilisateur
    if(!empty($thetitle)&&!empty($thetext)&&!empty($users_idusers)) {

        // pour la transaction, on utilise un try catch
    try {
    // On va démarrer une transaction, on doit pour utiliser efficacement le try catch, donc on active les erreurs avec setAttribute
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // On lance la transaction, ce qui désactive l'autocommit
    $db->beginTransaction();


    // les marqueurs ont un ordre de gauche à droite
    $sql = "INSERT INTO articles (thetitle,thetext,users_idusers) VALUES (?,?,?)";

    // on prépare la requête
    $prepare = $db->prepare($sql);


    // exécution de la requête préparée avec passage immédiat des marqueurs dans execute([]) (! pas de conversion de type, il faut vraiment avoir protégé ses variables avant)
    $prepare->execute([$thetitle, $thetext, $users_idusers,]);

    // la modification des variables du prepare après l'exécute fonctionne car on a utilisé un bindParam()
    $thetitle .= " c'est mieux bindParam! ";
    $thetext .= " encore du blabla";

    // exécution de la requête préparée, on doit repasser les éléments
    $prepare->execute(array("A" . $thetitle, "A" . $thetext, $users_idusers,));

    $update = $db->exec("UPDATE users SET thelogin='AAA', thename='AAAA' WHERE idusers= 5");

    $insert = $db->exec("INSERT INTO users (thelogin,thename,thepwd) VALUES('lalala3','lalala3','labvc')");




    // envoi de nos requêtes et tentative d'exécutions côté SQL
    $db->commit();

    $message = "Article inséré";


    // en cas d'erreur
    }catch(Exception $e){
        // on supprime les requêtes qui se trouvent entre beginTransaction et le commit en cas d'erreur lors d'une seule des requêtes
        $db->rollBack();
        echo $e->getMessage();
    }

    }else{
        $message = "Vos données ne sont pas au format adéquat";
    }
}


/*
 * Récupération de tous les utilisateurs
 */

$sql="SELECT idusers, thelogin FROM users ORDER BY thelogin ASC";

$request = $db->query($sql);

$users = $request->fetchAll(PDO::FETCH_OBJ);

$request->closeCursor();

/*
 * Récupération des 20 derniers articles
 */

// requête MySQL ou MariaDB prioritairement par date, puis dans un second temps par son id
$sql = "SELECT idarticles, thetitle, thetext, thedate 
            FROM articles ORDER BY thedate DESC, idarticles DESC 
        LIMIT 0,20";

// on va préparer la requête, même si dans ce cas c'est inutile (pas de marqueurs nommés ou non nommés (?))
$request= $db->query($sql);

// transformation du résultat de la requête en tableau indexé (toujours pour fetchAll) avec des valeurs de type objets (PDO::FETCH_OBJ)
$recupAllArticles = $request->fetchAll(PDO::FETCH_OBJ);


// Portabilité du code (inutile en mySQL ou MariaDB): remise de la requête à son état initial
$request->closeCursor();

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>La transaction en PDO</title>
</head>
<body>
<h2>La transaction permet de garder les propriétés ACID de requêtes SQL</h2>
<p><a href="https://fr.wikipedia.org/wiki/Propri%C3%A9t%C3%A9s_ACID">Transaction ACID</a></p>
<p>Lorsqu'on effectue un exec, un query, un prepare suivi d'un execute, l'autocommit est activé, c'est à dire que la requête est effectuée dès l'appel d'une de ces fonction.</p>
<h3>La transaction désactive l'autocommit !</h3>
<p>Ne pas oublier d'activer les erreurs PDO pour faire fonctionner le try/catch</p>
<code>try{ $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);</code>
<h4>Ouverture de transaction</h4>
<code>$db->beginTransaction();</code>
<h4>Exécution de toutes le requêtes nécessaires à notre transaction (insert, delete, update, parfois select)</h4>
<code>$db->query(); $db->query(); ....</code>
<h4>Envoi de toutes les requêtes avec le commit</h4>
<code>$db->commit()</code>
<h4>Pas d'erreurs, pas de catch, la transaction est validée par le commit</h4>
<h4>En cas d'erreur le catch lance un retour en arrière: $db->rollBack()</h4>
<code>..}catch(Exception $e){ $db->rollBack()}</code>
<h3>Toutes les modifications sont annulées et remise à leur état initial</h3>


<?php
if(isset($message)) echo "<h3>$message</h3>";
?>
<form action="" name="insert" method="post">
    <input type="text" name="thetitle" placeholder="Votre titre" required><br>
    <textarea name="thetext" placeholder="Votre texte" required></textarea><br>
    <select name="users_idusers" required>
        <?php
        foreach ($users as $user):
        ?>
        <option value="<?=$user->idusers?>"><?=$user->thelogin?></option>
        <?php
        endforeach;
        ?>
    </select><br>
    <input type="submit" value="Insérer l'article">
</form>
<h2>Affichage des <?=$request->rowCount()?> dernier articles</h2>
<p>
<?php
// var_dump($_POST);

foreach ($recupAllArticles as $item):
?>
<h4><?=$item->idarticles?> | <?=$item->thetitle ?> | <?=$item->thedate ?></h4>
<p><?=$item->thetext ?></p>
<?php
endforeach;
?></p>
<hr>
</body>
</html>
