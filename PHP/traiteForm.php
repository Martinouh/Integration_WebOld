<?php
    include "Fonctions.php";



    if (isset($_POST['nom'])){
        newRegister();
    }

    if (isset($_POST['login_submit'])){
        login();
    }
    if (isset($_POST['search_submit']) && $_POST['searchbar'] != NULL){
        search();
    }
?>
