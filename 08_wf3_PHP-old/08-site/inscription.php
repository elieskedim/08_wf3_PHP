<?php

require_once 'inc/init.inc.php';

$affiche_formulaire = true; // pour afficher le formulaire tant que le membre n'est pas inscrit

/************************************** 2- TRAITEMENT DU FORMULAIRE ********************************************** */

// Traitement de $_POST :
// debug($_POST, 2);

if ($_POST) { // !empty[$_POST] - si le formulaire est envoyé

    // Validation du formulaire :
    if (!isset($_POST['pseudo']) || strlen($_POST['pseudo']) < 4 || strlen($_POST['pseudo']) > 20) $contenu .= '<div class="alert alert-danger">Le pseudo doit contenir entre 4 et 20 caractères.</div>';
    
    if (!isset($_POST['mdp']) || strlen($_POST['mdp']) < 4 || strlen($_POST['mdp']) > 20) $contenu .= '<div class="alert alert-danger">Le mot de passe doit contenir entre 4 et 20 caractères.</div>';

    if (!isset($_POST['nom']) || strlen($_POST['nom']) < 2 || strlen($_POST['nom']) > 20) $contenu .= '<div class="alert alert-danger">Le nom doit contenir entre 2 et 20 caractères.</div>';

    if (!isset($_POST['prenom']) || strlen($_POST['prenom']) < 2 || strlen($_POST['prenom']) > 20) $contenu .= '<div class="alert alert-danger">Le prénom doit contenir entre 2 et 20 caractères.</div>';

    if (!isset($_POST['ville']) || strlen($_POST['ville']) < 2 || strlen($_POST['ville']) > 20) $contenu .= '<div class="alert alert-danger">La ville doit contenir entre 2 et 20 caractères.</div>';

    if (!isset($_POST['adresse']) || strlen($_POST['adresse']) < 4 || strlen($_POST['adresse']) > 50) $contenu .= '<div class="alert alert-danger">L\'adresse doit contenir entre 4 et 50 caractères.</div>';

    if (!isset($_POST['civilite']) || ($_POST['civilite'] != 'm' && $_POST['civilite'] != 'f')) $contenu .= '<div class="alert alert-danger">La civilité est incorrecte.</div>';

    if (!isset($_POST['code_postal']) || !preg_match('#^[0-9]{5}$#', $_POST['code_postal'])) $contenu .= '<div class="alert alert-danger">Le code postal est incorrect.</div>'; // l'expression rationnelle (ou régulière) est encadrée par des #. Le ^ signifie que le code postal "commence par" et $ signifie "finit par". La présence des 2 symboles en même temps siginifie qu'on définit l'intégralité de l'expression. [0-9] définit les caractères autorisés de 0 à 9. {5} définit strictement le nombre de ces caractères. La fonction prédéfinie preg_match() retourne 0 si le code postal n'est pas correct, sinon 1.

    /**
     * preg_match() expression rationnelle (ou régulière)
     * # début et fin de l'expression
     * ^ signale que l'expression commence au caractère suivant 
     * $ signifie que l'expression fini par ce qui précède
     * [0-9] accepte les chiffres dans l'intervalle défini entre crochets
     * [a-zA-Z0-9] accepte minuscules, masjuscules et chiffres 0-9
     * {5} quantificateur = nombre de caractères attendus lors de la saisie
     */

     if (!isset($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) $contenu .= '<div class="alert alert-danger">L\'email est incorrect.</div>'; // filter_var() avec le paramètre FILTER_VALIDATE_EMAIL permet de vérifier que la variable est bien de type email. Pour info, vous pouvez valider d'autres types : des adresses IP, des formats d'url... (voir la doc php.net)

     // s'il n'y a plus d'erreur sur le formulaire, on vérifie la disponibilité du pseudo avant d'inscrire le membre en BDD :
    if (empty($contenu)) { // si $contenu est vide c'est qu'il n'y a plus de message d'erreur

        // vérifier en BDD que le pseudo n'existe pas déjà
        // $membre = $pdo->prepare(); // on fait une fonction pour remplacer cela
        $membre = executeRequete("SELECT * FROM membre WHERE pseudo = :pseudo", array(
            ':pseudo'   => $_POST['pseudo']
        )); // $membre contient un objet PDOStatement qui provient de la requête SQL

        if ($membre->rowCount() > 0) { 
            // si la requête retourne des lignes c'est que le pseudo existe en BDD :
            $contenu .= '<div class="alert alert-danger">Le pseudo existe déjà, veuillez en choisir un autre.</div>';
        } else { 
            // le pseudo est disponible : on inscrit donc le membre en BDD :
            executeRequete("INSERT INTO membre (pseudo, mdp, nom, prenom, email, civilite, ville, code_postal, adresse, statut) VALUES (:pseudo, :mdp, :nom, :prenom, :email, :civilite, :ville, :code_postal, :adresse, 0)", array(
                ':pseudo'       => $_POST['pseudo'],
                ':mdp'          => $_POST['mdp'],
                ':nom'          => $_POST['nom'],
                ':prenom'       => $_POST['prenom'],
                ':email'       => $_POST['email'],
                ':civilite'     => $_POST['civilite'],
                ':ville'        => $_POST['ville'],
                ':code_postal'  => $_POST['code_postal'],
                ':adresse'     => $_POST['adresse']
            ));

            $contenu .= '<div class="alert alert-success">Vous êtes inscrit. <a href="connexion.php">Cliquez ici pour vous connecter.</a></div>';

            $affiche_formulaire = false;
        } // if ($membre->rowCount() > 0)

    } // if (empty($contenu))

} // if ($_POST)




/************************************** 1- AFFICHAGE DU SITE ********************************************** */
require_once 'inc/haut.inc.php';
?>
<h1 class="mt-4">Inscription</h1> <!-- mt-4 => margin-top  -->

<?php
echo $contenu;

if ($affiche_formulaire) : // si l'internaute n'est oas inscrit, cette variable valant true on entre dans la condition et on affiche le formulaire
?>
    <p>Veuillez renseigner le formulaire pour vous inscrire.</p>

    <form action="" method="post">
    <!-- (label[for=""]+input[type="" id="" name="" value=""])*3 -->
    <div class="row">
        <div class="col">
            <label for="pseudo">Pseudo</label><br>
            <input type="text" id="pseudo" name="pseudo" value="<?php echo $_POST['pseudo'] ?? ''; ?>"><br><br>

            <label for="mdp">Mot de passe</label><br>
            <input type="text" id="mdp" name="mdp" value="<?php echo $_POST['mdp'] ?? ''; ?>"><br><br>
            
            <label for="nom">Nom</label><br>
            <input type="text" id="nom" name="nom" value="<?php echo $_POST['nom'] ?? ''; ?>"><br><br>

            <label for="prenom">Prénom</label><br>
            <input type="text" id="prenom" name="prenom" value="<?php echo $_POST['prenom'] ?? ''; ?>"><br><br>

            <label for="email">Email</label><br>
            <input type="text" id="email" name="email" value="<?php echo $_POST['email'] ?? ''; ?>"><br><br>

            <label for="">Civilité</label><br>
            &nbsp; <input type="radio" name="civilite" value="m" checked="checked"> Homme &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
            <input type="radio" name="civilite" value="f" <?php if (isset($_POST['civilite']) && $_POST['civilite'] == 'f') echo 'checked'; ?>> Femme<br><br>
        </div>
        <div class="col">
            <label for="ville">Ville</label><br>
            <input type="text" id="ville" name="ville" value="<?php echo $_POST['ville'] ?? ''; ?>"><br><br>

            <label for="code_postal">Code Postal</label><br>
            <input type="text" id="code_postal" name="code_postal" value="<?php echo $_POST['code_postal'] ?? ''; ?>"><br><br>

            <label for="adresse">Adresse</label><br>
            <textarea name="adresse" id="adresse" cols="30" rows="10"><?php echo $_POST['adresse'] ?? ''; ?></textarea><br><br>  
        </div>
    </div>
    <input type="submit" value="S'inscrire" name="inscription" class="btn btn-block btn-outline-info">
    </form>


<?php
endif;

require_once 'inc/bas.inc.php';
