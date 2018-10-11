<?php
require_once "bdd.php";

//---------------------------------- TRAITEMENT -----------------------

 if(!empty($_POST)){
         $resultat = $bdd->prepare('INSERT INTO reservation VALUES (0, :id_voyage, :email, :nbTime, :nbPersonnes, NOW())');

        	$resultat->bindParam(':id_voyage', intval($_GET['id_voyage']));
        	$resultat->bindParam(':email', $_POST['email']);
        	$resultat->bindParam(':nbTime', intval($_POST['nbTime']));
            $resultat->bindParam(':nbPersonnes', $_POST['nbPersonnes']);

            $req = $resultat->execute();

            
    }




//---------------------------------- AFFICHAGE -----------------------
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>WorkShop 2</title>
</head>
<body>
    <?php
    if(!$_GET)
{
?>

    <nav class="navbar navbar-expand-lg navbar-light container fixed-top">
        <a class="navbar-brand" href="#"><i class="fab fa-phoenix-framework fa-2x"></i></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
            <a class="nav-item nav-link active" href="#">Phoenix <span class="sr-only">(current)</span></a>
            <a class="nav-item nav-link" href="#">Choisir une déstination</a>
            <a class="nav-item nav-link disabled" href="#">Payer</a>
            </div>
        </div>
    </nav>
    

    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner w-100">
            <div class="carousel-item active">
            <img class="d-block w-100" style="height: 800px;" src="img/caraibes1.jpg" alt="Slide caraibes">
            </div>
            <div class="carousel-item">
            <img class="d-block w-100" style="height: 800px;" src="img/maurice.jpg" alt="Second slide">
            </div>
            <div class="carousel-item">
            <img class="d-block w-100" style="height: 800px;" src="img/turkoise.jpg" alt="Third slide">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
        </div>
    <div class="container" style="border:1px solid #36adbf;">
        <a href="?choix=cliquer" class="btn text-center col" style="color: #36adbf;">Choisir mon séjour tous de suite</a>
    </div>
<?php
 }else if(isset($_GET['choix'])){
?>
<div class="container-fluid" style="background-color: #75c9c8;">
    <nav class="navbar navbar-expand-lg navbar-light container">
        <a class="navbar-brand" href="#"><i class="fab fa-phoenix-framework fa-2x"></i></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
            <a class="nav-item nav-link active" href="#">Phoenix <span class="sr-only">(current)</span></a>
            <a class="nav-item nav-link" href="#">Choisir une déstination</a>
            <a class="nav-item nav-link disabled" href="#">Payer</a>
            </div>
        </div>
    </nav>
</div><!-- Fin Nav -->

<div class="container">
    <div id="carouselExampleControls" class="carousel slide mt-4" data-ride="carousel">
        <div class="carousel-inner w-100">
            <div class="carousel-item active">
            <img class="d-block w-100" style="height: 300px;" src="img/caraibes1.jpg" alt="Slide caraibes">
            </div>
            <div class="carousel-item">
            <img class="d-block w-100" style="height: 300px;" src="img/maurice.jpg" alt="Second slide">
            </div>
            <div class="carousel-item">
            <img class="d-block w-100" style="height: 300px;" src="img/turkoise.jpg" alt="Third slide">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
        </div>

        <div class="mt-4 row">
     <?php 
             $reponse = $bdd->query('SELECT * FROM voyage');
            while($test = $reponse->fetch(PDO::FETCH_ASSOC)){
            ?>
            <div class="card col-md-4 mt-4" style="width: 18rem;">
                <img class="card-img-top" style="height: 100px;" src="<?= $test['photo'];?>".<?= $test['photo'];?> ."  alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title"><?= $test['destination'];?></h5>
                    <p class="card-text"><?=$test['presentation'];?></p>
                    <a href="?id_voyage=<?= $test['id_voyage'];?>" class="btn" style="background-color: #75c9c8; color: white;">Reserver maintenant !</a>
                </div>
            </div>
    <?php }?>
        </div><!-- bloc card -->
</div>

<?php
     }else if(!empty($_POST)){
          $reponse = $bdd->query('SELECT * FROM voyage INNER JOIN reservation WHERE id_reservation=LAST_INSERT_ID() AND voyage.id_voyage = '. $_GET['id_voyage'] .' AND reservation.id_voyage = '. $_GET['id_voyage'] .'');

          
          $rep = $reponse->fetch(PDO::FETCH_ASSOC);
          //var_dump($reponse);
          // var_dump($rep);
         ?>
     <div class="container-fluid" style="background-color: #75c9c8;">
    <nav class="navbar navbar-expand-lg navbar-light container">
        <a class="navbar-brand" href="#"><i class="fab fa-phoenix-framework fa-2x"></i></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
            <a class="nav-item nav-link active" href="#">Phoenix <span class="sr-only">(current)</span></a>
            <a class="nav-item nav-link" href="#">Choisir une déstination</a>
            <a class="nav-item nav-link disabled" href="#">Payer</a>
            </div>
        </div>
    </nav>
</div><!-- Fin Nav -->

          <div class="container">
    <div id="carouselExampleControls" class="carousel slide mt-4" data-ride="carousel" style="width:300px; margin:auto;">
        <div class="carousel-inner" >
            <div class="carousel-item active">
            <img class="d-block" style="height: 300px; width:300px; border-radius: 50%;" src="img/caraibes1.jpg" alt="Slide caraibes">
            </div>
            <div class="carousel-item">
            <img class="d-block " style="height: 300px; width:300px; border-radius: 50%;" src="img/maurice.jpg" alt="Second slide">
            </div>
            <div class="carousel-item">
            <img class="d-block" style="height: 300px; width:300px; border-radius: 50%;" src="img/turkoise.jpg" alt="Third slide">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
        </div>
       
       <div class="container">
        <p><i class="fab fa-phoenix-framework fa-2x"></i> Récapitulatif de votre commande <?=$rep['destination'];?></p>
       </div>

       <div class="row">
           <div class="col-6">
            <div class="row">
                <div class="col-2">
                    <p>Participant(s)</p>
                </div>
                <div class="col-10">
                    <p><?=$rep['participants'];?></p>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <p>Semaine(s)</p>
                </div>
                <div class="col-10">
                    <p><?=$rep['semaines'];?></p>
                </div>
            </div>
           </div>
           <div class="col-6">
           <div class="row">
                <div class="col-2" style="background-color:#d4edda;">
                    <p>Commande</p>
                </div>
                <div class="col-8  ml-2" style="background-color:#d4edda;">
                    <p><?=$rep['id_voyage'];?></p>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-2 text-center" style="background-color:#d4edda;">
                    <p>Prix</p>
                </div>
                <div class="col-8 ml-2" style="background-color:#d4edda;">
                    <p><?=($rep['semaines'] + $rep['participants']) * $rep['prix'];?> €</p>
                </div>
           </div>
       </div>
<?php
     }else if(isset($_GET['id_voyage'])){?>
      <div class="container-fluid" style="background-color: #75c9c8;">
    <nav class="navbar navbar-expand-lg navbar-light container">
        <a class="navbar-brand" href="#"><i class="fab fa-phoenix-framework fa-2x"></i></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
            <a class="nav-item nav-link active" href="#">Phoenix <span class="sr-only">(current)</span></a>
            <a class="nav-item nav-link" href="#">Choisir une déstination</a>
            <a class="nav-item nav-link disabled" href="#">Payer</a>
            </div>
        </div>
    </nav>
</div><!-- Fin Nav -->

<div class="container">
    <div id="carouselExampleControls" class="carousel slide mt-4" data-ride="carousel">
        <div class="carousel-inner w-100">
            <div class="carousel-item active">
            <img class="d-block w-100" style="height: 300px;" src="img/caraibes1.jpg" alt="Slide caraibes">
            </div>
            <div class="carousel-item">
            <img class="d-block w-100" style="height: 300px;" src="img/maurice.jpg" alt="Second slide">
            </div>
            <div class="carousel-item">
            <img class="d-block w-100" style="height: 300px;" src="img/turkoise.jpg" alt="Third slide">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
        </div>
        <div class="container row">
         <?php  
             $reponse = $bdd->query('SELECT * FROM voyage WHERE id_voyage =' .$_GET['id_voyage'] .'');
            while($test = $reponse->fetch(PDO::FETCH_ASSOC)){
            ?>
            <div class="card col-4 mt-4" style="width: 18rem;">
                <img class="card-img-top" style="height: 100px;" src="<?= $test['photo'];?>".<?= $test['photo'];?> ."  alt="Card image cap">
                <div class="card-body row">
                    <h5 class="card-title col-12"><?= $test['destination'];?></h5>
                    <p class="col-12" style="background-color:#d1ecf1; color: #12779c;">1 semmaine / personne : <?= $test['prix'];?> €</p>
                </div>
            </div>
    <?php }

   
    
    ?>
                
            <div class="col-8 mt-4">
            <h5 class="text-center"  style="background-color:#d1ecf1; color: #12779c;">Je complète mes informations de réservation <i class="fab fa-phoenix-framework fa-2x"></i></h5>
                <form class="row" action="" method="post">
            <div class="form-group col-12">
                <input type="text" class="form-control" name="email" placeholder="Email de confirmation">
            </div>
            <div class="form-group col-5 mr-1">
                <input type="text" class="form-control" name="nbTime" placeholder="Je pars combien de temps ?">
            </div>
            <div class="form-group col-5">
                <input type="text" class="form-control" name="nbPersonnes" placeholder="Pour combien de personnes ?">
            </div>
            <button type="submit" class="btn col-12" style="background-color:#d1ecf1; color: #12779c;">Envoyer</button>
            </form> 
            </div>
    </div>
        
<?php 
    }
 ?>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>