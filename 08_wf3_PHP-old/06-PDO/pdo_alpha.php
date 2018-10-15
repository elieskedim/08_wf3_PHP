<style>
    h3 {color: purple;}
</style>
<?php
//-------------------------------
//             PDO
//-------------------------------

// PDO pour PHP Data Object, définit une interface pour accéder à une base de données depuis le  PHP.

function debug($param)
{
    echo '<pre>';
    echo print_r($param);
    // echo var_dump($param);
    echo '</pre>';
}
//--------------------------------------------------------
echo '<h3> 01- Connexion : </h3>';
//--------------------------------------------------------

$pdo = new PDO(
    'mysql:host=localhost;dbname=entreprise',// driver mysql (pourrait être oracle, IBM, ODBC...) + nom de la BDD
    'root', // pseudo de la BDD
    'root', // mdp de la BDD
    array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, // pour afficher les messages d'erreur SQL
        PDO::MYSQL_ATTR_INIT_COMMAND => 'set NAMES utf8'// définition du jeu de caractère des échanges avec la BDD
    )
);

// $pdo ci-dessus est un objet issu de la classe prédéfinie PDO. Il représente la connexion à la base de donnée "societe".

//--------------------------------------------------------
echo '<h3> 02- La méthode exec() : </h3>';
//--------------------------------------------------------

// exec() est utilisé pour la formulation de requete ne retournant pas de résulta : INSERT, DELETE, UPDATE.

$resultat = $pdo->exec("INSERT INTO employes(prenom, nom, sexe, service, date_embauche, salaire) VALUES ('test', 'test', 'm', 'test', '2016-02-08', 500)");

/* 
Valeur de retour : 
    - Succes : renvoie le nombre de lignes affectées par la requête
    - Echec : retourne false
 */

echo 'nombre de lignes affectées par le INSERT : ' . $resultat . '<br>';
echo 'Dernière ID inséré par la BDD : ' . $pdo->lastInsertId() . '<br>';

//-----
// Supprimer les ligne test
$resultat = $pdo->exec("DELETE FROM employes WHERE prenom = 'test' ");
echo 'nombre de lignes affectées par le DELETE : ' . $resultat . '<br>';

//---------------------------------------------------------------
echo '<h3> 03 - la méthode query() et les différent fetch : </h3>';
//---------------------------------------------------------------

// Au contraire de exc() query() s'utilise pour la formulation de requête retournant un ou plusieurs résultats : SELECT.

$result = $pdo->query("SELECT * FROM employes WHERE prenom = 'daniel'");

debug($pdo);
debug($result);
/* 
Valeur de retour de la méthode query() : 
    - Succès : elle nous fournit un objet issu de la classe prédéfinie PDOStatement qui contient un ou plusieurs jeux de résultats.debug
    - Echec : retourn false

    Notez que query() peut être aussi utuilisée avec INSERT, DELETE et UPDATE.
 */

// $result est le résultat de la requête sous forme inexploitable directement. En effet on ne voit pas le jeu de résultat concernant daniel à l'intérieur... 
// Il faut donc transformer $result avec la method fetch() :
$employe = $result->fetch(PDO::FETCH_ASSOC); // la methode fetch() avec le paramètre PDO::FETCH_ASSOC permet de transformer l'objet $result en un ARRAY associatif dont les indices correspondent aux noms des champs (*) de la requête SQL.
debug($employe);
echo 'Je suis ' . $employe['prenom'] . ' ' . $employe['nom'] . ' du service ' . $employe['service'] . ' .<br>';

//n'oubliez pas qu'un array écrit dans des quotes ou des guillemets perd ses quotes à son indice.

// Résumé des quatre étapes principales pour afficher Daniel Chevel :
   //  1 - Connnexion à la BDD
   //  2 - on formulr la requête : on obtient un objet PDOStatement
   //  3 - on fait fetch sur cet objet pour le transformer
   //  4 - on affiche le résultat final

//-----
// On peut aussi transformer l'objet PDOStatement $result selon les méthodes fetch suivantes :

$result = $pdo->query("SELECT * FROM employes WHERE prenom = 'daniel'");
$employe = $result->fetch(PDO::FETCH_NUM); // Transforme l'objet $result en un array indicé numériquement.
debug($employe);
echo $employe[1] . '<br>'; // On passe par l'indice numérique pour afficher le prénom

$result = $pdo->query("SELECT * FROM employes WHERE prenom = 'daniel'");
$employe = $result->fetch(); // Transforme l'objet $result en un array associatif et numérique.
debug($employe);
echo $employe['prenom'] . '<br>';
echo $employe[1] . '<br>';

$result = $pdo->query("SELECT * FROM employes WHERE prenom = 'daniel'");
$employe = $result->fetch(PDO::FETCH_OBJ); // Transform l'objet $result en un autre objet stdClass dans lequel on accède aux informations de Daniel Chevel : les propriétés de cet objet correspondent au champs de la requête.
debug($employe);
echo $employe->prenom . '<br>';

// Note on répète la requête SQL avant chaque fetch(), car on ne peut pas réaliser plusieurs fetch sur le même résultat. 

