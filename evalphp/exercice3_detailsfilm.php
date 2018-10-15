<?php
require_once "exercice3bdd.php";
if(!empty($_GET)){
    $id_film = htmlspecialchars($_GET['id_film'], ENT_QUOTES);
    $resultat = $bdd->prepare('SELECT * FROM movies WHERE id_film = :id_film');
    $resultat->bindParam(':id_film', $id_film);
    $resultat->execute();
    
    //var_dump($id_film);
//Je vérifie qu'aucune érreur ne se soit glisser sinon je redirige vers la page de liste
    if($resultat->rowCount() == 0){
        echo 'Une érreur c\'est produite Vous aller être rediriger vers la liste des films';
        header("Refresh:5;url=exercice3_listefilm.php");
        exit();
    }
}
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
<table class="table">
    <thead>
        <tr>
			<td scope="col">Nom du film</td>
			<td scope="col">Réalisateur</td>
			<td scope="col">Année de production</td>
			<td scope="col">Acteurs</td>
            <td scope="col">Producteur</td>
            <td scope="col">Langue</td>
            <td scope="col">Catégorie</td>
            <td scope="col">Résumer</td>
            <td scope="col">Trailer</td>
        </tr>
    </thead>
    
    <tbody><!-- jaffiche tous les elements -->
            <?php

			while($req = $resultat->fetch(PDO::FETCH_ASSOC)){
					//var_dump($req);
					echo '<tr>';
					echo '<td>'.$req['title'].'</td>';
					echo '<td>'.$req['director'].'</td>';
					echo '<td>'.$req['year_of_prod'].'</td>';
                    echo '<td>'.$req['actors'].'</td>';
                    echo '<td>'.$req['producer'].'</td>';
                    echo '<td>'.$req['language'].'</td>';
                    echo '<td>'.$req['category'].'</td>';
                    echo '<td>'.$req['storyline'].'</td>';
                    echo '<td><a href="'.$req['video'].'">Trailer</a></td>';
					echo '</tr>';
                }
		?>
    </tbody>
</table>
<a href="exercice3_listefilm.php">Retour à la liset de films</a>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>