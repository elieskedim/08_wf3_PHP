<?php
// Exercice
/**
 * 1- créer une page "profil" avec un nom et un prénom
 * 2- y ajouter un lien "modifier mon profil", ce lien passe dans l'url à la page exercice.php elle-même 
 * que l'action demandée est la modification du compte
 * 3- si la modification est demandée, c'est-à-dire que vous avez reçu cette info en $_GET, vous 
 * affichez "Vous avez demandé la modification de votre profil !"
 */

// Traitement PHP
// var_dump($_GET);

$msg = '<div class="alert alert-light" role="alert"></div><br>';
if (isset($_GET['action']) || isset($_GET['action'])) {
    if($_GET['action'] == 'modifier') {
        $msg = '<div class="alert alert-info" role="alert">Modifier mon profil</div>';
    } elseif ($_GET['action'] == 'supprimer') {
    $msg = '<div class="alert alert-danger" role="alert">Supprimer mon profil</div>';
    }
}
// $msg = '<div class="alert alert-light" role="alert"></div><br>';
// if (isset($_GET['action']) && $_GET['action'] == 'modifier') {
//     $msg = '<div class="alert alert-info" role="alert">Modifier mon profil</div>';
// }
// if (isset($_GET['action']) && $_GET['action'] == 'supprimer') {
//     $msg = '<div class="alert alert-danger" role="alert">Supprimer mon profil</div>';
// }

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

    <h1>Profil</h1>

    <div>
        <?php echo $msg; ?>
    </div>

    <!-- div.row>div.col-4.offset-4 -->
    <div class="row">
        <div class="col-4 offset-4">
            <!-- div.card>div.card-body>h5.card-title+(p.card-text)*2+a.btn.btn-info -->
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <p class="card-text">Nom : Gauriau</p>
                            <p class="card-text">Prénom : Mila</p>
                        </div>    
                        <div class="col-6">
                            <img src="vehicule.jpg" alt="voiture rouge" style="width: 8rem;">
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="?action=modifier" class="btn btn-block btn-info">Modifier mon profil</a>
                    <a href="?action=supprimer" class="btn btn-block btn-danger">Supprimer mon profil</a>
                </div>
            </div>
        </div>
    </div>

</div>      
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"> </script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"> </script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"> </script>
</body>
</html>