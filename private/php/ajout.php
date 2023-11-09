<?php 

    session_start();
    include_once "conn.php";

    $outgoing = $_SESSION['unique_id'];
    if(isset($_POST['btn'])){
        $contact = mysqli_real_escape_string($con, $_GET['user_id']);
        
        // Efa misy contact ve ao ?
        $sql2 = mysqli_query($con, "SELECT * FROM contacts WHERE owner={$outgoing} AND contact={$contact}");
        if(mysqli_num_rows($sql2) > 0){
            echo '
                <script>
                    alert("Ce contact existe deja !");
                </script>
            ';
            header("Location:../home.php");
        } else {
            $sql = mysqli_query($con, "INSERT INTO contacts (owner, contact, date_ajout) VALUES ({$outgoing}, {$contact}, NOW())");
            if($sql){
                header("Location:../contact.php");
                echo '
                    <script>
                        alert("Contact ajoute avec succes !");
                    </script>
                ';
            } else {
                echo '
                <script>
                    alert("Echec d\'ajout");
                </script>
                ';
                header("Location:../home.php");
            }            
        }
        
    }
    

?>