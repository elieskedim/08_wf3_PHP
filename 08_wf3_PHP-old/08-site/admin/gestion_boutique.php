<?php
    require_once '../inc/init.inc.php';
    
//-----------------------------------------  TRAITEMENT ---------------------------------

// 1- On vérifie que le membre est administrateur : 
if(!internauteEstConnecteEtAdmin()){
    header('location:../connexion.php'); // Je remonte dans le dossier parent pour accéder au fichier connexion.php
    exit(); // Pour quitter le script
}

// 7- Suppression d'un produit :
//debug($_GET);
if(isset($_GET['action']) && $_GET['action'] == 'supprimer' && isset($_GET['id_produit'])){// Si  existe l'indice action dans GET et que sa valeur est "supprimer" et que existe aussi l'indice "id_produit", alors je peux traiter la suppression du produit demandé

    $resultat = executeRequete("DELETE FROM produit WHERE id_produit = :id_produit", array(':id_produit' => $_GET['id_produit']));

    if($resultat->rowCount() == 1){
        //Si le DELETE retourne une ligne c'est que l'id produit existe et qu'il à pu être supprimer
        $contenu .= '<div class="alert alert-success">Le produit n°' . $_GET['id_produit'] . 'a bien été supprimer</div>';
    }else{
        $contenu .= '<div class="alert alert-danger">Le produit n°' . $_GET['id_produit'] . 'na pas été supprimer</div>';
    }
}
// 6- Affichage des produits dans une table HTML : 
// Exercice : afficher tous les produits sous forme de table HTML. Cette table est stockée dans la variable $contenu. Tous les champs doivent être affichés. Pour la photo vous affichez l'image(90 px de largeur).
?>


<?php
//-----------------------------------------  AFFICHAGE ---------------------------------
    require_once '../inc/haut.inc.php';
?>

<h1 class="mt-4">Gestion Boutique</h1>

<ul class="nav nav-tabs">
    <li><a href="gestion_boutique.php" class="nav-link active">Affichage des produits</a></li>
    <li><a href="ajout_modif_produit.php" class="nav-link">Ajout d'un produit</a></li>
</ul>
<?php
    echo $contenu;
?>
<table>
<thead>
    <tr>
        <th >Id Produit</th>
        <th>Réference</th>
        <th>Catégorie</th>
        <th>Titre</th>
        <th>Déscription</th>
        <th>Couleur</th>
        <th>Taille</th>
        <th>Publique</th>
        <th>Photo</th>
        <th>Prix</th>
        <th>Stock</th>
        <th>Action</th> <!-- On ajout cette colonne en plus des autre afain de pouvoir modifier ou supprimer une ligne -->
    </tr>
</thead>
<tbody>
 <?php
             $sql = $pdo->query('SELECT count(id_produit) as nb_produit FROM produit');
                $x = $sql->fetch(PDO::FETCH_ASSOC);

                $nbProduit = $x['nb_produit'];
                $perPage = 4;
                $nbPage = ceil($nbProduit / $perPage);
                if(isset($_GET['p']) && $_GET['p'] > 0 && $_GET['p'] <= $nbPage){
                    $cPage = $_GET['p'];
                }else{
                    $cPage = 1;
                }
                //$cPage = $_GET['p'] ?? 1;
                $y = (($cPage - 1)* $perPage);
                
            $reponse = $pdo->query("SELECT * FROM produit LIMIT $y, $perPage");
            
            while($data = $reponse->fetch(PDO::FETCH_ASSOC)){
                echo '<tr>';
               /*  echo '<td>' . $data['id_produit'] . '</td>';
                echo '<td>' . $data['reference'] . '</td>';
                echo '<td>' . $data['categorie'] . '</td>';
                echo '<td>' . $data['titre'] . '</td>';
                echo '<td>' . $data['description'] . '</td>';
                echo '<td>' . $data['couleur'] . '</td>';
                echo '<td>' . $data['taille'] . '</td>';
                echo '<td>' . $data['public'] . '</td>';
                echo '<td><img style="width:90px;" src="../' . $data['photo'] . '" alt="imgProduit"></td>';
                echo '<td>' . $data['prix'] . '</td>';
                echo '<td>' . $data['stock'] . '</td>'; */
                    foreach($data as $key => $value){
                        if($key == 'photo'){
                                echo '<td><img style="width:90px;" src="../' . $value . '" alt="' . $data['titre'] . '"></td>';
                        }else{

                            echo'<td>' . $value . '</td>';
                        }
                    }
                    ?>
                    <td><a href="?action=supprimer&id_produit=<?= $data['id_produit'];?>" onclick="return confirm('Etes vous certain ?')">Supprimer</a><br><a href="ajout_modif_produit.php?action=modification&id_produit=<?= $data['id_produit'];?>">Modifier</a></td>
                <?php
                echo '</tr>';
            }
        ?>

</tbody>
</table>
<div class="page">
<?php
    for($i=1; $i<= $nbPage; $i++){
        echo "<a href=\"?p=$i\"> $i |</a>";
    }
    require_once '../inc/bas.inc.php';
?>
</div>