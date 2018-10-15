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


// ----------
echo '<h2> 13- Les fonctions utilisateurs </h2>';
// ----------

// Une fonction est un morceau de code encapsulé dans une paire d'accolades
// elle a un nom pour l'appeler au besoin pour exécuter le code qui s'y trouve

// une fonction vit en 2 temps
// 1- déclaration
// 2- appel

// Déclaration d'une fonction
function separation() { // déclaration d'une fonction sans paramètre
    echo '<hr>';
}

// Appel de la fonction
separation(); // on appelle une fonction par son nom suivi d'une paire de ()

// ----------
echo '<h4> 13.1- Fonction avec paramètre et "return" </h4>';
// ----------

function bonjour($qui) { // $qui est un paramètre. Il apparaît pour la 1ère fois : il permet de recevoir un argument. Il s'agit d'une variable de réception. Notez que l'on peut mettre plusieurs paramètres dans les parenthèses séparés par une virgule
    return 'Bonjour ' . $qui . '<br>'; // return renvoie le string qui le suit à l'endroit où est appelé la fonction
    //... 
    echo 'Cette ligne ne sera pas exécutée car elle est placée après un return !!';
}

echo bonjour('Mila'); // je passe un argument quand j'appelle ma fonction
// si une fonction attend un argument il faut le lui passer sinon on aura une erreur

// ----------
echo '<h4> 13.2- Exercice </h4>';
// ----------
function appliqueTva($nombre) {
    return $nombre * 1.2; // TVA à 20%
}

// Ecrivez une fonction appliqueTva2 qio calcule un nombre multiplié par un taux donné lors de l'appel de la fonction

function appliqueTva2($nombre, $taux = 1.2) // on peut initialiser par défaut un paramètre dans le ca où on ne passe pas de valeur en argument lors de l'appel de la fonction
// on a renommé notre fonction appliqueTva en appliqueTva2 car on ne peut pas déclarer 2 fonctions qui portent le même nom
{
    return $nombre * $taux; 
}

echo appliqueTva2(100, 1.196) . '<br>';
echo appliqueTva2(100) . '<br>';

// ----------
echo '<h4> 13.3- Exercice </h4>';
// ----------
function meteo($saison) {
    echo 'Nous sommes en ' . $saison . '<br>';
}

meteo('automne');
meteo('printemps');

// Au sein d'une nouvelle fonction exoMeteo, afficher l'article 'au' ou 'en' selon la saison
function exoMeteo($saison)
{
    if ($saison === 'printemps') {
        echo 'Nous sommes au ' . $saison . '<br>';
    } else {
        echo 'Nous sommes en ' . $saison . '<br>';
    }

    /* Pareil avec l'écriture ternaire
    echo ($saison === 'printemps') ? 'Nous sommes au ' . $saison . '<br>' : 'Nous sommes en ' . $saison . '<br>';
    */
}

exoMeteo('été');
exoMeteo('printemps');

// correction
function corrigeExoMeteo($saison) {
    if ($saison === 'printemps') {
        $article = 'au';
    } else {
        $article = 'en';
    }
    echo "Nous sommes $article $saison <br>";
}

corrigeExoMeteo('été');
corrigeExoMeteo('printemps');

// ----------
echo '<h4> 13.4- Variables locales & variables globales </h4>';
// ----------
 
/*
____________________
    |                    |
    |   espace global    |
    |                    |
    |  $varA = 10; => globale    |
    |      |

espace local
function maFonction()
|[derniere etape
global $varA; => récupère la variable globale
pour l'utiliser dans la fonction et là sur la 
ligne suivante je n'aurai plus d'erreur]
echo $varA; => erreur
$varB = 20; => locale
return $varB;


espace global
echo $varB; => erreur
echo maFonction(); => affiche 20 car on 
appelle la fonction
*/

// De l'espace local à l'espace global
function jourSemaine() {
    $jour = 'mercredi';
    return $jour;
}
// echo $jour; // erreur car cette variable n'est connue qu'à l'intérieur de la fonction [Notice: Undefined variable: jour]
echo jourSemaine() . '<br>'; // on récupère ici la valeur 'mercredi' grâce au return qui se situe dans la fonction


