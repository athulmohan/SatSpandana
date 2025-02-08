<?php
$message = '';
$type = '';
session_start();
error_reporting(0);
include('include/config.php');
// include('include/checklogin.php');
// check_login();

if(isset($_POST['submit']))
{
    $fname=$_POST['full_name'];
    $address=$_POST['address'];
    $city=$_POST['city'];
    $gender=$_POST['gender'];
    $email=$_POST['email'];
    
    $user_query=mysqli_query($con,"insert into users(fullname,address,city,gender,email) values('$fname','$address','$city','$gender','$email')");

    if($user_query > 0)
    {
        $specilization=$_POST['Doctorspecialization'];
        $doctorid=$_POST['doctor'];
        $userid=mysqli_insert_id($con);
        $fees=$_POST['fees'];
        $appdate=$_POST['appdate'];
        $time=$_POST['apptime'];
        $userstatus=1;
        $docstatus=1;

        $query=mysqli_query($con,"insert into appointment(doctorSpecialization,doctorId,userId,consultancyFees,appointmentDate,appointmentTime,userStatus,doctorStatus) values('$specilization','$doctorid','$userid','$fees','$appdate','$time','$userstatus','$docstatus')");
        if($query > 0)
        {
			$message = 'Your appointment successfully booked';
			$type = 'success';
            // echo "<script>alert('Your appointment successfully booked');</script>";
        } else {
			$message = 'Your appointment booking failed. Please try later.';
			$type = 'warning';
		}
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>User | Book Appointment</title>

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

	<!-- <link rel="stylesheet" href="assets/css/fontawsom-all.min.css"> -->
    <!-- <link rel="stylesheet" href="assets/css/animate.css"> -->
    <!-- <link rel="stylesheet" type="text/css" href="../assets/css/style.css" /> -->

    <script>
    function getdoctor(val) {
        $.ajax({
            type: "POST",
            url: "get_doctor.php",
            data: 'specilizationid=' + val,
            success: function(data	) {
                $("#doctor").html(data);
            }
        });
    }
    </script>


    <script>
    function getfee(val) {
        $.ajax({
            type: "POST",
            url: "get_doctor.php",
            data: 'doctor=' + val,
            success: function(data) {
                $("#fees").html(data);
            }
        });
    }
    </script>
</head>

<body>
    <header id="menu-jk" style="display:none;">
        <div id="nav-head" class="header-nav">
            <div class="container">
                <div class="row">
                    <div class="col-lg-2 col-md-3 col-sm-12">
                        <a href="javascript:void(0);">
                            <img src="../assets/images/satspandana-logo-png.png" alt="SAT SPANDANA">
                        </a>
                    </div>
                    <div id="menu" class="col-lg-8 col-md-9 d-none d-md-block nav-item">
                        <ul>
                            <li><a href="#">Home</a></li>
                            <li><a href="#services">Services</a></li>
                            <li><a href="#about_us">About Us</a></li>
                            <li><a href="#gallery">Gallery</a></li>
                            <li><a href="#contact_us">Contact Us</a></li>
                            <li class="nav-item dropdown">
                                <a class="dropdown-toggle" href="#" id="navbarDropdown2" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Logins
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown2">
                                    <a class="dropdown-item" href="hms/user-login.php">Patient Login</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="hms/doctor">Doctors Login</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="hms/admin">Admin Login</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="dropdown-toggle" href="#" id="navbarDropdown3" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    More
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown3">
                                    <a class="dropdown-item" href="hms/our-teams.php">Our Team</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="hms/accommodation.php">Our Home Stay</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="col-sm-2 d-none d-lg-block appoint">
                        <a class="btn btn-success" href="hms/guest-book-appointment.php">Book an Appointment</a>
                    </div>
                </div>

            </div>
        </div>
    </header>
    <div id="app">
        <?php include_once('include/notification.php'); ?>
        <?php //include('include/sidebar.php');?>
        <div class="app-content">

            <?php //include('include/header.php');?>

            <!-- end: TOP NAVBAR -->
            <div class="row">
                <div class="main-login col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
                    <div class="logo margin-top-30 more-style">
                        <a href="../index.php">
                            <i class="ti-arrow-circle-left col-md-2" style="font-size: 30px"></i>
                            <h2 class="col-md-10"> User | Book Appointment</h2>
                        </a>
                    </div>

                    <div class="box-login">
                        <form class="form-login" method="post">
                            <fieldset>
                                <legend>
                                    Book Your Appointment
                                </legend>
                                <p>
                                    Enter your personal details below:
                                </p>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="full_name" placeholder="Full Name"
                                        required>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="address" placeholder="Address"
                                        required>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="city" placeholder="City" required>
                                </div>
                                <div class="form-group">
                                    <label class="block">
                                        Gender
                                    </label>
                                    <div class="clip-radio radio-primary">
                                        <input type="radio" id="rg-female" name="gender" value="female">
                                        <label for="rg-female">
                                            Female
                                        </label>
                                        <input type="radio" id="rg-male" name="gender" value="male">
                                        <label for="rg-male">
                                            Male
                                        </label>
                                    </div>
                                </div>
                                <p>
                                    Enter your account details below:
                                </p>
                                <div class="form-group">
                                    <span class="input-icon">
                                        <input type="email" class="form-control" name="email" id="email"
                                            onBlur="userAvailability()" placeholder="Email" required>
                                        <i class="fa fa-envelope"></i> </span>
                                    <span id="user-availability-status1" style="font-size:12px;"></span>
                                </div>
                                <div class="form-group">
                                    <label for="DoctorSpecialization">
                                        Doctor Specialization
                                    </label>
                                    <select name="Doctorspecialization" class="form-control"
                                        onChange="getdoctor(this.value);" required="required">
                                        <option value="">Select Specialization</option>
                                        <?php $ret=mysqli_query($con,"select * from doctorspecilization");
                                    while($row=mysqli_fetch_array($ret))
                                    {
                                    ?>
                                        <option value="<?php echo htmlentities($row['specilization']);?>">
                                            <?php echo htmlentities($row['specilization']);?>
                                        </option>
                                        <?php 
                                    } ?>

                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="doctor">
                                        Doctors
                                    </label>
                                    <select name="doctor" class="form-control" id="doctor"
                                        onChange="getfee(this.value);" required="required">
                                        <option value="">Select Doctor</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="consultancyfees">
                                        Consultancy Fees
                                    </label>
                                    <select name="fees" class="form-control" id="fees" readonly></select>
                                </div>

                                <div class="form-group">
                                    <label for="AppointmentDate">
                                        Date
                                    </label>
                                    <input class="form-control datepicker" id="appdate" name="appdate" required="required"
                                        data-date-format="yyyy-mm-dd" onChange="getAvailableSlots(this.value);">
                                </div>

                                <div class="form-group">
                                    <label for="Appointmenttime">
                                        Time
                                    </label>
                                    <!-- <input class="form-control" name="apptime" id="timepicker1" required="required"> -->
									<select id="apptime" name="apptime" class="form-control">
										<option value="">Select a Slot</option>
									</select>
                                </div>

                                <button type="submit" name="submit" class="btn btn-o btn-primary">
                                    Submit
                                </button>
                            </fieldset>
                        </form>

                        <div class="copyright">
                            </span><span class="text-bold text-uppercase"> Sat Spandana</span>.
                        </div>

                    </div>

                </div>
            </div>
            <!-- </div>
</div> -->
            <!-- </div> -->
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

				$('.datepicker').datepicker({
					format: 'yyyy-mm-dd',
					startDate: '-3d',
					autoclose: true
				});

				function getAvailableSlots(selectedDate) {
					// Fetch available slots when a date is selected
					var selectedDoc = $("#doctor").val();
					$('#apptime').html('<option value="">Loading...</option>');

					$.get('include/book_slot.php', { date: selectedDate, doc: selectedDoc }, function (data) {
						$('#apptime').html('<option value="">Select a Slot</option>');
						var slots = JSON.parse(data);
						
						if (slots.length > 0) {
							slots.forEach(function (slot) {
								$('#apptime').append('<option value="' + slot + '">' + slot + '</option>');
							});
						} else {
							$('#apptime').html('<option value="">No Slots Available</option>');
						}
					});
				}
            </script>
            <script type="text/javascript">
            	$('#timepicker1').timepicker();
            </script>
            <!-- end: JavaScript Event Handlers for this page -->
            <!-- end: CLIP-TWO JAVASCRIPTS -->

            <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
</body>

</html>