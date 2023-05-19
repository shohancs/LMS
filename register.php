<?php include "inc/header.php"; ?>

      <!-- ::::: User register Section Start ::::: -->
      <section>
      	<div class="container py-5">
      		<div class="row">
	      		<div class="col-lg-12" style="border-top: 4px solid #08c; padding: 29px 62px 39px; box-shadow: 1px 10px 15px #ccc; border-radius: 5px; ">
	      			<h2 class="text-center py-3">User Registration</h2>
	      			<form action="" method="POST">
	      				<div class="row">
	      					<div class="col-lg-6">
		      					<div class="mb-3">
						                  <label for="exampleInputfullname" class="form-label">Full Name</label>
						                  <input type="text" name="fullname" class="form-control" id="exampleInputfullname" aria-describedby="" required autocomplete="off" placeholder="Your full name...">
					                  </div>

					                  <div class="mb-3">
						                  <label for="exampleInputEmail1" class="form-label">Email address</label>
						                  <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="" required autocomplete="off" placeholder="Your email...">
					                  </div>

					                  <div class="mb-3">
					                  	<label for="exampleInputPassword1" class="form-label">Password</label>
					                  	<input type="password" name="password" class="form-control" id="exampleInputPassword1" required autocomplete="off" placeholder="Your Password...">
					                  </div>

				                		<div class="mb-3">
				                  		<label for="exampleInputPassword2" class="form-label">Re-Type Password</label>
				                  		<input type="password" name="re_password" class="form-control" id="exampleInputPassword2" required autocomplete="off" placeholder="Re-Type Password...">
				                		</div>

				                		<div class="mb-3">
				                  		<label for="phone" class="form-label">Phone No.</label>
				                  		<input type="tel" name="phone" class="form-control" id="phone" aria-describedby="" required autocomplete="off" placeholder="Phone No...">
				                		</div>
		      				</div>

		      				<div class="col-lg-6">
								<div class="mb-3">
								  	<label for="exampleFormControlTextarea1" class="form-label">Address</label>
								  	<textarea class="form-control" name="address" id="exampleFormControlTextarea1" rows="4" placeholder="Your Address.." required autocomplete="off"></textarea>
								</div>

								<div class="mb-3">
				                  		<label class="form-label">Profile Picture</label>
				                  		<input type="file" name="image" class="form-control">
				                		</div>

				                		<div class="mb-3">
				                  		<div class="d-grid gap-2">
				                  			<input type="submit" name="register" class="btn btn-success" value="Sign Up">
								  	</div>
				                		</div>

				                		<div class="mb-3">
					                		<ul>
					                  		<li><i class="fa-regular fa-circle-question"></i> Already a Member? <a href="login.php">Signin Here</a></li>
					                		</ul>
					            	</div>
				                						                
		      				</div>
	      				</div>	      				
	              		</form>

	              		<?php  
	              			if (isset($_POST['register'])) {
	              				$user_id  		= $_POST['user_id'];
							$fullname 		= $_POST['fullname'];
							$email 		= $_POST['email'];
							$password 		= $_POST['password'];
							$re_password 	= $_POST['re_password'];
							$phone 		= $_POST['phone'];
							$address 		= $_POST['address'];

							$image 		= $_FILES['image']['name'];
							$image_temp		= $_FILES['image']['tmp_name'];

							if ($password == $re_password) {
								$hassedPass = sha1($password);

								if ( !empty($image) ) {
									$image_name		= rand(1, 999999999) ."_". $image;
									move_uploaded_file($image_temp, "admin/dist/img/users/$image_name");

									$sql = "INSERT INTO users (fullname, email, password, phone, address, image, join_date) VALUES ( '$fullname', '$email', '$hassedPass', '$phone', '$address', '$image_name', now() )";
									$registerUser = mysqli_query($db, $sql);

									if ( $registerUser ) {
										header("Location: login.php");
									}
									else {
										die("mysqli Error" . mysqli_error($db));
									}

								}
								else {
									$sql = "INSERT INTO users (fullname, email, password, phone, address, join_date) VALUES ( '$fullname', '$email', '$hassedPass', '$phone', '$address', now() )";
									$registerUser = mysqli_query($db, $sql);

									if ( $registerUser ) {
										header("Location: login.php");
									}
									else {
										die("mysqli Error" . mysqli_error($db));
									}
								}
							}
	              			}
	           
	              		?>

	              
	      		</div>
	      	</div>
      	</div>
      	

      </section>

      <!-- ::::: User register Section End ::::: -->
      
<?php include "inc/footer.php"; ?>