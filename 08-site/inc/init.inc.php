<?php

/**
 * fichier de configuration du site
 */

// ----------------
//  Connexion à la BDD
// -----------------
// ⚡️ pour Mac ⚡️
$pdo = new PDO(
    'mysql:host=localhost;dbname=site_commerce',// driver mysql (pourrait être oracle, IBM, ODBC...) + nom de la BDD
    'root', // pseudo de la BDD
    '', // mdp de la BDD
    //'root', // mdp de la BDD ⚡️ pour Mac ⚡️
    array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, // pour afficher les messages d'erreur SQL
        PDO::MYSQL_ATTR_INIT_COMMAND => 'set NAMES utf8'// définition du jeu de caractère des échanges avec la BDD
        )
    );
    
// ----------------
// Session
// ----------------
session_start();

// ----------------
// Constante qui contient le chemin du site
// ----------------
define('RACINE_SITE', '/08_wf3_PHP/08-site/'); // indiquer le dossier dans lequel se situe le site sans "localhost". Permet de créer des chemins absolus utilisés notamment dans le header du site inclus dans différents sous-dossiers : par conséquent les chemins relatifs vers les sources changent selon le sous-dossier, ce qui n'est pas le cas en chemin absolu

// echo __DIR__ . '<br>'; // affiche le chemin complet (absolu) vers le dossier de notre fichier

// ----------------
// Variables d'affichage
// ----------------
$contenu = '';
$contenu_gauche = '';
$contenu_droite = '';


// ----------------
// Inclusion du fichier qui contient les fonctions du site
// ----------------
require_once 'functions.inc.php';



