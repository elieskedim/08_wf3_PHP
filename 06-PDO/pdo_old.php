<?php

/**
 * **********************
 *          PDO
 * **********************
 * PHP Data Objects (objets de données PHP)
 * 
 * PDO est une interface qui permet de se connecter à une base de données depuis le PHP
 */

 // fonction d'affichage d'un print_r() avec balise <pre>
 function debugP($param) {
     echo '<pre style="background-color: #d5ecd4 ;">';
     echo '<strong>print_r($param)</strong> <br>';
         print_r($param);
     echo '</pre>';
 }


//-------------------------------
echo '<h3> 01 - Connexion </h3>';
//-------------------------------
$pdo = new PDO('mysql:host=localhost;dbname=entreprise', // driver (càd système de gestion de BDD) ici mysql (pourraît etre Oracle, IBM, ODBC ...) + nom du serveur de la BDD + nom de la BDD
            'root', // pseudo de la BDD
            'root', // mot de passe de la BDD
            array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, // pour afficher les messages d'erreurs SQL
                  PDO::MYSQL_ATTR_INIT_COMMAND => 'set NAMES utf8' // définition du jeu de caractères des échanges avec la BDD
            )
);
// mysql => système de gestion de BDD (aurait pût être du Oracle, IBM, ODBC ...)
// host => serveur où est la BDD
// dbname => nom de la BDD
// 'root' => login
// '' => mdp ('root' sur Macs)
// PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, ==> affichage des erreurs SQL en mode 'avertissement' non bloquant
// :: se met après une classe (ici on a des constantes de classes en majuscules) et remplace la -> qui est utilisée après un objet


// $pdo est un objet issu de la classe prédéfinie PDO, il représente la connexion à la BDD ici "societe"


//----------------------------------------
echo '<h3> 02 - La méthode exec() </h3>';
//----------------------------------------
// exec() est utilisée pour la formulation de requêtes de retournant pas de résultat : INSERT, UPDATE, DELETE

$resultat = $pdo->exec("INSERT INTO employes(prenom, nom, sexe, service, date_embauche, salaire) VALUES ('test', 'test', 'm', 'test', '2016-02-08', 500)");
// les objets qui viennent de la BDD ne prennet pas de quotes, les valeurs à insérer par contre oui elles prennent des quotes

/**
 * Valeur de retour :
 *  - Succès : renvoie le nombre de lignes affectées par la requête
 *  - Echec : retourne false
 */

//echo 'Nombre de lignes affectées par la requête INSERT INTO : ' . $resultat . '<br>';
echo "Nombre de lignes affectées par la requête INSERT INTO : $resultat <br>"; // entre "" la variable est évaluée

echo 'Dernier ID généré par la BDD : ' . $pdo->lastInsertId() . '<br>';


//----------------------------------------
echo '<h3> 02.1 - Supprimer les lignes avec "test" </h3>';
//----------------------------------------

$resultat = $pdo->exec("DELETE FROM employes WHERE prenom = 'test' ");

echo "<br>Nombre de lignes affectées par le DELETE : $resultat <br>";


//----------------------------------------
echo '<h3> 03 - La méthode query() et les différents fetch </h3>';
//----------------------------------------
/**
 * Au contraire de exec() query() s'utilise pour la formulation de requêtes retournant un ou plusieurs résultat(s) : SELECT. 
 */

$result = $pdo->query("SELECT * FROM employes WHERE prenom = 'daniel' "); // Daniel ou daniel ne change rien SQL est insensible à la casse
// $result est in objet de la classe PDOStatement

debugP($pdo);
debugP($result);


/**
explication simplifiée
l'objet $pdo provient de la classe PDO et représente la connexion à la BDD, query() est une méthode de PDO qui 
permet de sélectionner des éléments de la BDD et retourne un autre objet issu d'une autre classe (la classe PDO_Statement)

        $pdo (connexion à la bdd)
 *****************************************
 *   à l'intérieur de $pdo je peux       *
 *   utiliser la méthode query() :       *
 *                                       *
 *   function query() {                  *
 *        $res = new PDOStatement();     *
 *        return $res;                   *
 *   }                                   *
 *****************************************
 */

/**
 * Valeur de retour de la méthode query() :
 *  - Succès : elle nous fournit un objet issu de la classe prédéfinie PDOStatement qui contient 1 ou plusieurs 
 * jeux de résultats
 *  - Echec : retourne false
 *
 * Notez que query() peut aussi être utilisée avec INSERT, UPDATE et DELETE
 */


 // $result est le résultat de la requête sous forme inexploitable directement
 // en effet on ne voit pas le jeu de résultat concernant ici Daniel à l'intérieur ...
 // il faut donc transformer $result avec la méthode fetch() :

$employe = $result->fetch(PDO::FETCH_ASSOC); // constante de la classe PDO méthode FETCH__ASSOC
// "$result->fetch(PDO::FETCH_ASSOC);"      transforme $result en array associatif
// "$employe ="                             l'affecte à $employe
debugP($employe);

// la méthode fetch() avec le paramètre PDO::FETCH_ASSOC permet de transformer l'objet $result en un ARRAY associatif
// dont les indices correspondent aux noms des champs (*) de la requête SQL
echo "Je suis $employe[prenom] $employe[nom] du service $employe[service] <hr>"; // n'oubliez pas qu'un array écrit dans des quotes ou des guillements perd ses quotes à son indice

/**
 * Résumé des 4 étapes principales pour afficher "Daniel Chevel" :
 *  1- connexion à la BDD
 *  2- requête : on obtient un objet PDOStatement
 *  3- on fait un fetch sur cet objet pour le transformer (en objet, en array ...) ici en array avec un FETCH_ASSOC
 *  4- on affiche le résultat final
 */


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
    h3{color: #b3efb2; background-color: #2b193d; padding-left: 5vw;
}
    </style>
</head>
<body>
    
</body>
</html>