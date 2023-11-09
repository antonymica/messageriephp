<?php 

    if(isset($_POST['button_inscription'])){

        include_once "conn.php";

        $pseudo = mysqli_real_escape_string($con, $_POST['pseudo']);
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $mdp1 = mysqli_real_escape_string($con, $_POST['mdp1']);
        $mdp2 = mysqli_real_escape_string($con, $_POST['mdp2']);
    
        extract($_POST);

        if(!empty($pseudo) && !empty($email) && !empty($mdp1) && !empty($mdp2))
        {
            // Valide ve ny email nampidirina ?
            if(filter_var($email, FILTER_VALIDATE_EMAIL))
            {
                // Efa ao anaty BD ve ilay email io ?
                $sql = mysqli_query($con, "SELECT email FROM utilisateurs WHERE email='{$email}'");
                if(mysqli_num_rows($sql) > 0)
                {
                    $error = "Cette email est deja utilise !";
                } else {
                    // Verifions les deux mots de passes

                    if($mdp1 != $mdp2){
                        $error = "Les deux mots de passe ne sont pas conforme !";
                    } else {
                        // Verification image
                        if(!empty($_FILES['image']))
                        {
                            $img_name = $_FILES['image']['name'];
                            $tmp_name = $_FILES['image']['tmp_name'];
                            // Mila explodena ilay image hijerena ny extention
                            $img_explode = explode('.', $img_name);
                            $img_ext = end($img_explode);

                            $extension = ['png', 'jpeg', 'jpg'];

                            if(in_array($img_ext, $extension) === true)
                            { // Mety tsara ny extension ny image
                                $time = time();
                                $new_img_name = $time.$img_name;
                                if(move_uploaded_file($tmp_name, "images/".$new_img_name))
                                {
                                    $random_id = rand(time(), 100000000);
                                    $sql2 = mysqli_query($con, "INSERT INTO utilisateurs (unique_id, pseudo, email, mdp, img)
                                                                VALUES ({$random_id}, '{$pseudo}', '{$email}', '{$mdp1}', '{$new_img_name}')");
                                    if($sql2)
                                    {
                                        $error = "
                                            <p class='message_inscription' 
                                                style='
                                                    padding: 5px;
                                                    outline: 0;
                                                    font-size: 16px;
                                                    font-weight: bold;
                                                    color: chocolate;
                                                    text-align: center;
                                                    '
                                            >
                                                Votre compte a ete creer avec succes !
                                            </p>";
                                        //header("location:../public/index.php");
                                        
                                    } else {
                                        $error = "Il y a une erreur en creant votre compte !";
                                    }
                                }
                            } else {
                                $error = "Le format de l'image [jpeg, png, jpg] !";
                            }

                        } else {
                            $error = "Selectionner une photo pour votre profile.";
                        }
                    }
                }
            } else {
                $error = "Votre email est invalide !";
            }
        } else {
            $error = "Veuillez remplir tous les champs!";
        }

    }

?>