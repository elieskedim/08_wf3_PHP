<?php
require_once 'inc/init.inc.php';


//------------------------------------- TRAITEMENT ------------------------------------
// 1- Affichage des catégories :
$resultat = executeRequete("SELECT DISTINCT categorie FROM produit");

$contenu_gauche .= '<div class="list-group">';

    // Affichage de la catégorie "Tous" par défaut :
    $contenu_gauche .= '<a href="?categorie=tous" class="list-group-item">Tous les Produit</a>';

    //Affichage des autres catégories provenant de la BDD :
    while($cat = $resultat->fetch(PDO::FETCH_ASSOC)){ // FETCH_ASSOC crée un array associatif appelé $cat à chaque tour de boucle.
        //debug($cat);
        $contenu_gauche .= '<a href="?categorie='. $cat['categorie'] .'" class="list-group-item">'. $cat['categorie'] .'</a>';
    }
$contenu_gauche .= '</div>';

// 2- Affichage des produits en fonction de la catégorie :
if(isset($_GET['categorie']) && $_GET['categorie'] != 'tous'){
	// Si existe l'indice "categorie" dans l'url, et que sa valeur est diférente de "tous", on sélectionne la catégorie demandée :
	$donnees = executeRequete("SELECT * FROM produit WHERE categorie = :categorie", array(':categorie' => $_GET['categorie']));
	
	
}else{
	// Sinon si "categorie" n'existe pas dans l'url ou qu'elle est égale à "tous" on sélectionne tous les produits :
	$donnees = executeRequete("SELECT * FROM produit");
}

while($produit = $donnees->fetch(PDO::FETCH_ASSOC)){
	$contenu_droite .= '<div class="col-sm-4 mb-4">';
		$contenu_droite .= '<div class="card">';
			//debug($produit);
			//Image cliquable
			$contenu_droite .= '<a href="fiche_produit.php?id_produit='. $produit['id_produit'] .'"><img src="' . $produit['photo']. '" alt="' . $produit['titre'] . '" class="card-img-top"></a>';
			
			//info du produit
			$contenu_droite .= '<div clas="card-body"';
				$contenu_droite .= '<h4>'. ucfirst($produit['titre']) .'</h4>';
				$contenu_droite .= '<h5>'. number_format($produit['prix'], 2, ',', '') .' €</h5>';// number_format(nombre, nombre de decimal, séparateur des décimal, séparateur des millier)
				$contenu_droite .= '<p>'. $produit['description'] .'</p>';
			$contenu_droite .= '</div>';// Fin card-body
		$contenu_droite .= '</div>';//Fin card
	$contenu_droite .= '</div>';//Fin col-sm-4
}


//---------------------------------------- Affichage --------------------------------
require_once 'inc/haut.inc.php';
?>
    <h1 class="mt-4">Vêtements</h1>

    <div class="row">
        <div class="col-md-3">
            <?= $contenu_gauche;?><!-- Pour afficher les catégories. -->
        </div>
        <div class="col-md-9">
            <div class="row">
                <?= $contenu_droite;?><!-- Pour afficher les produits. -->
            </div>
        </div>
    </div><!-- .row -->




<?php
require_once 'inc/bas.inc.php';