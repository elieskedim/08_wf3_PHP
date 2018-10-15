<?php

/* 1- Créer une base de données "contacts" avec une table "contact" :
	  id_contact PK AI INT(3)
	  nom VARCHAR(20)
	  prenom VARCHAR(20)
	  telephone VARCHAR(10)
	  annee_rencontre (YEAR)
	  email VARCHAR(255)
	  type_contact ENUM('ami', 'famille', 'professionnel', 'autre')

	2- Créer un formulaire HTML (avec doctype...) afin d'ajouter un contact dans la bdd. Le champ année est un menu déroulant de l'année en cours à 100 ans en arrière à rebours, et le type de contact est aussi un menu déroulant.
	
	3- Effectuer les vérifications nécessaires :
	   Les champs nom et prénom contiennent 2 caractères minimum, le téléphone 10 chiffres
	   L'année de rencontre doit être une année valide
	   Le type de contact doit être conforme à la liste des types de contacts
	   L'email doit être valide
	   En cas d'erreur de saisie, afficher des messages d'erreurs au-dessus du formulaire

	4- Ajouter les contacts à la BDD et afficher un message en cas de succès ou en cas d'échec.

*/
$bdd = new PDO(
    'mysql:host=localhost;dbname=contacts',// driver mysql (pourrait être oracle, IBM, ODBC...) + nom de la BDD
    'root', // pseudo de la BDD
    '', // mdp de la BDD
    //'root', // mdp de la BDD ⚡️ pour Mac ⚡️
    array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, // pour afficher les messages d'erreur SQL
        PDO::MYSQL_ATTR_INIT_COMMAND => 'set NAMES utf8'// définition du jeu de caractère des échanges avec la BDD
    )
);


//----------------------------------------- Traitement ------------------------------------------
$error = "";
if($_GET){
	if(isset($_GET['nom']) && isset($_GET['prenom']) && isset($_GET['tel']) && isset($_GET['annee']) AND isset($_GET['tipe'])){
		foreach ($_GET as $indice => $valeur) {
            $_GET[$indice] = htmlspecialchars($valeur, ENT_QUOTES);
        	}
		if(strlen($_GET['nom']) < 3){
			$error .= "Veuillez entrer un nom plus long";
		}else{
			$nom = $_GET['nom'];
		}

		if(strlen($_GET['prenom']) < 3){
			$error .= "Veuillez entrer un prenom plus long";
		}else{
			$prenom = $_GET['prenom'];
		}

		if(ctype_digit($_GET['annee']) and $_GET['annee'] > date("Y") || $_GET['annee'] < (date("Y")-100)){
			$error .= "Sérieux ! pourquoi tu est parti changé ça ? tu y a cru hein ;)";
		}else{
			$annee = $_GET['annee'];
		}

		if($_GET['tipe'] != "ami" OR $_GET['tipe'] != 'famille' || $_GET['tipe'] != 'pro' OR $_GET['tipe'] != 'autre'){
			$error .= "Tu éssai vraiment de faire n'importe quoi avec mon formulaire hein";
		}else{
			$tipe = $_GET['tipe'];
		}

		if(strlen($_GET['tel']) < 10){
			$error .= "Veuillez entrer un tel plus long";
		}else{
			if(ctype_digit($_GET['tel'])){
				$tel = $_GET['tel'];
			}else{
				$error .= "Veuillez entrer un tel valide !";
			}
			
		}

		if (!filter_var($_GET['email'], FILTER_VALIDATE_EMAIL)) {
    		$error .= "cette adress mail n'est pas valide";
		}else{
			$email = $_GET['email'];
		}

		if(isset($nom) && isset($prenom) && isset($tel) && isset($email) && isset($annee) && isset($tipe)){
			 $resultat = $bdd->prepare('INSERT INTO contact VALUES (0, :nom, :prenom, :tel, :annee, :email, :tipe)');

        	$resultat->bindParam(':nom', $nom);
        	$resultat->bindParam(':prenom', $prenom);
        	$resultat->bindParam(':tel', $tel);
        	$resultat->bindParam(':annee', $annee);
        	$resultat->bindParam(':email', $email);
        	$resultat->bindParam(':tipe', $tipe);

        	$req = $resultat->execute();
			
			if($req){
				echo'OK';
			}else{
				echo'Pas OK';
			}
		}

	}
}









//-------------------------------------- Affichage -----------------------------------------------
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>ajout_contact</title>
</head>
<body>
	<div>
		<?= $error;?>
	</div>
	<form action="" method="get">
		<label for="nom">Nom</label><br>
		<input type="text" name="nom" id="nom"><br><br>

		<label for="prenom">Prenom</label><br>
		<input type="text" name="prenom" id="prenom"><br><br>

		<label for="tel">Tel</label><br>
		<input type="text" name="tel" id="tel"><br><br>

		<label for="annee">Anne de rencontre</label><br>
		<select name="annee" id="annee">
		<?php 
			$i = date("Y");
			$j = date("Y") - 100;
			while ($i >= $j ) {
				echo "<option value=". $i .">$i</option>";
				$i--;
			}
		?>
		</select><br><br>

		<label for="email">Email</label><br>
		<input type="mail" name="email" id="email"><br><br>

		<label for="tipe">Type</label><br>
		<select name="tipe" id="tipe">
			<option value="ami">Ami</option>
			<option value="famille">Famille</option>
			<option value="pro">Pro</option>
			<option value="autre">Autre</option>
		</select>
		<br>
		<input type="submit" value="Envoyer le formulaire">
	</form>
	
</body>
</html>
