<?php
    require_once '../inc/init.inc.php';
    
//-----------------------------------------  TRAITEMENT ---------------------------------

// 1- On vérifie que le membre est administrateur : 
if(!internauteEstConnecteEtAdmin()){
    header('location:../connexion.php'); // Je remonte dans le dossier parent pour accéder au fichier connexion.php
    exit(); // Pour quitter le script
}

// 4- Traitement du formulaire : enregistrement du produit
   // debug($_POST); 

    if($_POST){ // Si le formulaire est posté

        //ICI il faudrait mettre tous les contrôles sur le formulaire...

        $photo_bdd = ''; // Pour pouvoir insérer par défaut cette valeur en BDD

        // 5- suite de la PHOTO
       // debug($_FILES);

        if (!empty($_FILES['photo']['name'])){// Si existe l'indice "name" à l'intérieur de l'indice "photo", c'est que je suis en train d'uploader un fichier

            $nom_photo = 'ref' . $_POST['reference'] . '_' . $_FILES['photo']['name']; // On concatène la réference du produit avec le nom du fichier pour obtenir un nom de fichier unique (et ne pas écraser une photo existante)

            $photo_bdd = 'photo/' . $nom_photo; // cette variable est le chemin relatif de la photo enregistrer en BDD et utilisé par les balises <img> du site.

            copy($_FILES['photo']['tmp_name'], '../' . $photo_bdd); // copie le ficchier temporaire qui se trouve à l'adresse $_FILES['photo']['tmp_name'] dans le répertoire dont le chemin est '../photo/nomdelaphoto.jpg"
        }

        // 4- Sutie : enregistrement du produit :
        executeRequete("REPLACE INTO produit VALUES (:id_produit, :reference, :categorie, :titre, :description, :couleur, :taille, :public, :photo, :prix, :stock)", 
        array(':id_produit' => $_POST['id_produit'],
              ':reference' => $_POST['reference'],
              ':categorie' => $_POST['categorie'],
              ':titre' => $_POST['titre'],
              ':description' => $_POST['description'],
              ':couleur' => $_POST['couleur'],
              ':taille' => $_POST['taille'],
              ':public' => $_POST['public'],
              ':photo' => $photo_bdd, // attention : on lie le marqueur à la variable
              ':prix' => $_POST['prix'],
              ':stock' => $_POST['stock']
    ));

    // REPLACE INTO se comporte comme un INSERT INTO quand l'id_produit fourni n'existe pas en BDD (= création d'un produit). Il se comporte comme un UPDATE quand l'id_produit fourni existe en BDD (= modification d'un produit).

    $contenu .= '<div class="alert alert-success">Le produit a bien été enregistré.</div>';

    } //fin du if ($_POST)



//-----------------------------------------  AFFICHAGE ---------------------------------
    require_once '../inc/haut.inc.php';
?>

<h1 class="mt-4">Gestion Boutique</h1>

<ul class="nav nav-tabs">
    <li><a href="gestion_boutique.php" class="nav-link">Affichage des produits</a></li>
    <li><a href="ajout_modif_produit.php" class="nav-link active">Ajout d'un produit</a></li>
</ul>

<?php
    echo $contenu; // Pour afficher la table des produits 
?>
<!-- 3- Formulaire d'ajout d'un produit -->

<form action="" method="post" enctype="multipart/form-data"><!-- enctype="multipart/form-data" spécifie que le formulaire envoie des données binaires (correspondants au fichier uploadé) et des données textes (correspondants aux autres champs). Il est obligatoire pour pouvoir uploader des fichiers. --> 
    <input type="hidden" name="id_produit" value="0"><!-- champ caché utile pour la modification d'un produit existant, car on a besoin de le connaître pour la requête SQL REPLACE INTO qui se comporte comme un UPDATE en présence d'un id existant. La value à 0 permet de spécifier due l'id n'existe pas, donc que REPLACE INTO doit se comporter comme un INSERT pour créer le produit.-->

    <label for="reference">Référence</label><br>
    <input type="text" id="reference" name="reference" value=""><br><br>

    <label for="categorie">Catégorie</label><br>
    <input type="text" id="categorie" name="categorie" value=""><br><br>

    <label for="titre">Titre</label><br>
    <input type="text" id="titre" name="titre" value=""><br><br>

    <label for="description">Déscription</label><br>
    <textarea name="description" id="description" cols="30" rows="10"></textarea><br><br>

    <label for="couleur">Couleur</label><br>
    <input type="text" id="couleur" name="couleur" value=""><br><br>

    <label>Taille</label>
    <select name="taille" id="taille">
    <option value="S">S</option>
    <option value="M">M</option>
    <option value="L">L</option>
    <option value="XL">XL</option>
    </select><br><br>

    <label for="public">Public</label>
    <input type="radio" name="public" value="m" checked> Homme
    <input type="radio" name="public" value="f"> Femme
    <br><br>

    <label for="photo">Photo</label><br>
    <!-- 5- PHOTO -->
    <input type="file" name="photo" id="photo"><br><br> <!-- Ne pas oublier l'atribut enctype de la balise form pour pouvoir uploader des fichiers-->

    <label for="prix">Prix</label><br>
    <input type="text" id="prix" name="prix" value="0"><br><br>

    <label for="stock">Stock</label><br>
    <input type="text" id="stock" name="stock" value="0"><br><br>

    <input type="submit" value="Enregistrer" class="btn">
</form>

<?php
    require_once '../inc/bas.inc.php';
?>