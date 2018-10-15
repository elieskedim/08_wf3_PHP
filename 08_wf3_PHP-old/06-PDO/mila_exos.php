<style>
     h3{ background-color: #f1bf98; padding-left: 2vw;}
     pre{ background-color: #e1f4cb; margin: 0 8vw;}
</style>

<?php

// indenticator => color #f1bf98

// 1- fonction debug (var_dump)
function debug($param)
{
     echo '<pre>';
     // echo print_r($param);
     echo var_dump($param);
     echo '</pre>';
}

// 2- connexion BDD
// ⚡️ pour Mac ⚡️
$pdo = new PDO(
     'mysql:host=localhost;dbname=entreprise',// driver mysql (pourrait être oracle, IBM, ODBC...) + nom de la BDD
     'root', // pseudo de la BDD
     'root', // mdp de la BDD
     array(
          PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, // pour afficher les messages d'erreur SQL
          PDO::MYSQL_ATTR_INIT_COMMAND => 'set NAMES utf8'// définition du jeu de caractère des échanges avec la BDD
     )
);

echo '<hr>';
     echo '<h3> Exercice : afficher le service de l\'employe dont l\'id_employe est 417. </h3>';
$res = $pdo->query("SELECT service FROM employes WHERE id_employes = 417 ");
// debug($res);
$service = $res->fetch(PDO::FETCH_ASSOC);
// debug($service);
echo 'Le service du salarié 417 est : ' . $service['service'];

echo '<hr>';
     echo '<h3> 06 - Exercice : Afficher la liste des différents services de l\'entreprise dans une liste ul li </h3>';
$res = $pdo->query("SELECT service FROM employes GROUP BY service ASC");
// debug($res);
$services = $res->fetchAll(PDO::FETCH_ASSOC);
debug($services);
echo '<ul>';
foreach ($services as $service) {
     echo '<li>' . $service['service'] . '</li>';
}
echo '</ul>';

echo '<hr>';
echo '<h3> Exercice : <br>
     1- Afficher dans une liste ul li : le prenom, le nom et le salaire des employés du service commercial (1 commercial par li). Pour cela , vous utilisez une requete préparée. <br>
     2- Afficher le nombre de commerciaux dans l\'entreprise . </h3>';

$service = 'commercial';
$res = $pdo->prepare("SELECT prenom, nom, salaire FROM employes WHERE service = :service ");
// debug($res);
$res->bindParam(':service', $service);
$res->execute();
// debug($res);
echo '<ul>';
while ($employes = $res->fetch(PDO::FETCH_ASSOC)) {
     echo '<li>' . $employes['prenom'] . ' ' . $employes['nom'] . ' a un salaire mensuel de ' . $employes['salaire'] . ' €.</li>';
}
echo '<li><strong>Soit ' . $res->rowCount() . ' employés du service ' . $service . '.</strong></li>';
echo '</ul>';


