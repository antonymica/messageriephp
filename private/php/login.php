<?php 

    if(isset($_POST['button_con']))
    {
        // inclure le BD
        include_once "conn.php";

        $email = mysqli_real_escape_string($con, $_POST['email']);
        $mdp = mysqli_real_escape_string($con, $_POST['mdp1']);

        extract($_POST);

        if(isset($email) && isset($mdp) && $email != "" && $mdp != "")
        {
            $sql = mysqli_query($con, "SELECT * FROM utilisateurs WHERE email='{$email}' AND mdp='{$mdp}'");
            if(mysqli_num_rows($sql) > 0)
            {
                $row = mysqli_fetch_assoc($sql);
                $_SESSION['unique_id'] = $row['unique_id'];

                header("location:../private/home.php");

                // Detruire la variable message
                unset($_SESSION['message']);
            } else {
                $error = "Email ou mot de passe incorrecte !";
            }
        } else {
            $error = "Veuillez remplir le formulaire !";
        }

    }

?>