// De l'espace global à l'espace local
$pays = 'France'; // variable globale

function affichePays() {
    global $pays; // le mot clé 'global' permet de récupérer une variable globale au sein de l'espace local de la fonction
    echo $pays;
}

affichePays();


// ----------
echo '<h2> 14- Structures itératives : les boucles </h2>';
// ----------
// Les boucles sont destinés à répéter des lignes de code de façon automatique


// ----------
echo '<h4> 14.1- La boucle While </h4>';
// ----------
$i = 0; // valeur de départ de la boucle
/*
while ($a <= 10) {
    # code...
}

tantque (condition){
    instructions à répéter;
}
*/

while ($i < 3) { // 3 tours de boucle => on commence à 0 - tant que $i est inférieur à 3, nous entrons dans la boucle
    echo "$i---"; // affiche 0---1---2---
    $i++; // on n'oublie pas d'incrémenter à chaque tour de boucle pour ne pas avoir une boucle infinie
}

// Note : pas de ";" à la fin des structures itératives

echo '<br>';

// ----------
echo '<h4> 14.2- Exercice boucle While </h4>';
// ----------

echo '<select>';
echo '<option>1</option>';
echo '<option>2</option>';
echo '<option>...</option>';
echo '</select>';

echo '<br><br>';
// A l'aide d'une boucle while, afficher dans un sélecteur les années de 1918 à 2018
$annee = 1918;

echo '<select>';
    while ($annee <= 2018) {
        echo "<option>$annee</option>";
        $annee++;
    }
echo '</select>';
echo '<br><br>';

// Même exercice mais en commençant par l'année 2018 pour remonter jusqu'en 1918
$annee = 2018;

echo '<select>';
    while ($annee >= 1918) {
        echo "<option>$annee</option>";
        $annee--;
    }
echo '</select>';
echo '<br><br>';


// Même exercice de manière dynamique
$currentYear = date('Y');
$century = $currentYear - 100;

echo '<select>';
    while ($currentYear >= $century) {
        echo "<option>$currentYear</option>";
        $currentYear--;
    }
echo '</select>';
echo '<br><br>';


// ----------
echo '<h4> 14.3- La boucle Do While </h4>';
// ----------
// La boucle "do while" a la particularité de s'exécuter au moins une fois (correspondant à "do"), puis tant que la condition while est vraie

/*
do {
    # code...
} while ($a <= 10);

exécuter {
    instructions
} tantque (condition);
*/

$j = 1;
do {
    echo 'Je fais un tour de boucle <br>';
    $j++;
} while ($j > 10); // la condition renvoie false ici pourtant la boucle a bien tourné une fois
// 💥/!\ au ";" après le while de cette boucle /!\💥

// exemple d'utilisation : poser une question à l'internaute une 1ère fois avec le "do", puis tant qu'il n'a pas répondu avec le "while"

// ----------
echo '<h4> 14.4- La boucle For </h4>';
// ----------
// la boucle For est une autre syntaxe de la boucle While

for($i = 0; $i < 10; $i++){ // on trouver dans les parenthèses du for : valeur de départ; condition d'entrée dans la boucle; variation de la valeur de départ (incrémentation, décrémentation ou autre chose)
    echo $i . '<br>'; // affiche 0 à 9 en 10 tours
}

// ✨ Rappel : si on veut faire varier $i de 10 en 10 on écrit $i += 10 à la place de $i++ ✨

// ----------
echo '<h4> 14.5- Exercice ~ boucle For </h4>';
// ----------
// afficher 12 options de 1 à 12 à l'aide d'une boucle for

echo '<select>';
for ($i = 1; $i <= 12 ; $i++) { 
    echo '<option>' . $i . '</option>';
}
echo '</select>';

echo '<br><br>';

// ----------
echo '<h4> 14.6- La boucle foreach </h4>';
// ----------
// il existe aussi la boucle foreach pour parcourir les arrays et les objets
// nous la verrons dans un prochain chapitre

