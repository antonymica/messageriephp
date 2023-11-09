<?php 

    // Connexion Avec la BD en utilisant mysqli_connect()

    $serveur = 'localhost';
    $admin = 'root';
    $mdp = "";
    $db = "messagerie";

    $con = mysqli_connect($serveur, $admin, $mdp, $db);

    // Gerer les accents et autres caractere francais
    $req = mysqli_query($con, "SET NAMES UTF8");

    if(!$con){
        die("Erreur".mysqli_connect_error());
    }

?>