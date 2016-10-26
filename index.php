<?php

    include 'PHP/Fonctions.php';

    session_start();
    if (isset($_GET['rq'])) {
        $envoi=array();
        traiteRequete($_GET['rq']);
        die(json_encode($envoi));
    }
    else{
        include 'HTML/accueil_parti_FR.html';
    }
?>
