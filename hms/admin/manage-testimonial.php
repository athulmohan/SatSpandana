<?php
session_start();
error_reporting(0);
include('include/config.php');
if(strlen($_SESSION['id']==0)) {
	header('location:logout.php');
} else{
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Testimonial</title>
		
		<link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="vendor/themify-icons/themify-icons.min.css">
		<link href="vendor/animate.css/animate.min.css" rel="stylesheet" media="screen">
		<link href="vendor/perfect-scrollbar/perfect-scrollbar.min.css" rel="stylesheet" media="screen">
		<link href="vendor/switchery/switchery.min.css" rel="stylesheet" media="screen">
		<link href="vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" media="screen">
		<link href="vendor/select2/select2.min.css" rel="stylesheet" media="screen">
		<link href="vendor/bootstrap-datepicker/bootstrap-datepicker3.standalone.min.css" rel="stylesheet" media="screen">
		<link href="vendor/bootstrap-timepicker/bootstrap-timepicker.min.css" rel="stylesheet" media="screen">
		<link rel="stylesheet" href="assets/css/styles.css">
		<link rel="stylesheet" href="assets/css/plugins.css">
		<link rel="stylesheet" href="assets/css/themes/theme-1.css" id="skin_color" />
	</head>
	<body>
		<div id="app">		
		<?php include('include/sidebar.php');?>
			<div class="app-content">
				<?php include('include/header.php');?>
				<!-- end: TOP NAVBAR -->
				<div class="main-content" >
					<div class="wrap-content container" id="container">
						<!-- start: PAGE TITLE -->
						<section id="page-title">
							<div class="row">
								<div class="col-sm-8">
									<h1 class="mainTitle">Manage Testimonial</h1>
								</div>
								<ol class="breadcrumb">
									<li>
										<span>Pages </span>
									</li>
									<li class="active">
										<span>Testimonial</span>
									</li>
								</ol>
							</div>
						</section>
						<!-- end: PAGE TITLE -->
						<!-- start: BASIC EXAMPLE -->
						<div class="container-fluid container-fullw bg-white">
							<div class="row">
								<div class="col-md-12">	
									<h4 class="activity-msg"></h4>
									<table class="table table-hover" id="sample-table-1">
										<thead>
											<tr>
												<th class="center">#</th>
												<th>User Name</th>
												<th class="hidden-xs">Designation</th>
												<th>Testimonial</th>
												<th>Rating</th>
												<th>Status</th>
												<!-- <th>Action</th> -->
											</tr>
										</thead>
										<tbody>
										<?php
											$sql=mysqli_query($con,"select users.fullName as name, testimony.* from testimony left join users on users.id=testimony.user_id");
											$cnt=1;
											while($row=mysqli_fetch_array($sql))
											{
										?>
											<tr id="testimonial-<?php echo $row['id']; ?>">
												<td class="center"><?php echo $cnt;?>.</td>
												<td><?php echo $row['witness_name'];?></td>
												<td class="hidden-xs"><?php echo $row['witness_designation'];?></td>
												<td><?php echo $row['testimony'];?></td>
												<td><?php echo $row['rating'];?></td>
												<td>
													<select name="status" id="status_<?php echo $row['id'] ?>" class="form-control" onChange="changeStatus(this.value, '<?php echo $row['id']; ?>')">
														<option value="0" <?php if($row['status']==0) { echo 'selected'; } ?>>Pending</option>
														<option value="1" <?php if($row['status']==1) { echo 'selected'; } ?>>Active</option>
														<option value="2" <?php if($row['status']==2) { echo 'selected'; } ?>>Rejected</option>
														<option value="3" <?php if($row['status']==3) { echo 'selected'; } ?>>Deleted</option>
													</select>
													<input type="hidden" id="previousStatus_<?php echo $row['id'] ?>" value="<?php echo $row['status']; ?>">
												</td>
											</tr>
											
											<?php 
											$cnt=$cnt+1;
											}?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<!-- end: BASIC EXAMPLE -->
						<!-- end: SELECT BOXES -->
						
					</div>
				</div>
			</div>
			<!-- start: FOOTER -->
			<?php include('include/footer.php');?>
			<!-- end: FOOTER -->
		
			<!-- start: SETTINGS -->
			<?php include('include/setting.php');?>
			<!-- end: SETTINGS -->
		</div>
		<!-- start: MAIN JAVASCRIPTS -->
		<script src="vendor/jquery/jquery.min.js"></script>
		<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
		<script src="vendor/modernizr/modernizr.js"></script>
		<script src="vendor/jquery-cookie/jquery.cookie.js"></script>
		<script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
		<script src="vendor/switchery/switchery.min.js"></script>
		<!-- end: MAIN JAVASCRIPTS -->
		<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<script src="vendor/maskedinput/jquery.maskedinput.min.js"></script>
		<script src="vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
		<script src="vendor/autosize/autosize.min.js"></script>
		<script src="vendor/selectFx/classie.js"></script>
		<script src="vendor/selectFx/selectFx.js"></script>
		<script src="vendor/select2/select2.min.js"></script>
		<script src="vendor/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
		<script src="vendor/bootstrap-timepicker/bootstrap-timepicker.min.js"></script>
		<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<!-- start: CLIP-TWO JAVASCRIPTS -->
		<script src="assets/js/main.js"></script>
		<!-- start: JavaScript Event Handlers for this page -->
		<script src="assets/js/form-elements.js"></script>
		<script>
			jQuery(document).ready(function() {
				Main.init();
				FormElements.init();
			});


		function changeStatus(value, id) {
			const previousValue = document.getElementById('previousStatus_' + id).value;
			var confirmLabel = (value == 3) ? "delete" : "update";
			if (confirm("Are you sure want to "+confirmLabel+" this testimonial?")) {
				console.log("Confirmed: " + confirmLabel);
				$.ajax({
					url: 'manage-status.php',
					type: 'POST',
					data: { id: id, value: value },
					success: function (response) {
						// Optionally: parse response and check for success
						response = response.trim();
						if(response == "Updated") {
							$(".activity-msg").html("<span style='color: green;'>Status updated successfully.</span>").fadeIn().delay(3000).fadeOut();
						} else if (response == "Deleted") {
							$("#testimonial-" + id).fadeOut("slow", function () {
								$("#testimonial-" + id).remove();
							});
							$(".activity-msg").html("<span style='color: green;'>Status deleted successfully.</span>").fadeIn().delay(3000).fadeOut();
						} else {
							$(".activity-msg").html("<span style='color: red;'>Error: " + response + "</span>").fadeIn().delay(3000).fadeOut();
						}
					},
					error: function () {
						$(".activity-msg").html("<span style='color: red;'>Something went wrong while deleting.</span>").fadeIn().delay(3000).fadeOut();
					}
				});
			} else {
				// Reset the select box to its previous value
				$("#status_"+id).val(previousValue).val();
			}
		}
		</script>
		<!-- end: JavaScript Event Handlers for this page -->
		<!-- end: CLIP-TWO JAVASCRIPTS -->
	</body>
</html>
<?php } ?>
