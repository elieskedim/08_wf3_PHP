<?php
/*
  1- Créer une fonction qui retourne la conversion d'une date FR en date US ou inversement.
  Cette fonction prend 2 paramètres : une date et le format de conversion de sortie "US" ou "FR". Pour faire cette conversion, vous utilisez la classe DateTime.
	  
  2- Vous validez que le paramètre de format est bien "US" ou "FR". La fonction retourne un message si ce n'est pas le cas.
  
  3- Vous validez que la date fournie est bien une date. La fonction retourne un message si ce n'est pas le cas.
    
*/

function retourneDate($date, $format){
    if(strtotime($date)){
      switch (strtoupper($format)){
        case "FR":
        $formateDate = new DateTime($date);
        return  $formateDate->format('d-m-Y');

        case "US":
        $formateDate = new DateTime($date);
        return  $formateDate->format('Y-m-d');

        default:
          return "Le format indiqué n'est pas valide";
      }
    }else{
      return "Le format de la date n'est pas bon";
    }
}

echo retourneDate("2018-10-18", "en");