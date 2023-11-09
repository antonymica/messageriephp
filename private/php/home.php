<?php 

    session_start();
    include_once "conn.php";
    $outgoing_id = $_SESSION['unique_id'];
    $sql = mysqli_query($con, "SELECT * FROM utilisateurs 
                                JOIN messages ON (utilisateurs.unique_id=messages.incoming_msg_id OR utilisateurs.unique_id=messages.outgoing_msg_id)
                                WHERE unique_id != {$outgoing_id} AND
                                1 = CASE WHEN messages.incoming_msg_id=$outgoing_id THEN 1 ELSE 0 END
                                GROUP BY (messages.outgoing_msg_id)
                                ORDER BY messages.date DESC ");
    $output = "";

    if(mysqli_num_rows($sql) == 0){
        $output .= '<p style="font-size=16px; color=#3a3f0b text-align=center;">Pas de nouveau message!</p>';
    } elseif (mysqli_num_rows($sql) > 0) {
        //include "data.php";
        while($row = mysqli_fetch_assoc($sql)){
            $sql2 = "SELECT * FROM messages WHERE (incoming_msg_id = {$row['unique_id']}
                    OR outgoing_msg_id = {$row['unique_id']}) AND (outgoing_msg_id = {$outgoing_id}
                    OR incoming_msg_id = {$outgoing_id}) ORDER BY msg_id DESC LIMIT 1";
            $query2 = mysqli_query($con, $sql2);
            $row2 = mysqli_fetch_assoc($query2);
            if(mysqli_num_rows($query2) > 0){
                if($row2['msg'] != NULL){
                    $result = $row2['msg'];
                } elseif ($row2['msg'] == NULL && $row2['file'] != NULL){
                    $result = "Pièce jointe...";
                }
            }else{
                $result = "Pas de message";
            }

            // Triming message if word are more than 28
            (strlen($result) > 28) ? $msg = substr($result, 0, 28).'...' : $msg = $result;
            // adding vous: text before msg if login id send msg
            ($outgoing_id == $row2['outgoing_msg_id']) ? $you="Vous: " : $you="";

            $output .= '<a href="message.php?user_id='.$row['unique_id'].'">
                        <div class="content">
                            <img src="images/' . $row['img'] . '" alt="">
                            <div class="details">
                                <span>'. $row['pseudo'] .'</span>
                                <p>'. $you. $msg .'</p>
                            </div>
                        </div>
                        </a>';
        }
    
    }
    echo $output;

?>