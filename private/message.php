<?php 

    session_start();
    if(!isset($_SESSION['unique_id'])){
        header("location:../public/index.php");
    }

?>

<!DOCTYPE html>
<html lang="en">
<head class="header">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?php 
        if(isset($reload)){
            echo $reload;
            header('Refresh:0; ');
        }
    ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages | Chat</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
    <div class="container">

        <section class="chat-area">

            <header>

                <?php 
                    include_once "php/conn.php";
                    $user_id = mysqli_real_escape_string($con, $_GET['user_id']);
                    $sql = mysqli_query($con, "SELECT * FROM utilisateurs WHERE unique_id = {$user_id}");
                    if(mysqli_num_rows($sql) > 0){
                        $row = mysqli_fetch_assoc($sql);
                    }
                ?>

                <a href="home.php" class="back-icon"><<</a>
                <img src="images/<?php echo $row['img'] ?>" alt="">
                <div class="details">
                    <span><?php echo $row['pseudo'] ?></span>
                    <p><?php echo $row['email'] ?></p>
                </div>
         
            </header>

            <div class="chat-box">

            </div>

            <form action="#" class="typing-area" enctype="multipart/form-data" method="POST">
                
                <input type="text" name="outgoing_id" value="<?php echo $_SESSION['unique_id']; ?>" hidden>
                <input type="text" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
                
                <input type="file" name="fic" id="file" class="fic">
                <label for="file" class="uploadBtn">
                    <img src="plus.png" alt="+">
                </label>
                
                <input type="text" name="message" class="input-field" placeholder="Taper votre message ici...">
                <button name="send" class="button">Envoyer</button>
                

            </form>

        </section>

    </div>

    <script src="javascript/message.js"></script>
</body>
</html>