//----
//
//---------------------------------------------------------------
echo "<hr>";
echo '<h3> Exercice : afficher le service de l\'employe dont l\'id_employe est 417. </h3>';
//---------------------------------------------------------------
$result = $pdo->query("SELECT service FROM employes WHERE id_employes = 417");
$employe = $result->fetch(PDO::FETCH_ASSOC);
debug($employe);
echo 'le service de l\'employé 417 est : ' . $employe['service'] . '<br>';

//---------------------------------------------------------------
echo '<h3> 04 - La méthode query() et boucle while : </h3>';
//---------------------------------------------------------------

// Quand on est certain d'avoir qu'un seul résultat dans notre requête : pas de boucle. Si on peut en avoir potentiellement plusieus : on fait une boucle. 

$resultat = $pdo->query("SELECT * FROM employes");
echo 'Nombre d\'employés dans l\'entreprise : ' . $resultat->rowCount() . '<br>';
// rowCount() compte le nombre de ligne retourné par la requête. On peut ainsi compter le nombre de produits, de membre inscrits... 

while ($employe = $resultat->fetch(PDO::FETCH_ASSOC)) { //fetch()retourne la ligne suivante du jeu de résultat en  un array associatif. La boucle while permet de faire avancer le curseur dans le jeu de résultat et s'arrête quand le curseur est à la fin des résultat/.

    //debug($employe); // $employe est un array associatif qui contient les données d'une ligne du jeu de résultat contenu dans $resultat pour chaque tour de boucle.

    echo '<di>';
    echo '<p>' . $employe['id_employes'] . '<p>';
    echo '<p>' . $employe['prenom'] . '<p>';
    echo '<p>' . $employe['nom'] . '<p>';
    echo '</di><hr>';
}

// Conclusion : on fait une boucle si on a potentiellement plusieurs résultats.

//---------------------------------------------------------------
echo '<h3> 05 - La methode fetchAll() </h3>';
//---------------------------------------------------------------

$resultat = $pdo->query("SELECT * FROM employes");
$donnees = $resultat->fetchAll(PDO::FETCH_ASSOC);// Retourne toutes les lignes de $resultat dans un tableau multidimensionnel : on a un sous-array associatif à chaque indice numérique de $donnees. On peut mettre aussi FETCH8NUM pour des sous-array indicé numériquement ou fetchALL() vide pour des sous-array numérique et associatifs.
debug($donnees);

// On parcours $donnees avec une boucle foreach pour en afficher le contenu :
foreach ($donnees as $employe) {
    // debug($employe); // $employe correspond à chaque sous-array associatifs contenu dans $donnees.
    echo '<di>';
    echo '<p>' . $employe['id_employes'] . '<p>';
    echo '<p>' . $employe['prenom'] . '<p>';
    echo '<p>' . $employe['nom'] . '<p>';
    echo '</di><hr>';
}
//---------------------------------------------------------------
echo '<h3> 06 - exercice </h3>';
//---------------------------------------------------------------
// Afficher la liste des différents services de l'entreprise dans une liste ul li.

$resultat = $pdo->query("SELECT DISTINCT service FROM employes");
$categories = $resultat->fetchALL(PDO::FETCH_ASSOC);
// debug($categories);
// echo '<ul>';
//     while()
// echo '</ul>';




?>

<p> La liste de differents services de l'entreprise: </p>
<ul>
<?php foreach ($categories as $service) {
    echo '<li>' . $service['service'] . ' </li>';
}
?>   
</ul>

<?php
//---------------------------------------------------------------
echo '<h3> 07 - table HTML </h3>';
//---------------------------------------------------------------

$resultat = $pdo->query("SELECT * FROM employes");

echo '<table border="1">';
    // Affichage de la ligne des entêtes dynamiquement :
echo '<tr>';
for ($i = 0; $i < $resultat->columnCount(); $i++) {
    //debug($resultat->getColumnMeta($i)); // La méthode getColumnMeta() retourne un array qui contient notement l'indice name avec le nom de chaque colonne (= champ de la table).

    $colonne = $resultat->getColumnMeta($i);
    echo '<th>' . $colonne['name'] . '</th>'; // l'indice "name" contient le nom du champ à chaque tour de boucle
}
echo '<th>action</th>';
echo '</tr>';
// Affichage des lignes : 
while ($ligne = $resultat->fetch(PDO::FETCH_ASSOC)) {
    echo '<tr>';
    // $ligne étant un objet, je peux faire une foreach pour le parcourir :
    foreach ($ligne as $information) {
        echo '<td>' . $information . '</td>';
    }
    echo '<td><a href="?action=suppression&id=' . $ligne['id_employes'] . '">suppremier</a></td>';
    echo '</tr>';
}
echo '</table>';
// pour voir les méthode disponoible dans $resultat : 
// debug(get_class_methods($resultat));

//---------------------------------------------------------------
echo '<h3> 08 - requête préparée et bindParam() </h3>';
//---------------------------------------------------------------

$nom = 'sennard';

