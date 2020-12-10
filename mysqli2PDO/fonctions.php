<?php

/**
 * création de données pour l'insertion
 * @return array
 */
function createDatasArticles()
{
// id de l'utilisateur
    $users_idusers = mt_rand(1, 3);
// lettres pour tous
    $lettres = "abcdefoip";
// on mélange les lettres pour le titre str_shuffle
    $thetitle = str_shuffle($lettres);
// on crée un tableau à partir de texte "Lorem Ipsum" divisé par l'espace
    $mots = explode(" ","Lorem ipsum dolor sit amet
consectetur adipisicing elit sed do eiusmod tempor incididunt ut
labore et dolore magna aliqua Ut enim ad minim veniam quis nostrud
exercitation ullamco laboris nisi ut aliquip ex ea commodo
consequat");

// nombre d'éléments dans le tableau

    $nb_mots = count($mots);

// nombre de mots au hasard dans le texte
    $nb_mots_hasard = mt_rand(10,35);

// variable de remplissage du texte
    $thetext="";

    for($i=0;$i<$nb_mots_hasard;$i++){
        $thetext .= $mots[mt_rand(0,$nb_mots-1)]." ";
    }

    return ["thetitle"=>$thetitle,"thetext"=>$thetext,"users_idusers"=>$users_idusers];

}