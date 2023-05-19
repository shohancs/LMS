<?php 
  session_start();
  ob_start();
  include "admin/inc/db.php";
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Library Management System</title>

    <!-- Bootstrap CDN Css -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

    <!-- JQuery UI -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

    <!-- favicon link here -->
    <link rel="shortcut icon" href="assets/images/favicon.jpg" type="image/x-icon">

    <!-- Font Awesome Kit Link Here -->
    <script src="https://kit.fontawesome.com/0c66e46c25.js" crossorigin="anonymous"></script>

    <!-- Data Table Css Link -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">

    <!-- Custom Css -->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
  </head>

  <body style="
    background-image: url(assets/images/back.jpg); 
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center;
    background-attachment: fixed;">
    <main class="main-part">
      <!-- ::::: Header Section Start ::::: -->
      <header>
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <!-- Nav Menu Start -->
              <nav class="navbar navbar-expand-lg">
                <div class="container-fluid">
                  <a class="navbar-brand" href="index.php">Online <span>Library</span></a>

                  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>

                  <!-- Menu Item Start -->
                  <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                      <?php  
                        $sql = "SELECT cat_id AS 'pCatID', cat_name AS 'pCatName' FROM category WHERE is_parent = 0 AND status = 1 ORDER BY cat_name ASC";
                        $parentMenu = mysqli_query($db, $sql);

                        while( $row = mysqli_fetch_assoc($parentMenu) ) {
                          extract($row);
                          // print_r($row);

                          $subCat = "SELECT cat_id AS 'sCatID', cat_name AS 'sCatName' FROM category WHERE is_parent = '$pCatID' AND status = 1 ORDER BY cat_name ASC";

                          $subMenu = mysqli_query($db, $subCat);
                          $countSubMenu = mysqli_num_rows($subMenu);

                          if ($countSubMenu == 0) { ?>
                            <li class="nav-item">
                              <a class="nav-link" aria-current="page" href="category.php?category=<?php echo $pCatName; ?>"><?php echo $pCatName; ?></a>
                            </li>
                          <?php }
                          else { ?>
                            <li class="nav-item dropdown">
                              <a class="nav-link dropdown-toggle" href="category.php?category=<?php echo $pCatName; ?>" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <?php echo $pCatName; ?>
                              </a>
                              <ul class="dropdown-menu">
                                <?php  
                                  while ($row = mysqli_fetch_assoc($subMenu)) {
                                    extract($row);
                                    ?>
                                    <li><a class="dropdown-item" href="category.php?category=<?php echo $sCatName; ?>"><?php echo $sCatName; ?></a></li>
                                 <?php }
                                ?>
                                
                              </ul>
                            </li>
                          <?php }
                          ?>                          

                        <?php }
                      ?>

                      <?php  
                        if (empty($_SESSION['user_id']) || empty($_SESSION['email'])) { ?>
                          <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="login.php"><i class="fa-solid fa-right-to-bracket"></i> Log in</a>
                          </li>

                          <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="register.php"><i class="fa-solid fa-circle-user"></i> Create account</a>
                          </li>
                        <?php }

                        else { ?>
                          <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                              <!-- Show user name -->
                              <?php  
                                $user_id = $_SESSION['user_id'];
                                $query = "SELECT * FROM users WHERE user_id = '$user_id'";
                                $userData = mysqli_query($db, $query);

                                while ($row = mysqli_fetch_assoc($userData)) {
                                  $fullname =  $row['fullname'];
                                  $image    = $row['image'];

                                  if (!empty($image)) { ?>
                                    <img src="admin/dist/img/users/<?php echo $image; ?>" alt="User Image" style="width: 30px; height: 30px; border-radius: 50%; border: 1px solid #333;"> 
                                  <?php echo $fullname; }
                                  else { ?>
                                    <img src="admin/dist/img/image.jpg" alt="User Image" style="width: 30px; height: 30px; border-radius: 50%; border: 1px solid #333;"> 
                                  <?php echo $fullname; }
                                }
                              ?>
                            </a>
                            <ul class="dropdown-menu">                              
                              <li><a class="dropdown-item" href="orderHistory.php"><i class="fa-solid fa-cart-shopping"></i> Booking Item </a></li>
                              <li><a class="dropdown-item" href="manage.php?mid=<?php echo $_SESSION['user_id']; ?>"><i class="fa-solid fa-user"></i> Manage Profile</a></li>
                              <li><a class="dropdown-item" href="logout.php"><i class="fa-solid fa-right-from-bracket"></i> Log Out </a></li>                            
                            </ul>
                          </li>

                       <?php }
                      ?>


                      
                      

                                          
                    </ul>
                  </div>
                  <!-- Menu Item End -->
                </div>
              </nav>
              <!-- Nav Menu End -->
            </div>
          </div>
        </div>
      </header>
      <!-- ::::: Header Section End ::::: -->