<?php
/**
 * ****************************
 * La superglobale $_SESSION
 * ****************************
 * 
 * Un fichier temporaire appelé "session" est crée sur le serveur avec un identifiant unique
 * cette session est liée à un seul internaute, car dans le même temps un cookie est déposé sur son poste
 * avec l'identifiant à l'intérieur
 * très souvent le cookie s'appelle PHPSESSID (dépend des serveurs)
 * ce cookie se détruit lorsqu'on quitte le navigateur
 * 
 * Le fichier de session peut contenir toutes sortes d'informations, y compris sensibles, car il n'est pas accessible
 * ni modifiable par l'internaute
 * on peut donc y mettre des logins/mdp, paniers d'achat avant paiement, ...
 * 
 * si l'internaute tente de modifier ce cookie, le lien avec la session est rompu automatiquement, et donc l'internaute est déconnecté
 * 
 * les données du fichier session sont accessible est manipulables à partir de la superglobale $_SESSION
 */


// 1- Ouverture ou création d'une session
session_start(); // permet de créer une session si elle n'existe pas ou de l'ouvrir si elle existe déjà (on a reçu un cookie avec l'ID de session à l'intérieur)
print_r($_SESSION);

// 1.1- remplissage de la session
$_SESSION['pseudo'] = 'Tintin';
$_SESSION['mdp'] = 'Milou'; // $_SESSION étant un array, on utilise la syntaxe avec []


echo '<br> 1- La session après remplissage : ';
print_r($_SESSION);

// dans Xampp cliquer sur l'explorer de xampp => tmp => trier par date
// pour visualiser le fichier de session : xampp > tmp 

// 2- vider une partie de la session
unset($_SESSION['mdp']); // supprime l'indice 'mdp' et la valeur correspondante

echo '<br> 2- La session après suppression du mdp : ';
print_r($_SESSION);

// 3- supprimer entièrement une session ** la ligne suivante est commentée pour passer au fichier session2.php **
// session_destroy(); // on demande la suppression de la session, mais il faut savoir que le session_destroy() est d'abord lu, 
// puis exécuté seulement à la fin du script

echo '<br> 3- La session après session_destroy() : ';
print_r($_SESSION); // on voit encore notre session par la fin du cript se situe après cette ligne
// cependant si on regarde dans le dossier tmp, la session est bien supprimée à ma fin du script


?>