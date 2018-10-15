<?php
echo '<h1>Les commerciaux et leur salaire</h1>';
function debug($param)
{
    echo '<pre>';
    echo print_r($param);
    // echo var_dump($param);
    echo '</pre>';
}
// Eexercice : 
/* 
    - Afficher dans une liste ul li : le prenom, le nom et le salaire des employés du service commercial (1 commercial par <li>). Pour cela , vous utilisez une requete préparée.
    - Afficher le nombre de commerciaux dans l'entreprise.
 */
 // 1- connexion BDD : 
$pdo = new PDO(
    'mysql:host=localhost;dbname=societe',
    'root',
    '',
    array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
        PDO::MYSQL_ATTR_INIT_COMMAND => 'set NAMES utf8'
    )
);
// 2 - requête (péparée) :
$service = 'commercial';
$resultat = $pdo->prepare("SELECT prenom, nom, salaire  FROM employes WHERE service = :service");
    // on lie la valeur au marqueur : 
$resultat->bindParam(':service', $service);
$resultat->execute();
$donnees = $resultat->fetchAll(PDO::FETCH_ASSOC);
// debug($donnees);
echo '<ul>';
foreach ($donnees as $employe) {
    // debug($employe);
    echo '<li> prénom :' . $employe['prenom'] . '/ ' . 'nom : ' . $employe['nom'] . '/ ' . ' salaire  : ' . $employe['salaire'] . '</li>';
}
echo '</ul>';
echo '<p> le nombre de commerciaux est de  : ' . $resultat->rowCount() . '</p>';