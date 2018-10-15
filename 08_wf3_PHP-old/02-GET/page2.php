<?php

/**
 * **********************
 * ⭐La superglobale $_GET⭐
 * **********************
 * $_GET représente l'url
 * Il s'agit d'une superglobale, et comme toutes les superglobales, il s'agit d'un array
 * "Superglobale" signifique que ce tableau est disponible dans tous les contextes du script, y 
 * compris dans l'espace local des fonctions
 * 
 * Dans notre exemple, les informations transitent dans l'url de la manière suivante :
 *      ?article=jean&couleur=bleu&prix=30
 * 
 * La syntaxe de l'url est donc : page-de-destination.php?indice1=valeur1&indice2=valeur2&indiceN=valeurN
 * 
 * Le "&" indique que l'on change d'indice dans l'array $_GET
 * 
 * La supergobale $_GET transforme les informations passées dans l'url en cet array :
 *      $_GET = array('indice1' => 'valeur1', 'indice2' => 'valeur2', 'valeurN' => 'valeurN');
 */

// fonction d'affichage d'un var_dump() avec balise <pre>
function debugV($param) {
    echo '<pre style="background-color: #ebd4cb;">';
    echo '<strong>var_dump()</strong> <br>';
        var_dump($param);
    echo '</pre>';
}

 debugV($_GET);

if (isset($_GET['article']) && isset($_GET['couleur']) && isset($_GET["prix"])) {
    // si existent les indices "article" et "couleur" et "prix", alors on peut afficher les valeurs, sinon on met un message à l'internaute
    echo '<p>Article : ' . $_GET['article'] . '</p>';
    echo '<p>Article : ' . $_GET['couleur'] . '</p>';
    echo '<p>Article : ' . $_GET['prix'] . ' €</p>';
    echo '<h1>Détails du produit</h1>';
} else {
    echo '<p>Ce produit n\'existe pas !</p>';
}

if(!$_GET){
    echo '<p>$_GET est vide !!!</p>';
}




