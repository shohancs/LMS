<?php include "inc/header.php"; ?>  

	<!-- content-wrapper Start -->
	<div class="content-wrapper">
		<div class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1 class="m-0">User Management</h1>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
							<li class="breadcrumb-item active">User Management</li>
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
					                <h3 class="card-title">All Users Manage Page</h3>
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
									      <th scope="col">Picture</th>
									      <th scope="col">Full Name</th>
									      <th scope="col">Email</th>
									      <th scope="col">Phone No.</th>
									      <th scope="col">User Role</th>
									      <th scope="col">Status</th>								      
									      <th scope="col">Action</th>
									    </tr>
									  </thead>

									  <tbody>
									  	<?php  
									  		$sql = "SELECT * FROM users WHERE role = 2 ORDER BY fullname ASC";
									  		$allUserData = mysqli_query($db, $sql);
									  		$i = 0;

									  		while( $row = mysqli_fetch_assoc($allUserData) ) {
									  			$user_id  		= $row['user_id'];
									  			$fullname  		= $row['fullname'];
									  			$email  			= $row['email'];
									  			$password  		= $row['password'];
									  			$phone  			= $row['phone'];
									  			$address  		= $row['address'];
									  			$image  			= $row['image'];
									  			$role  				= $row['role'];
									  			$status  			= $row['status'];
									  			$join_date  	= $row['join_date'];
									  			$i++;
									  			?>
									  			<tr>
											      <th scope="row"><?php echo $i; ?></th>
											      	<td>
												      	<?php
												      		if (!empty($image)) { ?>
												      			<img src="dist/img/users/<?php echo $image; ?>" alt="" width="35">
												      		<?php }
												      		else { ?>
												      			<img src="dist/img/image.jpg" alt="" width="35">
												      		<?php }
												      	?>											      		
											      	</td>
											      <td><?php echo $fullname; ?></td>
											      <td><?php echo $email; ?></td>
											      <td><?php echo $phone; ?></td>
											      <td>
											      	<?php
											      		if( $role == 1 ) { ?>
											      			<span class="badge badge-primary">Admin</span>
											      		<?php }
											      		else if( $role == 2 ) { ?>
											      			<span class="badge badge-warning">User</span>
											      		<?php }
											      	?>	
											      	
											      </td>
											      <td>
											      	<?php
											      		if( $status == 1 ) { ?>
											      			<span class="badge badge-success">Active</span>
											      		<?php }
											      		else if ( $status == 0 ) { ?>
											      			<span class="badge badge-danger">InActive</span>
											      		<?php }
											      	?>	
											      </td>
											      <td>
	<div class="action-btn">
	    <ul>
	      <li>
	        <a href="users.php?do=Edit&uid=<?php echo $user_id; ?>"><i class="fa-regular fa-pen-to-square"></i></a>
	      </li>
	      <li>
	        <a href="" data-toggle="modal" data-target="#delUser<?php echo $user_id; ?>"><i class="fa-solid fa-trash-can"></i></a>
	      </li>
	    </ul>
	</div>
	</td>

	<!-- Modal Start -->
	<!-- Modal -->
<div class="modal fade" id="delUser<?php echo $user_id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Confirm to delete this 
        	<?php if( $role == 1 ) { ?> Admin <?php }
			else if( $role == 2 ) { ?> User <?php } ?>	?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="modal-btn">
	        	<ul>
	        		<li>
	        			<a href="users.php?do=Delete&deluser_id=<?php echo $user_id; ?>" class="btn btn-danger">Confirm <i class="fa-regular fa-trash-can"></i></a>
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
					                <h3 class="card-title">Add New User</h3>
					                <div class="card-tools">
					                  	<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
					                </div>
					              </div>
					              <div class="card-body">
									<form action="users.php?do=Store" method="POST" enctype="multipart/form-data">
										<div class="row">
											<div class="col-lg-6">
												<div class="form-group">
									        		<label>Full Name <sup style="font-size: 8px; color: #DD5353; top: -9px;"><small><i class="fa-solid fa-star"></i></small></sup></label>					                	
									        		<input type="text" name="fullname" class="form-control" placeholder="Your full name..." required autocomplete="off">
									        	</div>

									        	<div class="form-group">
									        		<label>Email <sup style="font-size: 8px; color: #DD5353; top: -9px;"><small><i class="fa-solid fa-star"></i></small></sup></label>					                	
									        		<input type="email" name="email" class="form-control" placeholder="Your email..." required autocomplete="off">
									        	</div>

									        	<div class="form-group">
									        		<label>Password <sup style="font-size: 8px; color: #DD5353; top: -9px;"><small><i class="fa-solid fa-star"></i></small></sup></label>					                	
									        		<input type="password" name="password" class="form-control" placeholder="Your Password..." required autocomplete="off">
									        	</div>

									        	<div class="form-group">
									        		<label>Re-Type Password <sup style="font-size: 8px; color: #DD5353; top: -9px;"><small><i class="fa-solid fa-star"></i></small></sup></label>					                	
									        		<input type="password" name="re_password" class="form-control" placeholder="Re-Type Password..." required autocomplete="off">
									        	</div>

									        	<div class="form-group">
									        		<label>Phone</label>					                	
									        		<input type="tel" name="phone" class="form-control" placeholder="Phone No...">
									        	</div>        	
											</div>
											<div class="col-lg-6">
												<div class="form-group">
									        		<label>Address</label>		
									        		<textarea name="address" class="form-control" placeholder="Your Address.." rows="4"></textarea>	
									        	</div>

									        	<div class="form-group">
									        		<label>Role <sup style="font-size: 8px; color: #DD5353; top: -9px;"><small><i class="fa-solid fa-star"></i></small></sup></label>
									        		<select name="role" class="form-control">
									        			<option value="2">Please Select User Role</option>
									        			<option value="1">Admin</option>
									        			<option value="2">User</option>
									        		</select>
									        	</div>

									        	<div class="form-group">
									        		<label>Status <sup style="font-size: 8px; color: #DD5353; top: -9px;"><small><i class="fa-solid fa-star"></i></small></sup></label>
									        		<select name="status" class="form-control">
									        			<option value="0">Please Select User Role</option>
									        			<option value="1">Active</option>
									        			<option value="0">InActive</option>
									        		</select>
									        	</div>

									        	<div class="form-group">
									        		<label>Profile Picture</label>
									        		<input type="file" name="image" class="form-control-file">
									        	</div>

									        	<div class="form-group">
									        		<input type="submit" name="addUser" class="btn btn-success btn-block" value="Add New User">
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
								if (isset($_POST['addUser'])) {
									$user_id  		= $_POST['user_id'];
									$fullname 		= $_POST['fullname'];
									$email 				= $_POST['email'];
									$password 		= $_POST['password'];
									$re_password 	= $_POST['re_password'];
									$phone 				= $_POST['phone'];
									$address 			= $_POST['address'];
									$role 				= $_POST['role'];
									$status 			= $_POST['status'];

									// Work image upload Start
									$image 			= $_FILES['image']['name'];
									$image_temp     = $_FILES['image']['tmp_name'];
									// $image_name		= rand(1, 999999999) ."_". $image;
									// move_uploaded_file($image_temp, "dist/img/users/$image_name");
									// Work image upload end

									// Password check work Start
									if ( $password == $re_password ) {
										$hassedPass = sha1($password);
										// Password check work end

										if ( !empty($image) ) {
											// $image 			= $_FILES['image']['name'];
											// $image_temp     = $_FILES['image']['tmp_name'];
											$image_name		= rand(1, 999999999) ."_". $image;
											move_uploaded_file($image_temp, "dist/img/users/$image_name");

											$sql = "INSERT INTO users (fullname, email, password, phone, address, image, role, status, 	join_date) VALUES ( '$fullname', '$email', '$hassedPass', '$phone', '$address', '$image_name', '$role', '$status', now() )";
											$addUser = mysqli_query($db, $sql);

											if ( $addUser ) {
												header("Location: users.php?do=Manage");
											}
											else {
												die("mysqli Error" . mysqli_error($db));
											}

										}
										else {
											$sql = "INSERT INTO users (fullname, email, password, phone, address, role, status, 	join_date) VALUES ( '$fullname', '$email', '$hassedPass', '$phone', '$address', '$role', '$status', now() )";
											$addUser = mysqli_query($db, $sql);

											if ( $addUser ) {
												header("Location: users.php?do=Manage");
											}
											else {
												die("mysqli Error" . mysqli_error($db));
											}
										}
										
										
									}
									else {
										echo "Password doesn't Match";
									}



									
								}
							}
							// Store page End



							// Edit page start
							// This edit page will show the update users info in a html file
