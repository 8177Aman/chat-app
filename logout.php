<?php
    session_start();
    if(isset($_SESSION['unique_id'])){
        include_once "conection.php";
        $id= $_SESSION['unique_id'];        
            $status = "Offline now";
            $sql = mysqli_query($con, "UPDATE users SET status = 'Offline' WHERE unique_id={$id}");
            if($sql){
                session_unset();
                session_destroy();
                header("location:login.php");
            }
        
    }else{  
        header("location:login.php");
    }
?>