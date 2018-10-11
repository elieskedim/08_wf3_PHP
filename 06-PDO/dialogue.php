<?php
/**
 * CAS PRATIQUE : un formulaire pour poster des commentaires
 * 
 * Objectif : sécuriser le formulaire
 */

/***
 * Modélisation de la BDD :
 * BDD : dialogue 
 * Table : commentaire
 * Champs : id_commentaire      INT(3) PK AI
 *          pseudo              VARCHAR(20)
 *          message             TEXT
 *          date_enregistrement DATETIME
 */

// II- Connexion à la BDD et traitement de $_POST :
// II.1- fonction debug (var_dump)
function debug($param)
{
    echo '<pre>';
     // echo print_r($param);
    echo var_dump($param);
    echo '</pre>';
}

// II.2- connexion BDD
// ⚡️ pour Mac ⚡️
$pdo = new PDO(
    'mysql:host=localhost;dbname=dialogue',// driver mysql (pourrait être oracle, IBM, ODBC...) + nom de la BDD
    'root', // pseudo de la BDD
    '', // mdp de la BDD
    // 'root', // mdp de la BDD ⚡️ pour Mac ⚡️
    array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, // pour afficher les messages d'erreur SQL
        PDO::MYSQL_ATTR_INIT_COMMAND => 'set NAMES utf8'// définition du jeu de caractère des échanges avec la BDD
    )
);

// II.3- Traitement du $_POST
// debug($_POST);

if(!empty($_POST)) {
    
    // V- Traitement contre les failles JavaScript ou CSS : on parle d'échapper les données ou d'échappement
    // Il faut aussi se prémunir contre les failles d'injection de CSS et de JavaScript => il faut assainir (échapper) les données
    // ex: <style>body {display: none;}</style>
    $_POST['pseudo'] = htmlspecialchars($_POST['pseudo'], ENT_QUOTES);
    $_POST['message'] = htmlspecialchars($_POST['message'], ENT_QUOTES);
    // htmlspecialchars ou htmlentities => convertit les caractères spéciaux (<, >, &, '', "") en entités HTML inoffensives par exemple le < devient &lt | > &gt | & &amp
    // ou htmlentities => convertit les caractères spéciaux(<, >, &, '', "") en entités HTML inoffensives par exemple le < devient &lt | > &gt | &&amp ET EN PLUS convertit tous les caractères accentués
    // ainsi les balises <style> ou <script> saisies dans le formulaire deviennent inopérantes
    // avant de tester l'injection CSS à nouveau on met en commentaire le debug() de la ligne 42


    // II.3.1- Nous commençons par faire une requête d'insertion qui n'est pas protégée contre les injections 
    // et qui n'accepte pas les apostrophes :
    // $resultat = $pdo->query("INSERT INTO commentaire (pseudo, date_enregistrement, message) VALUES ('$_POST[pseudo]', NOW(), '$_POST[message]') "); // exemple typique de ce qu'il ne faut pas faire : mettre des entrées utilisateur (ici $_POST) directement dans la requête
    // NOW() génère la date date du jour au format complet (jour heure mn seconde)

    // IV. Injections
    // nous faisons l'injection SQL suivante : ok');DELETE FROM commentaire;(
    // Elle a pour effet de vider la table commentaire
    // exemple si on fait cette injection dans le textarea : "INSERT INTO commentaire (pseudo, date_enregistrement, message) VALUES ('$_POST[pseudo]', NOW(), 'ok');DELETE FROM commentaire;(') "

    // IV.1- Pour se prémunir des injections SQL nous faisons la requête préparée suivante (requête non protégée mise en commentaire à ce moment):
    $resultat = $pdo->prepare("INSERT INTO commentaire (pseudo, date_enregistrement, message) VALUES (:pseudo, NOW(), :message) ");

    $resultat->bindParam(':pseudo', $_POST['pseudo']);
    $resultat->bindParam(':message', $_POST['message']);

    $resultat->execute();

    /***
     *  Comment ça marche ?
     * 
     * - Le fait de mettre des marqueurs dans la requête permet de ne pas concaténer les instructions SQL les rendant 
     * directement exécutables
     * - en faisant un bindParam() les instructions SQL sont automatiquement neutralisées par PDO qui les transforme en
     * strings bruts inoffensifs : ainsi le SGBD attend des valeurs à la place des marqueurs dont il sait qu'elles ne 
     * sont pas du code à exécuter
     */


} // fin if(!empty($_POST))


 // I. Formulaire de saisie des commentaires :
 ?>
 <style>
     h3{ background-color: #e1f4cb; padding-left: 2vw;}
     pre{ background-color: #f1bf98; margin: 0 8vw;}
</style>
 <h1>Votre commentaire</h1>

 <form method="post" action="">
    
    <!-- label[for="pseudo"]{Pseudo}+br+input[type="text" id="pseudo" name="pseudo" value=""]+br -->

    <!-- RAPPEL PHP 7 
        echo var1 ?? var2;
     -->

    <label for="pseudo">Pseudo</label><br>
    <input type="text" id="pseudo" name="pseudo" value="<?php echo $_POST['pseudo'] ?? ''; ?>">
    <br>

    <label for="message">Commentaire</label><br>
    <textarea id="message" name="message" cols="30" rows="10"><?php echo $_POST['message'] ?? ''; ?></textarea><br>
    <br>

    <input type="submit" name="envoi" value="Envoyer">
    <br>

 </form>

 <?php
 // III. Affichage des commentaires
$resultat = $pdo->query("SELECT pseudo, message, DATE_FORMAT(date_enregistrement, '%d-%m-%Y') AS datefr, DATE_FORMAT(date_enregistrement, '%H:%i:%s') AS heurefr FROM commentaire ORDER BY date_enregistrement DESC");

echo $resultat->rowCount() . ' commentaires postés <hr>';

while($commentaire = $resultat->fetch(PDO::FETCH_ASSOC)) {
    echo '<div> Par : ' . $commentaire['pseudo'] . ' le ' . $commentaire['datefr'] . ' à ' . $commentaire['heurefr'] . '</div>';
    echo '<div>' . $commentaire['message'] . '</div><hr>';
}

 ?>