else if ( $do == "Edit" ) { 
	if (isset($_GET['uid'])) {
		$updateId = $_GET['uid'];

		$sql = "SELECT * FROM users WHERE user_id = '$updateId' ORDER BY fullname ASC ";
		$usersData = mysqli_query($db, $sql);

		while ($row = mysqli_fetch_assoc($usersData)) {
				$user_id  		= $row['user_id'];
  			$fullname  		= $row['fullname'];
  			$email  		= $row['email'];
  			$password  		= $row['password'];
  			$phone  		= $row['phone'];
  			$address  		= $row['address'];
  			$image  		= $row['image'];
  			$role  			= $row['role'];
  			$status  		= $row['status'];
  			$join_date  	= $row['join_date'];
			?>
			<!-- Card Stat -->
			<div class="card">
			  <div class="card-header">
			    <h3 class="card-title">Update User Information</h3>
			    <div class="card-tools">
			      	<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
			    </div>
			  </div>
			  <div class="card-body">
				<form action="users.php?do=Update" method="POST" enctype="multipart/form-data">
					<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
				        		<label>Full Name</label>					                	
				        		<input type="text" name="fullname" class="form-control" placeholder="Your full name..." required autocomplete="off" value="<?php echo $fullname; ?>">
				        	</div>

				        	<div class="form-group">
				        		<label>Email</label>					                	
				        		<input type="email" name="email" class="form-control" placeholder="Your email..." required autocomplete="off" value="<?php echo $email; ?>">
				        	</div>

				        	<div class="form-group">
				        		<label>Password</label>
				        		<input type="password" name="password" class="form-control" placeholder="xxxxxx" autocomplete="off">
				        	</div>

				        	<div class="form-group">
				        		<label>Re-Type Password</label>		
				        		<input type="password" name="re_password" class="form-control" placeholder="xxxxxx" autocomplete="off">
				        	</div>

				        	<div class="form-group">
				        		<label>Phone</label>					                	
				        		<input type="tel" name="phone" class="form-control" placeholder="Phone No..." value="<?php echo $phone; ?>">
				        	</div>        	
						</div>
						<div class="col-lg-6">
							<div class="form-group">
				        		<label>Address</label>		
				        		<textarea name="address" class="form-control" placeholder="Your Address.." rows="4"><?php echo $address; ?></textarea>	
				        	</div>

				        	<div class="form-group">
				        		<label>Role</label>
				        		<select name="role" class="form-control">
				        			<option value="2">Please Select User Role</option>
				        			<option value="1" <?php if ( $role == 1 ){ echo 'selected'; }?>>Admin</option>
				        			<option value="2" <?php if ( $role == 2 ){ echo 'selected'; }?>>User</option>
				        		</select>
				        	</div>

				        	<div class="form-group">
				        		<label>Status</label>
				        		<select name="status" class="form-control">
				        			<option value="0">Please Select User Role</option>
				        			<option value="1" <?php if ( $status == 1 ){ echo 'selected'; }?>>Active</option>
				        			<option value="0" <?php if ( $status == 0 ){ echo 'selected'; }?>>InActive</option>
				        		</select>
				        	</div>

				        	<div class="form-group">
				        		<label>Profile Picture</label>
				        		<br>
				        		<?php
						      		if (!empty($image)) { ?>
						      			<img src="dist/img/users/<?php echo $image; ?>" alt="" width="60">
						      		<?php }
						      		else { ?>
						      			<p>No Picture Uploaded!</p>
						      		<?php }
						      	?>	
										
				        		<input type="file" name="image" class="form-control-file pt-2">
				        	</div>

				        	<div class="form-group">
				        		<input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
				        		<input type="submit" name="updateUser" class="btn btn-success btn-block" value="Save Changes">
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
								if (isset($_POST['updateUser'])) {
									$user_id  		= $_POST['user_id'];
									$fullname 		= $_POST['fullname'];
									$email 			= $_POST['email'];
									$password 		= $_POST['password'];
									$re_password 	= $_POST['re_password'];
									$phone 			= $_POST['phone'];
									$address 		= $_POST['address'];
									$role 			= $_POST['role'];
									$status 		= $_POST['status'];

									// Work image upload Start
									$image 			= $_FILES['image']['name'];
									$image_temp     = $_FILES['image']['tmp_name'];

									// Both for Password and Picture with all data change
									if( !empty($password) && !empty($image) ){ //Manea ei 2 tay data acea
										
										// New password check & encrypted
										if ($password == $re_password) {
											$hassedPass = sha1($password);
										}

										// Delete if image already exists
										$query = "SELECT * FROM users WHERE user_id = '$user_id'";
										$oldImage = mysqli_query($db, $query);

										while ($row = mysqli_fetch_assoc($oldImage)) {
											$existingImage = $row['image'];
											unlink("dist/img/users/$image_name" . $existingImage);
										}

										// Upload New Image
										$image_name		= rand(1, 999999999) ."_". $image;
										move_uploaded_file($image_temp, "dist/img/users/$image_name");

										$sql = "UPDATE users SET fullname='$fullname', email='$email', password='$hassedPass', phone='$phone', address='$address', image='$image_name', role='$role', status='$status' WHERE user_id = '$user_id' ";
											$updateUser = mysqli_query($db, $sql);

											if ( $updateUser ) {
												header("Location: users.php?do=Manage");
											}
											else {
												die("mysqli Error" . mysqli_error($db));
											}
									}

									// Only Password with all data change
									else if ( !empty($password) && empty($image) ) {
										// New password check & encrypted
										if ($password == $re_password) {
											$hassedPass = sha1($password);
										}

										$sql = "UPDATE users SET fullname='$fullname', email='$email', password='$hassedPass', phone='$phone', address='$address', role='$role', status='$status' WHERE user_id = '$user_id' ";
											$updateUser = mysqli_query($db, $sql);

											if ( $updateUser ) {
												header("Location: users.php?do=Manage");
											}
											else {
												die("mysqli Error" . mysqli_error($db));
											}
									}

									// Only Image with all data change
									else if ( empty($password) && !empty($image) ) {

										// Delete if image already exists
										$query = "SELECT * FROM users WHERE user_id = '$user_id'";
										$oldImage = mysqli_query($db, $query);

										while ($row = mysqli_fetch_assoc($oldImage)) {
											$existingImage = $row['image'];
											unlink("dist/img/users/$image_name" . $existingImage);
										}

										// Upload New Image
										$image_name		= rand(1, 999999999) ."_". $image;
										move_uploaded_file($image_temp, "dist/img/users/$image_name");

										$sql = "UPDATE users SET fullname='$fullname', email='$email', phone='$phone', address='$address', image='$image_name', role='$role', status='$status' WHERE user_id = '$user_id' ";
											$updateUser = mysqli_query($db, $sql);

											if ( $updateUser ) {
												header("Location: users.php?do=Manage");
											}
											else {
												die("mysqli Error" . mysqli_error($db));
											}
									}

									// Only Chnge the Data
									else if ( empty($password) && empty($image) ) {

										$sql = "UPDATE users SET fullname='$fullname', email='$email', phone='$phone', address='$address', role='$role', status='$status' WHERE user_id = '$user_id' ";
											$updateUser = mysqli_query($db, $sql);

											if ( $updateUser ) {
												header("Location: users.php?do=Manage");
											}
											else {
												die("mysqli Error" . mysqli_error($db));
											}
									}




								}
							}
							// Update page end



							// Delete page start
							// We will delete the users from Database
							else if ( $do == "Delete" ) {
								if (isset($_GET['deluser_id'])) {
									$deleteUserId = $_GET['deluser_id'];
									$sql = "DELETE FROM users WHERE user_id = '$deleteUserId'";
									$deleteUser = mysqli_query( $db, $sql );

									if ( $deleteUser ) {
										header( "Location: users.php?do=Manage" );
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