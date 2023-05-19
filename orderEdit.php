<?php include "inc/header.php"; ?>

  <!-- ::::: order-Edit Section Start ::::: -->
  <section>
    <div class="container">
      <div class="row">
        <div class="col-lg-12 py-5">
          <h2 class="text-center py-3">Edit Booking Status</h2>
          <!-- Table Start -->
          <div>
            <table class="table table-striped table-hover table-bordered">
            <thead class="table-info">
              <tr>
                <th scope="col">Book Title</th>
                <th scope="col">Order Date</th>
                <th scope="col">Receive Date</th>
                <th scope="col">Return Date</th>
              </tr>
            </thead>
            <tbody>
              <?php  

              if ( isset($_GET['orderId']) ) {
                    $order_id = $_GET['orderId'];

                    $sql = "SELECT * FROM booking_list WHERE id = '$order_id'";
                    $orderData = mysqli_query($db, $sql);

                    while ($row = mysqli_fetch_assoc($orderData)) {
                       $id             = $row['id'];
                       $book_id        = $row['book_id'];
                       $user_id        = $row['user_id'];
                       $rcv_date       = $row['rcv_date'];
                       $rtn_date       = $row['rtn_date'];
                       $booking_date   = $row['booking_date'];
                       $status         = $row['status'];
                       ?>
                       <tr>
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
                      </tr>    

                     <?php }                  
                  }      
                ?>
              </tbody>
            </table>            
          </div>          
          <!-- Table End -->

          <!-- Edit Status Part Start -->
          <div class="row py-5">
            <div class="col-lg-6 offset-lg-3" style="border-top: 4px solid #08c; padding: 29px 62px 39px; box-shadow: 1px 10px 15px #ccc; border-radius: 5px; ">
              <h4 class="text-center">Do You Want to Cancel this Booking?</h4>
              <form action="" method="POST">
                <div class="mb-3">
                  <select class="form-select" name='status'>
                    <option selected>Tap Here..</option>
                    <option value="3">Cancel</option>
                  </select>                
                </div> 

                <div class="mb-3">
                  <div class="d-grid gap-2">
                    <input type="hidden" name="order_id" value="<?php echo $id; ?>">
                    <input type="hidden" name="book_id" value="<?php echo $book_id; ?>">
                    <input type="submit" name="updateOrder" class="btn btn-success btn-block" value="CONFIRM">                        
                  </div>
                </div>
              </form>
              <?php  
                if (isset($_POST['updateOrder'])) {
                    $order_id     = $_POST['order_id'];
                    $book_id    = $_POST['book_id'];
                    $rcv_date     = date('Y-m-d', strtotime($_POST['rcv_date']));
                    $rtn_date     = date('Y-m-d', strtotime($_POST['rtn_date']));
                    $status     = $_POST['status'];

                    //Cancel
                    if ($status == 3) {
                      $sql = "UPDATE booking_list SET status='$status' WHERE id='$order_id'";
                      $updateOrderDetails = mysqli_query($db, $sql);

                      // Update the Quantity of the Order Book
                      $query = "SELECT * FROM book WHERE id='$book_id'";
                      $bookData = mysqli_query($db, $query);
                      while( $row = mysqli_fetch_assoc($bookData) ) {
                          $quantity = $row['quantity'];
                          $quantity;
                      }
                      $query2 = "UPDATE book SET quantity='$quantity' Where id='$book_id'";
                      $updateBookData = mysqli_query($db, $query2);

                      if ($updateBookData) {
                        header("Location: orderHistory.php");
                      }
                      else {
                        die("mysqli Error" . mysqli_error($db));
                      }
                    }                   
                    //Cancel                    
                  }
              ?>
            </div>
          </div>
          
          
          <!-- Edit Status Part End -->


        </div>
      </div>
    </div>
  </section>  
  
  <!-- ::::: order-Edit Section End ::::: -->
      
<?php include "inc/footer.php"; ?>

