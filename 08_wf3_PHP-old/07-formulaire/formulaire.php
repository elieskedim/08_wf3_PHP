<?php
/***
 * *******************************
 *    Validation de formulaire
 * *******************************
 */

 // Créer un formulaire qui permet d'enregistrer un nouvel employé dans la BDD société

 $msg = ''; // déclaration d'une variable pour afficher les messages d'erreur


/***
 * 2- Connexion BDD :
 */


// fonction debug(var_dump)
    function debug($param)
{
    echo '<pre>';
     // echo print_r($param);
    echo var_dump($param);
    echo '</pre>';
}

// ⚡️ pour Mac ⚡️
$pdo = new PDO(
    'mysql:host=localhost;dbname=societe',// driver mysql (pourrait être oracle, IBM, ODBC...) + nom de la BDD
    'root', // pseudo de la BDD
    '', // mdp de la BDD
    //'root', // mdp de la BDD ⚡️ pour Mac ⚡️
    array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, // pour afficher les messages d'erreur SQL
        PDO::MYSQL_ATTR_INIT_COMMAND => 'set NAMES utf8'// définition du jeu de caractère des échanges avec la BDD
    )
);


/***
 * 3- Traitement de $_POST :
 */
if ($_POST) { // écriture simplifiée => if(!empty($_POST)) - grâce aux valeurs implicites - 
    // le formulaire est posté, on a reçu des informations

    debug($_POST);

    // 3.1- Contrôles du formulaire
    if (!isset($_POST['prenom']) || strlen($_POST['prenom']) < 3 || strlen($_POST['prenom']) > 20 ) $msg .= '<p>Le prénom doit comporter entre 3 et 20 caractères.</p>';
        // on vérifie que l'indice prénom existe !isset($_POST['prenom'])
        // si n'existe pas l'indice prénom c'est que le name (du formulaire) correspondant a été modifié
        // on vérifie aussi la longueur du prénom

    if (!isset($_POST['nom']) || strlen($_POST['nom']) < 3 || strlen($_POST['nom']) > 20) $msg .= '<p>Le nom doit comporter entre 3 et 20 caractères.</p>';

    if (!isset($_POST['service']) || strlen($_POST['service']) < 3 || strlen($_POST['service']) > 30) $msg .= '<p>Le service doit comporter entre 3 et 30 caractères.</p>';

    if (!isset($_POST['sexe']) || ($_POST['sexe'] != 'm' && $_POST['sexe'] !='f')) $msg .= '<p>Le sexe n\'est pas valide.</p>';

    if (!isset($_POST['date_embauche']) || !strtotime($_POST['date_embauche'])) $msg .= '<p>La date n\'est pas valide</p>';
    // rappel strtotime => renvoie FALSE si le timestamp de la date fournie ne peut pas être obtenue, autrement 
    // si la date n'est pas réputée valide (sinon cette fonction retourne un timestamp pour la date renseignée)
echo strtotime($_POST['date_embauche']);
    if (!isset($_POST['salaire']) || !is_numeric($_POST['salaire']) || $_POST['salaire'] <= 0) $msg .= '<p>Le salaire doit être un nombre positif</p>';
    // is_numeric() vérifie si la variable est un nombre ou bien une chaîne numérique (un nombre en string)
    // ⚠️ is_int() recherche un chiffre alors qu'en BDD on récupère un chiffre mais entre quotes donc un string !! ⚠️

    // 3.2- Si la variable $msg est vide c'est que le formulaire est valide : peut enregister en BDD
    if (empty($msg)) {
        
        // 3.3- on échappe toutes les valeurs de $_POST :
        foreach ($_POST as $indice => $valeur) {
            $_POST[$indice] = htmlspecialchars($valeur, ENT_QUOTES); // on prend la valeur que l'on traite avec htmlspecialchars() puis que l'on range dans son emplaçement initial qui et $_POST[$indice] (image du nettoyage des chaussures que l'on sort pour nettoyer et que l'on range à nouveau après)
        }

        // 3.4- on reformate la date saisie jj-mm-YYYY en YYYY-mm-jj qui est le format de la BDD
        $date = new DateTime($_POST['date_embauche']); // on créé un objet $date qui contient la date d'embauche à partir de la classe DateTime
        $date_embauche = $date->format('Y-m-d'); // on utilise la méthode format() pour changer le format de la date
        // $date_embauche est un strig puisque j'ai affecté le résultat du reformatage de l'obejt $date à la variable $date_embauche
        debug($date_embauche);

        // 3.5- La requête préparée
        $resultat = $pdo->prepare("INSERT INTO employes (prenom, nom, sexe, service, date_embauche, salaire) VALUES (:prenom, :nom, :sexe, :service, :date_embauche, :salaire)");

        // $resultat->bindParam(':prenomX', $_POST['prenom']); // simuler une erreur lors du execute cf lignes 107-108
        $resultat->bindParam(':prenom', $_POST['prenom']);
        $resultat->bindParam(':nom', $_POST['nom']);
        $resultat->bindParam(':sexe', $_POST['sexe']);
        $resultat->bindParam(':service', $_POST['service']);
        $resultat->bindParam(':date_embauche', $date_embauche); // cf 3.4
        $resultat->bindParam(':salaire', $_POST['salaire']);

        $req = $resultat->execute(); // $req est un booléen : true en cas de succès de la requête; sinon false en cas d'échec

        /** RAPPEL -- cf. pdo.php ligne 343 --
         * La méthode prepare() permet de préparer une requête mais ne l'exécute pas. 
         * execute() permet d'exécuter une requête préparée
         * 
         * Valeurs de retour :
         *  - prepare() renvoie toujours un objet PDOStatement
         *  - execute() :
         *          - Succès : TRUE
         *          - Echec : FALSE
         */ 

        // Message de réussite ou d'échec de l'enregsitrement
        if ($req) {
            $msg .= '<p style="background-color: green;">SUCCES : L\'employé a bien été ajouté !</p>';
        } else {
            $msg .= '<p style="background-color: red;">ERREUR : L\'employé n\'a pû être ajouté.</p>';
        }

    } // fin if (empty($msg))
    
} // fin if ($_POST)


