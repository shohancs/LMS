<?php include "inc/header.php"; ?>  

	<!-- content-wrapper Start -->
	<div class="content-wrapper">
		<div class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1 class="m-0">Book's Management</h1>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
							<li class="breadcrumb-item active">Book's Management</li>
						</ol>
					</div>
				</div>
			</div>
		</div>

		<!-- Main content -->
		<section class="content">
			<div class="container-fluid">
				<div class="row">
					<div class="col-12 col-sm-12 col-md-12">
						<?php  

							// Ternary Condition
							$do = isset($_GET['do']) ? $_GET['do'] : "Manage";
							
							
							// Manage Page Start
							// All Users Manage Page
							if ( $do == "Manage" ) { ?>

								<!-- Card Stat -->
								<div class="card">
					              <div class="card-header">
					                <h3 class="card-title">Manage all Book</h3>
					                <div class="card-tools">
					                  	<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
					                </div>
					              </div>
					              <div class="card-body">
					                
					              	<!-- Table Start -->
					              	<table id="dataSearch" class="table table-dark table-striped table-hover table-bordered">
									  <thead>
									    <tr>
									      <th scope="col">#Sl.</th>
									      <th scope="col">Thumbnail</th>
									      <th scope="col">Title</th>
									      <th scope="col">Sub Title</th>
									      <th scope="col">Author Name</th>
									      <th scope="col">Category Name</th>
									      <th scope="col">Quantity</th>								      
									      <th scope="col">Status</th>								      
									      <th scope="col">Action</th>
									    </tr>
									  </thead>

									  <tbody>
									  	<?php  
									  		$sql = "SELECT * FROM book ORDER BY title ASC";
									  		$allData = mysqli_query($db, $sql);

									  		$numOfBooks = mysqli_num_rows($allData);

									  		if ($numOfBooks == 0) { ?>
									  			<div class="alert alert-info" role="alert">
													<i class="fa-solid fa-bell"> </i> Ooops!! No Book found in our library. Please add a book first.
													</div>
									  		<?php }
									  		else {
									  			$i = 0;

									  		while( $row = mysqli_fetch_assoc($allData) ) {
									  			$id   						= $row['id'];
									  			$title  					= $row['title'];
									  			$sub_title  			= $row['sub_title'];
									  			$description  		= $row['description'];
									  			$cat_id  					= $row['cat_id'];
									  			$author_name  		= $row['author_name'];
									  			$quantity  				= $row['quantity'];
									  			$image  					= $row['image'];
									  			$status  					= $row['status'];
									  			$i++;
									  			?>
									  			<tr>
											      <th scope="row"><?php echo $i; ?></th>
											      	<td>
												      	<?php
												      		if (!empty($image)) { ?>
												      			<img src="dist/img/books/<?php echo $image; ?>" alt="" width="55">
												      		<?php }
												      		else { ?>
												      			<img src="dist/img/books/blank_book.jpg" alt="" width="55">
												      		<?php }
												      	?>											      		
											      	</td>
											      <td><?php echo $title; ?></td>
											      <td><?php echo $sub_title; ?></td>
											      <td><?php echo $author_name; ?></td>
											      <td>
											      	<?php
											      	 		$sql = "SELECT * FROM category WHERE cat_id = '$cat_id'";
											      	 		$categoryName = mysqli_query($db, $sql);

											      	 		while ($row = mysqli_fetch_assoc($categoryName)) {
											      	 			$cat_id 	= $row['cat_id'];
											      	 			$cat_name = $row['cat_name'];
											      	 			?>
											      	 			<span class="badge badge-warning"><?php echo $cat_name; ?></span>
											      	 		<?php }
											      	 ?>											      		
											      	</td>
											      <td><span class="badge badge-info"><?php echo $quantity; ?> Pcs</span></td>											      	 											      
											      <td>
											      	<?php
											      		if( $status == 1 ) { ?>
											      			<span class="badge badge-success">Active</span>
											      		<?php }
											      		else if ( $status == 2 ) { ?>
											      			<span class="badge badge-danger">InActive</span>
											      		<?php }
											      	?>	
											      </td>
											      <td>
	<div class="action-btn">
	    <ul>
	      <li>
	        <a href="books.php?do=Edit&ubook=<?php echo $id; ?>"><i class="fa-regular fa-pen-to-square"></i></a>
	      </li>
	      <li>
	        <a href="" data-toggle="modal" data-target="#delbook<?php echo $id; ?>"><i class="fa-solid fa-trash-can"></i></a>
	      </li>
	    </ul>
	</div>
	</td>

	<!-- Modal Start -->
	<!-- Modal -->
<div class="modal fade" id="delbook<?php echo $id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Confirm to delete this <?php echo $title; ?> Book </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="modal-btn">
	        	<ul>
	        		<li>
	        			<a href="books.php?do=Delete&delbook_id=<?php echo $id; ?>" class="btn btn-danger">Confirm <i class="fa-regular fa-trash-can"></i></a>
	        		</li>
	        		<li>
	        			<a href="" class="btn btn-success" data-dismiss="modal">Cancel <i class="fa-regular fa-circle-xmark"></i></a>
	        		</li>	        		
	        	</ul>
	        </div>
      </div>
    </div>
  </div>
</div>
	<!-- Modal End -->
											    </tr>
									  		<?php }
									  		}

									  		
									  	?>
									    
									    
									  </tbody>
									</table>
					              	<!-- Table End -->

					              </div>
					            </div>
								<!-- Card End -->

							<?php }
							// Manage Page End



							// Create Page Start
							// This is the Create new users Html Page
							else if ( $do == "Add" ) { ?>
								<!-- Card Stat -->
								<div class="card">
		              <div class="card-header">
		                <h3 class="card-title">Register a new Book</h3>
		                <div class="card-tools">
		                  	<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
		                </div>
		              </div>
		              <div class="card-body">
										<form action="books.php?do=Store" method="POST" enctype="multipart/form-data">
											<div class="row">
												<div class="col-lg-6">
													<div class="form-group">
								        		<label>Title</label>					                	
								        		<input type="text" name="title" class="form-control" placeholder="Title of the book..." required autocomplete="off">
								        	</div>

								        	<div class="form-group">
								        		<label>Subtitle</label>					                	
								        		<input type="text" name="subtitle" class="form-control" placeholder="Subtitles..." required autocomplete="off">
								        	</div>

								        	<div class="form-group">
								        		<label>Author Name</label>					                	
								        		<input type="text" name="author" class="form-control" placeholder="Name of the author..." required autocomplete="off">
								        	</div>

								        	<div class="form-group">
								        		<label>Qunatity</label>					                	
								        		<input type="text" name="quantity" class="form-control" placeholder="Qunatity..." required autocomplete="off">
								        	</div>

								        	<div class="form-group">
								        		<label>Category Name </label>					                	
								        		<select name="cat_id" class="form-control">
								        			<option value="">Please select the Category or SubCategory name</option>
															<?php  

																// Parent category part start
																$sql = "SELECT * FROM category WHERE is_parent = 0 ORDER BY cat_name ASC";
																$parentCat = mysqli_query($db, $sql);

																while ( $row = mysqli_fetch_assoc($parentCat) ) {
																	$p_cat_id 			= $row['cat_id'];
																	$p_cat_name 		= $row['cat_name'];
																	?>
																	<option value="<?php echo $p_cat_id; ?>"><?php echo $p_cat_name; ?></option>
																	<!-- Parent category part End -->

																	<?php  
																			// Child category part start
																			$query = "SELECT * FROM category WHERE is_parent = '$p_cat_id' ORDER BY cat_name ASC";
																			$childCat = mysqli_query($db, $query);

																			while ($row = mysqli_fetch_assoc($childCat)) {
																				$c_cat_id 			= $row['cat_id'];
																				$c_cat_name 		= $row['cat_name'];
																				?>
																				<option value="<?php echo $c_cat_id; ?>">- - <?php echo $c_cat_name; ?></option>
																			<?php }
																			// Child category part end																	
																 }

															?>
								        		</select>
								        	</div>    

								        	<div class="form-group">
								        		<label>Status</label>
								        		<select name="status" class="form-control">
								        			<option value="1">Please Select User Role</option>
								        			<option value="1">Active</option>
								        			<option value="2">InActive</option>
								        		</select>
								        	</div>    	
												</div>

												<div class="col-lg-6">
													<div class="form-group">
								        		<label>Description</label>		
								        		<textarea id="description" name="description" class="form-control"></textarea>	
								        	</div>								        	

								        	<div class="form-group">
								        		<label>Thumbnail Picture</label>
								        		<input type="file" name="image" class="form-control-file">
								        	</div>

								        	<div class="form-group">
								        		<input type="submit" name="addBook" class="btn btn-success btn-block" value="Register the Book">
								        	</div>
												</div>
											</div>
										</form>
		              </div>
		            </div>
								<!-- Card End -->
							<?php }
							// Create Page End


							
							// Store page start
							// This store page will store the new users data into the Database
							else if ( $do == "Store" ) {
								if (isset($_POST['addBook'])) {
									$title  					= mysqli_real_escape_string($db, $_POST['title']);
									$subtitle  				= mysqli_real_escape_string($db, $_POST['subtitle']);
									$author  					= $_POST['author'];
									$quantity  				= $_POST['quantity'];
									$cat_id  					= $_POST['cat_id'];
									$description  		= mysqli_real_escape_string($db, $_POST['description']);
									$status  					= $_POST['status'];
									
									$image 						= $_FILES['image']['name'];
									$image_temp     	= $_FILES['image']['tmp_name'];

									if ( !empty($image) ) {
											$image_name		= rand(1, 999999999) ."_". $image;
											move_uploaded_file($image_temp, "dist/img/books/$image_name");

											$sql = "INSERT INTO book ( title,	sub_title, description, cat_id, author_name, quantity, image, status ) VALUES ('$title', '$subtitle', '$description', '$cat_id', '$author', '$quantity', '$image_name', '$status')";
											$registerBook = mysqli_query($db, $sql);

											if ( $registerBook ) {
												header("Location: books.php?do=Manage");
											}
											else {
												die("mysqli Error" . mysqli_error($db));
											}
									}
									else{
										$sql = "INSERT INTO book ( title,	sub_title, description, cat_id, author_name, quantity, status ) VALUES ('$title', '$subtitle', '$description', '$cat_id', '$author', '$quantity', '$status')";
											$registerBook = mysqli_query($db, $sql);

											if ( $registerBook ) {
												header("Location: books.php?do=Manage");
											}
											else {
												die("mysqli Error" . mysqli_error($db));
											}
									}
											


								}
							}
							// Store page End



							// Edit page start
							// This edit page will show the update users info in a html file
							else if ( $do == "Edit" ) { 
								if (isset($_GET['ubook'])) {
									$updateId = $_GET['ubook'];

									$sql = "SELECT * FROM book WHERE id = '$updateId' ORDER BY title ASC ";
									$bookData = mysqli_query($db, $sql);

									while ($row = mysqli_fetch_assoc($bookData)) {
										$id   						= $row['id'];
						  			$title  					= $row['title'];
						  			$sub_title  			= $row['sub_title'];
						  			$description  		= $row['description'];
						  			$cat_id  					= $row['cat_id'];
						  			$author_name  		= $row['author_name'];
						  			$quantity  				= $row['quantity'];
						  			$image  					= $row['image'];
						  			$status  					= $row['status'];
						  			?>
						  			<!-- Card Stat -->
								<div class="card">
		              <div class="card-header">
		                <h3 class="card-title">Update <?php echo $title; ?> Book Information</h3>
		                <div class="card-tools">
		                  	<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
		                </div>
		              </div>
		              <div class="card-body">
										<form action="books.php?do=Update" method="POST" enctype="multipart/form-data">
											<div class="row">
												<div class="col-lg-6">
													<div class="form-group">
								        		<label>Title</label>					                	
								        		<input type="text" name="title" class="form-control" placeholder="Title of the book..." required autocomplete="off" value="<?php echo $title; ?>">
								        	</div>

								        	<div class="form-group">
								        		<label>Subtitle</label>					                	
								        		<input type="text" name="subtitle" class="form-control" placeholder="Subtitles..." required autocomplete="off" value="<?php echo $sub_title; ?>">
								        	</div>

								        	<div class="form-group">
								        		<label>Author Name</label>					                	
								        		<input type="text" name="author" class="form-control" placeholder="Name of the author..." required autocomplete="off" value="<?php echo $author_name; ?>"> 
								        	</div>

								        	<div class="form-group">
								        		<label>Qunatity</label>					                	
								        		<input type="text" name="quantity" class="form-control" placeholder="Qunatity..." required autocomplete="off" value="<?php echo $quantity; ?>">
								        	</div>

								        	<!-- Category name problem -->
								        	<div class="form-group">
								        		<label>Category Name </label>					                	
								        		<select name="cat_id" class="form-control">
								        			<option value="">Please select the Category or SubCategory name</option>
															<?php  

																// Parent category part start
																$sql = "SELECT * FROM category WHERE is_parent = 0 ORDER BY cat_name ASC";
																$parentCat = mysqli_query($db, $sql);

																while ( $row = mysqli_fetch_assoc($parentCat) ) {
																	$p_cat_id 			= $row['cat_id'];
																	$p_cat_name 		= $row['cat_name'];
																	?>
																	<option value="<?php echo $p_cat_id; ?>"
																		<?php if( $p_cat_id == $cat_id ){ echo 'selected'; } ?>
																		><?php echo $p_cat_name; ?></option>
																	<!-- Parent category part End -->

																	<?php  
																			// Child category part start
																			$query = "SELECT * FROM category WHERE is_parent = '$p_cat_id' ORDER BY cat_name ASC";
																			$childCat = mysqli_query($db, $query);

																			while ($row = mysqli_fetch_assoc($childCat)) {
																				$c_cat_id 			= $row['cat_id'];
																				$c_cat_name 		= $row['cat_name'];
																				?>
																				<option value="<?php echo $c_cat_id; ?>"
																					<?php if( $c_cat_id == $cat_id ){ echo 'selected'; } ?>
																					>- - <?php echo $c_cat_name; ?></option>
																			<?php }
																			// Child category part end																	
																 }

															?>
															
								        		</select>
								        	</div>        

								        	<div class="form-group">
								        		<label>Status</label>
								        		<select name="status" class="form-control">
								        			<option value="1">Please Select User Role</option>
								        			<option value="1" <?php if ( $status == 1 ){ echo 'selected'; } ?>>Active</option>
								        			<option value="2" <?php if ( $status == 2 ){ echo 'selected'; } ?>>InActive</option>
								        		</select>
								        	</div>    	
												</div>

												<div class="col-lg-6">
													<div class="form-group">
								        		<label>Description</label>		
								        		<textarea id="description" name="description" class="form-control"><?php echo $description; ?></textarea>	
								        	</div>								        	

								        	<div class="form-group">
								        		<label>Thumbnail Picture</label>
								        		<br>
								        		<?php
										      		if (!empty($image)) { ?>
										      			<img src="dist/img/books/<?php echo $image; ?>" alt="" width="60">
										      		<?php }
										      		else { ?>
										      			<p>No Picture Uploaded!</p>
										      		<?php }
										      	?>	
								        		<input type="file" name="image" class="form-control-file pt-2">
								        	</div>

								        	<div class="form-group">
								        		<input type="hidden" name="id" value="<?php echo $id; ?>">
								        		<input type="submit" name="updateBook" class="btn btn-success btn-block" value="Update Book info">
								        	</div>
												</div>
											</div>
										</form>
		              </div>
		            </div>
								<!-- Card End -->
									<?php }
								}
							}
							// Edit page end



							// Update page start
							// This Update page will Update the users existing data info in a html file
							else if ( $do == "Update" ) {
								if (isset($_POST['id'])) {
									$id  							= $_POST['id'];
									$title  					= mysqli_real_escape_string($db, $_POST['title']);
									$subtitle  				= mysqli_real_escape_string($db, $_POST['subtitle']);
									$author  					= $_POST['author'];
									$quantity  				= $_POST['quantity'];
									$cat_id  					= $_POST['cat_id'];
									$description  		= mysqli_real_escape_string($db, $_POST['description']);
									$status  					= $_POST['status'];
									
									$image 						= $_FILES['image']['name'];
									$image_temp     	= $_FILES['image']['tmp_name'];

									// 
									// Both for Password and Picture with all data change
									if( !empty($image) ){ //Manea ei 2 tay data acea

										// Delete if image already exists
										$query = "SELECT * FROM book WHERE id = '$id'";
										$oldImage = mysqli_query($db, $query);

										while ($row = mysqli_fetch_assoc($oldImage)) {
											$existingImage = $row['image'];
											unlink("dist/img/books/$image_name" . $existingImage);
										}

										// Upload New Image
										$image_name		= rand(1, 999999999) ."_". $image;
										move_uploaded_file($image_temp, "dist/img/books/$image_name");

										$sql = "UPDATE book SET title='$title', sub_title='$subtitle', description='$description', cat_id='$cat_id', author_name='$author', quantity='$quantity', image='$image_name', status='$status' WHERE id = '$id' ";
											$updateBook = mysqli_query($db, $sql);

											if ( $updateBook ) {
												header("Location: books.php?do=Manage");
											}
											else {
												die("mysqli Error" . mysqli_error($db));
											}
									}

									// Only Chnge the Data
									else if ( empty($image) ) {

										$sql = "UPDATE book SET title='$title', sub_title='$subtitle', description='$description', cat_id='$cat_id', author_name='$author', quantity='$quantity', status='$status' WHERE id = '$id' ";
											$updateBook = mysqli_query($db, $sql);

											if ( $updateBook ) {
												header("Location: books.php?do=Manage");
											}
											else {
												die("mysqli Error" . mysqli_error($db));
											}
									}
									// 
								}
							}
							// Update page end



							// Delete page start
							// We will delete the users from Database
							else if ( $do == "Delete" ) {
								if (isset($_GET['delbook_id'])) {
									$deleteBookId = $_GET['delbook_id'];
									$sql = "DELETE FROM book WHERE id = '$deleteBookId'";
									$deleteBook = mysqli_query( $db, $sql );

									if ( $deleteBook ) {
										header( "Location: books.php?do=Manage" );
									}
									else {
										die("MySql Error!" . mysqli_error($db));
									}
								}
							}
							// Delete page end

						?>
					</div>
				</div>
			</div>
		</section>
	</div>
	<!-- content-wrapper End -->

<?php include "inc/footer.php"; ?>