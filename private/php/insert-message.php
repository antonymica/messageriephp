<?php 

    session_start();
    if(isset($_SESSION['unique_id'])){
        
        include_once "conn.php";
        $outgoing_id = mysqli_real_escape_string($con, $_POST['outgoing_id']);
        $incoming_id = mysqli_real_escape_string($con, $_POST['incoming_id']);
        $message = strip_tags(mysqli_real_escape_string($con, $_POST['message']));
       
        $file = $_FILES['fic']['name'];

        // Nous definissons un nom temporaire
        $tmp_nom = $_FILES['fic']['tmp_name'];

        // On recupere l'heure actuelle
        $time = time();

        // On renomme l'image en utilsant cette formule : heure + nom de i'image (Pour avoir des images uniques)
        $nouveau_nom_img = $time.$file;

        // on deplace l'image dans un dossier appelle "image_bdd"
        $deplace_img = move_uploaded_file($tmp_nom, "../photos/".$nouveau_nom_img);
        
        if(!empty($message) && !empty($file)){
            $sql4 = mysqli_query($con, "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg, file, date)
                                VALUES ({$incoming_id}, {$outgoing_id}, '{$message}', '{$nouveau_nom_img}', NOW())") or die();
            
        } elseif (!empty($message) && empty($file)){
            $sql4 = mysqli_query($con, "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg, file, date)
                                VALUES ({$incoming_id}, {$outgoing_id}, '{$message}', NULL, NOW())") or die();
            
        } elseif (empty($message) && !empty($file)){
            $sql4 = mysqli_query($con, "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg, file, date)
                                VALUES ({$incoming_id}, {$outgoing_id}, NULL, '{$nouveau_nom_img}', NOW())") or die();
            
        }

        
    } else {
        header("../../public/index.php");
    }


?>