// ----------
echo '<h4> 14.6- Exercice </h4>';
// ----------
// afficher avec une boucle For les chiffres de 0 à 9 dans une table HTML sur une seule ligne
/*
echo '<table border="1">';
echo '<tr>';
echo '<td>0</td>';
echo '<td>5</td>';
echo '<td>...</td>';
echo '</tr>';
echo '</table>';
*/
 // sur 1 ligne
echo '<table border="1" style="border-collapse: collapse; color: fuchsia">';
echo '<tr>';
for ($i = 0; $i <= 9 ; $i++) { 
    echo '<td>' . $i . '</td>';
}
echo '</tr>';
echo '</table>';

echo '<br><br>';

// sur 1 ligne en HTML
?>
<table border="1" style="border-collapse: collapse; color: fuchsia">
<tr>
<?php
for ($i = 0; $i <= 9 ; $i++) {
    echo '<td>' . $i . '</td>';
}
?>
</tr>
</table>
<br><br>


<?php
// 1 cellule par ligne
echo '<table border="1" style="border-collapse: collapse; color: fuchsia">';
for ($i = 0; $i <= 9; $i++) {
    echo '<tr>';
        echo '<td>' . $i . '</td>';
    echo '</tr>';
}
echo '</table>';

echo '<br><br>';

// les cellules paires en rouge les impaires en vert
echo '<table border="1" style="border-collapse: collapse; color: fuchsia">';
echo '<tr>';
for ($i = 0; $i <= 9; $i++) {
    if ($i % 2 === 0){
        echo '<td style="background-color: red;">' . $i . '</td>';
    } else {
        echo '<td style="background-color: green;">' . $i . '</td>';
    }
}
echo '</tr>';
echo '</table>';

echo '<br><br>';

// faites une boucle for qui affiche 0 à 9 sur la même ligne, répétée sur 10 lignes, dans une table HTML
echo '<table border="1" style="border-collapse: collapse; color: fuchsia">';
for ($i = 0; $i <= 9; $i++) {
    echo '<tr>';
    for ($j = 0; $j <= 9; $j++) {
        if ($j % 2 === 0) {
            echo '<td style="background-color: yellow;">' . $j . '</td>';
        } else {
            echo '<td style="background-color: cyan;">' . $j . '</td>';
        }
    }
    echo '</tr>';
}
echo '</table>'; // nous avons ici le principe des boucles imbriquées : quand la 1ère boucle fait 1 tour, la boucle intérieure fait 10 tours

echo '<br><hr><br>';

// pareil en numérotant les cellules de 0 à 99
echo '<table border="1" style="border-collapse: collapse; color: fuchsia">';
echo '<tr>';
for ($i = 0; $i <= 99; $i++) {
    if ($i % 10 == 0) {
            echo '</tr><tr>';
        }
    echo '<td>' . $i . '</td>';
    }
    echo '</tr>';
echo '</table>';

echo '<br><br>';

echo '<table border="1" style="border-collapse: collapse; color: fuchsia">';
    echo '<tr>';
        for ($i = 0; $i <= 99; $i++) {
            if ($i % 10 == 0) {
                    echo '</tr><tr>';
                }
            if ($i % 2 == 0){
                echo '<td style="background-color: #c5979d;">' . $i . '</td>';
            } else {
                echo '<td style="background-color: #484d6d;">' . $i . '</td>';
            }
        }
    echo '</tr>';
echo '</table>';

echo '<br><hr><br>';


// ----------
echo '<h4> 15- Les tableaux ou Array </h4>';
// ----------
// un tableau, ou array en anglais, est déclaré comme une variable améliorée dans laquelle on stocke une multitude de valeurs. Ces valeurs peuvent être de n'importe quel type. Elles possèdent un indice dont la numérotation par défait commence à 0

// déclaration d'un array - méthode 1
$liste = array('Grégoire', 'Nathalie', 20, 'Emilie', 'François', 'Georges', true);

echo 'Le type de $liste est : ' . gettype($liste) . '<br>'; // affiche le type array

//echo $liste; // Notice: Array to string conversion => erreur : vous essayez d'afficher un tableau, ce qui n'est pas possible avec un echo

// PRINT_R() est plus synthétique que var_dump() => il n'affiche pas le type des éléments contenus dans l'array
echo '<pre>'; // <pre> balise HTML qui permet de formater l'affichage
    print_r($liste);
