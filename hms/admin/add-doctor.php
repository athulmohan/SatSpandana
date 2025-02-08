<?php
session_start();
error_reporting(0);
include('include/config.php');
if(strlen($_SESSION['id']==0)) {
 header('location:logout.php');
  } else{

if(isset($_POST['submit']))
{	
    $docspecialization=$_POST['Doctorspecialization'];
	$docrole = $_POST['docrole'];
	$docname=$_POST['docname'];
	$docaddress=$_POST['clinicaddress'];
	$docfees=$_POST['docfees'];
	$doccontactno=$_POST['doccontact'];
	$docemail=$_POST['docemail'];
	$password=md5($_POST['npass']);
	$aboutDoc=$_POST['about_doctor'];

	if (isset($_FILES['file'])) {
		$uploadDir = '../../assets/images/teams/doctors/'; // Directory to save the file
	
		// Ensure the upload directory exists
		if (!is_dir($uploadDir)) {
			mkdir($uploadDir, 0777, true);
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
			echo "File successfully uploaded to: " . htmlspecialchars($uploadFile);
		} else {
			echo "File upload failed.";
		}
	} else {
		echo "No file was uploaded.";
	}
	
	$sql=mysqli_query($con,"insert into doctors(specilization,role,doctorName,address,docFees,contactno,docEmail,password,profile_pic,about_doctor) values('$docspecialization','$docrole','$docname','$docaddress','$docfees','$doccontactno','$docemail','$password', '$filename','$aboutDoc')");
	if($sql)
	{
        $msg="Doctor Details Addedd successfully";
		// echo "<script>alert('Doctor info added Successfully');</script>";
		echo "<script>
        const myTimeout = setTimeout(reRoute, 2000);
        function reRoute() {
            window.location.href ='manage-doctors.php'
        }
        </script>";
	}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin | Add Doctor</title>

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
	<script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
    <script type="text/javascript">
		bkLib.onDomLoaded(nicEditors.allTextAreas);
		function valid() {
			if (document.adddoc.npass.value != document.adddoc.cfpass.value) {
				alert("Password and Confirm Password Field do not match  !!");
				document.adddoc.cfpass.focus();
				return false;
			}
			return true;
		}
    </script>

    <script>
		function checkemailAvailability() {
			$("#loaderIcon").show();
			jQuery.ajax({
				url: "check_availability.php",
				data: 'emailid=' + $("#docemail").val(),
				type: "POST",
				success: function(data) {
					$("#email-availability-status").html(data);
					$("#loaderIcon").hide();
				},
				error: function() {}
			});
		}
    </script>
</head>

<body>
    <div id="app">
        <?php include('include/sidebar.php');?>
        <div class="app-content">

            <?php include('include/header.php');?>

            <!-- end: TOP NAVBAR -->
            <div class="main-content">
                <div class="wrap-content container" id="container">
                    <!-- start: PAGE TITLE -->
                    <section id="page-title">
                        <div class="row">
                            <div class="col-sm-8">
                                <h1 class="mainTitle">Admin | Add Doctor</h1>
                            </div>
                            <ol class="breadcrumb">
                                <li>
                                    <span>Admin</span>
                                </li>
                                <li class="active">
                                    <span>Add Doctor</span>
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
                                    <?php if($msg) { echo htmlentities($msg);}?>
                                </h5>
                                <div class="row margin-top-30">
                                    <div class="col-lg-8 col-md-12">
                                        <div class="panel panel-white">
                                            <div class="panel-heading">
                                                <h5 class="panel-title">Add Doctor</h5>
                                            </div>
                                            <div class="panel-body">

                                                <form role="form" name="adddoc" method="post" onSubmit="return valid();"
                                                    enctype="multipart/form-data">
                                                    <div class="form-group">
                                                        <label for="DoctorSpecialization">
                                                            Doctor Specialization
                                                        </label>
                                                        <select name="Doctorspecialization" class="form-control"
                                                            required="true">
                                                            <option value="">Select Specialization</option>
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
                                                            placeholder="Enter Doctor Role" required="true">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="doctorname">
                                                            Doctor Name
                                                        </label>
                                                        <input type="text" name="docname" class="form-control"
                                                            placeholder="Enter Doctor Name" required="true">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="address">
                                                            Doctor Clinic Address
                                                        </label>
                                                        <textarea name="clinicaddress" class="form-control"
                                                            placeholder="Enter Doctor Clinic Address"></textarea>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="fees">
                                                            Doctor Consultancy Fees
                                                        </label>
                                                        <input type="text" name="docfees" class="form-control"
                                                            placeholder="Enter Doctor Consultancy Fees" required="true">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="contact">
                                                            Doctor Contact no
                                                        </label>
                                                        <input type="text" name="doccontact" class="form-control"
                                                            placeholder="Enter Doctor Contact no" required="true">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="email">
                                                            Doctor Email
                                                        </label>
                                                        <input type="email" id="docemail" name="docemail"
                                                            class="form-control" placeholder="Enter Doctor Email id"
                                                            required="true" onBlur="checkemailAvailability()">
                                                        <span id="email-availability-status"></span>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="profile-pic">
                                                            Profile Pic
                                                        </label>
                                                        <input type="file" name="file" id="file" class="form-control"
                                                            placeholder="Upload Profile Pic">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="exampleInputPassword1">
                                                            Password
                                                        </label>
                                                        <input type="password" name="npass" class="form-control"
                                                            placeholder="New Password" required="required">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="exampleInputPassword2">
                                                            Confirm Password
                                                        </label>
                                                        <input type="password" name="cfpass" class="form-control"
                                                            placeholder="Confirm Password" required="required">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="about_doctor">About Doctor</label>
                                                        <textarea class="form-control" name="about_doctor" id="about_doctor"
                                                            rows="12"><?php  echo $row['about_doctor'];?></textarea>
                                                    </div>

                                                    <button type="submit" name="submit" id="submit"
                                                        class="btn btn-o btn-primary">
                                                        Submit
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