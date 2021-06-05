<?php
session_start();
  include"../conection.php";
   $i=$_SESSION['unique_id'];
  $sel=mysqli_query($con,"SELECT * FROM users WHERE NOT unique_id = '{$i}' ORDER BY user_id DESC");
  
  if (mysqli_num_rows($sel)>0) {
   while ($dis=mysqli_fetch_assoc($sel)) {

   
?>
<ul id="myUL">
  <li> 
    <a href="index.php?user_id=<?php echo $dis['unique_id'];  ?>"><img class="avtar mr-2" src="user-image/<?php echo $dis['img']; ?>"><?php echo $dis['fname']. " " . $dis['lname'] ;echo'<br>';
      if ($dis['status']=='Active now') {
         echo "<span class='badge badge-pill badge-success'>on</span>";
       } else {
          echo "<span class='badge badge-pill badge-danger'>off</span>";
       }
        ?>
    </a>
  </li>
</ul>
<?php
  }
   
  }?>