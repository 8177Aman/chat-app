<?php 
 
session_start();
    if(isset($_SESSION['unique_id'])){
        include_once "../conection.php";
        $outgoing_id = $_SESSION['unique_id'];
         // $incoming_id= 960061749;
         $incoming_id = mysqli_real_escape_string($con, $_POST['I_id']);
        $sql=mysqli_query($con ,"SELECT * FROM messages WHERE (outgoing_msg_id='$outgoing_id' AND incoming_msg_id='$incoming_id') OR (outgoing_msg_id='$incoming_id' AND incoming_msg_id='$outgoing_id' )");
       
        while ($row=mysqli_fetch_assoc($sql)) {
            if($row['outgoing_msg_id'] === $outgoing_id){
                    echo'<div style="margin-bottom:5px;   display: flex;  "">
                                <div style="max-width: calc(100% - 130px);background: #333;margin-left: auto;
  color: #fff;
  border-radius: 18px 18px 0 18px;">
                                    <p style="padding: 10px; margin-bottom: 0rem !important;" >'. $row['msg'] .'</p>
                                </div>
                                </div>';
                }else{
                    echo'<div style="margin-bottom:5px;" class="">
                                
                                <div style="background-color:#646464; max-width: 230px; border-radius:18px  18px 18px 0px;">
                                    <p style="color:#fff; padding: 10px; margin-bottom: 0rem !important;">'. $row['msg'] .'</p>
                                </div>
                                </div>';
                }
        }
    }
?>