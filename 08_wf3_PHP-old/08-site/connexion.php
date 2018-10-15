<?php
require_once 'inc/init.inc.php';
$message_deconnexion = '';

// 2- Déconnexion de l'internaute
if (isset($_GET['action']) && $_GET['action'] == 'deconnexion') { // si on reçoit en $_GET dans l'url l'indice 'action' et la valeur 'deconnexion' c'est que le membre veut se déconnecter

    unset($_SESSION['membre']); // on supprime les informations du membre dans la session
    // si on a un panier dans la session $_SESSION['panier'] l'utilisateur pourra le consulter et s'il se reconnecte alors on recréé $_SESSION['membre'] et il pourra payer
    
    debug($_SESSION);
    $message_deconnexion .= '<div class="alert alert-info">Vous avez été déconnecté.</div>';
    
}


// 3- l'internaute connecté est redirigé vers son profil : il n'y a pas de raison qu'il puisse se reconnecter une seconde (3ème... qui créeraient plusieurs sessions !) fois
if (internauteEstConnecte()) {
    header('location:profil.php'); // on redirige (redirection) l'internaute vers la page située à l'url 'profil.php'
    exit(); // et on quitte le script puisqu'on change de page donc inutile que le serveur continue à travailler (interpréter) les lignes qui suivent devenues inutiles
}


// 1- Traitement du formulaire de connexion
debug($_POST);

if ($_POST) {
    // contrôles sur le formulaire :
    if (empty($_POST['pseudo'])) { // empty vérifie si c'est vide (0, NULL, '', false, non défini)
        $contenu .= '<div class="alert alert-danger">Le pseudo est requis.</div>';
    }
    if (empty($_POST['mdp'])) { // empty vérifie si c'est vide (0, NULL, '', false, non défini)
        $contenu .= '<div class="alert alert-danger">Le mot de passe est requis.</div>';
    }

    if (empty($contenu)) { // si $contenu est vide c'est qu'il n'y a pas d'erreur sur le formulaire de connexion, on peut donc interroger la BDD
        $resultat = executeRequete("SELECT * FROM membre WHERE pseudo = :pseudo AND mdp = :mdp", array(
            ':pseudo'   =>  $_POST['pseudo'],
            ':mdp'      => $_POST['mdp']
        ));

        if ($resultat->rowCount() > 0) { // s'il y a une (ou plusieurs, ce qui est en principe pas possible si on a bien géré les insertionslors de l'inscription) ligne dans $resultat, le pseudo et le mdp existent pour le même membre
            $membre = $resultat->fetch(PDO::FETCH_ASSOC); // pas de while car il n'y a qu'une seule ligne de résultat dans la requête puisque (les pseudos sont uniques)
            debug($membre);

            $_SESSION['membre'] = $membre; // nous créons une session appelée 'membre' qui contient les informations provenant de la BDD
            // $_SESSION['membre'] array multidimensionnel
            // $membre sous-array de $_SESSION

           header('location:profil.php'); // on redirige (redirection) l'internaute vers la page située à l'url 'profil.php'
           exit(); // et on quitte le script puisqu'on change de page donc inutile que le serveur continue à travailler (interpréter) les lignes qui suivent devenues inutiles

        } else { 
            // sinon il n'y a pas de correspondance entre le login et le mdp pour le même membre
            $contenu .= '<div class="alert alert-danger">Identifiants erronés.</div>';

        }
    } // fin if (empty($contenu))

} // fin if ($_POST)

/**
 * *************** AFFICHAGE ******************
 */
require_once 'inc/haut.inc.php';
?>

<h1 class="mt-4">Connexion</h1>

<?php echo $message_deconnexion; ?>
<p>Veuillez indiquer vos identifiants pour vous connecter.</p>

<?php echo $contenu; ?>

<form method="post" action="">
    <div class="form-group">
        <label for="pseudo">pseudo</label>
        <input type="text" class="form-control" id="pseudo" name="pseudo">
    </div>
    <div class="form-group">
        <label for="mdp">Mot de passe</label>
        <input type="password" class="form-control" id="mdp" name="mdp">
    </div>
    
    <input type="submit" class="btn btn-outline-info" value="Se connecter">
</form>



<?php
require_once 'inc/bas.inc.php';