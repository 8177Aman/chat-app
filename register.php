<?php
session_start();
if(isset($_SESSION['unique_id'])){
header('location:index.php');
}
include_once('conection.php');
 $msg='';
  $error='';
if (isset($_POST['register-submit'])) {

      $fname = mysqli_real_escape_string($con, $_POST['fname']);
    $lname = mysqli_real_escape_string($con, $_POST['lname']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    if(!empty($fname) && !empty($lname) && !empty($email) && !empty($password)){
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            $sql = mysqli_query($con, "SELECT * FROM users WHERE email = '{$email}'");
            if(mysqli_num_rows($sql) > 0){
                $error="$email - This email already exist!";
            }else{
                if(isset($_FILES['image'])){
                    $img_name = $_FILES['image']['name'];
                    $img_type = $_FILES['image']['type'];
                    $tmp_name = $_FILES['image']['tmp_name'];
                    
                    $img_explode = explode('.',$img_name);
                    $img_ext = end($img_explode);
    
                    $extensions = ["jpeg", "png", "jpg"];
                    if(in_array($img_ext, $extensions) === true){
                        $types = ["image/jpeg", "image/jpg", "image/png"];
                        if(in_array($img_type, $types) === true){
                            $time = time();
                            $new_img_name = $time.$img_name;
                            if(move_uploaded_file($tmp_name,"user-image/".$new_img_name)){
                                
                                $ran_id = rand(time(), 100000000);
                                $status = "Active now";
                                $option=['cost'=>10];
                                $passcode = password_hash($password, PASSWORD_DEFAULT,$option);
                                $insert_query = mysqli_query($con, "INSERT INTO users (unique_id, fname, lname, email, password, img, status)
                                VALUES ({$ran_id}, '{$fname}','{$lname}', '{$email}', '{$passcode}', '{$new_img_name}', '{$status}')");
                                if($insert_query){
                                    $select_sql2 = mysqli_query($con, "SELECT * FROM users WHERE email = '{$email}'");
                                    if(mysqli_num_rows($select_sql2) > 0){
                                        $result = mysqli_fetch_assoc($select_sql2);
                                        $_SESSION['unique_id'] = $result['unique_id']    ;                       

                                        $msg= "Registration Success";
                                        header("location:index.php?msg=".$msg."");
                                    }else{
                                        $error= "This email address not Exist!";
                                    }
                                }else{
                                    $error= "Something went wrong. Please try again!";
                                }
                            }
                        }else{
                            $error= "Please upload an image file - jpeg, png, jpg";
                        }
                    }else{
                        $error= "Please upload an image file - jpeg, png, jpg";
                    }
                }
            }
        }else{
            $error= "$email is not a valid email!";
        }
    }else{
        $error= "All input fields are required!";
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
    <title>Hello, world!</title>
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
                    <strong>congratulations!</strong> ".$msg."
                  </div>";
          } ?>
          
          <div class="d-flex justify-content-center">
            <h2>
              Register Form
            </h2>
          </div>
          
          <div class="d-flex justify-content-center form_container">
            <form action="#" method="POST"  enctype="multipart/form-data"  autocomplete="off">
              <div class="error-text"></div>
              <div class="row">
                <div class="col-md-6">
                   <div class="form-group">
                <label for="fname">First Name</label>
                <input class="form-control " id="fname" name="fname" required placeholder="enter your fname" type="text" value="">
              </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                <label for="lname">Last Name</label>
                <input class="form-control input_pass" id="lname" name="lname" required placeholder="lname" type="lname" value="">
              </div>
                </div>
              </div>
             
              
              <div class="form-group">
                <label for="email">email</label>
                <input class="form-control input_pass" id="email" name="email" required placeholder="email" type="email" value="">
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <input class="form-control input_pass" id="password" name="password" required placeholder="password" type="password" value="">
              </div>
              <div class="form-group">
                <label for="image">Select Image:</label>
                <input class="" id="image" name="image" required placeholder="image" type="file" value="">
              </div>
              <div class="form-group">
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" id="customControlInline" type="checkbox"> <label class="custom-control-label" for="customControlInline">Remember me</label>
                </div>
              </div>
              <div class="d-flex justify-content-center mt-3 login_container">
                <button class="btn login_btn"  name="register-submit" type="submit">Register</button>
              </div>
            </form>
          </div>
          <div id="ack"></div>
          <div class="mt-4">
            <div class="d-flex justify-content-center links">
             Already an account? <a class="ml-2" href="login.php">Login</a>
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


