<?php 
include_once('conection.php');

session_start();
if(isset($_SESSION['unique_id'])){
header('location:index.php');
}
$msg='';
$error='';
if (isset($_POST['loginbutton'] )) {
  include_once('conection.php');
  $email=mysqli_real_escape_string($con,$_POST['email']);
  $password=mysqli_real_escape_string($con,$_POST['password']);
  $sql = mysqli_query($con, "SELECT * FROM users WHERE email = '{$email}'");
  if(mysqli_num_rows($sql) > 0){
    $row = mysqli_fetch_assoc($sql);
    $db_password = $row['password'];
    if(password_verify($password, $row['password'])){
      $status = "Active now";
      $sql2 = mysqli_query($con, "UPDATE users SET status = '{$status}' WHERE unique_id = '{$row['unique_id']}'");
      if($sql2){
        $_SESSION['unique_id'] = $row['unique_id'];
        $msg= "success";
        header('location:index.php');
        }else{
           $error= "Something went wrong. Please try again!";
             }
    }else{
            $error= " Password is Incorrect!";
          }
  }else{
          $error= "$email - This email not Exist!";
        }
}
 ?>

 <!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="assets/css/login.css">
    <title>techwithaman-Chat-app</title>
    <link rel = "icon" href = "assets/images/logo.png"  type = "image/x-icon">
  </head>
  <body>
    
      
    <div class="container h-100 mt-auto">
        
    <div class="container h-100">
      <div class="d-flex justify-content-center h-100">
        <div class="form-area">
          <?php if ($error != "") {
           echo" <div class='alert alert-danger alert-dismissible ' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span>
                    </button>
                    <strong>Error!</strong> ". $error.".
                  </div>";
          } ?>
          <?php if ($msg != "") {
           echo" <div class='alert alert-success alert-dismissible ' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span>
                    </button>
                    <strong>congratulations!</strong> <?php echo $msg ?>.
                  </div>";
          } ?>
          <!-- <div class='alert alert-success alert-dismissible ' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span>
                    </button>
                    <strong>Error!</strong> <?php echo $error ?>.
                  </div> -->
          <div class="d-flex justify-content-center">
            <h2>
              Login Form
            </h2>
          </div>
          
          <div class="d-flex justify-content-center form_container">
            <form action="#" method="POST"  enctype="multipart/form-data"  autocomplete="off">
              <div class="error-text"></div>
              <div class="form-group">
                <label for="email">Email</label>
                <input class="form-control " id="email" name="email" required placeholder="enter your email" type="email" value="">
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <input class="form-control input_pass" id="password" name="password" required placeholder="password" type="password" value="">
              </div>
              <div class="form-group">
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" id="customControlInline" type="checkbox"> <label class="custom-control-label" for="customControlInline">Remember me</label>
                </div>
              </div>
              <div class="d-flex justify-content-center mt-3 login_container">
                <button class="btn login_btn"  name="loginbutton" type="submit">Login</button>
              </div>
            </form>
          </div>
          <div id="ack"></div>
          <div class="mt-4">
            <div class="d-flex justify-content-center links">
              Don't have an account? <a class="ml-2" href="register.php">Sign Up</a>
            </div>
            <div class="d-flex justify-content-center links">
              <a href="#">Forgot your password?</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    </section>
    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>


