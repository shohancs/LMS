<?php include "inc/header.php"; ?>


      <!-- ::::: Carosel Slider Section Start ::::: -->
      <section>
        <div class="container">
          <div class="row">
            <div class="col-lg-12 py-5">
              <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">
                <div class="carousel-indicators" style="background: rgba(0, 0, 0, 0.3); width: 31%; border-radius: 10px; margin: 17px auto;">
                  <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                  <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                  <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                  <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Slide 4"></button>
                  <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="4" aria-label="Slide 5"></button>
                </div>
                <div class="carousel-inner" style="height: 600px;">
                  <div class="carousel-item active">
                    <ul style="background: rgba(0, 0, 0, 0.7);">
                      <li>
                        <img src="assets/images/1.jpg" class="d-block w-100" alt="..." style="opacity: 0.8;">
                      </li>
                    </ul>                    
                  </div>
                  <div class="carousel-item">
                    <img src="assets/images/2.jpg" class="d-block w-100" alt="...">
                  </div>
                  <div class="carousel-item">
                    <img src="assets/images/4.jpg" class="d-block w-100" alt="...">
                  </div><div class="carousel-item">
                    <img src="assets/images/5.jpg" class="d-block w-100" alt="...">
                  </div><div class="carousel-item">
                    <ul style="background: black;">
                      <li>
                        <img src="assets/images/6.jpg" class="d-block w-100" alt="..." style="opacity: 0.8;">
                      </li>
                    </ul>
                    <!-- <img src="assets/images/6.jpg" class="d-block w-100" alt="..."> -->
                  </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true" style="background-color: red; border-radius: 50%; padding: 18px;"></span>
                  <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true" style="background-color: red; border-radius: 50%; padding: 18px;"></span>
                  <span class="visually-hidden">Next</span>
                </button>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- ::::: Carosel Slider Section End ::::: -->

      <!-- ::::: All Books Section Start ::::: -->
      <section class="py-5">
        <div class="container">
          <div class="row">
            <!-- Book Content Start -->
            <div class="col-lg-9">
              <h2 class="text-center pb-5">Our All Book Collection</h2>
              <div class="row">      

                <?php  

                    $sql = "SELECT * FROM book WHERE status = 1 ORDER BY title ASC";
                    $allBooks = mysqli_query($db, $sql);

                    $totalBooks = mysqli_num_rows($allBooks);
                    
                    if ($totalBooks <= 0) { ?>
                      <div class="alert alert-info" role="alert"><i class="fa-solid fa-bell"> </i> Ooops!! No Book found Yet....</div>
                    <?php }
                    else {
                      while ($row = mysqli_fetch_assoc($allBooks)) {                        
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
                                    <img src="admin/dist/img/books/<?php echo $image; ?>" alt="" style="width: 100%; height: 300px;">
                                  <?php }
                                  else { ?>
                                    <img src="admin/dist/img/books/blank_book.jpg" alt="" style="width: 100%; height: 300px;">
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
                              <?php  
                                if (empty($_SESSION['email'])) { ?>
                                  <a href="login.php" class="book-btn">Log In to Reserve your Book</a>
                                <?php }
                                else { ?>
                                  <a href="booking.php?id=<?php echo $id; ?>" class="book-btn">Book Now</a>
                                <?php }
                              ?>        
                            </div>

                        </div> 
                        <!-- Card Part End -->

                      <?php }
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

      <!-- ::::: Sticker Section Start ::::: -->
      <section style="
    background-image: linear-gradient( rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.8) ),url(assets/images/60.png); 
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    margin-bottom: 60px;">
        <div class="container">
          <div class="row" style="">
            <div class="col-lg-12">
              <div class="row" style="align-items: center;">
                <div class="col-lg-6">
                  <img src="assets/images/sticker.png" alt="" style="width: 100%; ">
                </div>
                <div class="col-lg-6 text-center pt-5">
                  <div>
                    <h3 style="color: white; font-size: 60px; line-height: 20px;">Get it on time</h3>
                    <p style="color: red; font-family: 'Poppins', sans-serif; font-size: 20px;"> Book online & collect from library</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- ::::: Sticker Section End ::::: -->
      
<?php include "inc/footer.php"; ?>