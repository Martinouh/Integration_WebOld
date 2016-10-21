<?php
/**
 * Created by PhpStorm.
 * User: Rom
 * Date: 10/10/2016
 * Time: 20:05
 */

include 'Fonctions.php';


if (isset($_GET['rq'])) {
    $envoi=array();
    traiteRequete($_GET['rq']);
    die(json_encode($envoi));
}
/*else{
    include 'HTML/choix_FR.html';
}*/
?>