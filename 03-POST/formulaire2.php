<?php

// Exercice
// - créer un formulaire avec les champs ville, code postal et une zone de texte adresse
// - afficher les données saisies par l'internaute dans la page formulaire2-traitement.php

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="">
<style>
    html{position: relative; min-height: 100%;}
    body{margin-bottom: 60px; /* Margin bottom by footer height */}
</style>
</head>
<body>
<div class="container">
    <h1>Formulaire PHP (pour traitement)</h1>
        
    <form method="POST" action="formulaire2-traitement.php">
        <div class="form-group">
            <label for="city">Ville</label>
            <input type="text" class="form-control" id="city" name="city" placeholder="Toronto">
        </div>
        <div class="form-group">
            <label for="cp">Code postal</label>
            <input type="number" class="form-control" id="cp" name="cp" placeholder="75000">
        </div>
        <div class="form-group">
            <label for="address">Adresse</label>
            <textarea class="form-control" id="address" name="address" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-block btn-info mb-2">Soumettre le formulaire</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"> </script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"> </script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"> </script>
</body>
</html>
