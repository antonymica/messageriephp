<?php 

    session_start();
    if(isset($_SESSION['unique_id'])){
        include_once "conn.php";
        $outgoing_id = mysqli_real_escape_string($con, $_POST['outgoing_id']);
        $incoming_id = mysqli_real_escape_string($con, $_POST['incoming_id']);
        $output = "";

        $sql = "SELECT * FROM messages
                LEFT JOIN utilisateurs ON utilisateurs.unique_id = messages.outgoing_msg_id
                WHERE (outgoing_msg_id = {$outgoing_id} AND incoming_msg_id = {$incoming_id})
                OR (outgoing_msg_id = {$incoming_id} AND incoming_msg_id = {$outgoing_id}) ORDER BY msg_id";
        $query = mysqli_query($con, $sql);
        if(mysqli_num_rows($query) > 0){
            while($row = mysqli_fetch_assoc($query)){

                if($row['outgoing_msg_id'] === $outgoing_id){
                    
                    if($row['msg'] != NULL && $row['file'] != NULL){

                        $fic = $row['file'];
                        $fic_explode = explode('.', $fic);
                        $fic_ext = end($fic_explode);

                        $extension = ['png', 'jpeg', 'jpg', 'gif', 'ico'];

                        if(in_array($fic_ext, $extension) === true){

                            $output .= '<div class="chat outgoing">
                                        <div class="details">
                                            <p>
                                            '. $row['msg'] .'
                                            </br>
                                            <span>'. $row['date'] .'</span>
                                            </p>
                                            <a download="'. $row['file'] .'" href="photos/'. $row['file'] .'">
                                                <img src="photos/'. $row['file'] .'" alt=" ">
                                            </a>
                                        </div>
                                        </div>';

                        } else {

                            $output .= '<div class="chat outgoing">
                                        <div class="details">
                                            <p>
                                            '. $row['msg'] .'
                                            </br>
                                            <span>'. $row['date'] .'</span>
                                            </p>
                                            <a download="'. $row['file'] .'" href="photos/'. $row['file'] .'">'. $row['file'] .'</a>
                                        </div>
                                        </div>';
                        }

                    } elseif ($row['msg'] != NULL && $row['file'] == NULL){

                        $output .= '<div class="chat outgoing">
                                        <div class="details">
                                            <p>
                                            '. $row['msg'] .'
                                            </br>
                                            <span>'. $row['date'] .'</span>
                                            </p>
                                        </div>
                                    </div>';

                    } elseif ($row['msg'] == NULL && $row['file'] != NULL){

                        $fic = $row['file'];
                        $fic_explode = explode('.', $fic);
                        $fic_ext = end($fic_explode);

                        $extension = ['png', 'jpeg', 'jpg', 'gif', 'ico'];

                        if(in_array($fic_ext, $extension) === true){

                            $output .= '<div class="chat outgoing">
                                        <div class="details">
                                            <a download="'. $row['file'] .'" href="photos/'. $row['file'] .'">
                                                <img src="photos/'. $row['file'] .'" alt=" ">
                                            </a>
                                        <span>'. $row['date'] .'</span>
                                        </div>
                                        </div>';

                        } else {

                            $output .= '<div class="chat outgoing">
                                        <div class="details">
                                        <a download="'. $row['file'] .'" href="photos/'. $row['file'] .'">'. $row['file'] .'</a>
                                        <span>'. $row['date'] .'</span>
                                        </div>
                                    </div>';

                        }
                        
                    }
                      
                    // Fin le if mpandefa an'le message
                    
                } else {
                    
                    if($row['msg'] != NULL && $row['file'] != NULL){

                        $fic = $row['file'];
                        $fic_explode = explode('.', $fic);
                        $fic_ext = end($fic_explode);

                        $extension = ['png', 'jpeg', 'jpg', 'gif', 'ico'];

                        if(in_array($fic_ext, $extension) === true){

                            $output .= '<div class="chat incoming">
                                        <img class="img1" src="images/'. $row['img'].'" alt="">
                                        <div class="details">
                                            <p>
                                            '. $row['msg'] .'
                                            </br>
                                            <span>'. $row['date'] .'</span>
                                            </p>  
                                            <a download="'. $row['file'] .'" href="photos/'. $row['file'] .'">
                                                <img src="photos/'. $row['file'] .'" alt=" ">
                                            </a>
                                        </div>
                                        </div>';

                        } else {

                            $output .= '<div class="chat incoming">
                                        <img class="img1" src="images/'. $row['img'].'" alt="">
                                        <div class="details">
                                            <p>
                                            '. $row['msg'] .'
                                            </br>
                                            <span>'. $row['date'] .'</span>
                                            </p>  
                                            <a download="'. $row['file'] .'" href="photos/'. $row['file'] .'">'. $row['file'] .'</a>
                                        </div>
                                    </div>';

                        }

                        
                    } elseif ($row['msg'] != NULL && $row['file'] == NULL){

                        $output .= '<div class="chat incoming">
                                        <img class="img1" src="images/'. $row['img'].'" alt="">
                                        <div class="details">
                                            <p>
                                            '. $row['msg'] .'
                                            </br>
                                            <span>'. $row['date'] .'</span>
                                            </p>  
                                        </div>
                                    </div>';

                    } elseif ($row['msg'] == NULL && $row['file'] != NULL){

                        $fic = $row['file'];
                        $fic_explode = explode('.', $fic);
                        $fic_ext = end($fic_explode);

                        $extension = ['png', 'jpeg', 'jpg', 'gif', 'ico'];

                        if(in_array($fic_ext, $extension) === true){

                            $output .= '<div class="chat incoming">
                                            <img class="img1" src="images/'. $row['img'].'" alt="">
                                            <div class="details">
                                            <a download="'. $row['file'] .'" href="photos/'. $row['file'] .'">
                                                <img src="photos/'. $row['file'] .'" alt=" ">
                                            </a>
                                            <span>'. $row['date'] .'</span>  
                                            </div>
                                        </div>';

                        } else {

                            $output .= '<div class="chat incoming">
                                            <img class="img1" src="images/'. $row['img'].'" alt="">
                                            <div class="details">
                                                <a download="'. $row['file'] .'" href="photos/'. $row['file'] .'">'. $row['file'] .'</a>
                                                <span>'. $row['date'] .'</span>  
                                            </div>
                                        </div>';
                                        
                        }
                        
                    }

                } // Fin le else andefasana an'le message

            }
            echo $output;
            
        }
    } else {
        header("../../public/index.php");
    }

?>
