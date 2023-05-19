<?php include "inc/header.php"; ?>

  <!-- ::::: order-history Section Start ::::: -->
  <section class="py-5">
    <div class="container">
      <div class="row">
        <div class="col-lg-9 py-5">
          <h2 class="text-center py-1 pb-3">Order History</h2>
          <?php  
            if (!empty($_SESSION['msg'])) { ?>
              <div class="alert alert-info" role="alert">
                <?php echo $_SESSION['msg']; ?>
              </div>
            <?php }
          ?>

          <!-- Table Start -->
          <table id="dataSearch" class="table table-striped table-hover table-bordered">
            <thead class="table-dark">
              <tr>
                <th scope="col">#Sl.</th>
                <th scope="col">Book Title</th>
                <th scope="col">Order Date</th>
                <th scope="col">Receive Date</th>
                <th scope="col">Return Date</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
              </tr>
            </thead>

            <tbody>
              <?php  
                if ($_SESSION['user_id']) {
                   $user_id = $_SESSION['user_id'];

                   $sql = "SELECT * FROM booking_list WHERE user_id = '$user_id' ORDER by id Asc";
                   $allBookList = mysqli_query($db, $sql);
                   $i = 0;

                   $numberCount = mysqli_num_rows($allBookList);
                   if ( $numberCount <= 0 ){ ?>
                      <div class="alert alert-info text-center" role="alert">
                          <i class="fa-solid fa-bell"> </i> Ooops!! No Booking List Found Yet. Thank You <i class="fa-regular fa-face-smile-beam"></i>
                      </div>
                   <?php }
                   
                   else {
                    while( $row = mysqli_fetch_assoc($allBookList) ) {
                      $id             = $row['id'];
                      $book_id        = $row['book_id'];
                      $user_id        = $row['user_id'];
                      $rcv_date       = $row['rcv_date'];
                      $rtn_date       = $row['rtn_date'];
                      $booking_date   = $row['booking_date'];
                      $status         = $row['status'];
                      $i++;
                      ?>
                      <tr>
                        <th scope="row"><?php echo $i; ?></th>
                        <td>
                          <?php  
                            $sql = "SELECT * FROM book WHERE id = '$book_id'";
                            $theBook = mysqli_query($db, $sql);

                            while ($row = mysqli_fetch_assoc($theBook)) {
                              $title = $row['title'];
                              echo $title;
                            }
                          ?>
                        </td>
                        <td><?php echo $booking_date; ?></td>
                        <td><?php echo $rcv_date; ?></td>
                        <td><?php echo $rtn_date; ?></td>
                        <td>
                            <?php  
                              if ($status == 1) { ?>
                                <span class="badge text-bg-primary">Active Booking</span>
                              <?php }

                              else if ($status == 2) { ?>
                                <span class="badge text-bg-success">Book Returned</span>
                              <?php }

                              else if ($status == 3) { ?>
                                <span class="badge text-bg-danger">Booking Canceled</span>
                              <?php }

                              else if ($status == 4) { ?>
                                <span class="badge text-bg-info">Pending Booking</span>
                              <?php }
                            ?>
                        </td>
                        <td>   
                          <?php  
                            if ($status == 4) { ?>
                              <div class="action-btn">
                                <ul>
                                  <li>
                                    <a href="orderEdit.php?orderId=<?php echo $id;?>"><i class="fa-regular fa-pen-to-square"></i></a>
                                  </li>
                                </ul>
                              </div>
                          <?php }
                          else { ?>
                            Done

                          <?php }
                          ?>   
                                    
                        </td>     
                      </tr>    
                    <?php }
                   }

                }
              ?>
                      
            </tbody>
          </table>        
          <!-- Table End -->
        </div>

        <!-- Sidebar Content Start -->
        <?php include "inc/sidebar.php"; ?>
        <!-- Sidebar Content End -->
      </div>
    </div>
  </section>


  <?php  
    unset($_SESSION['msg']);
  ?>
  
  
  <!-- ::::: order-history Section End ::::: -->
      
<?php include "inc/footer.php"; ?>

