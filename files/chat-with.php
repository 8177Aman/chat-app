
<?php
include"../conection.php";
                      $id =mysqli_real_escape_string($con, $_POST['I_id']);
                      $sql = mysqli_query($con, "SELECT * FROM users WHERE unique_id = '$id'");
                      if(mysqli_num_rows($sql) > 0){
                        $row = mysqli_fetch_assoc($sql);
                      }
                     
                      ?>
<div class="card-header">
                     <div class="widget-content p-0">
                        <div class="widget-content-wrapper">
                          <div class="widget-content-left">
                            <div class="btn-group">
                              <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn">
                              <img width="42" class="rounded-circle mr-2 " src="user-image/<?php echo $row['img']; ?>" alt="">
                              </a>
                            </div>
                          </div>
                          <div class="widget-content-left  ml-3 header-user-info">
                            <div class="widget-heading">
                              <?php echo $row['fname']. " " . $row['lname'] ?>
                            </div>
                            <div class="widget-subheading">
                              <?php if ($row['status']=='Active now') {
                         echo "<span class='badge badge-pill badge-success'>on</span>";
                       } else {
                          echo "<span class='badge badge-pill badge-danger'>off</span>";
                       } ?>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                 