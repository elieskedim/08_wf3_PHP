<?php
//----------------------------------------------- TRAITEMENT -------------------------------------
    $content =""; //J'initialise une variable d'affichage vide afain de la replir au fur et à mesure du script

    $date = new DateTime('1992-10-19');// J'instancie la classe DATETIME que je stock dans une variable $date

    $users = [ #Je crée un tableau associatif nomée users cars se sont des data utilisateurs qui sont stoqué à l'intérieur
        "prenom" => "Elies",
        "nom" =>"Kedim",
        "adresse" => "2 avenue de la gare",
        "cp" => "92230",
        "ville" => "Gennevilliers",
        "email" => "elies.kedim@lepoles.com",
        'tel' => "0769499039",
        "date" => $date->format('d-m-Y')
    ];

    //var_dump($users); Avec le var_dump je vérifie le contenu de mon tableau avant de le traiter pour voir s'il y a eu des érreurs

    $content .='<ul>';// Pour ne pas dupliquer la balise ul je la sort de la boucle
    foreach($users as $key => $value){// Je démarre une boucle foreache qui vas parcourir le tableau users en stoquant les clé et les valeurs dans des variable qui vont me servir d'affichage
        $content .='<li>';//Je crée une balise li pour chaque éléments present dans le tableau
        $content .=$key. ' => ' .$value;
        $content .='</li>';
    }
    $content .='</ul>';

//---------------------------------------------- AFFICHAGE --------------------------------------------------------
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Exercice1</title>
</head>
<body>
    <?=$content;?><!-- j'affiche le contenu de la variable content -->

</body>
</html>