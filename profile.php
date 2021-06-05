<?php include"header.php";

$msg='';
$error='';
 $i=$_SESSION['unique_id'];
if (isset($_POST['updatepassword'])) {

  $current_password=mysqli_real_escape_string($con, $_POST['current_password']);
  $password=mysqli_real_escape_string($con, $_POST['password']);
  $confirm_password=mysqli_real_escape_string($con, $_POST['confirm_password']);
  if ($password===$confirm_password) {
    
    $sel=mysqli_query($con,"SELECT * FROM users WHERE unique_id = '{$i}' "); 
   
    $dis=mysqli_fetch_assoc($sel);
      $db_pass= $dis['password'];
    

    if (password_verify($current_password,$db_pass)) {
      $option=['cost'=>10];
      $passcode = password_hash($password, PASSWORD_DEFAULT,$option);
      $update=mysqli_query($con,"UPDATE users SET password='{$passcode}' WHERE unique_id='{$i}'");
      if ($update) {
        $msg="Password changed successfully";
      }else{
        die(mysqli_error($con));
        $error="unable to change password";
      }
      
    }else{
      $error="current password is incorrect";
    }
  }else{
    $error="password and confirm password should match";
  }  
}

if (isset($_POST['updateprofile'])) {
  $fname=mysqli_real_escape_string($con, $_POST['fname']);
  $lname=mysqli_real_escape_string($con, $_POST['lname']);
 

  if (isset($_FILES['image'])) {

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
                                
                                
                                $update = mysqli_query($con, "UPDATE users SET fname='{$fname}', lname='{$lname}', img='{$new_img_name}' WHERE unique_id='{$i}'");
                                if ($update) {

                              $msg='profile updated successfully';
                                header('location:profile.php?msg='.$msg.'');
                              } else {
                                 $erorr='unable to update profile';
                              }
                            }
                        }else{
                            $error= "Please upload an image file - jpeg, png, jpg";
                        }
                    }else{
                        $error= "Please upload an image file - jpeg, png, jpg";
                    }
  }else{

      $update=mysqli_query($con,"UPDATE users SET fname='{$fname}', lname='{$lname}' WHERE unique_id='{$i}'");
      if ($update) {
         $msg='profile updated successfully ';
         header('location:profile.php?msg='.$msg.'');
      } else {
         $erorr='unable to update profile';
      }     

  }

  
  
}



 ?>
      <div class="content">
        <main class="mt-5">

          <div class="container-fluid">
            <!--main content start -->


            <div class="row">
  		<div class="col-sm-3"><!--left col-->
              
<?php  
$i=$_SESSION['unique_id'];
  $sel=mysqli_query($con,"SELECT * FROM users WHERE unique_id = '{$i}' ");
 
  $dis=mysqli_fetch_assoc($sel);
   ?>
   
      <div class="text-center">
        <img src="user-image/<?php echo $dis['img']; ?>" class="rounded-circle img-thumbnail" width="200" height="180" alt="avatar">
        <h6><?php echo $dis['fname']. " " . $dis['lname'] ;?></h6>  
      </div></hr><br>
        </div><!--/col-3-->
    	<div class="col-sm-6">
        <?php if (isset($_GET['msg'])) {
  ?>

             <div class='alert alert-success alert-dismissible ' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span>
                    </button>
                    <strong>congratulations!</strong> <?php echo  $_GET['msg'];?>
                  </div><?php } ?>
                 <h3>PROFILE</h3> 
    <form class="row g-3 needs-validation "  action="#" method="POST" novalidate>         
  <div class="col-md-6 form-group">
    <label for="validationCustom01" class="form-label">First name</label>
    <input type="text" class="form-control" id="validationCustom01" name="fname"  value="<?php echo $dis['fname']; ?>" placeholder="please enter your first name"  required>
    <div class="valid-feedback">
      Looks good!
    </div>
  </div>
  <div class="col-md-6 form-group">
    <label for="validationCustom02" class="form-label">Last name</label>
    <input type="text" class="form-control" id="validationCustom02" name="lname" value="<?php echo $dis['lname']; ?>" placeholder="please enter your last name" required>
    <div class="valid-feedback">
      Looks good!
    </div>
  </div>
  <div class="col-md-6 form-group">
    <label for="validationCustomUsername" class="form-label">E-mail</label>
    <div class="input-group has-validation">
      <span class="input-group-text" id="inputGroupPrepend">@</span>
      <input type="email" class="form-control" disabled value="<?php echo $dis['email']; ?>" id="validationCustomUsername" aria-describedby="inputGroupPrepend" required>
      <div class="invalid-feedback">
        Please choose a username.
      </div>
    </div>
  </div>

  <div class="col-md-6 form-group">
    <label >Profile Picture Update</label>    
      <input type="file" class="form-control" value="<?php echo $dis['img']; ?>" name="image" >
     
    </div>


  


  <div class="col-12">
    <button class="btn btn-primary" name="updateprofile" type="submit">Update</button>
  </div>
</form>

<form action="" method="post">
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
            <h3>Set a new password</h3>
             <label>Current Password</label>
        <div class="form-group pass_show"> 
                <input type="password" required name="current_password"  class="form-control" placeholder="Current Password"> 
            </div> 
           <label>New Password</label>
            <div class="form-group pass_show"> 
                <input type="password" required name="password"   class="form-control" placeholder="New Password" > 
            </div> 
           <label>Confirm Password</label>
            <div class="form-group pass_show"> 
                <input type="password" required name="confirm_password"   class="form-control" placeholder="Confirm Password"> 
            </div> 
      <button type="reset" class="btn btn-light">Cancel</button>
             <button  type="submit" name="updatepassword" class="btn btn-success">change</button>
          </form>
                 
              

              
          
    </div><!--/row-->

           

<?php include"footer.php"; ?>