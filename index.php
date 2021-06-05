<?php include"header.php"; ?>
      <div class="content ">
        <main>
          <div class="container-fluid ">
            <!--table start -->
            <?php if(isset($_GET['msg'])) {
              $msg=$_GET['msg'];
              echo" <div class='alert alert-success alert-dismissible ' role='alert'>
                      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span>
                      </button>
                      <strong>congratulations!</strong> REgistration Successfull👍👍✌.
                    </div>"; 
              } ?>
            <!-- <h1 class=" mt-2">chat home page</h1> -->
            <div class="row">
              <div class="col-md-4 ">
                <div class="card">
                  <div class="card-header">
                    <div class="header-btn-lg pr-0">
                      <div class="widget-content p-0">
                        <div class="widget-content-wrapper">
                          <div class="widget-content-left">
                            <div class="btn-group">
                              <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn">
                              <img width="42"  class="rounded-circle mr-2 " src="user-image/<?php echo $row['img']; ?>" alt="">
                              </a>
                            </div>
                          </div>
                          <div class="widget-content-left  ml-3 header-user-info">
                            <div class="widget-heading">
                              <?php echo $row['fname']. " " . $row['lname'] ?>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php $outgoing_id = $_SESSION['unique_id'];?>
                  <input type="text" id="myInput" onkeyup="myFunction()" autocomplete="off" placeholder="Search for names.." title="Type in a name">
                  <div id="load-user"></div>
                  
                </div>
              </div>
<!-- users list section end -->


<!-- chat section start -->

              <div class="col-md-8" >
                <div id="chat-with"></div>
                <div class="main-card card">
                  
                  <?php if (isset($_GET['user_id'])): 
                   $user_id =mysqli_real_escape_string($con, $_GET['user_id']);
                  $incoming_id =  $user_id;?>

                    <input  id="incoming_id" value="<?php echo $incoming_id; ?>" hidden>
                    
                  <div class="card-body text-dark" style="overflow-x: hidden; overflow-y: auto;">
                    
                    <div class=" scroll">
                      <!-- Chat section -->
                    
                    <div class="load-chat"></div> 
                    </div>
                    <form action="insert-chat.php" method="POST" id="send-msg-form"  class="typing-area ">
                      <input type="text" class="incoming_id" name="incoming_id" id="incoming_id" value="<?php echo $incoming_id; ?>" hidden>
                      <input type="text" id="message"  name="message" required  class="input-msg" placeholder="Type a message here..." autocomplete="off">
                      <!-- <input type="submit" name="send-form"> -->
                      <input type="submit" value="send" name="send-form " class="btn btn-info" >

                    </form>
                  </div>
                  <?php endif ?> 
                  <?php if (!isset($_GET['user_id'])): ?>
                  <h1 class="heading">plese select any user to chat</h1>
                  <?php endif ?>
                </div>
              </div>
            </div>
          </div>
          <!--main end -->
      </div>
      </main>
    </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.bundle.min.js" integrity="sha256-OUFW7hFO0/r5aEGTQOz9F/aXQOt+TwqI1Z4fbVvww04=" crossorigin="anonymous" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery-slimScroll/1.3.8/jquery.slimscroll.min.js" integrity="sha256-qE/6vdSYzQu9lgosKxhFplETvWvqAAlmAuR+yPh/0SI=" crossorigin="anonymous" ></script>
    <script src="assets/js/script.js"></script>
    <script src="assets/js/main.js"></script>
    <!-- <script src="assets/js/display-chat.js"></script> -->
    <script src="insert-chat.js"></script>
    <script src="js/load-user.js"></script>
    <script src="js/load-chat.js"></script>
    <!-- <script src="js/load-chat-with.js"></script> -->
  </body>
</html>
<script type="text/javascript">
  var incoming_id=<?php echo $incoming_id; ?>;

chatWith=document.querySelector("#chat-with");

setInterval(() =>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "files/chat-with.php", true);
    xhr.onload = ()=>{
      if(xhr.readyState === XMLHttpRequest.DONE){
          if(xhr.status === 200){
            let data = xhr.response;
            chatWith.innerHTML = data;
           
          }
      }
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("I_id="+incoming_id);
}, 500);

</script>