<?php 
  session_start();
  if(!isset($_SESSION['unique_id'])){
  header('location:login.php');
  }
  include"conection.php";
   ?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>chat application</title>
    <link rel = "icon" href = "assets/images/logo.png"  type = "image/x-icon">
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css"
      integrity="sha256-L/W5Wfqfa0sdBNIKN9cG6QA5F2qx4qICmU2VgLruv9Y="
      crossorigin="anonymous"
      />
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="assets/css/style.css" />
    <link rel="stylesheet" href="assets/css/main.css" />
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
      <button class="navbar-toggler sideMenuToggler" type="button">
      <!-- <span class="navbar-toggler-icon"></span> -->
      </button>
      <a class="navbar-brand" href="#"><img src="assets/images/logo.png"></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"  aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" >
      <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
          <?php include"conection.php";
            $sql = mysqli_query($con, "SELECT * FROM users WHERE unique_id='{$_SESSION['unique_id']}'");            
              $row = mysqli_fetch_assoc($sql);            
            ?>
          <img class="avtar mr-2 " src="user-image/<?php echo $row['img']; ?>">
          <li class="nav-item dropdown">
            <!-- <a class="nav-link dropdown-toggle p-0" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" > -->
            <span class="text-dark"><?php echo $row['fname']. " " . $row['lname']  ?></span>
            </a>
            
          </li>
        </ul>
      </div>
    </nav>
    <div class="wrapper d-flex">
      <div class="sideMenu bg-mattBlackLight">
        <div class="sidebar">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a href="index.php" class="nav-link px-2">
              <span class=" text heading"><i class="las la-home"></i>Home</span>
              </a>
            </li>
            <li class="nav-item">
              <a href="profile.php" class="nav-link  px-2">
              <i class="icon lar la-user"></i>
              <span class="text">User Profile</span>
              </a>
            </li>
            <li class="nav-item">
              <a href="logout.php" class="nav-link  px-2">
              <i class="icon las la-door-open"></i>
              <span class="text">Logout</span>
              </a>
            </li>
          </ul>
        </div>
      </div>