echo '</pre>';

echo '<br>';

// VAR_DUMP() affiche le contenu du tableau plus certaines informations
echo '<pre>'; // balise de préformatage
    var_dump($liste);
echo '</pre>';

echo '<br>';

// fonction d'affichage d'un print_r avec balise <pre>
function debug($param) {
    echo '<pre style="background-color: lightgray;">';
        print_r($param);
    echo '</pre>';
}

// autre méthode de déclaration d'un array (depuis PHP 5.4)
$tab = ['France', 'Espagne', 'Italie', 'Portugal'];
debug($tab);

$tab[] = 'Australie'; // [] vides permettent de compléter un array en ajoutant des valeurs à la fin
debug($tab);

$tab[2] = 'test';
debug($tab);

$tab[25] = 'indice 25 de mon $tab';
debug($tab);


// ----------
echo '<h4> 15.1- Les tableaux associatifs </h4>';
// ----------
// un tableau associatif est un tableau dans lequel on choisir la dénomination des indices
$couleur = array(
    'j' =>  'jaune',
    'b' =>  'bleu',
    'v' =>  'vert'
);

// pour accéder à un élément du tableau associatif :
echo 'La seconde couleur du tableau est le ' . $couleur['b'] . '<br>';

echo "La seconde couleur du tableau est le $couleur[b] <br>"; // affiche bleu
// un array écrit dans des guillemets ou des quotes perd les quotes autour de son indice

/**
 * PARTIE PERSO
 */
// fonction d'affichage d'un print_r() avec balise <pre>
function debugP($param) {
    echo '<pre style="background-color: #d5ecd4 ;">';
    echo '<strong>print_r()</strong> <br>';
        print_r($param);
    echo '</pre>';
}

// fonction d'affichage d'un var_dump() avec balise <pre>
function debugV($param) {
    echo '<pre style="background-color: #ebd4cb;">';
    echo '<strong>var_dump()</strong> <br>';
        var_dump($param);
    echo '</pre>';
}

debugP($couleur);
debugV($couleur);
/**
 * PARTIE PERSO ~ FIN
 */

// mesurer la taille d'un array
echo 'Taille du tableau $couleur : ' . count($couleur) . '<br>';
echo 'Taille du tableau $couleur : ' . sizeof($couleur) . '<br>';
// count() et sizeof() font la même chose : ils comptent le nombre d'éléments dans l'array indiqué


// ----------
echo '<h2> 16- La boucle foreach </h2>';
// ----------
// la boucle foreach est un moyen "simple" de passer en revue un tableau ou un abjet
// elle retourne une erreur si vous tentez de l'utiliser sur autre chose

debugP($tab);


// foreach - version 1
foreach ($tab as $valeur) { // le mot clé AS fait partie de la structure syntaxique de la foreach : il est obligatoire. $valeur vient parcourir la colonne des valeurs de l'array, notez qu'on peut l'appeler comme on veut : c'est sa place après AS qui détermine qu'elle parcourt les valeurs

    echo $valeur . '<br>'; // on affiche successivement les éléments du tableau à chaque tour de boucle. La foreach s'arrête automatiquement à la fin du tableau
}

echo '<br>';

// foreach - version 2
foreach ($tab as $indice => $valeur) { // quand il y a 2 variables après AS, la première parcourt la colonne des indices (quelque soit son nom) et la seconde parcourt la colonne des valeurs (quelque soit son nom)
    echo $indice . ' est l\'indice de la valeur ' . $valeur . '<br>';
}

// ----------
echo '<h4> 16.1- Exercice </h4>';
// ----------
// écrivez un array associatif avec les indices prénom, nom, email et téléphone et mettez-y des informations pour une seule personne
// puis avec une boucle foreach, affichez les valeurs dans des <p>, sauf pour le prénom qui doit être dans un <h3>

$bibi = array(
    'prenom'    =>  'Mila',
    'nom'       =>  'Gauriau',
    'email'     =>  'moi@moi.fr',
    'tel'       =>  '07.84.18.09.13',
);

