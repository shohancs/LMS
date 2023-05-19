<?php include "inc/header.php"; ?>

      <!-- ::::: Book Details Section Start ::::: -->
      <section class="py-5">
        <div class="container">
          <div class="row">
            <!-- Book Details Start -->
            <div class="col-lg-4 py-5">
              <div class="row">     
              	<?php  
              		if (isset($_GET['book'])) {
              			$bookId = $_GET['book'];
              			$sql = "SELECT * FROM book WHERE id='$bookId'";
                    $details = mysqli_query($db, $sql);

                    	while ($row = mysqli_fetch_assoc($details)) {
                    		$id               = $row['id'];
                        $title            = $row['title'];
                        $sub_title        = $row['sub_title'];
                        $description      = $row['description'];
                        $cat_id           = $row['cat_id'];
                        $author_name      = $row['author_name'];
                        $quantity         = $row['quantity'];
                        $image            = $row['image'];
                        $status           = $row['status'];
                        ?>
                        <div class="book-thumbnail">
                              <?php
                                  if (!empty($image)) { ?>
                                    <img src="admin/dist/img/books/<?php echo $image; ?>" alt="" class="img-fluid">
                                  <?php }
                                  else { ?>
                                    <img src="admin/dist/img/books/blank_book.jpg" alt="" class="img-fluid">
                                  <?php }
                                ?>  

                            </div>
                    	<?php }
              		}
              	?>    
              </div>
            </div>

            <div class="col-lg-5 book_details py-5">
              <div class="row">
                <h4><?php echo $title; ?></h4>
                <p class="subtitle"><?php echo $sub_title; ?></p>
                <h5 class="author-name">Written By - <?php echo $author_name; ?></h5>
                <p class="quantity">Quantity: <span id="quantityValue"><?php echo $quantity; ?> Pcs</span></p>
                <p><?php echo $description; ?></p>

                <?php  
                  if (empty($_SESSION['email'])) { ?>
                    <a href="login.php" class="book-btn">Log In to Reserve your Book</a>
                  <?php }
                  else { ?>
                    <a href="booking.php?id=<?php echo $id; ?>" class="book-btn">Book Now</a>
                  <?php }
                ?>                
              </div>
              <!-- Book Details End -->  
            </div>
            <!-- Sidebar Content Start -->
              <?php include "inc/sidebar.php"; ?>
              <!-- Sidebar Content End -->
          </div>
        </div>
      </section>

      <!-- ::::: Book Details Section End ::::: -->
      
<?php include "inc/footer.php"; ?>