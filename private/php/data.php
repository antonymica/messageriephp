<?php 

    while($row = mysqli_fetch_assoc($sql))
    {

        $sql2 = "SELECT * FROM messages WHERE (incoming_msg_id = {$row['unique_id']}
                    OR outgoing_msg_id = {$row['unique_id']}) AND (outgoing_msg_id = {$outgoing_id}
                    OR incoming_msg_id = {$outgoing_id}) ORDER BY msg_id DESC LIMIT 1";
        $query2 = mysqli_query($con, $sql2);
        $row2 = mysqli_fetch_assoc($query2);
        if(mysqli_num_rows($query2) > 0){
            $result = $row2['msg'];
        }else{
            $result = "Pas de message";
        }

        // Triming message if word are more than 28
        (strlen($result) > 28) ? $msg = substr($result, 0, 28).'...' : $msg = $result;
        // adding you: text before msg if login id send msg

        $output .= '<a href="message.php?user_id='.$row['unique_id'].'">
                    <div class="content">
                        <img src="images/' . $row['img'] . '" alt="">
                        <div class="details">
                            <span>'. $row['pseudo'] .'</span>
                            <p>'. $msg .'</p>
                        </div>
                    </div>
                    <form action="php/ajout.php?user_id='.$row['unique_id'].'" method="POST" class="ajouter" enctype="multipart/form-data">
                        <input type="submit" name="btn" value="Ajouter">
                    </form>
                    </a>';
    }

?>