foreach ($bibi as $indice => $contact) {
    if ($indice === 'prenom'){
        echo '<h3>' . $contact . '</h3>';
    } else {
        echo '<p>' . $contact . '</p>';
    }
}

/**
 * 27/09/2018
 */
// correction
$coordonnees = array(
    'prenom'    =>  'John',
    'nom'       => 'Doe',
    'email'     => 'johnDoe@gmail.com',
    'telephone' => '0601020304'
);

foreach ($coordonnees as $index => $item) {
    if ($index == 'prenom') {
        echo '<h3>' . $item . '</h3>';
    } else {
        echo '<p>' . $item . '</p>';

    }
}

echo '<hr>';


// ----------
echo '<h2> 17- Les tableaux (arrays) multidimensionnels </h2>';
// ----------

/*
$tab_multi

_| => tableau externe
* => tableau interne
 ________________________________________________________________________
 |                       |                                               |
 |                       | ********************************************  |
 |                       | * prenom     *  Julien                     *  |
 |         0             | ********************************************  |
 |                       | * nom        *  Dupont                     *  |
 |                       | ********************************************  |
 |                       | * telephone  *  0601020304                 *  |
 |                       | ********************************************  |
 |_______________________|_______________________________________________|
 |                       |                                               |
 |                       | ********************************************  |
 |                       | * prenom     *  Nicolas                    *  |
 |         1             | ********************************************  |
 |                       | * nom        *  Durans                     *  |
 |                       | ********************************************  |
 |                       | * telephone  *  0601020304                 *  |
 |                       | ********************************************  |
 |_______________________|_______________________________________________|
 |                       |                                               |
 |                       | ********************************************  |
 |                       | * prenom     *  Pierre                     *  |
 |         2             | ********************************************  |
 |                       | * nom        *  Dulac                      *  |
 |                       | ********************************************  |
 |                       | * telephone  *  0601020304                 *  |
 |                       | ********************************************  |
 |_______________________|_______________________________________________|

 */
//Nous parlons de tableau multidimensionnel quand un tableau est contenu dans un autre tableau
// chaque tableau représente une dimension

// création d'un array multidimensionnel
$tab_multi = array(
    0   => array(
        'prenom'    => 'Julien',
        'nom'       => 'Dupont',
        'telephone' => '0601020304'
    ),
    1   => array(
        'prenom'    => 'Nicolas',
        'nom'       => 'Durand',
        'telephone' => '0601020304'
    ),
    2   => array(
        'prenom'    => 'Pierre',
        'nom'       => 'Dulac',
        'telephone' => '0601020304'
    ),
); // il est possible de choisir le nom des indices dans cet array multidimensionnel

debugP($tab_multi);
debugV($tab_multi);

echo '<hr>';

// accéder à la valeur "Julien" dans cet array
echo $tab_multi[0]['prenom']; // affiche Julien. Nous entrons d'abord à l'indice [0] de $multi_tab pour ensuite aller à l'indice ['prenom'] dans le sous-tableau

// ----------
echo '<h4> 17.1- Exercice </h4>';
// ----------
// parcourir le tableau multidimensionnel avec une boucle for 
// ce qui est possible car les indices sont numériques
for ($i = 0; $i < 3 ; $i++) {
    echo $tab_multi[$i]['prenom'] . '<br>';
}
echo '<hr>';

// de façon dynamique
for ($i = 0; $i < count($tab_multi) ; $i++) { // count($tab_multi) ou sizeof($tab_multi)
    echo $tab_multi[$i]['prenom'] . '<br>';
}
echo '<hr>';

// ----------
echo '<h4> 17.2- Exercice </h4>';
// ----------
// afficher les 3 prénoms avec une boucle foreach
foreach ($tab_multi as $info) { // $info => c'est le sous-array que l'on récupère
    // debugP($info);
    echo $info['prenom'] . '<br>';
}

echo '<hr>';

foreach ($tab_multi as $key => $value) {
    debugP($value);
    echo $tab_multi[$key]['prenom'] . '<br>';
    echo $value['prenom'] . '<br>'; // $value c'est $tab_multi[$key]
}

echo '<hr>';

