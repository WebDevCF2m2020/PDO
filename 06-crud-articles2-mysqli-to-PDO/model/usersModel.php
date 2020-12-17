<?php
// connect function

/**
 * @param PDO $connect
 * @param string $login
 * @param string $pwd
 * @return false|array
 */
function connectUser(PDO $connect, string $login, string $pwd){
    // traitement des données
    $login = htmlspecialchars(strip_tags(trim($login)),ENT_QUOTES);
    $pwd = htmlspecialchars(strip_tags(trim($pwd)),ENT_QUOTES);
    // request
    $sql = "SELECT u.idusers, u.thename, d.iddroit, d.droit_name
	FROM users u
    INNER JOIN droit d 
		ON d.iddroit = u.droit_iddroit
    WHERE u.thename=:login AND u.thepwd=:pwd;";

    // prepare request
    $prepare = $connect->prepare($sql);

    // param request
    $prepare->bindValue(":login",$login,PDO::PARAM_STR);
    $prepare->bindValue(":pwd",$pwd,PDO::PARAM_STR);

    // send request
    $prepare->execute();

    if($prepare->rowCount()){
        return $prepare->fetch(PDO::FETCH_ASSOC);
    }else{
        return false;
    }

}

// find all user (Rédacteur and administateur)

/**
 * @param PDO $c
 * @return array|false
 */
function AllUser(PDO $c){
    $sql="SELECT idusers, thename FROM users ORDER BY thename ASC;";
    $recup = $c->query($sql);
    if($recup->rowCount()) {
        return $recup->fetchAll(PDO::FETCH_ASSOC);
    }
    return false;
}