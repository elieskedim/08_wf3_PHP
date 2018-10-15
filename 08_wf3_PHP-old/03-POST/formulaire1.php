<?php
/**
 * *************************
 * La superglobale $_POST
 * *************************
 * 
 * $_POST est une superglobale qui permet de récupérer les données saisies dans un formulaire
 * 
 * £_POST est une superglobale donc un array. Il est disponible dans tous les contextes duscript, 
 * y compris au sein des fonction
 * 
 * syntaxe de $_POST$_POST = array('name1' => 'valeur input1', 'nameN' => 'valeur inputN');
 */

 print_r($_POST);
 echo '<hr>';
 
 if(!empty($_POST)) { // si $_POST n'est pas vide c'est qu'on a reçu des données du formulaire (le formulaire a été posté / soumis)
     echo 'Prenom : ' . $_POST['prenom'] . '<br>';
     echo 'Description : ' . $_POST['description'] . '<br>'; // les indices 'prenom' et 'description' proviennent des 'names' du formulaire HTML
     echo '<hr>';
 }

// pour réinitialiser un formulaire avec le dernier code saisi : on clique dans l'url + "entrée"
// pour répéter la dernieère action et donc renvoyer les données du formulaire : F5

 ?>

 <!DOCTYPE html>
 <html lang="fr">
 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <title>Formulaire</title>
 </head>
 <body>
     <h1>Formulaire</h1>
     <form method="post" action="" enctype="">
     <!--METHOD = comment circulent les données en PHP, ENCTYPE concerne la récupération des fichiers, ACTION est l'url de destination des données-->
     <!-- 
        Un formulaire doit TOUJOURS être dans des balises <form> pour fonctionner (envoyer les données)
        l'attribut 'method' définit la méthode d'envoi des saisies vers le serveur
        l'attribut 'action' définit l'url de destination des saisies
      -->
     
         <label for="prenom">Prénom</label>
         <input type="text" id="prenom" name="prenom" required>
         <!--ID fait le lien avec le FOR du label en HTML => quand on clique dans un label le curseur se place dans l'input qui a le même ID.  le NAME est récupéré en PHP. Ce type d'ID étant dans un formulaire il n'y a pas le souci de limiter l'utilisation de l'attribut ID.-->
        <!-- 
            Les 'name' des input constituent les indices de l'array $_POST qui réceptionne les infos
         -->
         <br>
     
         <label for="description">Description</label>
         <textarea id="description" name="description" rows="15" cols="25"></textarea>
         <br>
         <!--zone de texte avec les réglages de sa taille ROWS et COLS-->
        <!-- 
            Les ID et les FOR sont liés : ils permettent de placer le curseur dans l'input quand on clique sur le label
         -->
     
         <input type="submit" name="envoyer" value="Envoyer">
         <input type="reset" name="effacer" value="Recommencer">
         <br>
     
     </form>
 </body>
 </html>
