<?php

function conversionDevise($prix, $devise){
    $prix = (int)$prix;// Je convertit la chaine de caractère numérique en int, si on entre des lettre comme blabla par éxemple la fonction retourne 0
        if(strtolower($devise) == 'euro'){// je vérifie la valeur de $devise pour mon calcule et pour plus de simplicité le transforme la chaine de caractère en minuscule
        echo $prix . ' euros = ' . ($prix*1.2) . ' en dollard';
        }else if(strtolower($devise) == 'us'){
            echo $prix . ' dollards = ' . ($prix/1.2) . ' en euro';
        }else{
            echo 'Veuillez entrer soit us Soit euro';
        }
}
conversionDevise('elies', 'us')
?>