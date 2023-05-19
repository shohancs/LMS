<?php include "inc/header.php"; ?>

      <!-- ::::: Book Details Section Start ::::: -->
      <section class="py-5">
        <div class="container">
          <div class="row">
            <div class="col-lg-9">
              <?php  
              
                  if (isset($_GET['id'])) {
                    $theBookId = $_GET['id'];
                    $sql = "SELECT * FROM book WHERE id = '$theBookId'";
                    $bookData = mysqli_query($db, $sql);

                    while ($row = mysqli_fetch_assoc($bookData)) {
                      $id               = $row['id'];
                      $title            = $row['title'];
                      $quantity         = $row['quantity'];
                    }

                    if ($quantity <= 0) { ?>
                      <div class="alert alert-info text-center" role="alert">
                        <i class="fa-solid fa-bell"> </i> Sorry!! This book is not available now for Booking purpose. Please check back later. Thank You <i class="fa-regular fa-face-smile-beam"></i>
                      </div>
                    <?php }

                    else { ?>
                      <h2>Please fillup information for the Booking confirmation -  </h2>
                    <?php 
                      $user_id = $_SESSION['user_id'];
                      $query = "SELECT * FROM users WHERE user_id = '$user_id'";
                      $userData = mysqli_query($db, $query);

                      while ($row = mysqli_fetch_array($userData)) {
                        $fullname   = $row['fullname'];
                        $address    = $row['address'];
                        $phone      = $row['phone'];
                      } ?>

                      <div class="user-info py-5">
                        <table class="table table-striped table-hover table-bordered">
                          <thead class="table-info">
                            <tr>
                              <th scope="col">Full Name</th>
                              <th scope="col">Email address</th>
                              <th scope="col">Address</th>
                              <th scope="col">Phone No.</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td><?php echo $fullname; ?></td>
                              <td><?php echo $_SESSION['email']; ?></td>
                              <td><?php echo $address; ?></td>
                              <td><?php echo $phone; ?></td>
                            </tr>
                          </tbody>
                        </table>
                      </div>

                        <form action="" method="POST">
                          <div class="row">                            
                            <div class="col-lg-6 offset-lg-3">
                              <div class="mb-3">
                                <label class="form-label">Receive Date <small>(mm/dd/yyyy)</small></label>
                                <input type="text" name="rcv_date" id="datepicker1" class="form-control" placeholder="Please Input the Date for Receive the Book" autocomplete="off" required>   
                              </div>

                              <div class="mb-3">
                                <label class="form-label">Return Date <small>(mm/dd/yyyy)</small></label>
                                <input type="text" name="rtn_date" id="datepicker2" class="form-control" placeholder="Please Input the Date for Return the Book" autocomplete="off" required>                        
                              </div> 

                              <div class="mb-3">
                                <div class="d-grid gap-2">
                                  <input type="hidden" name="book_id" value="<?php echo $theBookId; ?>">
                                  <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                                  <input type="submit" name="placeOrder" class="btn btn-success btn-block " value="PROCEED THE BOOKING">                          
                                </div>
                              </div>
                            </div>

                          </div>                
                        </form>

                    <?php

                      // Send data for the booking(work like as create)
                      if (isset($_POST['placeOrder'])) {
                        $book_id    = $_POST['book_id'];
                        $user_id    = $_POST['user_id'];
                        $rcv_date   = date('Y-m-d', strtotime($_POST['rcv_date']));
                        $rtn_date   = date('Y-m-d', strtotime($_POST['rtn_date']));

                        if (!empty($rcv_date) && !empty($rtn_date)) {
                          $sql = "INSERT INTO booking_list ( book_id, user_id, rcv_date, rtn_date, booking_date ) VALUES ( '$book_id', '$user_id', '$rcv_date', '$rtn_date', now() )";
                          $bookingConfirmation = mysqli_query($db, $sql);

                          if ($bookingConfirmation) {
                            $_SESSION['msg'] = 'Your Booking is Pending for Admin Approval. Please Contact with the Library Admin physically to Receive the Book.';
                            header("Location: orderHistory.php");
                          }
                          else {
                            die("MySql Error." .mysqli_error($db));
                          }
                        }
                        else {

                        }
                      }

                    }

                  }

              ?>
              

              <!-- ei part ta ene rakhci arki, jokhon jei data dorkar porbe, tokhon ekhan theke nibo -->
               <?php  
                // $user_id = $_SESSION['user_id'];
                // $query = "SELECT * FROM users WHERE user_id = '$user_id'";
                // $userData = mysqli_query($db, $query);

                // while ($row = mysqli_fetch_array($userData)) {
                  // $fullname   = $row['fullname'];
                  // $address    = $row['address'];
                  // $phone      = $row['phone'];
                // } 
              ?> 

              
            </div>
            
            <!-- Sidebar Content Start -->
              <?php include "inc/sidebar.php"; ?>
              <!-- Sidebar Content End -->
          </div>
        </div>
      </section>

      <!-- ::::: Book Details Section End ::::: -->
      
<?php include "inc/footer.php"; ?>