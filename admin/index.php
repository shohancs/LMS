<?php 
  session_start();
  ob_start();
  include "inc/db.php";

  // Problem same email ea anaother password dilew access kora jachea ei condition er karonea

  // if (!empty($_SESSION['user_id']) || !empty($_SESSION['email'])) {
  //   header("Location: dashboard.php");
  // }

  // Ekhon uporer code na use korar karone ami dashboard ea log in tahaka obostay abar login page a back korte parteci, dashboard theke log in pagea ea na jawar jonno ei code ti use kora hoyecilo.

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Administration Login</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page" style="background: #454D55;">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary" style="background: #25273E; color: white; padding: 10px 0;">
    <div class="card-header text-center">
      <h2 class="text-bold">ADMIN PANEL</h2>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form action="" method="POST">
        <div class="input-group mb-3">
          <input type="email" name="email" class="form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>

        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password" id="myInput">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>          
        </div>

        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <div>
              <input type="checkbox" aria-label="Checkbox for following text input" onclick="myFunction()">
            </div>&nbsp; Show Password
          </div>
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

        <div class="row">
          <div class="col-12">
            <input type="submit" name="login" class="btn btn-primary btn-block" value="Sign In">
          </div>
        </div>
      </form>

      <?php  
        if (isset($_POST['login'])) {
          // Get the data from user
          $email      = mysqli_real_escape_string($db, $_POST['email']);
          $password   = mysqli_real_escape_string($db, $_POST['password']);

          if (!empty($password)) {
            $hassedPass = sha1($password);
          }

          // Check the email address first
          $sql = "SELECT * FROM users WHERE email='$email'";
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
            if ( $email == $_SESSION['email'] && $hassedPass == $password && $_SESSION['role'] == 1 ) {
              header("Location: dashboard.php");
            }

            // User LogIn
            else if ( $email != $_SESSION['email'] && $hassedPass != $password && $_SESSION['role'] != 1 ) {
              header("Location: index.php");
            }
            else {
              header("Location: index.php");
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
        }
      ?>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>

<?php 
  ob_end_flush();
  // session_destroy(); //issue
?>
</body>
</html>