// ----------
echo '<h4> 17.3- Exercice </h4>';
// ----------
// afficher toutes les valeurs de l'array $tab_multi en utilisant foreach
foreach ($tab_multi as $sous_tableau) { // je ne mets pas d'index car je ne me sers pas de l'indice de l'array externe |_
    foreach ($sous_tableau as $indice => $info) { // ici l'index $indice du array intérieur me sert que pour mon IF
        // $sous_tableau étant lui même un array on le parcourt aussi avec une foreach
        // debugP($value);
        // debugP($indice);
        if($indice === 'telephone') {
            echo $info; // $info correspond aux valeurs de $sous_tableau 
        } else {
            echo $info . ' - '; // $info correspond aux valeurs de $sous_tableau
        }
    }
    echo '<br>';
}

echo '<hr>';

// ----------
echo '<h2> 18- Les inclusions de fichiers </h2>';
// ----------
/*                              
    CONFIGURATION                                                           TEMPLATES
         ||                                                                   ||
         \/                 ____________________________________              \/
~~~~~~~~~~~~~~~~~~~~~~      |                                   |      
functions.inc.php           |              HEADER               | ==> fichier header.inc.php
                            |___________________________________|
connexionBdd.inc.php        |                                   |
                            |                                   |
                            |                                   |
                            |              CONTENU              |
                            |                                   |
                            |                                   |
                            |___________________________________|
                            |                                   |
                            |              FOOTER               | ==> fichier footer.inc.php
                            |___________________________________|

 */

echo 'Première inclusion : ';
include 'exemple.inc.php'; // le fichier dont le chemin est spécifié est inclus ici. En cas d'erreur lors de l'inclusion du fichier, "include" génère une erreur de type warning et continue l'exécution du script

echo 'Deuxième inclusion : ';
include_once 'exemple.inc.php'; // le 'once' vérifie si le fichier a déjà été inclus. Si c'est le cas (dans le script avant la ligne avec "once") il ne le ré-inclut pas

echo '<br><br> Troisième inclusion : ';
require 'exemple.inc.php'; // le fichier est "requis" donc obligatoire : en cas d'erreur lors de l'inclusion du fichier, 'require' génère une erreur de type "fatal error" et stoppe l'exécution du script

echo 'Quatrième inclusion : ';
require_once 'exemple.inc.php'; // le 'once' vérifie si le fichier a déjà été inclus. Si c'est le cas (dans le script même après la ligne avec "once") il ne le ré-inclut pas

// le "inc" dans le nom du fichier inclus est indicatif pour préciser aux développeurs qu'il s'agit d'un fichier d'inclusion, et donc pas d'une page à part entière. Ce n'est pas obligatoire mais utile

echo '<hr>';

// ----------
echo '<h2> 19- La gestion des dates </h2>';
// ----------
echo date('d/m/Y ~ H:i:s') . '<br>'; 
/**
 * date() retourne la date de maintenant selon le format indiqué 
 * => d day, 
 * => m month, 
 * => Y year sur 4 chiffres, y sur 2 chiffres, 
 * => H hour s/ 24h, h s/ 12h, 
 * => i mInute, 'm' est réservé à 'month' donc le 'i' est la 2ème lettre de minute
 * => s second
 */

echo date('Y-m-d ~ i,s,h') . '<br>'; // on peut changer l'ordre des paramètres ainsi que le sépararteur

// ----------
echo '<h4> 19- Le timestamp </h4>';
// ----------
// le timestamp est le nombre de secondes écoulées entre une date et le 01/01/1970 à 00h00m00s. Cette date correspond à la création du système UNIX (1er système d'exploitation moderne de notre histoire informatique)
// ce système de timestamp est utilisé par de nombreux langages de programmation dont le PHP et le JavaScript

//-----
echo time() . '<br>'; // retourne l'heure actuelle en timestamp

// ----------
echo '<h5> changer le format d\'une date (méthode procédurale) </h5>';
// ----------
$dateJour = strtotime('27-09-2018'); // strtotime() transforme la date exprimée en string en timestamp
// en raison du système 32bits l'encodage est limité en nombre de caractères d'encodage et passé 2038 en fait cette fonction ne pourra plus fonctionner faute de place
echo $dateJour . '<br>'; // affiche le timestamp du jour

