## créer la BDD dans PhpMyAdmin

## importer le fichier SQL

# créer l'arbo du site
08-site / admin
08-site / inc
08-site / photo

## 1er fichier : configuration
08-site / inc / init.inc.php 
=> fichier de configuration du site contenant :
- connexion à la BDD
- session_start
- constante (racine url depuis localhost - sans htdocs - et entre / /)
- variables d'affichage
- inclusion du fichier qui contient les fonctions du site

## fichier des fonctions du site
- debug
- membre connecté
- admin connecté (membre ayant le statut 1 en BDD que l'on récupère dans $_SESSION)


