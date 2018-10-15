<?php
/* 
   Vous créez un tableau PHP contenant les pays suivants : France, Italie, Espagne, inconnu, Allemagne auxquels vous associez les valeurs Paris, Rome, Madrid, '?', Berlin.

   Vous parcourez ce tableau pour afficher la phrase "La capitale X se situe en Y" dans un paragraphe (où X remplace la capitale et Y le pays).

   Pour le pays "inconnu" vous afficherez "Ca n'existe pas !" à la place de la phrase précédente. 	

*/

/* $tab = [
    "France" => "Paris",
    "Italie" => "Rome",
    "inconnue" => "?",
    "Allemagne" => "Berlin",
    "Espagne" => "Madrid"
];

foreach($tab as $key => $value){
    if($key == "inconnue"){
        print("Ca n'existe pas ! <br>");
    }else{
        print('La Capitale ' . $key . ' se situe en ' . $value . '<br>');
    }
} */

function retourne($date, $format){
        if($format == "US" || $format == "FR"){
            if($format == "US"){
                $newDate = date_create($date);
                return date_format($newDate, 'Y-m-d');
            }else{
                $newDate = date_create($date);
                return date_format($newDate, 'd-m-Y');
            }

        }else{
            return "Le format indiqué n'est pas correct";
        }   
}

echo retourne("2018-10-10", "FR");