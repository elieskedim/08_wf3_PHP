<?php
/*
	1- Afficher dans une table HTML la liste des contacts avec les champs nom, prénom, téléphone, et un champ supplémentaire "autres infos" avec un lien qui permet d'afficher le détail de chaque contact.

	2- Afficher sous la table HTML le détail d'un contact quand on clique sur le lien "autres infos".
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

$resultat = $bdd->query("SELECT * FROM contact");
$req = $resultat->fetch(PDO::FETCH_ASSOC);

 /* foreach($req[2] as $key => $value){
	echo $key .' = > '. $value .'<br>';
} */
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<title>Affiche contact</title>
</head>
<body>
	<table class="table">
    <thead>
        <tr>
			<td scope="col">Nom</td>
			<td scope="col">Prenom</td>
			<td scope="col">Telephone</td>
			<td scope="col">Action</td>
        </tr>
    </thead>
    <tbody>
        
            <?php

			while($req = $resultat->fetch(PDO::FETCH_ASSOC)){
					//var_dump($req);
					echo '<tr>';
					echo '<td>'.$req['nom'].'</td>';
					echo '<td>'.$req['prenom'].'</td>';
					echo '<td>'.$req['telephone'].'</td>';
					echo '<td><a class="text-dark" href="?affiche='.$req['id_contact'].'">Afficher tous</td>';
					echo '</tr>';
				}
				/*for($i=0; $i< count($req); $i++){;
					?>
				<tr>
				<?php
					foreach($req[$i] as $key => $value){
						echo '<td>'.$value.'</td>';
					}
					?>
					<td><a href="?affiche=<?php echo $req[$i]['id_contact'];?>">Affiche Infos</a></td>
        </tr>
		<?php
		}*/
		?>
    </tbody>
</table>
<div>
<?php
	if(isset($_GET['affiche']) AND !isset($_GET['nom'])){
		$affiche = htmlentities($_GET['affiche']);
		$resultat = $bdd->prepare("SELECT * FROM contact WHERE id_contact = :id_contact");
		$resultat->bindParam(':id_contact',$affiche);
		$requ = $resultat->execute();
		$req = $resultat->fetch(PDO::FETCH_ASSOC);
		?>
		<div class="row mt-5">
			<table class="table col-4">
			<tr>
				<td>Nom : <?=$req['nom'];?></td>
			</tr>
			<tr>
				<td>Prenom : <?=$req['prenom'];?></td>
			</tr>
			<tr>
				<td>Tel : <?=$req['telephone'];?></td>
			</tr>
			<tr>
				<td>Année de rencontre : <?=$req['annee_rencontre'];?></td>
			</tr>
			<tr>
				<td>Email : <?=$req['email'];?></td>
			</tr>
			<tr>
				<td>Type : <?=$req['type_contact'];?></td>
			</tr>
			</table>
			
			<div class="col-6 ml-4">
				<h2>Modifier</h2>
				<form action="" method="post">
				<input type="hidden" name="id" value="<?php echo $_GET['affiche'];?>">
				<label for="nom" >Nom : </label>
				<input type="text" name="nom" id="nom" class="col-6">
				<label for="prenom">Prenom : </label>
				<input type="text" name="prenom" id="prenom"><br>
				<label for="tel">Tel : </label>
				<input type="text" name="tel" id="tel"><br>
				<label for="year">Année de rencontre : </label>
				<input type="text" name="year" id="year"><br>
				<label for="type_contact">Type : </label>
				<input type="text" name="type_contact" id="type_contact"><br>
				</form>
			</div>
		</div>
		<?php
	}
	if(!empty($_POST)){
	
		$resultat = $bdd->prepare("UPDATE contact SET nom = :nom WHERE id_contact = :id_contact");
		$resultat->bindParam(':nom', $_POST['nom']);
		$resultat->bindParam(':id_contact', $_GET['affiche']);
		$req = $resultat->execute();

		if($req){
				echo'OK';
			}else{
				echo'Pas OK';
			}
	}else{
		echo 'test';
	}
				?>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>