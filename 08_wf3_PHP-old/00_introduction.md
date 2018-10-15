# PHP
[Christophe DHAUSSY - 24/09/2018]

(Plan + recup Alpha)
J1 à J3 : les bases
J4      : les superglobales
J5 à J6 : PDO (PHP Data Object)
J7 à J9 :

### Hypertext PreProcessor

- inventé spécialement pour faire des sites internet
- open source

- Langage fonctionnel qui sert à traiter les données du formulaire
- permet de faire des sites dynamiques (le JS rend le site interactif avec l'utilisateur) càd un site qui contient une BDD (ensemble des contenus du site => titres, textes, images, produits, chambres d'hôtels, contenus) et qui comporte en fait 2 sites :
    - un front pour le client
    - un site back accessible par identification à l'admin du site pour créer et mettre à jour les contenus en back office

Un site dynamique en bref contient : BDD + site front + site back office

### Architecture client-serveur

  _______________    requête HTTP        ___
 |               |      ==>             |   |   serveur
 | nav (client)  |                      |   |
 |_______________|      <==             |   |
                     fichier HTML       |___|                       /\
                                                ||                  ||
    ---- fin schéma simple ----             interpréteur PHP    HTML ...
                                                ||                  ||
                                        PHP     \/
                                        SQL

### Serveur

XAMPP
 - X : cross platform
 - A : Apache - stocke les fichiers et les envoie quand on fait une requête HTTP
 - M : SQL - gestion BDD
 - P : interpréteur de PHP
 - P : interpréteur de Perl (moins de 2% des sites)

### Dans HTDOCS