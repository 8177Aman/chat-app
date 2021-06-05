

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="../ChatApp - CodingNepal/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Hello, world!</title>
  </head>
  <body>
    <div class="container-fluid">
      <div class="row">
        <!-- user.php -->
        <div class="col-md-4">
          <?php 
            session_start();
            // echo $_SESSION['unique_id'];
            // die();
            include_once "../ChatApp - CodingNepal/php/config.php";
            if(!isset($_SESSION['unique_id'])){
              header("location: login.php");
            }
            ?>
          <?php include_once "../ChatApp - CodingNepal/header.php"; ?>
          <body>
            <div class="wrapper">
              <section class="users">
                <header>
                  <div class="content">
                    <?php 
                      $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
                      if(mysqli_num_rows($sql) > 0){
                        $row = mysqli_fetch_assoc($sql);
                      }
                      ?>
                    <img src="../ChatApp - CodingNepal/php/images/<?php echo $row['img']; ?>" alt="">
                    <div class="details">
                      <span><?php echo $row['fname']. " " . $row['lname'] ?></span>
                      <p><?php echo $row['status']; ?></p>
                    </div>
                  </div>
                  <a href="php/logout.php?logout_id=<?php echo $row['unique_id']; ?>" class="logout">Logout</a>
                </header>
                <div class="search">
                  <span class="text">Select an user to start chat</span>
                  <input type="text" placeholder="Enter name to search...">
                  <button><i class="fas fa-search"></i></button>
                </div>
                <div class="users-list">
                    <?php 

                    for($i=0;$i<20;$i++){
                        echo " aman" .$i."";
                        echo 'break';
                        echo"<br>";
                    } ?>
                </div>
              </section>
            </div>
            <script src="../ChatApp - CodingNepal/javascript/users.js"></script>
  
</div>
<!-- chat.php -->
<div class="col-md-8">
<?php 
  
  include_once "../ChatApp - CodingNepal/php/config.php";
  if(!isset($_SESSION['unique_id'])){
    header("location: login.php");
  }
  ?>
<?php include_once "../ChatApp - CodingNepal/header.php"; ?>
<body>
<div class="wrapper">
<section class="chat-area">
<header>
<?php 
  $img=''; 
  $fname='';
  $lname='';
  $status='';
if(isset($_GET['user_id'])) {
    $user_id = mysqli_real_escape_string($conn, $_GET['user_id']);
  $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$user_id}");
  if(mysqli_num_rows($sql) > 0){
    $row = mysqli_fetch_assoc($sql);
  }
  $img=$row['img']; 
  $fname=$row['fname'];
  $lname=$row['lname'];
  $status=$row['status'];
}else{
    echo"select one of the chat";
    die();
}
  
  ?>
<a href="home.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
<img src="../ChatApp - CodingNepal/php/images/<?php echo $row['img']; ?>" alt="">
<div class="details">
<span><?php echo $row['fname']. " " . $row['lname'] ?></span>
<p><?php echo $row['status']; ?></p>
</div>
</header>
<div class="chat-box">
</div>
<form action="#" class="typing-area">
<input type="text" class="incoming_id" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
<input type="text" name="message" class="input-field" placeholder="Type a message here..." autocomplete="off">
<button><i class="fab fa-telegram-plane"></i></button>
</form>
</section>
</div>
<script src="../ChatApp - CodingNepal/javascript/chat.js"></script>
</body>
</html>
</div>          
</div>
</div>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>