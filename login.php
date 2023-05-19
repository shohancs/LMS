<?php include "inc/header.php"; ?>

      <!-- ::::: User LogIn Section Start ::::: -->
      <section class="py-5">
        <div class="container">
          <div class="row">
            <div class="col-lg-6 offset-lg-3" style="border-top: 4px solid #08c; padding: 29px 52px 39px; box-shadow: 1px 10px 15px #ccc; border-radius: 5px; ">
              <h2 class="text-center py-3">User Login</h2>
              <form action="" method="POST">

                <div class="mb-0">
                  <label for="exampleInputEmail1" class="form-label">Email address</label>
                </div>
                <div class="input-group mb-3">
                  <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="enter your email..." aria-label="emailHelp" aria-describedby="basic-addon2" required>
                  <span class="input-group-text" id="basic-addon2"><i class="fa-solid fa-envelope"></i></span>
                </div>

                <div class="mb-0">
                  <label for="exampleInputPassword1" class="form-label">Password</label>
                </div>
                <div class="input-group mb-3">
                  <input type="password" name="password" class="form-control" id="myInput" placeholder="enter your password..." required autocomplete="off">
                  <span class="input-group-text" id="basic-addon2"><i class="fa-solid fa-lock"></i></span>
                </div>

                <div class="input-group mb-3">
                  <div>
                    <input class="form-check-input" type="checkbox" aria-label="Checkbox for following text input" onclick="myFunction()">
                  </div>&nbsp; Show Password
                  <script>
                    function myFunction() {
                      var x = document.getElementById("myInput");
                      if (x.type === "password") {
                        x.type = "text";
                      } else {
                        x.type = "password";
                      }
                    }
                  </script>
                </div>

                <div class="mb-3">                
                  <button type="submit" name="login" class="btn btn-primary">Log in</button>
                </div>
              </form>

              <!-- login option start -->
              <?php  
                if (isset($_POST['login'])) {
                  // Get the data from user
                  $email      = mysqli_real_escape_string($db, $_POST['email']);
                  $password   = mysqli_real_escape_string($db, $_POST['password']);

                  if (!empty($password)) {
                    $hassedPass = sha1($password);
                  // }

                  // Check the email address first
                  $sql = "SELECT * FROM users WHERE email='$email' AND status = 1";
                  $userData = mysqli_query($db, $sql);

                  // Data gula kea khujbe
                  while( $row = mysqli_fetch_assoc($userData) ) {
                    $_SESSION['user_id']      = $row['user_id'];
                    $fullname                 = $row['fullname'];
                    $_SESSION['email']        = $row['email'];
                    $password                 = $row['password'];
                    $phone                    = $row['phone'];
                    $address                  = $row['address'];
                    $image                    = $row['image'];
                    $_SESSION['role']         = $row['role'];
                    $status                   = $row['status'];
                    $join_date                = $row['join_date'];
                    
                    // Admin LogIn
                    if ( $email == $_SESSION['email'] && $hassedPass == $password ) {
                      header("Location: index.php");
                    }

                    // User LogIn
                    else if ( $email != $_SESSION['email'] || $hassedPass != $password ) {
                      header("Location: index.php");
                    }

                    else {
                      header("Location: index.php");
                    }
                  }
                }

        /* Same work line 102-112
        if ($_SESSION['role'] == 1) {
          if ( $email == $_SESSION['email'] && $hassedPass == $password ) {
            header("Location: dashboard.php");
          }
          else if ( $email != $_SESSION['email'] && $hassedPass != $password ) {
            header("Location: index.php");
          }
          else {
            header("Location: index.php");
          }
        }
        else {
          session_unset();
          session_destroy();
          header("Location: index.php");
        }
        */
                    
                  
                }
              ?>
              <!-- login option end -->

              <div class="login-option">
                <ul>
                  <li><i class="fa-regular fa-circle-question"></i> Not a Member? <a href="register.php">Signup Here</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- ::::: User LogIn Section End ::::: -->
      
<?php include "inc/footer.php"; ?>