// Une requête préparé se réalise en trois étapes : 

    // Etape 1 : préparer la requête :
$resultat = $pdo->prepare("SELECT * FROM employes WHERE nom =  :nom");// :nom est un marqueur nominatif qui est en attente d'une valeur

    // Etape 2 : lier les marqueurs aux valeurs : 
$resultat->bindParam(':nom', $nom); // bindParam() reçcoit exclusivement une variable vers laquelle pointe le marqueur (on ne peut pas y mettre directement une valeurs). Ainsi, si le contenu de la variable change, la valeur du marqueur changera automatiquement (Pas besoin de refaire bindParam).

    // Etape 3 : exécuter la requête :
$resultat->execute();

    //Puis on fait un fetch sur $resultat pour obtenir le jeu de résultat qu'il contient :
$donnees = $resultat->fetch(PDO::FETCH_ASSOC); // pas de while car il n'y a qu'un seul résultat
debug($donnees);

/* 
La méthode prepare() permet de préparer une requête mais ne l'exécute pas.
Execute() permet d'exécuter une requête préparée. 


Valeurs de retour : 
prepare() renvoie toujours un objet PDOStatement. 
execute() :
    Succes : TRUE
    Echec : FALSE

Les requêtes préparées sont préconisées i vous exécutez plusieurs fois la même requête et ainsi vouloir éviter de répéter le cycle analyse / interprétation / exécution réalisé par le SGBD (gain de performance). 

Les requêtes préparées sont  souvent utilisées pour assénir les données et éviter les injections SQL (ce que nous verrons dans un chapitre ultérieur). 
 */
//!\\

 // Si on change la valeur contenu dans $nom, sans refaire un bindParam(), le marqueur de la requête pointe automatiquement faire une la nouvelle valeur. On peut donc execute() directement :
$nom = 'durand';
$resultat->execute();
$donnees = $resultat->fetch(PDO::FETCH_ASSOC);
debug($donnees); // on acceède aux données de "durand" sans avoir refait un bindParam().

//---------------------------------------------------------------
echo '<h3> 09 - requête préparée et bindValue() </h3>';
//---------------------------------------------------------------

$nom = 'thoyer';

// 1- prépare la requête : 
$resultat = $pdo->prepare("SELECT * FROM employes WHERE nom =  :nom");

// 2 - liéer les marqueurs aux valeurs : 
$resultat->bindValue(':nom', $nom); // bindValue() recoit une variable ou une valeur directement. Le marqueur pointe uniquement vers la valeurs : ci celle -ci change, il faudra refaire un bindValue() lors d'un nouvel execute() pour tenir compte de cette nouvelle valeur (sinon le marqueur conserve l'ancienne valeur).

// 3 - executer la requête :
$resultat->execute();

// Puis on affiche le résultat : 
$donnees = $resultat->fetch(PDO::FETCH_ASSOC);
debug($donnees);

// Si on change la valeur de $nom, sans nouveau bindValue(), le marqueur de la requête continu de pointer vers "thoyer".
$nom = 'durand';
$resultat->execute();
$donnees = $resultat->fetch(PDO::FETCH_ASSOC);
debug($donnees); // on continue d'accéder aux valeurs de "thoyer" si on ne refait pas notre bindValue.

//---------------------------------------------------------------
echo '<h3> 10 - requête préparée et point complémentaire </h3>';
//---------------------------------------------------------------

echo '<h4> Le marqueur " ? "</h4>';

$resultat = $pdo->prepare("SELECT * FROM employes WHERE nom = ? AND prenom = ?");// opn pr"pare la requête avec les parties variable représenté par des marqueurs sous forme de "?"

$resultat->bindValue(1, 'durand'); // le chiffre 1 représente le premier marqueur "?" de la requête
$resultat->bindValue(2, 'damien'); // le chiffre 2 représente le second marqueur "?" de la requête

$resultat->execute();
//On peut aussi utiliser cette syntaxe directement : 
//$resultat->execute(array('durand', 'damien')); //on peut remplacer les deux bindValue et le execute() précédent par cette ligne, en passant un array à la méthode execute(). Les valeurs sont dans le même ordre que les marqueursdans la requête

$donnees = $resultat->fetch(PDO::FETCH_ASSOC);
debug($donnees);

echo '<h4> execute() sans bindParam ni bindValue()</h4>';
$resultat = $pdo->prepare("SELECT * FROM employes WHERE nom = :nom AND prenom = :prenom");
$resultat->execute(array(':nom' => 'chevel', ':prenom' => 'daniel')); // on associe les mlarqueurs à leur valeur directement dans un array passé à la méthode execute()
$donnees = $resultat->fetch(PDO::FETCH_ASSOC);
debug($donnees);


//---------------------------------------------------------------
echo '<h3> 11 - L\'extension Mysqli </h3>';
//---------------------------------------------------------------

// Connexion à la BDD : 

$mysqli = new Mysqli('localhost', 'root', '', 'societe');

// exemple de requête : 
$resultat = $mysqli->query("SELECT * FROM employes");

//--------------------- FIN DU FICHIER ----------------------------------