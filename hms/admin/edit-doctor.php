<?php
ob_start();
session_start();
error_reporting(0);
include('include/config.php');
if(strlen($_SESSION['id']==0)) {
 header('location:logout.php');
  } else{

$did=intval($_GET['id']);// get doctor id
if(isset($_POST['submit']))
{
	$docspecialization=$_POST['Doctorspecialization'];
	$docrole=$_POST['docrole'];
	$docname=$_POST['docname'];
	$docaddress=$_POST['clinicaddressid'];
	$docfees=$_POST['docfees'];
	$doccontactno=$_POST['doccontact'];
	$docemail=$_POST['docemail'];
	$aboutDoc=$_POST['about_doctor'];

	if (isset($_FILES['file']) && $_FILES['file']['name'] !== '') {
		$uploadDir = '../../assets/images/teams/doctors/'; // Directory to save the file
	
		// Ensure the upload directory exists
		if (!is_dir($uploadDir)) {
			mkdir($uploadDir, 0755, true);
		}
	
		// Check for errors
		if ($_FILES['file']['error'] !== UPLOAD_ERR_OK) {
			die("Error during file upload: " . $_FILES['file']['error']);
		}
	
		// Validate file type using MIME types
		$allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
		$fileMimeType = mime_content_type($_FILES['file']['tmp_name']);
		if (!in_array($fileMimeType, $allowedMimeTypes)) {
			die("Invalid file type. Only JPG, PNG, GIF, and WEBP images are allowed.");
		}
	
		// Validate file extension (optional, adds an extra layer of security)
		$allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
		$fileExtension = strtolower(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION));
		if (!in_array($fileExtension, $allowedExtensions)) {
			die("Invalid file extension. Only JPG, PNG, GIF, and WEBP are allowed.");
		}
	
		// Validate file size (optional, e.g., max 2MB)
		$maxFileSize = 2 * 1024 * 1024; // 2MB
		if ($_FILES['file']['size'] > $maxFileSize) {
			die("File size exceeds the maximum allowed size of 2MB.");
		}
	
		// Move the uploaded file to the target directory
		$uploadFile = $uploadDir . basename($_FILES['file']['name']);
		$filename = basename($_FILES['file']['name']);
		if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadFile)) {
			$msg = "File successfully uploaded to: " . htmlspecialchars($uploadFile);
		} else {
			$msg = "File upload failed.";
		}
	} else {
		$filename = $_POST['oldfile'];
		$msg = "No file was uploaded.";
	}
	$sql=mysqli_query($con,"Update doctors set specilization='$docspecialization',role='$docrole',doctorName='$docname',address='$docaddress',docFees='$docfees',contactno='$doccontactno',docEmail='$docemail',profile_pic='$filename',about_doctor='$aboutDoc' where id='$did'");
	if($sql)
	{
		$msg="Doctor Details Updated Successfully";
	}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin | Edit Doctor Details</title>

    <link
        href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic"
        rel="stylesheet" type="text/css" />
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
	<!-- <script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script> -->
    <script type="text/javascript">
		// bkLib.onDomLoaded(nicEditors.allTextAreas);
	</script>

</head>

