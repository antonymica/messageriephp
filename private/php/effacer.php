<?php 

    session_start();
    include_once "conn.php";

    $outgoing = $_SESSION['unique_id'];
    if(isset($_POST['btn2'])){
        $contact = mysqli_real_escape_string($con, $_GET['user_id']);
        
        $sql = mysqli_query($con, "DELETE FROM contacts WHERE owner={$outgoing} AND  contact={$contact}");
        if($sql){
            header("Location:../contact.php");
            echo '
                <script>
                    alert("Suppression reussi !");
                </script>
            ';
        } else {
            echo '
            <script>
                alert("Echec de suppression !");
            </script>
            ';
            header("Location:../contact.php");
        }
    }   
?>