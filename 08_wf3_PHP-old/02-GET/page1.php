<?php

/**
 * GET envoie des infos du client / navigateur vers le serveur
 * 
 * Côté serveur
 * les infos passées après le "?" dans l'url sont réceptionnées dans un array $_GET
 * ex de recherche sur google sur le mot php l'url devient https://www.google.com/search?q=php&ie=utf-8&oe=utf-8&client=firefox-b-ab
 * 
 * le array $_GET est alors rempli ainsi
 *  --------------------------------
 *  | q         | php 
 *  --------------------------------
 *  | ie        | utf-8 
 *  --------------------------------
 *  | oe        | utf-8 
 *  --------------------------------
 *  | client    | firefox-b-ab
 *  --------------------------------
 */
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nos produits</title>
</head>
<body>
    <h1>Nos produits</h1>

    <a href="page2.php?article=jean&couleur=bleu&prix=30">Jean bleu</a>
    <br>
    <a href="page2.php?article=robe&couleur=rouge&prix=35">Robe rouge</a>
    <br>
    <a href="page2.php?article=pull&couleur=blanc&prix=50">Pull blanc</a>



</body>
</html>
