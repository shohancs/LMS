<?php include "inc/header.php"; ?>

  <!-- ::::: Manage Section Start ::::: -->
  <?php  
    if (isset($_GET['mid'])) {
      $manageId = $_GET['mid'];

      $sql = "SELECT * FROM users WHERE user_id = '$manageId' ORDER by fullname ASC ";
      $manageData = mysqli_query($db, $sql);

      while ( $row = mysqli_fetch_assoc($manageData) ) {
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
        ?>

        <!-- User Edit part start -->
        <section class="py-5">
          <div class="container">
            <div class="row">
              <div class="col-12 col-sm-12 col-md-12" style="border-top: 4px solid #08c; padding: 29px 62px 39px; box-shadow: 1px 10px 15px #ccc; border-radius: 5px; ">
                <h2 class="py-1 pb-5"> <i class="fa-solid fa-pen-to-square fs-4"></i> 
                    <?php  
                      if ($_SESSION['role'] == 1) { ?>
                        <span>Admin</span>
                      <?php }
                      else if ($_SESSION['role'] == 2) { ?>
                        <span>User</span>
                      <?php }
                    ?>
                    <small><span class="text-success"><?php echo $_SESSION['email']; ?></span></small>            
                    information </h2>

                  <!-- Form Start -->
                  <form action="" method="POST" enctype="multipart/form-data">
                    <div class="row">
                      <div class="col-lg-6">
                        <div class="mb-3">
                          <label for="exampleInputfullname" class="form-label">Full Name</label>
                          <input type="text" name="fullname" class="form-control" id="exampleInputfullname" aria-describedby="" required autocomplete="off" placeholder="Your full name..." value="<?php echo $fullname; ?>">
                        </div>

                        <div class="mb-3">
                          <label for="exampleInputPassword1" class="form-label">Password</label>
                          <input type="password" name="password" class="form-control" id="exampleInputPassword1" autocomplete="off" placeholder="xxxxxx">
                        </div>

                        <div class="mb-3">
                          <label for="exampleInputPassword2" class="form-label">Re-Type Password</label>
                          <input type="password" name="re_password" class="form-control" id="exampleInputPassword2" autocomplete="off" placeholder="xxxxxx">
                        </div>

                        <div class="mb-3">
                          <label for="phone" class="form-label">Phone No.</label>
                          <input type="tel" name="phone" class="form-control" id="phone" aria-describedby="" required autocomplete="off" placeholder="Phone No..." value="<?php echo $phone; ?>">
                        </div>
                      </div>

                      <div class="col-lg-6">
                        <div class="mb-3">
                          <label for="exampleFormControlTextarea1" class="form-label">Address</label>
                          <textarea class="form-control" name="address" id="exampleFormControlTextarea1" rows="4" placeholder="Your Address.."><?php echo $address; ?></textarea>
                        </div>                        

                        <div class="mb-3">
                          <label class="form-label">Profile Picture</label>
                          <br>
                          <?php
                            if (!empty($image)) { ?>
                              <img src="admin/dist/img/users/<?php echo $image; ?>" alt="" width="60" class="py-2">
                            <?php }
                            else { ?>
                              <p class="py-2">No Picture Uploaded!</p>
                            <?php }
                          ?>  
                          <input type="file" name="image" class="form-control">
                        </div>

                        <div class="mb-3">
                          <div class="d-grid gap-2">
                            <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
                            <input type="submit" name="updateUser" class="btn btn-success btn-block" value="Update information">                          
                          </div>
                        </div>                       
                      </div>
                    </div>                
                  </form>
                  <!-- Form End -->

                  

              </div>
            </div>
          </div>
        </section>
        <!-- User Edit part end -->

        <?php  }
    }
  ?>

  <!-- Update part start -->

  <?php  
      if (isset($_POST['updateUser'])) {
        $user_id      = $_POST['user_id'];
        $fullname     = $_POST['fullname'];
        $password     = $_POST['password'];
        $re_password  = $_POST['re_password'];
        $phone        = $_POST['phone'];
        $address      = $_POST['address'];

        // Work image upload Start
        $image        = $_FILES['image']['name'];
        $image_temp   = $_FILES['image']['tmp_name'];

        // Both for Password and Picture with all data change
        if( !empty($password) && !empty($image) ){ //Manea ei 2 tay data acea
          
          // New password check & encrypted
          if ($password == $re_password) {
            $hassedPass = sha1($password);
          }

          // Delete if image already exists
          $query = "SELECT * FROM users WHERE user_id = '$user_id'";
          $oldImage = mysqli_query($db, $query);

          while ($row = mysqli_fetch_assoc($oldImage)) {
            $existingImage = $row['image'];
            unlink("admin/dist/img/users/$image_name" . $existingImage);
          }

          // Upload New Image
          $image_name   = rand(1, 999999999) ."_". $image;
          move_uploaded_file($image_temp, "admin/dist/img/users/$image_name");

          $sql = "UPDATE users SET fullname='$fullname', password='$hassedPass', phone='$phone', address='$address', image='$image_name', WHERE user_id = '$user_id' ";
            $updateUser = mysqli_query($db, $sql);

            if ( $updateUser ) {
              header("Location: index.php");
            }
            else {
              die("mysqli Error" . mysqli_error($db));
            }
        }

        // Only Password with all data change
        else if ( !empty($password) && empty($image) ) {
          // New password check & encrypted
          if ($password == $re_password) {
            $hassedPass = sha1($password);
          }

          $sql = "UPDATE users SET fullname='$fullname', password='$hassedPass', phone='$phone', address='$address' WHERE user_id = '$user_id' ";
            $updateUser = mysqli_query($db, $sql);

            if ( $updateUser ) {
              header("Location: index.php");
            }
            else {
              die("mysqli Error" . mysqli_error($db));
            }
        }

        // Only Image with all data change
        else if ( empty($password) && !empty($image) ) {

          // Delete if image already exists
          $query = "SELECT * FROM users WHERE user_id = '$user_id'";
          $oldImage = mysqli_query($db, $query);

          while ($row = mysqli_fetch_assoc($oldImage)) {
            $existingImage = $row['image'];
            unlink("admin/dist/img/users/$image_name" . $existingImage);
          }

          // Upload New Image
          $image_name   = rand(1, 999999999) ."_". $image;
          move_uploaded_file($image_temp, "admin/dist/img/users/$image_name");

          $sql = "UPDATE users SET fullname='$fullname', phone='$phone', address='$address', image='$image_name' WHERE user_id = '$user_id' ";
            $updateUser = mysqli_query($db, $sql);

            if ( $updateUser ) {
              header("Location: index.php");
            }
            else {
              die("mysqli Error" . mysqli_error($db));
            }
        }

        // Only Chnge the Data
        else if ( empty($password) && empty($image) ) {

          $sql = "UPDATE users SET fullname='$fullname', phone='$phone', address='$address' WHERE user_id = '$user_id' ";
            $updateUser = mysqli_query($db, $sql);

            if ( $updateUser ) {
              header("Location: index.php");
            }
            else {
              die("mysqli Error" . mysqli_error($db));
            }
        }
      }
  ?>

  <!-- ::::: Manage Section End ::::: -->
      
<?php include "inc/footer.php"; ?>

