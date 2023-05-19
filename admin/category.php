<?php include "inc/header.php"; ?>  

	<!-- content-wrapper Start -->
	<div class="content-wrapper">
		<div class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1 class="m-0">All Category and Sub Category for the books</h1>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
							<li class="breadcrumb-item active">Manage All Category</li>
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

						<!-- Card Start -->
						<?php  

							// Ternary Condition
							$do = isset($_GET['do']) ? $_GET['do'] : "Manage";
							
							
							// Manage Page Start
							// All Users Manage Page
							if ( $do == "Manage" ) { ?>

								<!-- Card Stat -->
								<div class="card">
		              <div class="card-header">
		                <h3 class="card-title">All Category and Sub Category Manage</h3>
		                <div class="card-tools">
		                  	<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
		                </div>
		              </div>
		              <div class="card-body">
					                
					        <!-- Table Start -->
					        <table class="table table-dark table-striped table-hover table-bordered">
									  <thead>
									    <tr>
									      <th scope="col">#Sl.</th>
									      <th scope="col">Category Name</th>
									      <th scope="col">Description</th>
									      <th scope="col">Category / SubCategory</th>
									      <th scope="col">Status</th>								      
									      <th scope="col">Action</th>
									    </tr>
									  </thead>

									  <tbody>
									  	<?php  
									  		$sql = "SELECT * FROM category WHERE is_parent = 0 ORDER BY cat_name ASC";
									  		$allCat = mysqli_query($db, $sql);
									  		$i = 0;

									  		while ( $row = mysqli_fetch_assoc($allCat) ) {
									  			$cat_id 			= $row['cat_id'];
									  			$cat_name 		= $row['cat_name'];
									  			$cat_desc 		= $row['cat_desc'];
									  			$is_parent 		= $row['is_parent'];
									  			$status 			= $row['status'];
									  			$i++;
									  			?>

									  			<tr>
											      <th scope="row"><?php echo $i; ?></th>
											      <td><?php echo $cat_name; ?></td>
											      <td><?php echo $cat_desc; ?></td>
											      <td>
											      	<?php 
											      		if ( $is_parent == 0 ) { ?>
											      			<span class="badge badge-success">Primary Category</span>
											      		<?php }
											      		else { ?>
											      			<span class="badge badge-info">Sub Category</span>
											      		<?php }
											      	?>											      		
											      </td>
											      <td>
											      	<?php 
											      		if ( $status == 1 ) { ?>
											      			<span class="badge badge-primary">Active</span>
											      		<?php }
											      		else { ?>
											      			<span class="badge badge-danger">InActive</span>
											      		<?php }
											      	?>				
											      </td>
<td>
	<div class="action-btn">
    <ul>
      <li>
        <a href="category.php?do=Edit&cat_id=<?php echo $cat_id;?>"><i class="fa-regular fa-pen-to-square"></i></a>
      </li>
      <li>
        <a href="" data-toggle="modal" data-target="#delParCat<?php echo $cat_id; ?>"><i class="fa-solid fa-trash-can"></i></a>
      </li>
    </ul>
  </div>
  <!-- Delete Parent Category Modal Start -->
	<div class="modal fade" id="delParCat<?php echo $cat_id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Confirm to delete this Primary Category?</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <div class="modal-btn">
	        	<ul>
	        		<li>
	        			<a href="category.php?do=Delete&cat_id=<?php echo $cat_id; ?>" class="btn btn-danger">Confirm <i class="fa-regular fa-trash-can"></i></a>
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
  <!-- Delete Parent Category Modal End -->
</td>
											    </tr>

											    <!-- Sub Category Check Start -->
											    <?php  
											    	$sql = "SELECT * FROM category WHERE is_parent = '$cat_id' ORDER BY cat_name ASC";
									  				$allSubCat = mysqli_query($db, $sql);

									  				while ( $row = mysqli_fetch_assoc($allSubCat) ) {
									  					$cat_id 			= $row['cat_id'];
											  			$cat_name 		= $row['cat_name'];
											  			$cat_desc 		= $row['cat_desc'];
											  			$is_parent 		= $row['is_parent'];
											  			$status 			= $row['status'];
											  			$i++;
											  			?>
											  				<tr>
											      <th scope="row"></th>
											      <td>-- <?php echo $cat_name; ?></td>
											      <td><?php echo $cat_desc; ?></td>
											      <td>
											      	<?php 
											      		if ( $is_parent == 0 ) { ?>
											      			<span class="badge badge-success">Primary Category</span>
											      		<?php }
											      		else { ?>
											      			<span class="badge badge-info">Sub Category</span>
											      		<?php }
											      	?>											      		
											      </td>
											      <td>
											      	<?php 
											      		if ( $status == 1 ) { ?>
											      			<span class="badge badge-primary">Active</span>
											      		<?php }
											      		else { ?>
											      			<span class="badge badge-danger">InActive</span>
											      		<?php }
											      	?>				
											      </td>
<td>
	<div class="action-btn">
    <ul>
      <li>
        <a href="category.php?do=Edit&cat_id=<?php echo $cat_id;?>"><i class="fa-regular fa-pen-to-square"></i></a>
      </li>
      <li>
        <a href="" data-toggle="modal" data-target="#delChildCat<?php echo $cat_id; ?>"><i class="fa-solid fa-trash-can"></i></a>
      </li>
    </ul>
  </div>
  <!-- Delete Child Category Modal Start -->
	<div class="modal fade" id="delChildCat<?php echo $cat_id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Confirm to delete this Sub Category?</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <div class="modal-btn">
	        	<ul>
	        		<li>
	        			<a href="category.php?do=Delete&cat_id=<?php echo $cat_id; ?>" class="btn btn-danger">Confirm <i class="fa-regular fa-trash-can"></i></a>
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
  <!-- Delete Child Category Modal End -->
</td>
											    </tr>
									  				<?php }

											    ?>
											    <!-- Sub Category Check End -->

									  		<?php }
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
    <h3 class="card-title">Add New Category</h3>
    <div class="card-tools">
      	<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
    </div>
  </div>
  <div class="card-body">
    <form action="category.php?do=Store" method="POST" enctype="multipart/form-data">
    	<div class="form-group">
    		<label>Category Name <sup style="font-size: 8px; color: #DD5353; top: -9px;"><small><i class="fa-solid fa-star"></i></small></sup></label> 				                	
    		<input type="text" name="name" class="form-control" placeholder="Your full name..." required autocomplete="off">
    	</div>

    	<div class="form-group">
    		<label>Description (Optional)</label> 
    		<textarea id="description" name="desc" class="form-control" placeholder="Type Here..." rows="5"></textarea>		
    	</div>

    	<div class="form-group">
    		<label>Parent Category <sup style="font-size: 8px; color: #DD5353; top: -9px;"><small><i class="fa-solid fa-star"></i></small></sup></label>
    		<select class="form-control" name="is_parent">
    			<option value="0">Please select the Parent Category</option>
    			<?php  
  					$sql = "SELECT * FROM category WHERE is_parent = 0";
  					$parentCat = mysqli_query($db, $sql);

  					while ($row = mysqli_fetch_assoc($parentCat)) {
  						$cat_id 	= $row['cat_id'];
  						$cat_name = $row['cat_name'];
  						?>
  						<option value="<?php echo $cat_id; ?>"><?php echo $cat_name; ?></option>
  					<?php }
  				?> 
    		</select>
    	</div>

    	<div class="form-group">
    		<label>Category Status <sup style="font-size: 8px; color: #DD5353; top: -9px;"><small><i class="fa-solid fa-star"></i></small></sup></label> 				                	
    		<select class="form-control" name="status">
    			<option value="1">Please select the Status</option>
    			<option value="1">Active</option>
    			<option value="2">InActive</option>
    		</select>
    	</div>

    	<div class="form-group">
    		<input type="submit" name="addCat" class="btn btn-success" value="Add New Category">
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
								if ( isset($_POST['addCat']) ) {
									$name 			= $_POST['name'];
									$desc 			= $_POST['desc'];
									$is_parent 	= $_POST['is_parent'];
									$status 		= $_POST['status'];

									$sql = "INSERT INTO category (cat_name, cat_desc, is_parent, status) VALUES ('$name', '$desc', '$is_parent', '$status')";
									$addCategory = mysqli_query($db, $sql);

									if ( $addCategory ) {
										header( "Location: category.php?do=Manage" );
									}
									else {
										die("MySql Query Failed." . mysqli_error());
									}

								}
								
							}
							// Store page End



							// Edit page start
							// This edit page will show the update users info in a html file
							else if ( $do == "Edit" ) {
								if ( isset($_GET['cat_id']) ) {
									$updateId = $_GET['cat_id'];
									$sql = "SELECT * FROM category WHERE cat_id = '$updateId'";
									$editData = mysqli_query($db, $sql);

									while ($row = mysqli_fetch_assoc($editData)) {
										$cat_id 			= $row['cat_id'];
										$cat_name 		= $row['cat_name'];
										$cat_desc 		= $row['cat_desc'];
										$is_parent 		= $row['is_parent'];
										$status 			= $row['status'];
										?>

<!-- Card Stat -->
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Edit <?php echo $cat_name; ?> Category</h3>
    <div class="card-tools">
      	<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
    </div>
  </div>
  <div class="card-body">
    <form action="category.php?do=Update" method="POST" enctype="multipart/form-data">
    	<div class="form-group">
    		<label>Category Name <sup style="font-size: 8px; color: #DD5353; top: -9px;"><small><i class="fa-solid fa-star"></i></small></sup></label> 				                	
    		<input type="text" name="name" class="form-control" placeholder="Your full name..." required autocomplete="off" value="<?php echo $cat_name; ?>">
    	</div>

    	<div class="form-group">
    		<label>Description (Optional)</label> 
    		<textarea id="description" name="desc" class="form-control" placeholder="Type Here..." rows="5"><?php echo $cat_desc; ?></textarea>		
    	</div>

    	<!-- EDIT IS PARENT PART START -->
  		<div class="form-group">
  			<label>Parent Category</label>
  			<select class="form-control" name="is_parent">
  				<?php  
					  // Primary category Edit part start
						if ( $is_parent == 0 ) {
							$sql = "SELECT cat_id AS 'pCatID', cat_name AS 'pCatName' FROM category WHERE is_parent = 0 ORDER BY cat_name ASC "; 
							$parentCat = mysqli_query($db, $sql);

							while( $row = mysqli_fetch_assoc($parentCat) ) {
							extract($row);
							?>
							<option value="0" <?php if ($pCatID == $updateId){ echo 'selected';}?>><?php echo $pCatName; ?></option>

							<?php }
						}
						// Primary category Edit part End

						// Sub category Edit part Start
						else {
							$sql = "SELECT cat_id AS 'CatID', cat_name AS 'CatName' FROM category WHERE is_parent = 0 ORDER BY cat_name ASC "; 
							$parentCat = mysqli_query($db, $sql);

							while( $row = mysqli_fetch_assoc($parentCat) ) {
							extract($row);
							?>
							<option value="<?php echo $CatID; ?>" <?php if($CatID == $is_parent){ echo 'selected';}?>><?php echo $CatName; ?></option>

							<?php }
						}
						// Sub category Edit part End
					?>
  			</select>
  		</div>
			<!-- EDIT IS PARENT PART END -->

    	<div class="form-group">
    		<label>Category Status <sup style="font-size: 8px; color: #DD5353; top: -9px;"><small><i class="fa-solid fa-star"></i></small></sup></label> 				                	
    		<select class="form-control" name="status">
    			<option value="1">Please select the Status</option>
    			<option value="1" <?php if ( $status == 1 ) { echo 'selected'; } ?>>Active</option>
    			<option value="2" <?php if ( $status == 2 ) { echo 'selected'; } ?>>InActive</option>
    		</select>
    	</div>

    	<div class="form-group">
    		<input type="hidden" name="cat_id" value="<?php echo $cat_id; ?>">
    		<input type="submit" class="btn btn-success" name="updateCat" value="Save Changes">
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
								if ( isset($_POST['updateCat']) ) {
									$cat_id 			= $_POST['cat_id'];
									$name 				= $_POST['name'];
									$desc 				= $_POST['desc'];
									$is_parent 		= $_POST['is_parent'];
									$status 			= $_POST['status'];

									$sql = "UPDATE category SET cat_name = '$name', cat_desc = '$desc', is_parent = '$is_parent', status = '$status' WHERE cat_id = '$cat_id' ";
									$updateCategory = mysqli_query($db, $sql);

									if ( $updateCategory ) {
										header( "Location: category.php?do=Manage" );
									}
									else {
										die("MySql Query Failed." . mysqli_error());
									}

								}
							}
							// Update page end



							// Delete page start
							// We will delete the users from Database
							else if ( $do == "Delete" ) {
								if (isset($_GET['cat_id'])) {
									$deleteId = $_GET['cat_id'];

									// To check this Delete Category is Parent or Child

									$sql = "SELECT * FROM category WHERE cat_id = '$deleteId' ";
									$deleteData = mysqli_query($db, $sql);

									while( $row = mysqli_fetch_assoc($deleteData) ) {
										$cat_id 		= $row['cat_id'];
										$is_parent 	= $row['is_parent'];

										// Single Sub Category Item Delete
										if( $is_parent != 0 ) {
											$sql = "DELETE FROM category WHERE cat_id = '$deleteId' ";
											$deleteSubData = mysqli_query($db, $sql);

											if ( $deleteSubData ) {
												header( "Location: category.php?do=Manage" );
											}
											else {
												die("MySql Error!" . mysqli_error($db));
											}
										}

										// Delete Parent Category and all its Sub Category
										else if ($is_parent == 0) {
											$sql = "SELECT * FROM category WHERE is_parent = '$cat_id' ";
											$dataAllSubCat = mysqli_query($db, $sql);

											// Sub Cat Delete
											while( $row = mysqli_fetch_assoc($dataAllSubCat) ) {
												$subCatId = $row['cat_id'];
												$delSubCatSql = "DELETE FROM category WHERE cat_id = '$subCatId' ";
												$delSubCat = mysqli_query($db, $delSubCatSql);
											}			
											// Sub Cat Delete
											// Delete Parent Cat
											$sql = "DELETE FROM category WHERE cat_id = '$deleteId' ";
											$deleteParentCat = mysqli_query($db, $sql);
											// Delete Parent Cat
											if ( $deleteParentCat ) {
												header( "Location: category.php?do=Manage" );
											}
											else {
												die("MySql Error!" . mysqli_error($db));
											}

										}
									}

									
								}
							}
							// Delete page end

						?>
						<!-- Card End -->
						
					</div>
				</div>
			</div>
		</section>
	</div>
	<!-- content-wrapper End -->

<?php include "inc/footer.php"; ?>