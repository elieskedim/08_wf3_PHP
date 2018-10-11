<?php
require_once 'inc/init.inc.php';


//------------------------------------- TRAITEMENT ------------------------------------
// Variable d'affichage :
$panier = '';
$suggestion = '';

// 1- Contrôle de l'éxistence du produit demandé (un produit en favori à pu  être supprimer de la BDD...) :
if(isset($_GET['id_produit'])){
	// si un produit à été sélectionné :
	$resultat = executeRequete("SELECT * FROM produit WHERE id_produit = :id_produit",array(':id_produit' => $_GET['id_produit']));
	
	if($resultat->rowCount() == 0){
		//s'il n'y a pas de ligne dans $resultat, c'est que le produit n'existe pas
		header('location:boutique.php');// On redirige vers la boutique.
		exit();
	}
	// 2- Affichage des infos du produit :
	$produit = $resultat->fetch(PDO::FETCH_ASSOC); // on ne fait pas de boucle while car on est certain de n'avoir qu'un seul produit par id_produit
	//debug($produit);
	extract($produit); // crée autant de variable qu'il y a d'indice dans l'array $produit. celle-ci on pour nom le nom de l'indice et pour valeur la valeur associé a cet indice.
	// 3- Affichage du formulaire d'ajout au panier si le stock est positif :
	if($stock > 0){
		//si le stock existe, on ajoute le boutton au panier :
		$panier .= '<form method="post" action="panier.php">';
			$panier .= '<input type="hidden" name="id_produit" value="'. $id_produit .'">';// pour donner l'id_produit du produit selectionnez au panier
			
			// Selecteur de quantité de produit :
			$panier .= '<select name="quantite" class="custom-select col-sm-2">';
				for($i = 1; $i <= $stock && $i <= 5; $i++){
					$panier .= '<option>' .$i. '</option>';
				}
			$panier .= '</select>';
			
			$panier .= '<input type="submit" name="ajout_panier" value="ajouter au panier" class="btn col-sm-8">';
		
		$panier .= '</form>';
		$panier .= '<p>Nombre de produit(s) disponible(s) : '. $stock .'</p>';
	}else{
		// si le stock est nul on met le message suivant :
		$panier .= '<p>Produit en rupture de stock !</p>';
	}
}else{
	// sinon, l'indice "id_produit" n'éxiste pas dans l'url, ce qui signifie que l'on as accédé à la page directement sans choisir de produit. On redirige donc vers la boutique.
	header('location:boutique.php');
	exit();
}


//-------------
// EXERCICE   :
// Crée des suggestion de produits : afficher 2 produits (photo / titre) aléatoirement appartenant à la même catégorie que le produit afficher, Et différent du produit actuel Vous utilisez la variable $suggestion pour afficher le contenu.

//debug($categorie);
	$requete = executeRequete("SELECT * FROM produit WHERE id_produit != :id_produit AND categorie = :categorie ORDER BY RAND() LIMIT 0, 2",array(':id_produit' => $_GET['id_produit'], ':categorie' => $categorie));
	$data = $requete->fetchAll();
	//debug($data);
	for($j = 0; $j < 2; $j++){
		$suggestion .= '<p>' . $data[$j]['titre'] . '</p>';
		$suggestion .= '<a href="?id_produit='.$data[$j]['id_produit'].'"><img style="width:90px;" src="' . $data[$j]['photo'] . '" alt="' . $data[$j]['titre'] . '"></a>';
	}

//---------------------------------------- Affichage --------------------------------
require_once 'inc/haut.inc.php';
?>
	<div class="row">
	
		<div class="col-12">
			<h1><?= $titre;?></h1>
		</div>
		
		<div class="col-md-8">
			<img class="img-fluid" src="<?= $photo;?>" alt="<?= $titre;?>">
		</div>
		
		<div class="col-md-4">
			<h3>Déscription</h3>
			<p><?= $description;?></p>
			
			<h3>Détals</h3>
				<ul>
					<li>Catégorie : <?= $categorie;?></li>
					<li>Couleur : <?= $couleur;?></li>
					<li>Taille : <?= $taille;?></li>
				</ul>
				
			<h4>Prix <?= number_format($prix, 2, ',', '');?>€</h4>
			
			<?=$panier;?>
			
			<p><a href="boutique.php?categorie=<?=$categorie;?>">Retour ver la catégorie '<?=$categorie;?>'</a></p>
		</div><!-- .col-md-4 -->
	</div><!-- .row-->
 
	<!-- Exercice suggestions de produits -->
	
	<hr>
	<div class="row">
		<div class="col-12">
			<h3>Suggestion de produits</h3>
			
			<?=$suggestion;?>
		</div><!-- .col-12 -->
	</div><!-- .row-->

<?php
require_once 'inc/bas.inc.php';