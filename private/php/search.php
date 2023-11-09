<?php 

    session_start();
    include_once "conn.php";
    $outgoing_id = $_SESSION['unique_id'];
    $searchTerm = mysqli_real_escape_string($con, $_POST['searchTerm']);
    $output = "";
    $sql = mysqli_query($con, "SELECT * FROM utilisateurs WHERE NOT unique_id = {$outgoing_id} 
                                AND (pseudo LIKE '%{$searchTerm}%' OR email = '%{$searchTerm}%' )");
    if(mysqli_num_rows($sql) > 0){
        include "data.php";
    } else {
        $output .= "<p style='font-size=14px; text-align=center;'>Il n'y pas d'utilisateur de ce pseudo !</p>";
    }
    echo $output;

?>