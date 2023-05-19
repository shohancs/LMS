<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <span class="brand-link">
      <a href="dashboard.php"><img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"></a>
      <span class="brand-text font-weight-normal" style="color: #fff;">Admin Panel</span>
    </span>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <?php  
              $user_id = $_SESSION['user_id'];
              $query = "SELECT * FROM users WHERE user_id = '$user_id'";
              $userData = mysqli_query($db, $query);

              while ($row = mysqli_fetch_assoc($userData)) {
                $image  = $row['image'];

                if (!empty($image)) { ?>
                  <img src="dist/img/users/<?php echo $image; ?>" class="img-circle elevation-2" alt="User Image" >
                <?php }
                else { ?>
                  <img src="dist/img/image.jpg" class="img-circle elevation-2" alt="User Image">
                <?php }
              }
            ?>
          <!-- <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image"> -->
        </div>
        <div class="info">
          <a href="#" class="d-block">
            <?php  
              $user_id = $_SESSION['user_id'];
              $query = "SELECT * FROM users WHERE user_id = '$user_id'";
              $userData = mysqli_query($db, $query);

              while ($row = mysqli_fetch_assoc($userData)) {
                echo $row['fullname'];
              }
            ?>
          </a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="dashboard.php" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>            
          </li>          

          <!-- Manage Category Nav Menu Start -->
          <li class="nav-header">Library Management</li>

          <li class="nav-item">
            <a href="" class="nav-link">
              <i class="fa-solid fa-cart-shopping"></i>
              <p class="pl-1">
                 Manage Category
                <i class="fas fa-angle-left right"></i>
                <!-- <span class="badge badge-info right">6</span> -->
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="category.php?do=Manage" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage All Category</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="category.php?do=Add" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add New Category</p>
                </a>
              </li>
            </ul>
          </li>
          <!-- Manage Category  Nav Menu End -->

           <!-- Book's Management Nav Menu Start -->
          <li class="nav-header">Book's Management</li>

          <li class="nav-item">
            <a href="" class="nav-link">
              <i class="fa-solid fa-book"></i>
              <p class="pl-1">
                 Manage Book's
                <i class="fas fa-angle-left right"></i>
                <!-- <span class="badge badge-info right">6</span> -->
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="books.php?do=Manage" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage All Book</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="books.php?do=Add" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add New Book</p>
                </a>
              </li>
            </ul>
          </li>
          <!-- Book's Management  Nav Menu End -->

          <!-- Order Management Nav Menu Start -->
          <li class="nav-header">Booking Management</li>

          <li class="nav-item">
            <a href="" class="nav-link">
              <i class="fa-solid fa-list-check"></i>
              <p class="pl-1">
                 Manage Order
                <i class="fas fa-angle-left right"></i>
                <!-- <span class="badge badge-info right">6</span> -->
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="orderDetails.php?do=Manage" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage All Order</p>
                </a>
              </li>
            </ul>
          </li>
          <!-- Order Management  Nav Menu End -->

          <!-- Users Nav Menu Start -->
          <li class="nav-header">Role Management</li>

          <li class="nav-item">
            <a href="" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Role
                <i class="fas fa-angle-left right"></i>
                <!-- <span class="badge badge-info right">6</span> -->
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="admin.php?it=Manage" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Super Admin</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="users.php?do=Manage" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage All Users</p>
                </a>
              </li>
              <li class="nav-item pb-5">
                <a href="users.php?do=Add" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add New User</p>
                </a>
              </li>
            </ul>
          </li>
          <!-- Users Nav Menu End -->
          
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>