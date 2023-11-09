<?php 

    session_start();
    if(isset($_SESSION['unique_id']))
    { // Rahe toa ka misy utilisateur efa connecter am'le navigateur dia tonga dia redirigena any
        header("location:../private/home.php");
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | ChatYou</title>
    <link rel="stylesheet" href="../private/style.css">
</head>
<body>
    <?php include_once "../private/php/login.php"; ?>
    <form action="" method="POST" class="form_connexion_inscription">
        <h1>Connexion</h1>
        <p class="message_error">
            <?php 
                if(isset($error)){
                    echo $error;
                }
            ?>
            <!-- Email ou mot de passe incorrecte ! -->
        </p>
        <label>Adresse email</label>
        <input type="email" name="email" placeholder="Entrer votre email">
        <label>Mot de passe</label>
        <input type="password" name="mdp1" placeholder="Entrer votre mot de passe">
        <input type="submit" value="Connexion" name="button_con">
        <p class="link">Vous n'avez pas de compte ? <a href="../private/inscription.php">Creer un compte</a></p>
    </form>

</body>
</html>