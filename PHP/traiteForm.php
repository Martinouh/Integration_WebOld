<?php
/**
 * Created by PhpStorm.
 * User: Rom
 * Date: 12/10/2016
 * Time: 23:07
 */
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
