<?php include "inc/header.php"; ?>  

	<!-- content-wrapper Start -->
	<div class="content-wrapper">
		<div class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1 class="m-0">All Order List</h1>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
							<li class="breadcrumb-item active">Manage all order list</li>
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

							if ($do == 'Manage') { ?>

							<!-- Card Stat -->
							<div class="card">
				              <div class="card-header">
				                <h3 class="card-title">Manage All Order List</h3>
				                <div class="card-tools">
				                  	<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
				                </div>
				              </div>
				              <div class="card-body">
			              	
									<table id="dataSearch" class="table table-dark table-striped table-hover table-bordered">
									  <thead>
									    <tr>
									      <th scope="col">#Sl.</th>
									      <th scope="col">Book Title</th>
									      <th scope="col">User Name</th>
									      <th scope="col">Order Date</th>
									      <th scope="col">Receive Date</th>
									      <th scope="col">Return Date</th>
									      <th scope="col">Status</th>
									      <th scope="col">Action</th>
									    </tr>
									  </thead>

									  <tbody>
									  	<?php  
									  		if ($_SESSION['user_id']) {
							                   $user_id = $_SESSION['user_id'];

							                   $sql = "SELECT * FROM booking_list ORDER by id DESC";
							                   $allBookList = mysqli_query($db, $sql);
							                   $i = 0;

							                   $numberCount = mysqli_num_rows($allBookList);
							                   if ( $numberCount <= 0 ){ ?>
							                      <div class="alert alert-info text-center" role="alert">
							                          <i class="fa-solid fa-bell"> </i> Ooops!! No Booking List Found Yet. Thank You <i class="fa-regular fa-face-smile-beam"></i>
							                      </div>
							                   <?php }
							                   else {
							                   		while( $row = mysqli_fetch_assoc($allBookList) ) {
								                      $id             = $row['id'];
								                      $book_id        = $row['book_id'];
								                      $user_id        = $row['user_id'];
								                      $rcv_date       = $row['rcv_date'];
								                      $rtn_date       = $row['rtn_date'];
								                      $booking_date   = $row['booking_date'];
								                      $status         = $row['status'];
								                      $i++;
								                      ?>
								                      	<tr>
													      <th scope="row"><?php echo $i; ?></th>
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
													      <td>
													      	<?php  
									                            $sql = "SELECT * FROM users WHERE user_id = '$user_id'";
									                            $theUser = mysqli_query($db, $sql);

									                            while ($row = mysqli_fetch_assoc($theUser)) {
									                              $fullname = $row['fullname'];
									                              echo $fullname;
									                            }
									                        ?>
													      </td>
													      <td><?php echo $booking_date; ?></td>
								                          <td>
								                          	<span class="badge badge-success"><?php echo $rcv_date; ?></span>
								                          </td>
								                          <td>
								                          	<span class="badge badge-warning"><?php echo $rtn_date; ?></span>
								                          </td>
								                          <td>
								                            <?php  
								                              if ($status == 1) { ?>
								                                <span class="badge badge-primary">Active Booking</span>
								                              <?php }

								                              else if ($status == 2) { ?>
								                                <span class="badge badge-success">Book Returned</span>
								                              <?php }

								                              else if ($status == 3) { ?>
								                                <span class="badge badge-danger">Booking Canceled</span>
								                              <?php }

								                              else if ($status == 4) { ?>
								                                <span class="badge badge-warning">Pending Booking</span>
								                              <?php }
								                            ?>
								                          </td>
								                          <td>
															<div class="action-btn">
															    <ul>
															      <li>
															        <a href="orderDetails.php?do=Edit&orderId=<?php echo $id; ?>"><i class="fa-regular fa-pen-to-square"></i></a>
															      </li>

															      <li>
															        <a href=""><i class="fa-solid fa-trash-can"></i></a>
															      </li>
															    </ul>
														  	</div>
														   </td>
													    </tr>
								                  	<?php }
							                   }
							               }
									  	?>
									    
									  </tbody>
									</table>
								<?php }

								else if ($do == 'Edit') {
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
					                       <!-- Card Stat -->
											<div class="card">
								              <div class="card-header">
								                <h3 class="card-title">Update 
								                	<?php  
							                            $sql = "SELECT * FROM users WHERE user_id = '$user_id'";
							                            $theUser = mysqli_query($db, $sql);

							                            while ($row = mysqli_fetch_assoc($theUser)) {
							                              $fullname = $row['fullname']; ?>
							                              <span class="badge badge-primary"><?php echo $fullname; ?></span>
							                            <?php }
							                        ?>
								                	<?php  
							                            $sql = "SELECT * FROM book WHERE id = '$book_id'";
							                            $theBook = mysqli_query($db, $sql);

							                            while ($row = mysqli_fetch_assoc($theBook)) {
							                              $title = $row['title']; ?>
							                              <span class="badge badge-info"><?php echo $title; ?></span>
							                            <?php }
							                        ?>


									                 Booking Information</h3>
									                <div class="card-tools">
									                  	<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
									                </div>
									              </div>
									              <div class="card-body">
									                <form action="orderDetails.php?do=Update" method="POST" enctype="multipart/form-data">
														<div class="row">
															<div class="col-lg-6">
																<div class="form-group">
													        		<label>Receive Date</label>   	
													        		<input type="text" id="datepicker1" name="rcv_date" class="form-control" required autocomplete="off" value="<?php echo $rcv_date; ?>">
													        	</div>

													        	<div class="form-group">
													        		<label>Return Date</label>   	
													        		<input type="text" id="datepicker2" name="rtn_date" class="form-control" required autocomplete="off" value="<?php echo $rtn_date; ?>">
													        	</div>        	
															</div>
															<div class="col-lg-6">
																<div class="form-group">
																	<label>Booking Status</label>
																	<select name="status" class="form-control">
																		<!-- <option value="4">Please Select Booking Status</option> -->
																		<option value="1" <?php if ( $status == 1 ){ echo 'selected'; }?>>Active</option>
																		<option value="2" <?php if ( $status == 2 ){ echo 'selected'; }?>>Returned</option>
																		<option value="3" <?php if ( $status == 3 ){ echo 'selected'; }?>>Cancel</option>
																		<option value="4" <?php if ( $status == 4 ){ echo 'selected'; }?>>Pending</option>
																	</select>
																</div>

													        	<div class="form-group">
													        		<input type="hidden" name="order_id" value="<?php echo $id; ?>">
													        		<input type="hidden" name="book_id" value="<?php echo $book_id; ?>">
													        		<input type="submit" name="updateOrder" class="btn btn-success btn-block" value="Save Changes">
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

								else if ($do == 'Update') {
									if (isset($_POST['updateOrder'])) {
										$order_id 		= $_POST['order_id'];
										$book_id 		= $_POST['book_id'];
										$rcv_date   	= date('Y-m-d', strtotime($_POST['rcv_date']));
                        				$rtn_date   	= date('Y-m-d', strtotime($_POST['rtn_date']));
										$status 		= $_POST['status'];

										if ($status == 1) {
											$sql = "UPDATE booking_list SET rcv_date='$rcv_date', rtn_date='$rtn_date', status='$status' WHERE id='$order_id'";
											$updateOrderDetails = mysqli_query($db, $sql);

											// Update the Quantity of the Order Book
											$query = "SELECT * FROM book WHERE id='$book_id'";
											$bookData = mysqli_query($db, $query);
											while( $row = mysqli_fetch_assoc($bookData) ) {
									  			$quantity = $row['quantity'];
									  			$quantity--;
											}
											$query2 = "UPDATE book SET quantity='$quantity' Where id='$book_id'";
											$updateBookData = mysqli_query($db, $query2);

											if ($updateBookData) {
												header("Location: orderDetails.php?do=Manage");
											}
											else {
												die("mysqli Error" . mysqli_error($db));
											}
										}
										else if ($status == 2) {
											$sql = "UPDATE booking_list SET rcv_date='$rcv_date', rtn_date='$rtn_date', status='$status' WHERE id='$order_id'";
											$updateOrderDetails = mysqli_query($db, $sql);

											// Update the Quantity of the Order Book
											$query = "SELECT * FROM book WHERE id='$book_id'";
											$bookData = mysqli_query($db, $query);
											while( $row = mysqli_fetch_assoc($bookData) ) {
									  			$quantity = $row['quantity'];
									  			$quantity++;
											}
											$query2 = "UPDATE book SET quantity='$quantity' Where id='$book_id'";
											$updateBookData = mysqli_query($db, $query2);

											if ($updateBookData) {
												header("Location: orderDetails.php?do=Manage");
											}
											else {
												die("mysqli Error" . mysqli_error($db));
											}
										}

										//Cancel
										else if ($status == 3) {
											$sql = "UPDATE booking_list SET rcv_date='$rcv_date', rtn_date='$rtn_date', status='$status' WHERE id='$order_id'";
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
												header("Location: orderDetails.php?do=Manage");
											}
											else {
												die("mysqli Error" . mysqli_error($db));
											}
										}										
										//Cancel										
									}
								}

								else if ($do == 'Delete') {
									
								}
			              	?>

			                
			              </div>
			            </div>
						<!-- Card End -->
						
					</div>
				</div>
			</div>
		</section>
	</div>
	<!-- content-wrapper End -->

<?php include "inc/footer.php"; ?>