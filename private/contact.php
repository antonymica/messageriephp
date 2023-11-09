<?php 

    session_start();
    if(!isset($_SESSION['unique_id'])){
        header("location:../public/index.php");
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceuil | Chat</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <section class="chat-area">

            <header>

                <?php 
                    include_once "php/conn.php";
                    $sql = mysqli_query($con, "SELECT * FROM utilisateurs WHERE unique_id = {$_SESSION['unique_id']}");
                    if(mysqli_num_rows($sql) > 0){
                        $row = mysqli_fetch_assoc($sql);
                    }
                ?>

                <a href="home.php" class="back-icon"><<</a>
                <img src="telephoner.png" alt="contact">
                <div class="details">
                    <span>Mes Contacts</span>
                </div>

            </header>

            <div class="home-list">

                <?php 

                    $outgoing_id = $_SESSION['unique_id'];
                    $sql3 = mysqli_query($con, "SELECT * FROM contacts 
                                                JOIN utilisateurs ON (contacts.contact=utilisateurs.unique_id)
                                                WHERE owner={$outgoing_id} ORDER BY date_ajout");
                    $output = "";

                    if(mysqli_num_rows($sql3) == 0){
                        $output .= '<div class="content"><p>Aucun contact enregistrer !</p></div>';
                    } elseif (mysqli_num_rows($sql3) > 0) {
                        while($row = mysqli_fetch_assoc($sql3))
                            {
                                $output .= '<a href="message.php?user_id='.$row['unique_id'].'">
                                            <div class="content contact">
                                                <img src="images/' . $row['img'] . '" alt="">
                                                <div class="details">
                                                    <span>'. $row['pseudo'] .'</span>
                                                    <p>Ajoute le '. $row['date_ajout'] .'</p>
                                                </div>
                                                
                                            </div>
                                            <form action="php/effacer.php?user_id='.$row['unique_id'].'" method="POST" class="ajouter effacer" enctype="multipart/form-data">
                                                    <input type="submit" name="btn2" value="Effacer">
                                            </form>
                                            </a>';
                            }
                    }
                    echo $output;

                ?>

            </div>

        </section>

    </div>

    <script src="javascript/contact.js"></script>
    <script src="javascript/home.js"></script>

</body>
</html>