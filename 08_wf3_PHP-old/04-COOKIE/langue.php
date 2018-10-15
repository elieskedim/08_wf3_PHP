<?php
/**
 * ******************************
 * La superglobale $_COOKIE
 * ******************************
 * Le cookie est un petit fichier (4 Ko max) déposé par le serveur HTTP du site sur le poste de l'internaute, et qui 
 * peut contenir des information
 * Il est lié à une url particulière
 * Les cookies sont automatiquement renvoyés au serveur web par le navigteur lorsque l'internaute navigue dans les 
 * pages concernées par le cookie
 * PHP permet de récupérer très facilement les données contenues dans un cookie : elles sont stockées dans la
 * superglobale $_COOKIE
 * 
 * Précaution à prendre avec les cookies :
 * le cookie étant sauvegardé sur le poste de l'internaute, il peut être volé ou détourné
 * on n'y mettra donc pas d'informations sensibles (mot de passe, carte bancaire ...), mais des informations relatives
 * aux préférences ou aux traces de visite (produits consultés ...)
 */

  
// 1- HTML (on écrit le HTML puis on affiche le contenu de $_GET)

print_r($_GET);


// 2- On détermine la langue à afficher dans la variable $langue :
if (isset($_GET['langue'])) {
    $langue = $_GET['langue']; // si l'indice "langue" existe, c'est qu'on a cliqué sur un lien. 
    // On affecte donc sa valeur à la variable $langue
} elseif (isset($_COOKIE['langue'])) {
    $langue = $_COOKIE['langue']; // $_COOKIE est une superglobale : son indice correspond au nom du cookie reçu
    // si non, $_COOKIE existe, c'est quon a reçu un cookie de nom "langue" et on affecte donc sa valeur à la variable $langue
} else {
    $langue = 'fr'; // par défaut, si (1) on n'a pas cliqué sur un lien et (2) si le cookie langue n'existe pas on choisit "fr
}


// 3- Création du cookie :
$un_an = 365 * 24 * 60 * 60; // jours - heures - minutes - secondes => exprime un an en secondes

setcookie('langue', $langue, time() + $un_an); // on envoie un cookie chez l'internaute avec un nom, une valeur et une date d'expiration exprimée en timestamp (maintenant + 1 an)
// setcookie() permet de créer un cookie et de l'envoyer sur le poste client
// il n'existe pas de fonction prédéfinie pour supprimer un cookie
// dans ce cas, on le met à jour avec : 
// - une date périmée
// - ou à zéro
// - ou en ne mettant que le nom du cookie dans les parenthèses de setcookie()


// 4- Affichage de la langue :
echo 'Le site est affiche en : ' . $langue . '<hr>';

// dans FireFox - console => Stockage => Cookies => localhost
// Chrome - console => Application => Cookies => localhost





?>

<h1>Votre langue :</h1>

<!-- ul>(li>a[href="?langue="])*4 -->
<ul>
    <li><a href="?langue=fr">Français</a></li>
    <li><a href="?langue=es">Espagnol</a></li>
    <li><a href="?langue=it">Italien</a></li>
    <li><a href="?langue=uk">Anglais</a></li>
</ul>