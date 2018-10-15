<?php
$bdd = new PDO(
    'mysql:host=localhost;dbname=exercice_3',// driver mysql (pourrait être oracle, IBM, ODBC...) + nom de la BDD
    'root', // pseudo de la BDD
    '', // mdp de la BDD
    //'root', // mdp de la BDD ⚡️ pour Mac ⚡️
    array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, // pour afficher les messages d'erreur SQL
        PDO::MYSQL_ATTR_INIT_COMMAND => 'set NAMES utf8'// définition du jeu de caractère des échanges avec la BDD
    )
);