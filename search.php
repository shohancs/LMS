<?php include "inc/header.php"; ?>

      <!-- ::::: All Books Section Start ::::: -->
      <section class="py-3">
        <div class="container">
          <div class="row">
            <!-- Book Content Start -->
            <div class="col-lg-9">              
              <div class="row">
                <?php  
                  if (isset($_POST['searchBtn'])) {
                    $sContent = $_POST['search']; ?>

                    <h2 class="py-5">Search Result - <?php echo $sContent ?></h2>
                    
                    <?php $sql = "SELECT * FROM book WHERE title LIKE '%$sContent%' OR sub_title LIKE '%$sContent%' OR description LIKE '%$sContent%' OR author_name LIKE '%$sContent%' OR quantity LIKE '%$sContent%' ORDER BY title ASC ";

                    $readData = mysqli_query($db, $sql);

                    $foundTotal = mysqli_num_rows($readData);

                    if ($foundTotal == 0) { ?>
                      <div class="alert alert-info" role="alert">
                        <i class="fa-solid fa-bell"> </i> Sorry!!! No Book Found in our Database regarding your search Topic - <strong><?php echo $sContent; ?></strong>
                      </div>
                    <?php }

                    else {
                      while ($row = mysqli_fetch_assoc($readData)) {
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
                        <!-- Card Part Start -->
                        <div class="col-lg-4 book-item pb-4">
                            <div class="book-thumbnail">
                              <?php
                                  if (!empty($image)) { ?>
                                    <img src="admin/dist/img/books/<?php echo $image; ?>" alt="" class="img-fluid">
                                  <?php }
                                  else { ?>
                                    <img src="admin/dist/img/books/blank_book.jpg" alt="" class="img-fluid">
                                  <?php }
                                ?>  

                                <div class="author-info">
                                  <h4><?php echo $author_name; ?></h4>
                                </div> 

                            </div>

                            <div class="book-info">
                              <h4><?php echo $title; ?></h4>
                              <p class="subtitle"><?php echo $sub_title; ?></p>
                              <p class="quantity">Quantity: <span><?php echo $quantity; ?> Pcs</span></p>
                              <p><?php echo substr($description, 0, 50); ?>... <a href="details.php?book=<?php echo $id; ?>">read more</a></p>
                              <a href="" class="book-btn">Book Now</a>
                            </div>

                        </div> 
                        <!-- Card Part End -->
                      <?php }
                    }
                  }
              ?>
              </div>
              
            </div>
            <!-- Book Content End -->

            <!-- Sidebar Content Start -->
            <?php include "inc/sidebar.php"; ?>
            <!-- Sidebar Content End -->
          </div>
        </div>
      </section>

      <!-- ::::: All Books Section End ::::: -->
      
<?php include "inc/footer.php"; ?>