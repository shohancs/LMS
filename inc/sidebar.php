<!-- Sidebar Content Start --> 
<div class="col-lg-3 py-3">
    <div class="search-option py-5">
        <form action="search.php" method="POST">
            <div class="mb-3">
                <label for="search" class="form-label "></label>
                <input type="text" name="search" class="form-control" id="search" aria-describedby="searchHelp" required autocomplete="off" placeholder="Search Here...">
                <div id="searchHelp" class="form-text m-0">Search by Book name, Author name</div>
            </div>

            <div class="mb-3">
                <div class="d-grid gap-2">
                  <button type="submit" name="searchBtn" class="btn btn-success book-btn m-0" >Search</button>
                </div>
            </div>
        </form>
    </div>  

    <div class="author-part">
        <h3>Popular Book</h3>

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
                    
                    <div class="row">
                        <div class="col-lg-6">
                            <div>
                                <?php
                                  if (!empty($image)) { ?>
                                    <img src="admin/dist/img/books/<?php echo $image; ?>" alt="" width="100%" class="pb-3">
                                  <?php }
                                  else { ?>
                                    <img src="admin/dist/img/books/blank_book.jpg" alt="" class="img-fluid">
                                  <?php }
                                ?>                          
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="">
                              <h4><?php echo $title; ?></h4>
                              <p class="quantity"><?php echo $quantity; ?> Pcs</p>
                            </div> 
                        </div>
                    </div>
                    
                    
                <?php }
            }
        ?>
    </div> 
</div>
<!-- Sidebar Content End -->