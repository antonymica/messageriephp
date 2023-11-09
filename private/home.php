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
        <section class="home">
            <header>

                <?php 
                    include_once "php/conn.php";
                    $sql = mysqli_query($con, "SELECT * FROM utilisateurs WHERE unique_id = {$_SESSION['unique_id']}");
                    if(mysqli_num_rows($sql) > 0){
                        $row = mysqli_fetch_assoc($sql);
                    }
                ?>

                <div class="content">
                    <img src="images/<?php echo $row['img'] ?>" alt="">
                    <div class="details">
                        <span><?php echo $row['pseudo'] ?></span>
                        <p><?php echo $row['email'] ?></p>
                        <p><a href="contact.php?user_id=<?php echo $row['unique_id'] ?>"><?php echo "Mes Contact" ?></a></p>
                    </div>
                </div>

                <a href="php/deconnexion.php?logout_id=<?php echo $row['unique_id'] ?>"class="deconnexion">Deconnexion</a>     
            </header>

            <div class="search">
                <span class="text">
                    >> Bienvenue dans le Chat <?php echo $row['pseudo'] ?>
                </span>
                <input type="text" placeholder="Entrer son pseudo...">
                <button>Rechercher</button>
            </div>
            
            <div class="home-list">

            </div>

        </section>
    </div>

    <script src="javascript/home.js"></script>

</body>
</html>