<?php
//---------------------------------- TRAITEMENT-----------------------
//Je récupère la base de donnée
require_once "exercice3bdd.php";

//Je récupère toutes les valeurs présente dans la base de données
$resultat = $bdd->query("SELECT * FROM movies");

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Exercice3</title>
</head>
<body>
    <div class="container">
        <table class="table">
    <thead>
        <tr>
			<td scope="col">Nom du film</td>
			<td scope="col">Réalisateur</td>
			<td scope="col">Année de production</td>
			<td scope="col">Action</td>
        </tr>
    </thead>
    <tbody><!-- Jaffiche tous les éléments -->
        
            <?php

			while($req = $resultat->fetch(PDO::FETCH_ASSOC)){
					//var_dump($req);
					echo '<tr>';
					echo '<td>'.$req['title'].'</td>';
					echo '<td>'.$req['director'].'</td>';
					echo '<td>'.$req['year_of_prod'].'</td>';
					echo '<td><a class="text-dark" href="exercice3_detailsfilm.php?id_film='.$req['id_film'].'">Plus dinfos</td>';
					echo '</tr>';
				}
		?>
    </tbody>
</table>
    </div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>