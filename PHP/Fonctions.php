<?php
/**
 * Created by PhpStorm.
 * User: Rom
 * Date: 9/10/2016
 * Time: 14:01
 */

/*    $dsn = 'mysql:dbname=db7;host=137.74.43.201';
    $user = 'rcharlier';
    $password = 'qe9hm2kx';
    $date = date('Y-m-d H:i:s');
    try {
        $db = new PDO($dsn, $user, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    } catch (PDOException $e) {
       printf('Erreur'. $e->getMessage());
    }
// $sql = 'INSERT INTO message (nom, prenom, email, msg, sujet,dateCréation) VALUES  ("'.$_POST['nom'].'", "'.$_POST['prénom'].'", "'.$_POST['email'].'", "'.$_POST['message'].'", "'.$_POST['sujet'].'","'.$date.'")';
    $query=$db->query('select * from utilisateurs');
$retour=$query->fetchAll();
    print_r($retour);*/

function search(){
    $dsn = 'mysql:dbname=db7;host=137.74.43.201';
    $user = 'rcharlier';
    $password = 'qe9hm2kx';
    try {
        $db = new PDO($dsn, $user, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    } catch (PDOException $e) {
        printf('Erreur'. $e->getMessage());
    }
    $requete = htmlspecialchars($_POST['searchbar']);
    $query = $db->query("SELECT * FROM professionnels WHERE nom LIKE '%$requete%' ORDER BY nom");
    $nbResultats = $query->rowCount();
    if($nbResultats !=0){
    ?>
        <meta charset="UTF-8">
        <h3>Résultat de votre recherche.</h3>
        <p>Nous avons trouvé <?php echo $nbResultats;
        if ($nbResultats > 1) {
            echo ' résultats';
        }else{
            echo ' résultat';
        }
    ?>
        dans notre base de données. Voici le(s) médedecin(s) que nous avons trouvé(s) :<br/>
        <?php while($données = $query->fetch(PDO::FETCH_ASSOC)){
            echo $données['prenom'].' '.$données['nom'];
        }

    }else{
        echo 'Pas de resultat';
        }
}
function login()
{
    $dsn = 'mysql:dbname=db7;host=137.74.43.201';
    $user = 'rcharlier';
    $password = 'qe9hm2kx';
    try {
        $db = new PDO($dsn, $user, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    } catch (PDOException $e) {
        printf('Erreur' . $e->getMessage());
    }
    $req = $db->query('select nom,prenom,semence,mdp,question,reponse,telephone,email  from utilisateurs where email = "' . $_POST['email'] . '" ');
    $retour = $req->fetchAll(PDO::FETCH_ASSOC);
    if (isset($retour[0])) {
        $mdp = md5($retour[0]['semence'] . $_POST['mdp']);
        if ($retour[0]['mdp'] == $mdp) {
            printf('Bienvenue ' . $retour[0]['prenom']);

        }else {
            echo 'Connexion refusée';
        }
    }else{
        echo 'Connexion refusée';
    }
}
function newRegister(){
    $dsn = 'mysql:dbname=db7;host=137.74.43.201';
    $user = 'rcharlier';
    $password = 'qe9hm2kx';
    $date = date('Y-m-d H:i:s');
    try {
        $db = new PDO($dsn, $user, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    } catch (PDOException $e) {
        printf('Erreur'. $e->getMessage());
    }


    $semence = md5(time());
    $mdp = md5($semence.$_POST['mdp']);
    $req = $db->prepare('INSERT INTO utilisateurs (nom, prenom, semence, mdp, question, reponse, telephone, dateCreation, email) VALUES (:nom, :prenom, :semence, :mdp, :question, :reponse, :telephone, :dateCreation, :email)');
    if($req->execute(array(
        'nom' => $_POST['nom'],
        'prenom' => $_POST['prénom'],
        'semence' => $semence,
        'mdp' => $mdp,
        'question' => $_POST['question'],
        'reponse' => $_POST['reponse'],
        'telephone' => $_POST['telephone'],
        'dateCreation' => $date,
        'email' => $_POST['mail']
    ))){
        echo 'Inscription réussie';
    }else{
        echo 'Erreur';
    }


}

function chargeTemplate($t){
    $file = file('../HTML/'.$t.'.html');
    return implode('',$file);
}

function traiteRequete($rq){
    global $envoi;
    switch($rq){
        case 'form_register': $envoi['formInscription'] = chargeTemplate($rq);
    }

}
?>

