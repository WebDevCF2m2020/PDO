<?php


// Count number of articles


/**
 * @param PDO $c
 * @return int
 */
function countAllArticles(PDO $c){
    // le count renvoie une ligne de résultat avec le nombre d'articles, utiliser la clef primaire permet d'éviter qu'il compte réellement le nombre d'articles: c'est un résultat se trouvant en début du code de la table (dans l'index)
    $req = "SELECT COUNT(idarticles) AS nb
FROM articles";
    $recup = $c->query($req);
    $out = $recup->fetch(PDO::FETCH_ASSOC);
    return (int) $out["nb"];
}

// Load all articles with author but with 300 caracters from "texte" with pagination LIMIT

/**
 * @param PDO $cdb
 * @param int $begin
 * @param int $nbperpage
 * @return array|false
 */
function articlesLoadResumePagination(PDO $cdb, int $begin, int $nbperpage=10){

    $req = "SELECT a.idarticles, a.titre, LEFT(a.texte,300) AS texte, a.thedate, u.idusers, u.thename 
FROM articles a 
	INNER JOIN users u 
		ON a.users_idusers = u.idusers
ORDER BY a.thedate DESC 
LIMIT ?, ? ;";

    $prepare = $cdb->prepare($req);
    $prepare->bindParam(1,$begin,PDO::PARAM_INT);
    $prepare->bindParam(2,$nbperpage,PDO::PARAM_INT);

    $prepare->execute();

    if($prepare->rowCount()){
        // on utilise le fetch all car il peut y avoir plus d'un résultat
        return $prepare->fetchAll(PDO::FETCH_ASSOC);
    }
    // no result
    return false;
}

// LOAD full article with ID

/**
 * @param PDO $connect
 * @param int $id
 * @return false|mixed
 */
function articleLoadFull(PDO $connect, int $id){
    $id = (int) $id;
    $req = "SELECT * FROM articles a 
	INNER JOIN users u 
		ON a.users_idusers = u.idusers
    WHERE a.idarticles=?";

    $prepare = $connect->prepare($req);
    $prepare->execute([$id]);
    // si on a 1 résultat
    if($prepare->rowCount()){
        // on utilise le fetch car il ne peut y avoir qu'un résultat
        return $prepare->fetch(PDO::FETCH_ASSOC);
    }
    // no result
    return false;
}

/**
 * insertion d'un nouvel article
 * @param PDO $c
 * @param string $title
 * @param string $text
 * @param int $id
 * @return bool|int|mixed
 */
function insertArticle(PDO $c, string $title, string $text, int $id){

    // prepare la requête
    $sql="INSERT INTO articles (titre,texte,users_idusers) VALUES (?,?,?);";
    $prepare= $c->prepare($sql);
    try {
        $prepare->execute([$title, $text, $id]);
        return true;

    }catch(Exception $exception){
        return $exception->getCode();
    }
}

/**
 * suppression d'un article via son ID
 * @param PDO $connect
 * @param int $id
 * @return bool
 */
function deleteArticle(PDO $connect, int $id){

    $sql="DELETE FROM articles WHERE idarticles=?";

    $prepare = $connect->prepare($sql);

    try{
        $prepare->execute([$id]);
        return true;
    }catch (PDOException $e){
        return false;
    }

}

/*
 * mise à jour de l'article
 * $db -> connexion mysqli
 * $datas -> array de $_POST
 * $id -> variable GET idarticles
 */

function updateArticle($db,$datas,$id){
    // traîtement des variables
    // $_GET
    $id = (int) $id;
    // $_POST => on pourrait utiliser extract(), plus rapide mais dangereux et non sécurisé sans mettre les mêmes lignes que celles ci-dessous
    $idarticles = (int) $datas['idarticles'];
    $titre = htmlspecialchars(strip_tags(trim($datas['titre'])),ENT_QUOTES);
    // exception pour le strip_tags qui va accepter les balises html entre allowable_tags
    $texte= htmlspecialchars(strip_tags(trim($datas['texte']),'<p><br><a><img><h4><h5><b><strong><i><ul><li>'),ENT_QUOTES);
    $thedate = htmlspecialchars(strip_tags(trim($datas['thedate'])),ENT_QUOTES);

    // on vérifie si la date valide existe dans la chaîne, si oui elle est mise dans $tab et séparée du reste
    $tab = preg_grep("/(\d{4})-(\d{2})-(\d{2}) (\d{2}):(\d{2}):(\d{2})/",[$thedate]);
    // si on ne la trouve pas, on met la date du jour
    if(empty($tab)) $thedate = date("Y-m-d H:i:s");


    $users_idusers = (int) $datas['users_idusers'];

    // quelqu'un essaie de modifier un autre article que celui affiché
    if($id!=$idarticles) return "Inutile d'essayer de supprimer un article de quelqu'un d'autre";

    if(empty($id)||empty($idarticles)||empty($titre)||
        empty($texte)||empty($thedate)||empty($users_idusers)) return "Vos champs ne sont pas correctement remplis";

    $sql ="UPDATE articles SET titre = '$titre', texte ='$texte',thedate='$thedate', users_idusers= $users_idusers WHERE idarticles = $idarticles";

   return (mysqli_query($db,$sql))? true : "Erreur inconnue lors de la modification, Veuillez recommencer";


}