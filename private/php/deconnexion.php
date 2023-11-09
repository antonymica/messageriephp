<?php 

    session_start();

    if(isset($_SESSION['unique_id']))
    { // if user is logged in then come to this page otherwise go to login page
        include_once "conn.php";
        $logout_id = mysqli_real_escape_string($con, $_GET['logout_id']);
        if(isset($logout_id))
        { // if logout is set
                session_unset();
                session_destroy();
                header("location:../../public/index.php");
        } else {
            header("location:../home.php");
        }
    } else {
        header("location:../../public/index.php");
    }

?>