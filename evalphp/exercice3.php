<?php
//---------------------------------- TRAITEMENT-----------------------
require_once "exercice3bdd.php"; //On iclu la connexion à la base de donné
$error = '';
if(!empty($_POST)){
   // var_dump($_POST);
     //Je vérifie que tous les champs sont bien remplit
    if(isset($_POST['title']) && isset($_POST['name']) && isset($_POST['actor']) && isset($_POST['producer']) && isset($_POST['lang']) && isset($_POST['year_prod']) && isset($_POST['cat']) && isset($_POST['storie']) && isset($_POST['url'])){

        //Je vérifie le nombre de carctére présent dans la chaine
        if(strlen($_POST['title']) < 5){
            $error .= "Veuillez indiquer un titre avec minimum 5 caractère.<br>";
        }
        if(strlen($_POST['name']) < 5){
            $error .= "Veuillez indiquer un Nom de real avec minimum 5 caractère.<br>";
        }
        if(strlen($_POST['producer']) < 5){
            $error .= "Veuillez indiquer un Nom de producteur avec minimum 5 caractère.<br>";
        }
        if(strlen($_POST['storie']) < 5){
            $error .= "Veuillez indiquer un Résumer avec minimum 5 caractère.<br>";
        }
        //Je vérifie si l'url passer est bien valide
        if(!filter_var($_POST['url'], FILTER_VALIDATE_URL)){
            $error .= "Veuillez indiquer une url valide.<br>";
        }
       
        //var_dump($_POST);
    }else{
        $error .= "Veuillez remplir tous les champs demander.";
    }
    //Si la variable érreur est vide donc qu'il n'y a pas eu dérreur dans le formulaire
    if(empty($error)){
        //je fait une boucle pour retirer tous les caractère spéciaux pouvant être envoyer dans le formaulaire
        foreach ($_POST as $indice => $valeur) {
            $_POST[$indice] = htmlspecialchars($valeur, ENT_QUOTES); // pour éviter les injections CSS et JS
        }

        //Je prépare une requête 
        $resultat = $bdd->prepare('INSERT INTO movies VALUES (0, :title, :actors, :director, :producer, :year_of_prod, :lang, :cat, :storie, :video)');

        $resultat->bindParam(':title', $_POST['title']);
        $resultat->bindParam(':actors', $_POST['actor']);
        $resultat->bindParam(':director', $_POST['name']);
        $resultat->bindParam(':producer', $_POST['producer']);
        $resultat->bindParam(':year_of_prod', $_POST['year_prod']);
        $resultat->bindParam(':lang', $_POST['lang']);
        $resultat->bindParam(':cat', $_POST['cat']);
        $resultat->bindParam(':storie', $_POST['storie']);
        $resultat->bindParam(':video', $_POST['url']);

        $req = $resultat->execute();
        //mettre le $resultat->execute(); dans une variable nous renvoie un booleen dont je me set pour savoir si l'ajout c'est bien passer
        if($req){
            header('Location:exercice3_listefilm.php');
            exit();//il faut toujour faire un exit apres une redirection
        }else{
            $error .= "L'ajout est un echec";
        }
    }
}//Fin du if !empty($_POST)

//----------------------------------- AFFICHAGE----------------------
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
        <div style="color:red;">
        <!-- J'affiche les erreurs contenue dans la variable $error -->
            <?=$error;?>
        </div>
        <form action="" method="POST">
        <div class="form-row">
            <div class="form-group col-md-6">
            <label for="title">Titre</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Titre du film">
            </div>
            <div class="form-group col-md-6">
            <label for="name">Nom</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Nom du Réalisateur">
            </div>
        </div>
        <div class="form-group">
            <label for="actor">Acteur(s)</label>
            <input type="text" class="form-control" id="actor" name="actor" placeholder="Will Smith Scarlette Johanson Elies Kedim">
        </div>
        <div class="form-group">
            <label for="producer">Producteur</label>
            <input type="text" class="form-control" id="producer" name="producer" placeholder="Nom du producteur">
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
            <label for="lang">Langue</label>
            <select id="lang" name="lang" class="form-control">
            <option>fr</option>
            <option>en</option>
            <option>es</option>
            <option>it</option>
            </select>
            </div>
            <div class="form-group col-md-4">
                <label for="year_prod">Année de production</label>
                <!-- Je fait une boucle qui par de l'année actuelle et remonte il y a 100 ans pour afficher dynamiquement les 100 dernières années -->
                <select id="year_prod" name="year_prod" class="form-control">
                   <?php
                   $current_year = date('Y');
                    for($i=$current_year; $i>= date('Y')-100; $i--){
                        echo '<option>' . $i . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="form-group col-md-4">
            <label for="cat">Catégorie</label>
            <select id="cat" name="cat" class="form-control">
            <option>comedie</option>
            <option>animation</option>
            <option>romantique</option>
            <option>fantastique</option>
            </select>
            </div>
            <div class="form-group ml-2">
            <label for="storie">Résumer</label>
            <textarea class="form-control" id="storie" name="storie" rows="3"></textarea>
        </div>
        <div class="form-group">
            <label for="url">Vidéo</label>
            <input type="text" class="form-control" id="url" name="url" placeholder="www.mavideo.com">
        </div>
        <button type="submit" class="btn btn-primary col-md-12">Sign in</button>
    </form><!-- Fin du formulaire -->
    </div>    <!-- Fin .container -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>