<?php

/**
 * ***************************** FONCTIONS DE DEBUG ******************************
 */

// fonction d'affichage d'un print_r() [2ème paramètre = 1] et d'un var_dump() [2ème paramètre = 2] avec balise <pre>
function debug($param, $exit = 2)
{
    if ($exit === 1) {
        echo '<pre style="background-color: #d5ecd4 ; padding: 1vh 5vh;">';
        echo '<strong>print_r($param)</strong> <br>';
        print_r($param);
        echo '</pre>';
    } elseif ($exit === 2) {
        echo '<pre style="background-color: #ebd4cb; padding: 1vh 5vh;">';
        echo '<strong>var_dump($param)</strong> <br>';
        var_dump($param);
        echo '</pre>';
    }
}


/**
 * FONCTIONS MEMBRES
 */
// fonction qui m'indique si l'internaute est connecté
function internauteEstConnecte() {
    /*
    if (isset($_SESSION['membre'])) {
        return true; // si l'indice "membre" existe dans la session, c'est que l'internaute est passé par le formulaire de connexion avec le login/mdp. On retourne donv "true"
    } else {
        return false; // dans le cas contraire (il n'est pas connecté) on retourne "false"
    }
    */

    // ECRITURE SIMPLIFIEE
    return (isset($_SESSION['membre']));
}


// fonction qui m'indique si l'internaute est administrateur et est connecté
function internauteEstConnecteEtAdmin() {
    if (internauteEstConnecte() && $_SESSION['membre']['statut'] == 1) { // $_SESSION est un array multidimensionnel 
        return true;
    } else {
        return false;
    }
}

/**
 * ***************************** FONCTION DE REQUETE ******************************
 */
//$membre = $executeRequete("SELECT * FROM membre WHERE pseudo = :pseudo", array(':pseudo' => $_POST['pseudo']));

function executeRequete($requete, $param = array()) {
    
    if (!empty($param)) { // si j'ai bien reçu un array rempli (non vide), je peux faire la foreach dessus pour transformer les caractères spéciaux en entités HTML
        // en PHP si le tableau est vide la foreach génère une erreur car elle va tenter de parcourir le tableau même vide
        foreach ($param as $indice => $valeur) {
            $param[$indice] = htmlspecialchars($valeur, ENT_QUOTES); // pour éviter les injections CSS et JS
        }
    }

    global $pdo; // permet d'avoir accès (à l'intérieur de la fonction) à la variable $pdo définie dans l'espace global (à l'extérieur de la fonction)

    $resultat = $pdo->prepare($requete); // on prépare la requête fournie lors de l'appel de la fonction
    $resultat->execute($param); // on exécute en liant les marqueurs aux valeurs qui se trouvent dans l'array $param fourni lors de l'appel de la fonction, et comme execute() fonctionne même si on ne lui passe pas d'argument si mon array $param est vide il n'y aura pas d'erreur

    return $resultat; // on retourne l'objet PDOStatement à l'endroit ou la fonction executeRequete() est appelée
}
