<?php

// ouverture ou création d'une session
session_start();
echo 'La session est accessible dans tous les scripts du site, comme ici : ';
print_r($_SESSION); // on voit les infos de la session créée dans la page session1.php
// ce fichier n'a pourtout rien à voir avec l'autre (il n'y a pas d'inclusion, il pourrait être dans
// un autre dossier, s'appeler n'importe comment, les infos contenues dans la session restent accessibles grâce au session_start().)