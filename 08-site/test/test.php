<?php
session_start();

$error = "";
if(!empty($_POST)){
    if(isset($_POST['name']) && !empty($_POST['name'])){
        $nom = htmlspecialchars($_POST['name'], ENT_QUOTES);
    }else{
        $error .="Veuillez renseigner votre nom.<br>";
    }
    if(isset($_POST['prenom']) && !empty($_POST['prenom'])){
        $prenom = htmlspecialchars($_POST['prenom'], ENT_QUOTES);
    }else{
        $error .="Veuillez renseigner votre prenom.<br>";
    }
    if(isset($_POST['tel']) && preg_match('`[0-9]{10}`',$_POST['tel'])){
        $tel = htmlspecialchars($_POST['tel'], ENT_QUOTES);
    }else{
        $error .="Veuillez renseigner un Numéro valide.<br>";
    }
    if(isset($_POST['email']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
        $email = htmlspecialchars($_POST['email'], ENT_QUOTES);
    }else{
        $error .="Veuillez renseigner un Mail valide.<br>";
    }
    if($error == ""){
        $_SESSION['nom'] = $nom;
        $_SESSION['prenom'] = $prenom;
        $_SESSION['tel'] = $tel;
        $_SESSION['email'] = $email;
       header("Location:test_session2.php");
       exit();
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Test Session</title>
</head>
<body>
<nav class="navbar navbar-light bg-dark">
  <a class="navbar-brand text-white" href="test.php">Dashboard</a>
  <a class="navbar-brand text-white" href="test_session2.php">Page 2</a>
</nav>

<div class="container">
<?php //var_dump($_SESSION);?>
<h2 class="mb-5">Inscription</h2>
<?=$error;?>
<form action="" method="POST"> 
  <div class="form-group">
    <label for="Name">Nom :</label>
    <input type="text" class="form-control" name="name" id="name" placeholder="Votre nom">
  </div>
  <div class="form-group">
    <label for="prenom">Prenom</label>
    <input type="text" class="form-control" name="prenom" id="prenom" placeholder="Prenom">
  </div>
  <div class="form-group">
    <label for="tel">Tel</label>
    <input type="text" class="form-control" name="tel" id="tel" placeholder="06 34 25 18 97">
  </div>
  <div class="form-group">
    <label for="email">Email</label>
    <input type="email" class="form-control" name="email" id="email" placeholder="Votremail@mail.com">
  </div>
  <button type="submit" class="btn btn-secondary">Soumettre</button>
</form>
</div>
    
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>