/**
         * CULTURE de programmeur => Les valeurs implicites
         * 
         * 0 est interprété => FALSE
         * 
         * 1 est interprété => TRUE
         * 24 est interprété => TRUE
         * -5 est interprété => TRUE
         * 
         * '' est interprété => FALSE
         * 'hello' est interprété => TRUE
         * 
         * array() est interprété => FALSE
         * array('azerty', 1, 'fghjk') est interprété => TRUE
         * 
         */



/***
 * 1- Le formulaire HTML :
 */
echo $msg;
?>

<!-- form[method="post"]>(label+br+input[id="" name="" value=""]+br)*7 -->
<form action="" method="post">
    <label for="prenom">Prénom</label>
    <br>
    <input type="text" id="prenom" name="prenom" value="<?php echo $_POST['prenom'] ?? ''; ?>">
    <br>

    <label for="nom">Nom</label>
    <br>
    <input type="text" id="nom" name="nom" value="<?php echo $_POST['nom'] ?? ''; ?>">
    <br>

    <label>Sexe</label>
    <br>
    <input type="radio" name="sexe" value="m" checked> Homme
    <input type="radio" name="sexe" value="f" <?php if (isset($_POST['sexe']) && $_POST['sexe'] == 'f') echo 'checked'; ?>> Femme
    <br>

    <label for="service">Service</label>
    <br>
    <input type="text" id="service" name="service" value="<?php echo $_POST['service'] ?? ''; ?>">
    <br>

    <label for="date_embauche">Date d'embauche</label>
    <br>
    <input type="text" id="date_embauche" name="date_embauche" value="<?php echo $_POST['date_embauche'] ?? ''; ?>" placeholder="jj-mm-aaaa">
    <br>
    
    <label for="salaire">Salaire</label>
    <br>
    <input type="text" id="salaire" name="salaire" value="<?php echo $_POST['salaire'] ?? '' ;?>">
    <br>

    <br>
    <input type="submit" value="Enregistrer">
    <br>
</form>