<body>
    <div id="app">
        <?php include('include/sidebar.php');?>
        <div class="app-content">

            <?php include('include/header.php');?>
            <!-- start: MENU TOGGLER FOR MOBILE DEVICES -->

            <!-- end: TOP NAVBAR -->
            <div class="main-content">
                <div class="wrap-content container" id="container">
                    <!-- start: PAGE TITLE -->
                    <section id="page-title">
                        <div class="row">
                            <div class="col-sm-8">
                                <h1 class="mainTitle">Admin | Edit Doctor Details</h1>
                            </div>
                            <ol class="breadcrumb">
                                <li>
                                    <span>Admin</span>
                                </li>
                                <li class="active">
                                    <span>Edit Doctor Details</span>
                                </li>
                            </ol>
                        </div>
                    </section>
                    <!-- end: PAGE TITLE -->
                    <!-- start: BASIC EXAMPLE -->
                    <div class="container-fluid container-fullw bg-white">
                        <div class="row">
                            <div class="col-md-12">
                                <h5 style="color: green; font-size:18px; ">
                                    <?php if($msg) { echo htmlentities($msg);}?> </h5>
                                <div class="row margin-top-30">
                                    <div class="col-lg-8 col-md-12">
                                        <div class="panel panel-white">
                                            <div class="panel-heading">
                                                <h5 class="panel-title">Edit Doctor info</h5>
                                            </div>
                                            <div class="panel-body">
                                                <?php $sql=mysqli_query($con,"select * from doctors where id='$did'");
												while($data=mysqli_fetch_array($sql))
												{
												?>
													<h4><?php echo htmlentities($data['doctorName']);?>'s Profile</h4>
													<p><b>Profile Reg. Date:
														</b><?php echo htmlentities($data['creationDate']);?></p>
													<?php if($data['updationDate']){?>
													<p><b>Profile Last Updation Date:
														</b><?php echo htmlentities($data['updationDate']);?></p>
													<?php } ?>
													<hr />
													<form role="form" name="adddoc" method="post"
														onSubmit="return valid();" enctype="multipart/form-data">
														<div class="form-group">
															<label for="DoctorSpecialization">
																Doctor Specialization
															</label>
															<select name="Doctorspecialization" class="form-control"
																required="required">
																<option
																	value="<?php echo htmlentities($data['specilization']);?>">
																	<?php echo htmlentities($data['specilization']);?>
																</option>
																<?php $ret=mysqli_query($con,"select * from doctorspecilization");
																while($row=mysqli_fetch_array($ret))
																{
																?>
																<option
																	value="<?php echo htmlentities($row['specilization']);?>">
																	<?php echo htmlentities($row['specilization']);?>
																</option>
																<?php } ?>
															</select>
														</div>

														<div class="form-group">
															<label for="doctor_role">
																Role
															</label>
															<input type="text" name="docrole" class="form-control"
															value="<?php echo htmlentities($data['role']);?>">
														</div>

														<div class="form-group">
															<label for="doctorname">
																Doctor Name
															</label>
															<input type="text" name="docname" class="form-control"
																value="<?php echo htmlentities($data['doctorName']);?>">
														</div>

														<div class="form-group">
															<label for="address">
																Doctor Clinic Address
															</label>
															<!-- <textarea name="clinicaddress"
																class="form-control"><?php //echo htmlentities($data['address']);?></textarea> -->
																<select name="clinicaddressid" class="form-control"
                                                            required="true">
                                                            <option value="">Select Address</option>
																<?php $ret=mysqli_query($con,"select * from locations where status = 1");
																while($row=mysqli_fetch_array($ret))
																{
																?>
																<option
																	value="<?php echo htmlentities($row['id']);?>" <?php echo ($row['id'] === $data['address']) ? 'selected="selected"' : ''; ?>>
																	<?php echo htmlentities($row['location_name']);?>
																</option>
																<?php } ?>
															</select>
														</div>
														<div class="form-group">
															<label for="fees">
																Doctor Consultancy Fees
															</label>
															<input type="text" name="docfees" class="form-control"
																required="required"
																value="<?php echo htmlentities($data['docFees']);?>">
														</div>

														<div class="form-group">
															<label for="contact">
																Doctor Contact no
															</label>
															<input type="text" name="doccontact" class="form-control"
																required="required"
																value="<?php echo htmlentities($data['contactno']);?>">
														</div>

														<div class="form-group">
															<label for="email">
																Doctor Email
															</label>
															<input type="email" name="docemail" class="form-control"
																readonly="readonly"
																value="<?php echo htmlentities($data['docEmail']);?>">
														</div>
														<div class="form-group">
															<label for="profile-pic">
																Profile Pic
															</label>
															<input type="file" name="file" id="file" class="form-control" placeholder="Upload Profile Pic">
															<input type="hidden" name="oldfile" value="<?php echo htmlentities($data['profile_pic']);?>">
															<?php if(isset($data['profile_pic']) && $data['profile_pic'] !== "") { ?>
																<a class="uploadedPic" href="<?php echo '../../assets/images/teams/doctors/'.$data['profile_pic']; ?>" target="_blank">VIEW UPLOADED PIC</a>
															<?php } ?>
														</div>

														<div class="form-group">
															<label for="about_doctor">
																About Doctor
															</label>
															<textarea class="form-control" name="about_doctor" id="tinymce_editor"
																rows="12"><?php  echo $data['about_doctor'];?></textarea>
														</div>
												<?php } ?>

												<button type="submit" name="submit" class="btn btn-o btn-primary">
													Update
												</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="panel panel-white">

                                </div>
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
    <>
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
		<!-- <script src="../../assets/js/tinymce.min.js"></script> -->
		<script src="https://cdn.tiny.cloud/1/d2v0midup7lpvowewkee6om89twgjbeveofkrrpwsc5z7gm7/tinymce/6/tinymce.min.js"></script>
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