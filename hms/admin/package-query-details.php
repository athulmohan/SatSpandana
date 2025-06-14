<?php
session_start();
// error_reporting(0);
include('include/config.php');
if(strlen($_SESSION['id']==0)) {
 header('location:logout.php');
  } else{

//updating Admin Remark
if(isset($_POST['update']))
{
	$qid=intval($_GET['id']);
	$adminremark=$_POST['adminremark'];
	$enquiry_on_package=strtoupper($_POST['enquiry_on_package']);
	$enquiry_note=$_POST['enquiry_note'];
	$email=$_POST['email'];
	$isread=1;
	$query=mysqli_query($con,"update package_enquiry set  admin_remark='$adminremark',is_read='$isread' where id='$qid'");
	if($query) {
		// echo "<script>alert('Admin Remark updated successfully.');</script>";
		// echo "<script>window.location.href ='package-read-query.php'</script>";

		include ('../include/send-mail.php');

        $from = 'admin@satspandana.com';
        $subject = 'Welcome to SatSpandana Wellness';
        $message = '<h1>Thank you for contacting us!</h1>';
        $message .= '<p>Our team has responded to your query on <b>'.$enquiry_on_package.'</b>.</p><br />';
		$message .= '<h3>Your enquiry note: </h3>';
		$message .= '<p><i>"' . $enquiry_note . '"</i></p>';
        $message .= '<h3>Our Response</h3>';
        $message .= '<p>"' . $adminremark . '"</p>';

        $msg = "Your response to the query successfully submitted.";

        if(sendEmail($from, $email, $subject, $message)) {
            $msg = "Response sent successfully.";
        } else {
            $msg = "Responded, but failed to send email notification.";
        }

		echo "<script>
        const myTimeout = setTimeout(reRoute, 2000);
        function reRoute() {
            window.location.href ='package-read-query.php'
        }
        </script>";
	}
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Admin | Package Query Details</title>
		
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
		<?php if (isset($msg) && !empty($msg)): ?>
			<div id="toast"><?php echo $msg; ?></div>
			<?php 
				include ('../include/toast-script.php'); 
			?>
		<?php endif; ?>
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
									<h1 class="mainTitle">Admin | Package Query Details</h1>
																	</div>

								<ol class="breadcrumb">
									<li>
										<span>Admin</span>
									</li>
									<li class="active">
										<span>Package Query Details</span>
									</li>
								</ol>
							</div>
						</section>
						<!-- end: PAGE TITLE -->
						<!-- start: BASIC EXAMPLE -->
						<div class="container-fluid container-fullw bg-white">
						

									<div class="row">
								<div class="col-md-12">
									<h5 class="over-title margin-bottom-15">Manage <span class="text-bold">Package Query Details</span></h5>
												<hr />
									<table class="table table-hover" id="sample-table-1">
		
										<tbody>
<?php
$qid=intval($_GET['id']);
$sql=mysqli_query($con,"select pe.*, p.specialization, p.treatmentName from package_enquiry as pe left join packages as p on pe.enquiry_on_package = p.id where pe.id='$qid'");
$cnt=1;
while($row=mysqli_fetch_array($sql))
{
?>

											<tr>
												<th>Full Name</th>
												<td><?php echo $row['name'];?></td>
											</tr>

											<tr>
												<th>Email Id</th>
												<td><?php echo $row['email'];?></td>
											</tr>
											<tr>
												<th>Contact Number</th>
												<td><?php echo $row['contact_no'];?></td>
											</tr>
											<tr>
												<th>Enquiry On</th>
												<td><?php echo $row['specialization'] . '-' . $row['treatmentName'];?></td>
											</tr>
											<tr>
												<th>Enquiry Note</th>
												<td><?php echo $row['enquiry_note'];?></td>
											</tr>
											<tr>
												<th>Query Date</th>
												<td><?php echo $row['created_date'];?></td>
											</tr>

<?php if($row['admin_remark']==""){?>	
<form name="query" method="post">
	<tr>
												<th>Admin Remark</th>
												<td><textarea name="adminremark" class="form-control" required="true"></textarea></td>
												</tr>
												<tr>
													<input type="hidden" name="enquiry_note" value="<?php echo $row['enquiry_note'];?>">
													<input type="hidden" name="enquiry_on_package" value="<?php echo $row['specialization'] . '-' . $row['treatmentName'];?>">
													<input type="hidden" name="email" value="<?php echo $row['email'];?>">

													<td>&nbsp;</td>
													<td>	
														<button type="submit" class="btn btn-primary pull-left" name="update">
		Update <i class="fa fa-arrow-circle-right"></i>
								</button>

													</td>
												</tr>

</form>												
													<?php } else {?>										
	
	<tr>
												<th>Admin Remark</th>
												<td><?php echo $row['admin_remark'];?></td>
												</tr>

<tr>
												<th>Last Updatation Date</th>
												<td><?php echo $row['updation_date'];?></td>
												</tr>
											
											<?php 
											 }} ?>
											
											
										</tbody>
									</table>
								</div>
							</div>
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
		</script>
		<!-- end: JavaScript Event Handlers for this page -->
		<!-- end: CLIP-TWO JAVASCRIPTS -->
	</body>
</html>
<?php } ?>
