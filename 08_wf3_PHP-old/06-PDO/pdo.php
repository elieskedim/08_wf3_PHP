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
 function debugP($param)
 {
     echo '<pre style="background-color: #d5ecd4 ;">';
     echo '<strong>print_r($param)</strong> <br>';
     print_r($param);
     echo '</pre>';
 }


//-------------------------------
echo '<h3> 01 - Connexion </h3>';
//-------------------------------
$pdo = new PDO(
    'mysql:host=localhost;dbname=societe', // driver (càd système de gestion de BDD) ici mysql (pourraît etre Oracle, IBM, ODBC ...) + nom du serveur de la BDD + nom de la BDD
            'root', // pseudo de la BDD
            '', // mot de passe de la BDD
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


/**
 * ******************************
 * Les autres méthodes fetch()
 * ******************************
 * On peut aussi transformer l'objet PDOStatement $result selon les méthodes fetch() suivantes :
 *
 *
 */
$result = $pdo->query("SELECT * FROM employes WHERE prenom = 'daniel'");
$employe = $result->fetch(PDO::FETCH_NUM); // transforme l'objet $result en un ARRAY indicé numériquement
debugP($employe);
echo $employe[1] . '<br>'; // on passe par l'indice numérique 1 pour afficher le prénom


$result = $pdo->query("SELECT * FROM employes WHERE prenom = 'daniel'");
$employe = $result->fetch(); // transforme l'objet $result en un ARRAY associatif et numérique
debugP($employe);
echo $employe['prenom'] . '<br>';
echo $employe[1] . '<br>';


$result = $pdo->query("SELECT * FROM employes WHERE prenom = 'daniel'");
$employe = $result->fetch(PDO::FETCH_OBJ); // transforme l'objet $result en un autre objet stdClass (objet standard de PHP pour les objets anonymes) dans lequel on accède aux informations de Daniel Chevel : les propriétés de cet objet correspondent aux champs de la requête SQL
debugP($employe);
echo $employe->prenom . '<br>';

// Note : on répète la requête SQL avant chaque fetch(), car on ne PEUT PAS réaliser PLUSIEURS fetch() sur le même résultat


/**
 * ******************************
 * Exercice
 * ******************************
 * Afficher le service de l'employé dont l'id_employes est 417
 */

$result = $pdo->query("SELECT service FROM employes WHERE id_employes = 417");
$employe = $result->fetch(PDO::FETCH_ASSOC);
debugP($employe);
echo $employe['service'] . '<br>';
$result = $pdo->query("SELECT service FROM employes WHERE id_employes = 417");
$employe = $result->fetch(PDO::FETCH_NUM);
debugP($employe);
echo "Le service de l'employé 417 est $employe[0] <br>";


//----------------------------------------
echo '<h3> 04 - La méthode query() et boucle while </h3>';
//----------------------------------------

/**
 * Quand on est certain d'avoir qu'un seul résultat dans notre requête : pas de boucle
 * Si on peut en avoir potentiellement plusieurs, on fait une boucle
 */

 $result = $pdo->query("SELECT * FROM employes");

 echo 'Nombre d\'employés dans la société : ' . $result->rowCount() . '<br>';
// rowCount() compte le nombre de lignes retournées par la requête
// on peut ainsi compter le nombre de produits, de membres inscrits...

while ($employe = $result->fetch(PDO::FETCH_ASSOC)) { // fetch() retourne la ligne suivante du jeu de résultat en un array associatif.
    // La boucle while permet de faire avancer le curseur dans le jeu de résultat, et s'arrête quand le curseur est à la fin des
    // résultats
    // c'est le fetch() qui génère la condition de fin 'false' => c'est pour cela que le fetch() est dans la condition de la while :
    // while($var_de_reception_du fetch = $objet_a_traiter->fetch(PDO::FETCH_xx)) { ... affichage ou traitement ... }

    // debugP($employe); // $employe est un array associatif qui contient les données d'une ligne du jeu de
    // résultat contenu dans $result pour chaque tour de boucle
    // 1 tour de boucle = 1 array associatif

    echo '<div>';
    echo '<p>' . $employe['id_employes'] . '</p>';
    echo '<p>' . $employe['prenom'] . '</p>';
    echo '<p>' . $employe['nom'] . '</p>';
    echo '</div><hr>';
}

// conclusion : on fait une boucle si on a potentiellement plusieurs résultats


//----------------------------------------
echo '<h3> 05 - La méthode fetchAll() </h3>';
//----------------------------------------

$result = $pdo->query("SELECT * FROM employes");

$donnees = $result->fetchAll(PDO::FETCH_ASSOC); // retourne toutes les lignes de résultats dans un tableau multidimensionnel : on a
// un sous-array associatif à chaque indice numérique de $donnees
// On peut mettre aussi FETCH_NUM pour des sous-arrays indicés numériquement, ou fetchAll() pour des sous-arrays numériques et associatifs mélangés (mais le résultat est une collection de doublons)
debugP($donnees);

// On parcourt $donnees avec une boucle foreach pour en afficher le contenu :
foreach ($donnees as $employe) { // $employe correspond à chaque sous-array associatif obtenu dans $donnees
    // debugP($employe);
    echo '<div>';
    echo '<p>' . $employe['id_employes'] . '</p>';
    echo '<p>' . $employe['prenom'] . '</p>';
    echo '<p>' . $employe['nom'] . '</p>';
    echo '</div><hr>';
}


//----------------------------------------
echo '<h3> 06 - Exercice </h3>';
//----------------------------------------
// afficher la liste des différents services de l'entreprise, dans une liste <ul><li>
// pas de doublons

// ------ avec un FOR
$result = $pdo->query("SELECT DISTINCT service FROM employes");
// $result = $pdo->query("SELECT service FROM employes GROUP BY service DESC");

// debugP($services);
echo '<ul>';
while ($services = $result->fetch(PDO::FETCH_ASSOC)) {
    echo '<li>' . $services['service'] . '</li>';
}
echo '</ul>';

// ------ avec un FOREACH
$result = $pdo->query("SELECT service FROM employes GROUP BY service ASC");
$services = $result->fetchAll(PDO::FETCH_ASSOC);
// debugP($services);
echo '<ul>';
    foreach ($services as $value) {
        echo '<li>' . $value['service'] . '</li>';
    }
echo '</ul>';

//----
// les 2 façons de faire sont identiques, pas 1 mieux que l'autre
// sin on utilise le fetchAll() on est obligé de passer par une boucle FOREACH


//----------------------------------------
echo '<h3> 07 - Tables HTML </h3>';
//----------------------------------------
// $resultat = $pdo->query("SELECT * FROM employes");
$resultat = $pdo->query("SELECT id_employes AS 'Id employé', prenom AS 'Prénom', nom AS 'Nom', sexe AS 'Genre', service AS 'Service', date_embauche AS 'Date d\'embauche', salaire AS 'Salaire' FROM employes");

echo '<div class="container">';
    echo '<table class="table table-striped table-hover table-info">';
    // affichage de la ligne des entêtes dynamiquement :
    echo '<tr>';
    for ($i = 0; $i < $resultat->columnCount(); $i++) {
        debugP($resultat->getColumnMeta($i)); // récupère les informations contextuelles de chaque champs de la table parcourue 
        // et on voit que l'indice [name] ramène le titre des champs
        // la méthode getColumnMeta() retourne un array qui contient notamment l'indice "name" avec le nom de
        // chaque colonne (= champs de la table SQL)
        
        $colonne = $resultat->getColumnMeta($i);
        
        echo '<th scope="col">' . $colonne['name'] . '</th>'; // l'indice "name" contient le nom du champ à chaque tour de boucle
    }
    echo '</tr>';

    //-- Affichage des lignes
    while ($ligne = $resultat->fetch(PDO::FETCH_ASSOC)) { // $ligne => 1 ligne de la table de la BDD
        echo '<tr>';
        // $ligne est tableau associatif, donc je peux faire une FOREACH pour le parcourir
        foreach ($ligne as $information) {
            echo '<td>' . $information . '</td>';
        }
        echo '</tr>';
    }
echo '</table>';
echo '</div>';

// pour voir les méthodes disponibles dans $resultat, il faut faire :
debugP(get_class_methods($resultat));


//----------------------------------------
echo '<h3> 08 - Requête préparée et bindParam() </h3>';
//----------------------------------------
$nom = 'sennard';

/**
 *  Une requête préparée se réalise en 3 étapes :
 * 
 * ETAPE 1- préparer la requête
 * ETAPE 2- Lier les marqueurs aux valeurs
 * ETAPE 3- Exécuter la requête
 * 
 **/

// ETAPE 1- préparer la requête
$resultat = $pdo->prepare("SELECT * FROM employes WHERE nom = :nom ");
// :nom est un marqueur nominatif (il a un nom) qui est en attente d'une valeur (il est vide à cette étape)
// il faut relier la valeur de $nom et le marqueur :nom qui est dans la requête

//ETAPE 2 - Lier les marqueurs aux valeurs
$resultat->bindParam(':nom', $nom); // bindParam() reçcoit exclusivement une variable vers laquelle pointe le marqueur (on ne peut pas y mettre directement une valeurs). Ainsi, si le contenu de la variable change, la valeur du marqueur changera automatiquement (Pas besoin de refaire bindParam).

// ETAPE 3- Exécuter la requête
$resultat->execute();

// PUIS on fait un fetch() sur l'objet $resultat pour obtenir le jeu de résultat qu'il contient
$donnees = $resultat->fetch(PDO::FETCH_ASSOC);
debugP($donnees);

echo $donnees['prenom'] . '<br>';
echo $donnees['nom'] . '<br>';


/**
 * La méthode prepare() permet de préparer une requête mais ne l'exécute pas. 
 * execute() permet d'exécuter une requête préparée
 * 
 * Valeurs de retour :
 *  - prepare() renvoie toujours un objet PDOStatement
 *  - execute() :
 *          - Succès : TRUE
 *          - Echec : FALSE
 * 
 * Les requêtes préparées sont préconisées si vous exécutez plusieurs fois la même requête, et ainsi vouloir éviter
 * de répéter le cycle analyse / interprétation / exécution réalisé par le SGDB (gain de performance)
 * 
 * Les requêts préparées sont souvent utilisées pour assainir les données et éviter les injections SQL (ce que nous verrons dans 
 * un chapître ultérieur)
 * 
 * 
 */

 // Si on change la valeur contenue dans $nom sans refaire un bindParam(), le marqueur de la requête pointe automatiquement vers
 // la nouvelle valeur. On peut donc faire un execute() directement :

 $nom = 'durand';
 $resultat->execute();
 $donnees = $resultat->fetch(PDO::FETCH_ASSOC);
 debugP($donnees); // on accède aux données de Durand sans avoir refait un bindParam()


//---------------------------------------------------------------
echo '<h3> 09 - requête préparée et bindValue() </h3>';
//---------------------------------------------------------------

$nom = 'thoyer';

// 1- prépare la requête : 
$resultat = $pdo->prepare("SELECT * FROM employes WHERE nom =  :nom");

// 2 - lier les marqueurs aux valeurs : 
$resultat->bindValue(':nom', $nom); // bindValue() recoit une variable ou une valeur directement. Le marqueur pointe uniquement vers la valeurs : ci celle-ci change, il faudra refaire un bindValue() lors d'un nouvel execute() pour tenir compte de cette nouvelle valeur (sinon le marqueur conserve l'ancienne valeur).

// 3 - executer la requête :
$resultat->execute();

// Puis on affiche le résultat : 
$donnees = $resultat->fetch(PDO::FETCH_ASSOC);
debugP($donnees);
// Si on change la valeur de $nom, sans nouveau bindValue(), le marqueur de la requête continu de pointer vers "thoyer".
$nom = 'durand';
$resultat->execute();
$donnees = $resultat->fetch(PDO::FETCH_ASSOC);
debugP($donnees); // on continue d'accéder aux valeurs de "thoyer" si on ne refait pas notre bindValue.


// Exercice : 
/* 
    - Afficher dans une liste <ul><li> : le prenom, le nom et le salaire des employés du service commercial (1 commercial par <li>). Pour cela , vous utilisez une requete préparée.
    - Afficher le nombre de commerciaux dans l'entreprise.
 */


 // exercice dans un fichier séparé :
 // 1- connexion BDD

 // 2- Requête SQL
$service = 'commercial';
$resultat = $pdo->prepare("SELECT prenom, nom, salaire FROM employes WHERE service = :service ");
$resultat->bindParam(':service', $service);
// debugP($resultat);

$resultat->execute();

debugP($resultat->rowCount());
echo '<ul>';
for ($i = 0; $i < $resultat->rowCount(); $i++) {
    $commerciaux = $resultat->fetch(PDO::FETCH_ASSOC);
    echo '<li>' . $commerciaux['prenom'] . ' ' . $commerciaux['nom'] . ' ' . $commerciaux['salaire'] . '</li>';
    $total = $resultat->rowCount($i);
}
echo $total . ' commerciaux dans l\'entreprise.';
echo '</ul>';

$resultat->execute();
echo '<ul>';
while ($donnees = $resultat->fetch(PDO::FETCH_ASSOC)) {
    echo '<li>' . $commerciaux['prenom'] . ' ' . $commerciaux['nom'] . ' gagne ' . $commerciaux['salaire'] . ' euros</li>';
}
echo '</ul>';
echo 'La société a : ' . $resultat->rowCount() . ' commerciaux.';
debugP(get_class_methods($resultat));
var_dump($resultat);
echo '<hr>';

//----------------------------------------
echo '<h3> 10 - Requête préparée et points complémentaires </h3>';
//----------------------------------------

echo '<hr>';
echo '<h4> Le marqueur "?" </h4>';

$resultat = $pdo->prepare("SELECT * FROM employes WHERE nom = ? AND prenom = ? "); // on prépare la requête avec les parties
// variables représentées par des marqueurs sous forme de "?" (marqueurs anonymes)

$resultat->bindValue(1, 'durand'); // le chiffre 1 représente le premier marqueur "?" de la requête
$resultat->bindValue(2, 'damien'); // le chiffre 2 représente le second marqueur "?" de la requête

$resultat->execute();

// On peut aussi utiliser cette syntaxe condensée directement :
$resultat->execute(array('durand', 'damien')); // on peut remplacer les 2 bindValue() et le execute() précédents par cette ligne
// en passant un array à la méthode execute()
// les valeurs sont dans le même ordre que les marqueurs dans la requête


$donnees = $resultat->fetch(PDO::FETCH_ASSOC); 
debugP($donnees);

echo $donnees['prenom'] . ' ' . $donnees['nom'];

echo '<hr>';
echo '<h4> execute() sans bindParam() ni bindValue() </h4>';

$resultat = $pdo->prepare("SELECT * FROM employes WHERE nom = :nom AND prenom = :prenom "); 

$resultat->execute(array(':nom' => 'chevel', ':prenom' => 'daniel')); // on associe les marqueurs à leur valeur directement
// dans un array passé à la méthode execute()

$donnees = $resultat->fetch(PDO::FETCH_ASSOC);
debugP($donnees);
echo $donnees['prenom'] . ' ' . $donnees['nom'];

//----------------------------------------
echo '<hr>';
echo '<h3> 11 - L\'extension Mysqli [pour la culture] </h3>';
//----------------------------------------

// Connexion à la BDD
$mysqli = new Mysqli('localhost', 'root', '', 'societe');

// exemple de requête
$resultat = $mysqli->query("SELECT * FROM employes");



//----------------------------------------
echo '<hr>';
echo '<h3> 0x - La méthode fetchClass() </h3>';
//----------------------------------------


?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Document</title>
    <style>
    h3{color: #b3efb2; background-color: #2b193d; padding-left: 5vw;}
    h4{color: #2b193d; background-color: #b3efb2; padding-left: 5vw;}
}
    </style>
</head>
<body>
    
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>