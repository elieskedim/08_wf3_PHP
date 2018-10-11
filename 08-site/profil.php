<?php
require_once 'inc/init.inc.php';

/**
 * ****************************** 2- TRAITEMENT **************************
 */

// 2- Si membre non connecté, alors on le redirige vers la page de connexion : il n'a pas le droit d'accéder à son profil
if (!internauteEstConnecte()) {
    header('location:connexion.php');
    exit();
}



 // 1- Préparation des variables d'affichage
 extract($_SESSION['membre']); // extrait tous les indices pour en faire des variables qui reçoivent chacun la valeur qui leur correspondent





/**
 * ****************************** 1- AFFICHAGE **************************
 */
require_once 'inc/haut.inc.php';
?>
<h1 class="mt-4">Profil</h1>

<h2>Bonjour <strong> <?php echo $prenom; ?> ! </strong></h2>

<?php
if (internauteEstConnecteEtAdmin()) echo '<p>Vous êtes un administrateur du site.</p>';
?>

<hr>

<h3>Voici vos informations de profil</h3>

<p>Votre email : <?php echo $email; ?></p>
<p>Votre adresse : <?php echo $adresse; ?></p>
<p>Votre ville : <?php echo $ville; ?></p>

<table class="table table-info table-hover table-striped">
    <tbody>
        <tr>
            <th>Votre email</th>
            <td><?php echo $email; ?></td>
        </tr>
        <tr>
            <th>Votre adresse</th>
            <td><?php echo $adresse; ?></td>
        </tr>
        <tr>
            <th>Votre ville</th>
            <td><?php echo $ville; ?></td>
        </tr>
    </tbody>
</table>
<?php
require_once 'inc/bas.inc.php';
