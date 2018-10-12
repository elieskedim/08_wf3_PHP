<?php
/* 
	1- Vous réalisez un formulaire "Votre devis de travaux" qui permet de saisir le montant des travaux de votre maison en HT et de choisir la date de construction de votre maison (bouton radio) : "plus de 5 ans" ou "5 ans ou moins". Ce formulaire permettra de calculer le montant TTC de vos travaux selon la période de construction de votre maison.

	2- Vous créez une fonction montantTTC qui calcule le montant TTC à partir du montant HT donné par l'internaute et selon la période de construction : le taux de TVA est de 10% pour plus de 5 ans, et de 20% pour 5 ans ou moins. La fonction retourne  "Le montant de vos travaux est de X euros TTC." où X est le montant TTC calculé. Vous affichez le résultat au-dessus du formulaire.

*/
?>

<form action="" method="post">
<input type="text" name="montant" id="montant" placeholder="prix"><br>
<input type="radio" name="time" value="plus"> plus<br>
<input type="radio" name="time" value="moin"> moin<br>
<input type="submit" value="calculer">
</form>
<?php
if(!empty($_POST)){

	function montanTTC($prix, $time){
		if($time == 'plus'){
			echo "plus";
			return 'Le prix total est ' . ($prix * 1.1);
		}else{
			return 'Le prix total est ' . ($prix * 1.2);
		}
	}

	echo montanTTC($_POST['montant'], $_POST['time']);
}