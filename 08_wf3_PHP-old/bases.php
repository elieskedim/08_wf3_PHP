<style>
    h2 { color: #b3efb2; background-color: #2b193d; padding-left: 5vw;}
    h4 { color: #001a23; background-color: #b3efb2 ; padding-left: 5vw;}
</style>

<?php
// ----------
echo '<h2> 1- Les balises PHP </h2>';
// ----------
?>

<?php
// pour ouvrir un passage en PHP on utilise la balise précédente
// pour fermer un passage en PHP on utilise la balise suivante
?>

<p>Bonjour</p> 
<!-- en dehors des balises d'ouverture et de fermeture du PHP, nous pouvons écrire du HTML quand on est dans un fichier ayant l'extension .php -->

<?php
// vous n'etes pas obligé de fermer un passage PHP en fin de script


// ----------
echo '<h2> 2- Affichage </h2>';
// ----------

echo 'Bonjour <br>';
// echo '<p>Bonjour</p>'; // ici l'écriture du script est faite proprement, mais pour les besoins du cours on va faire des <br>
// echo est une instruction qui permet d'afficher dans le navigateur, toutes les instructions se terminent par un ";"
// dans un echo nous pouvons mettre aussi du HTML

print 'Nous sommes mardi <br>';
// print est une autre instruction d'affichage, pas ou peu de différence avec echo

// autres instructions d'affichage que nous verrons plus loin, elles sont utilisées en phase de développement
// print_r();
// var_dump();

// pour faire un commentaire sur une seule ligne

/*
   pour faire un commentaire sur plusieurs lignes
*/

# autre syntaxe de commentaire sur une seule ligne


// ----------
echo '<h2> 3- Variable : déclaration / affectation / types </h2>';
// ----------

// une variable est un espace mémoire de stockage qui porte un nom et permettant de conserver une seule valeur
// en PHP on déclare une variable avec le signe $

$a = 127; // affectation de la valeur 127 à la variable $a

echo gettype($a); // gettype() est une fonction prédéfinie qui indique le type d'une variable, ici il s'agit d'un integer (entier)

echo '<br>';

$a = 'une chaîne de caractères';
echo gettype($a); // affiche 'string'

echo '<br>';

$b = '127';
echo gettype($b); // affiche 'string' car dès qu'il y a des quotes / guillemets simples c'est un string
// un nombre ou un booléen écrit entre quotes est interprété comme un string

echo '<br>';

$a = true;
echo gettype($a); // affiche boolean

/* par convention un nom de variable :
    - commence par une lettre minuscule,
    - puis on met une majuscule à chaque mot (camel case)
    - il peut contenir des chiffres (jamais au début)
    - il peut contenir un "_" (jamais au début car cela a une signification particulière en objet, et jamais à la fin non plus)
*/


// ----------
echo '<h2> 4- Concaténation </h2>';
// ----------

// il s'agit de mettre des éléments (variables, contenus... ) les uns à la suite des autres
// elle s'effectue avec le signe "." (et non le "+" comme en JS qui peut parfois confondre concaténation et addition)

$x = 'Bonjour';
$y = 'tout le monde';

echo $x . ' ' . $y . '<br>';
// le point de concaténation peut être traduit par 'suivi de'

// remarque sur echo (ce qui suit ne fonctionne pas avec print et est plus utilisé par les dévs US)
echo $x, $y, '<br>';
// dans l'instruction echo on peut séparer les éléments à afficher par une virgule, cette syntaxe est spécifique au echo et ne marche pas avec print

// ----------
echo '<h4> 4.1- Concaténation lors de l\'affectation</h4>';
// ----------

$prenom1 = 'Hugo';
$prenom1 = 'Samba';
echo $prenom1 . '<br>'; // affiche Samba qui remplace la précédente valeur stockée dans la variable $prenom1

$prenom2 = 'Nicolas';
$prenom2 .= ' Marie'; // l'opérateur .= est un opérateur combiné => il fait 2 choses
echo $prenom2 . '<br>'; // affiche "Nicolas Marie" grâce à l'opérateur combiné .= la valeur "Marie" vient se concaténer à la valeur "Nicolas" sans la remplacer


// ----------
echo '<h2> 5- Guillemets & Quotes </h2>';
// ----------

$message = "aujourd'hui"; // ou bien :
$message = 'aujourd\'hui'; // on échappe l'apostrophe (alt gr + 8) dans les quotes simples avec l'antislash qui neutralise l'apostrophe pour ne pas fermer le string après le d ici

$txt = 'Bonjour';
echo "$txt tout le monde <br>"; // entre guillemets la variable est évaluée => on affiche son contenu => Bonjour
echo '$txt tout le monde <br>'; // entre quotes la variable n'est pas évaluée => on affiche le texte brut => $txt


// ----------
echo '<h2> 6- Constantes & Constantes magiques </h2>';
// ----------

// une constante permet de conserver une valeur sauf que celle-ci ne peut pas être modifiée durant l'exécution du ou des scripts
// utile pour, par exemple, conserver les paramètres de connexion à la BDD sans pouvoir les modifier une fois définis

define('CAPITALE', 'Paris');
// on déclare une constante avec la fonction prédéfinie define() qui attend 2 paramètres : 1- le nom de la constante et 2- la valeur de la constante
// en PHP (comme en JS) par convention les constantes sont toujours en capitales dans les programmations de script
// une constante ne débute pas par $ comme les variables

echo CAPITALE . '<br>'; // affiche Paris

/*
*   Les constantes magiques
*   Elles sont en fait des constantes prédéfinies
*   Elles s'écrivent en débutant avec 2 underscores __ et en majuscules
*/

// Deux constantes magiques (il en existe d'autres) :
echo __DIR__ . '<br>'; // affiche le chemin complet (absolu) vers le dossier de notre fichier

echo __FILE__ . '<br>'; // affiche le chemin complet (absolu) vers le fichier (dossier + nom du fichier)

// ----------
echo '<h4> 6.1- Exercice </h4>';
// ----------
// afficher Bleu-Blanc-Rouge (avec les tirets) en mettant le texte de chaque couleur dans des variables
$bleu = 'Bleu';
$blanc = 'Blanc';
$rouge = 'Rouge';
$tiret = '-';
echo $bleu . $tiret . $blanc . $tiret . $rouge . '<br>';
echo $bleu . '-' . $blanc . '-' . $rouge . '<br>';
echo "$bleu-$blanc-$rouge <br>";


// ----------
echo '<h2> 7- Opérateurs arithmétiques </h2>';
// ----------
$a = 10;
$b = 2;

echo $a + $b . '<br>'; // affiche 12
echo $a - $b . '<br>'; // affiche 8
echo $a * $b . '<br>'; // affiche 20
echo $a / $b . '<br>'; // affiche 5
echo $a % $b . '<br>'; // affiche 0 - modulo = reste de la division entière. Exemple 3 % 2 si on a 3 billes réparties entre 2 personnes il nous en reste une dans la main


// ----------
echo '<h2> 8- Opérations & Affectations combinées </h2>';
// ----------
$a = 10;
$b = 2;

$a += $b; // équivaut à $a = $a + $b; => $a vaut donc au final 12
$a -= $b; // équivaut à $a = $a -$b; => $a vaut 10
$a *= $b; // $a vaut 20
$a /= $b; // $a vaut 10
$a %= $b; // $a vaut 0

// exemple d'utilisation : pratique pour faire des calculs de quantités dans les pa,niers d'achat (+= et -=)


// ----------
echo '<h2> 9- Incrémenter & Décrémenter </h2>';
// ----------
$i = 0;
$i++; // on ajoute 1 à $i qui vaut au final 1
$i--; // on retire 1 à $i qui vaut au final 0

$i = 0;
$k = ++$i; // la variable $i est incrémentée de 1 puis elle est retournée : on affecte donc 1 à $k
echo '$i vaut ' . $i . '<br>'; // 1
echo '$k vaut ' . $k . '<br>'; // 1

$i = 0;
$k = $i++; // la variable $i est d'abord retournée puis elle est incrémentée de 1 (le ++ est après donc le calcul est fait après l'affectation)
echo '$i vaut ' . $i . '<br>'; // 1
echo '$k vaut ' . $k . '<br>'; // 0


// ----------
echo '<h2> 10- Structures conditionnelles - opérateurs de comparaison </h2>';
// ----------

$a = 10;
$b = 5;
$c = 2;

// NB - une structure comme les conditions, les boucles et les fonctions prennent des accolades et ne se termnient pas avec un ";"
// NB - seules les instructions se terminent par un ";"

// ----------
echo '<h4> 10.1- if ... else </h4>';
// ----------
if ($a > $b) { // si la condition est évaluée à TRUE, on exécute le code dans les accolades qui suivent
    echo '$a est supérieur à $b <br>';
} else { // si la condition est évaluée à FALSE, on exécute le code dans les accolades du else
    echo 'Non, c\'est $b qui est supérieur à $a <br>';
}

// ----------
echo '<h4> 10.2- AND s\'écrit && </h4>';
// ----------
if ($a > $b && $b > $c) { // si $a est supérieur à $b ET que dans le même temps $b est supérieur à $c, alors on entre dans les accolades du IF
    echo 'OK pour les 2 conditions <br>';
}

// ----------
echo '<h4> 10.3- OR s\'écrit || </h4>';
// ----------
if ($a == 9 || $b > $c) { // si $a est égal à 9 (opérateur ==) OU que $c est supérieur à $c, alors on entre dans les accolades
    echo 'OK pour au moins une des 2 conditions <br>';
}

// ----------
echo '<h4> 10.4- if ... elseif ... else </h4>';
// ----------
$a = 10;
$b = 5;
$c = 2;

if ($a == 8) {
    echo '$a est égal à 8 <br>';
} elseif ($a != 10) {
    echo '$a est différent de 10 <br>';
} else {
    echo 'Les 2 conditions précédentes sont fausses <br>';
}

/*
*   NOTES
* - on ne fait JAMAIS suivre un else par une condition (sinon c'est qu'on a besoin d'un elseif)
* - on ne met pas de ";" à la fin d'une condition car il s'agit d'une structure
*/

// ----------
echo '<h4> 10.5- L\'opérateur XOR </h4>';
// ----------
$question1 = 'mineur';
$question2 = 'je vote'; // exemple d'un questionnaire statistique

if ($question1 == 'mineur' xor $question2 == 'je vote') { // XOR ou OU EXCLUSIF : seulement une des 2 conditions doit être vraie (soit l'une soit l'autre). Siles 2 conditions sont vraoes, alors l'expression est fausse : c'est le cas ici on rentre donc dans le else
    echo 'Vos réponses sont cohérentes <br>';
} else {
    echo 'Vos réponses sont incohérentes <br>';
}

// ----------
echo '<h4> 10.6- Forme contractée de la condition dite "ternaire" </h4>';
// ----------
// echo (...) ? ... : ... ;
// si je les imbriques pour faire des elseif alors c'est assez illisible => echo (...) ? ... : (...) ? ... : ... ;
// echo (condition) ?/if ..Si vrai.. :/else ..Si faux.. ;
// le "?" remplace le "if" et le ":" remplace le "else"

echo ($a == 10) ? '$a est égal à 10 <br>' : '$a est différent de 10 <br>';

// ou encore :
$resultat = ($a == 10) ? '$a est égal à 10 <br>' : '$a est différent de 10 <br>';
echo $resultat;

// ----------
echo '<h4> 10.7- Comparaison en == et en === </h4>';
// ----------
$varA = 1; // integer
$varB = '1'; // string

if ($varA == $varB) {
    echo '$varA est égale à $varB en valeur uniquement <br>';
}
// si mon IF se limite à un jeu d'accolades je ne suis pas obligé de les mettre

if ($varA === $varB) {
    echo '$varA est égale à $varB en valeur ET en type <br>';
} else {
    echo '$varA est différent de $varB en valeur OU en type <br>';
}

/**
 * = signe d'affectation
 * == signe de comparaison en valeur
 * === signe de comparaison en valeur et en type
 */

 // ----------
echo '<h4> 10.8- Fonctions prédéfinies isset() & empty() </h4>';
// ----------

/**
 * Définitions
 *
 * isset() teste si c'est défini (si existe) et a une valeur non NULL
 *
 * empty() teste si c'est vide, c'est-à-dire 0, string vide '', NULL, false ou encore non défini
 */

 $var1 = 0;
 $var2 = '';

 if (empty($var1)) {
     echo '0, vide, NULL, false, non défini <br>';
 } // $var1 est vide au sens de empty => vrai
 if (isset($var2)) {
     echo 'existe et non NULL <br>';
 } // $var2 est déclaré donc existe et n'est pas NULL => vrai

 // hiérarchie des vides en programmation :
 // 0 c'est zéro mais c'est qq chose en programmation
 // '' c'est un string vide mais c'est un string donc qq chose en programmation
 // NULL c'est le vide absolu

 // si on ne déclare pas les variables $var1 et $var2 (lignes324 et 325) la condition empty() reste vraie car non définie mais la condition avec isset() devient fausse car la variable ne serait pas définie

/**
 *  exemple d'utilisation
 *  empty() => vérifier qu'un champ de formulaire est vide
 *  isset() => vérifier qu'une variable existe bien avant de l'utiliser
 */

// ----------
echo '<h4> 10.9- L\'opérateur NOT écrit "!" </h4>';
// ----------

$var3 = 'une chaîne de caractères';

if (empty($var3)) {
    echo '$var3 est vide';
} // je ne rentre pas dans ce IF puisque $var3 n'est pas vide

if (!empty($var3)) {
    echo '$var3 n\'est PAS vide';
} // je ne rentre pas dans ce IF puisque $var3 n'est pas vide

// ! pour NOT
// il d'agit d'une négaction qui transforme false en true et inversement (!false = true et !true = false)
// littéralement on teste ici si $var3 n'est pas vide


// ----------
echo '<h2> ** PHP 7 minimum ** </h2>';
echo '<h4> 10.10- Entrer une valeur dans une variable si elle existe </h4>';
// ----------
// phpinfo(); // donne notamment la version PHP du serveur et infos sur l'environnement de travail

$var1 = $variableInconnue ?? $variableInconnueSuivante ?? 'valeur par défaut';
// $var1 = si isset($variableInconnue) l'interpréteur PHP prend cette valeur ??/sinon il prend la 'valeur par défaut';

/**
 * l'opérateur ?? indique qu'il faut prendre la 1ère variable ou valeur qui existe
 * $variableInconnue n'existant pas on passe à $variableInconnueSuivante qui n'existe pas non plus, donc on prend la valeur affectée à $var1
 * echo $var1; // affiche la valeur par défaut
 * si j'oublie de mettre une valeur par défaut j'ai un erreur
 * on utilise cet opérateur pour remplir les values des formulaires quand l'internaute aura saisi et envoyé des valeurs
 */

// on peut tester comme des elseif successifs par ordre de priorité puisque l'interpréteur s'arrête dès qu'une variable est définie / existe :
$autreVar = 'Mila';
$varTest = $variableInconnue ?? $autreVar ?? $encoreUneAutre ?? 'valeur par défaut';
echo $varTest;


// ----------
echo '<h2> 11- Condition Switch </h2>';
// ----------
// La condition swicth est une autre syntaxe du if / elseif / else quand on veut comparer une variable à une multitude de valeurs

$couleur = 'rouge';

switch ($couleur) {
    case 'bleu': // on compare $couleur à la valeur des 'case' et exécute le code qui suit les ":" (on peut par ex. y imbriquer un IF après les ":", ou un autre switch) si elle correspond
        echo 'Vous aimez le bleu <br>';
        break; // break est OBLIGATOIRE pour quitter la condition une fois le case exécuté

    case 'vert':
        echo 'Vous aimez le vert <br>';
        break;

    case 'jaune':
        echo 'Vous aimez le jaune <br>';
        break;
    
    default:
        echo 'Vous n\'aimez pas le bleu, le vert ni le jaune <br>';
        break;
}

/**
 * on peut alléger l'écriture
 *
 * switch ($couleur) {
    case 'bleu': echo 'Vous aimez le bleu <br>'; break;

    case 'vert': echo 'Vous aimez le vert <br>'; break;

    case 'jaune': echo 'Vous aimez le jaune <br>'; break;

    default: echo 'Vous n\'aimez pas le bleu, le vert ni le jaune <br>';
        break; // facultatif ici le break
}
 */

// ----------
echo '<h4> 11.1- Exercice </h4>';
// ----------
// réécrire le switch précédent en conditions if ... classiques. On doit obtenir le même résultat

if ($couleur == 'bleu') {
    echo 'Vous aimez le bleu <br>';
} elseif ($couleur == 'vert') {
    echo 'Vous aimez le vert <br>';
} elseif ($couleur == 'jaune') {
    'Vous aimez le jaune <br>';
} else {
    echo 'Vous n\'aimez pas le bleu, le vert ni le jaune <br>';
}

/***
 * le switch en PHP compare en == (alors qu'en JS il compare en ===)
 */


// ----------
echo '<h2> 12- Quelques fonctions prédéfinies </h2>';
// ----------
// une fonction prédéfinie permet de réaliser un traitement spécifique prédéterminé dans le langage PHP

// ----------
echo '<h4> 12.1- strpos [string position]</h4>';
// ----------
$email1 = 'prenom@site.fr';
echo strpos($email1, '@'); // affiche la position de l'@ dans la string (en comptant à partir de 0) => affiche 6

echo '<br>';

$email2 = 'bonjour';
echo strpos($email2, '@'); // cette ligne n'affiche RIEN alors qu'il y a pourtant un echo même si on n'a pas de @ dans la string évaluée et la fonction retourne bien quelque chose : 'false'
var_dump(strpos($email2, '@')); // var_dump() permet d'obtenir ce que retourne cette fonction si (ici) le @ n'est pas trouvé. var_dump() est une fonction d'affichage améliorée que l'on utilise en phase de développement

// ----------
echo '<h4> 12.2- strlen [string length]</h4>';
// ----------
$phrase = 'mettez une phrase ici à cet endroit';
echo strlen($phrase); // strlen retourne la taille d'une chaine de caratères (en nombre d'octets de cette chaîne, un caractère accentué valant 2 octets)
echo '<br>';
echo strlen('€'); // 3 octets
echo '<br>';
echo strlen('$'); // 1 octet
echo '<br>';

// strlen() est un compteur et non un tableau => il compte à partir de 1 et retourne 0 si la string est vide

// mb_strlen() Retourne la taille d'une chaîne (pas les octets)

// ----------
echo '<h4> 12.3- substr [sub-string]</h4>';
// ----------
$texte = 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Asperiores, repellat, earum at voluptatibus reprehenderit eum illum unde facilis illo suscipit, iste sequi in esse doloremque eveniet cupiditate rerum eligendi adipisci?';
echo substr($texte, 0, 20) . '...<a href="">Lire la suite</a>';

// substr() retourne une partie du string de la position ici 0 et sur 20 caractères

echo '<br>';

// ----------
echo '<h4> 12.4- trim </h4>';
// ----------
$messageAvecBlancs = '       Hello World     ';
echo strlen($messageAvecBlancs) . '<br>'; // on compte la taille avec les espaces
echo strlen(trim($messageAvecBlancs)) . '<br>'; // on compte la taille une fois les espaces supprimés avec trim en début et en fin de string

// ----------
echo '<h4> 12.5- die() & exit() </h4>';
// ----------
// exit('un message'); // quitte le script après avoir affiché le message (utilisé lors des redirections pour éviter que le script qui suit et est inutile puisqu'on redirige ailleurs)
// die('un message'); // fait la même chose ! die() est un alias de exit()