debugV(strtotime('13-13-2018')); // ici retourne false car la date fourni n'est pas valide. Cette fonction permet donc de valider une date

$dateFormat = strftime('%Y-%m-%d', $dateJour); // argument 1 format de sortie souhaité et argument 2 la date à traiter
// strftime() transforme une date donnée en stimestamp selon le format indiqué, ici en année-mois-jour
echo $dateFormat . '<br>';

// ----------
echo '<h5> changer le format d\'une date (méthode objet) </h5>';
// ----------
$date = new DateTime('11-04-2017'); // $date est un objet date qui représente le 11-04-2017 (on instancie la class DateTime)
debugV($date);

// https://www.w3schools.com/php/php_date.asp

echo $date->format('Y-m-d') . '<br>'; // on peut formater cet objet date en appelant sa méthode format() et en lui indiquant les paramètres du format souhaité, ici 'Y-m-d'. Affiche 2017-04-11

echo '<hr>';

// ----------
echo '<h2> 20- Les superglobales </h2>';
echo 'voir les fichiers correspondants';
// ----------

// ----------
echo '<h2> 21- Introduction aux objets </h2>';
// ----------

/**
 * Dans monde réel tout est objet
 * 
 *              caractéristiques             actions
 *              _______________________________________
 * VOITURE       marque                     démarrer 
 *               puissance                  rouler
 *               prix                       tourner
 *               couleur 
 * 
 * 
 * Objet        propriétés / attributs      méthodes
 * $voiture     
 *                  $marque                 rouler()
 *                  $couleur                tourner()
 * 
 *    /\
 *    ||
 * classe voiture
 * 
 * 
 * Dans le monde de la programmation il y a aussi des objets : paniers d'achat
 */

/***
 * Un objet est un autre type de données, il représente un objet du réel (exemple : une voiture, un meuble, un
 * personnage...) auquel on peut associer des caractéristiques appelées propriétés (ou attributs), ainsi que des fonctions
 * pour faire des actions appelées méthodes (une fonction dans un objet s'appelle une méthode)
 * 
 * Pour créer un objet, il nous faut un "plan de construction" : c'est le rôle de la classe
 * Nous créons ici une classe pour fabriquer des objets meubles :
 */

 class Meuble { //on met une majuscule au nom des classes
    public $marque = 'Ikea'; // $marque est une propriété - public pour dire qu'elle est accessible à l'extérieur de
    // la classe (un peu comme la portée des variables dans les fonctions par exemple)

    public function prix(){ // prix est une méthode ( = une fonction dans un objet)
        return rand(50, 200); // rand() choisit un entier aléatoirement entre 2 nombres
    }
 } // cette classe est un "plan de construction" d'objets "meubles" qui pourront utiliser la propriété $marque et la méthode prix()

 // puis nous créons une table à partir de cette classe :

 $table = new Meuble(); // $table est un objet de la classe meuble
 // quand on créé un objet d'une classe, on instancie la classe
 // new est un mot clé qui permet d'instancier la classe Meuble pour en faire un objet $table
 // on dit qeu $table est une instance de la classe

 debugV($table); // affiche le type 'object', la classe Meuble dont il vient et sa propriété $marque (mais pas la méthode)

 echo 'La marque de ma table est : ' . $table->marque . '<br>'; 
 // la flèche simple est pareille que le point en JS
 // array => $array[coucou]
 // objet => $objet->coucou
 // pour accéder à la propriété d'un objet on écrit l'objet suivi d'une flèche "->" suivi du nom de la propriété sans le "$"

 echo 'Le prix de ma table est : ' . $table->prix() . '€ <hr>'; // pour accéder à une méthode d'un objet, on écrit l'objet suivi d'une flèche "->" suivi du nom de la méthode avec une paire de ()



 /**
  * $tableau = array( 'indice' => 'valeur', ...);
  ******
  * $objet->propriete
  * $objet->methode()
  ******
  * $objet->methode(PDO::FETCH_ASSOC)
  * $objet->methode(Classe::CONSTANTE)
  * 
  */

 