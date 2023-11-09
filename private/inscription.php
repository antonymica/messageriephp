<?php 

    session_start();
    if(isset($_SESSION['unique_id']))
    { // Rahe toa ka misy utilisateur efa connecter am'le navigateur dia tonga dia redirigena any
        header("location:home.php");
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription | Chat</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <?php include_once "php/inscription.php"; ?>

    <form action="" method="POST" class="form_connexion_inscription" enctype="multipart/form-data">

        <h1>INSCRIPTION</h1>
        <p class="message_error">
            <?php 
                if(isset($error)){
                    echo $error;
                }
            ?>
        </p>
        <label>Pseudo</label>
        <input type="text" name="pseudo" placeholder="Entrer votre pseudo" required>
        <label>Adresse email</label>
        <input type="email" name="email" placeholder="Entrer votre email" required>
        <label>Mot de passe</label>
        <input type="password" name="mdp1" placeholder="Entrer votre mot de passe" class="mdp1" required>
        <label>Confirmation mot de passe</label>
        <input type="password" name="mdp2" placeholder="Retaper le mot de passe" class="mdp2" required>
        <label>Photo de profile</label>
        <input type="file" name="image">
        <input type="submit" value="Inscription" name="button_inscription">
        <p class="link">Vous avez compte ? <a href="../public/index.php">Se conecter</a></p>

    </form>

</body>
</html>