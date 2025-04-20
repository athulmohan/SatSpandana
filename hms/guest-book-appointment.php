<?php
$message = '';
$type = '';
session_start();
// error_reporting(0);
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);;
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
        $locationid=$_POST['location'];
        $userid=mysqli_insert_id($con);
        $fees=$_POST['fees'];
        $appdate=$_POST['appdate'];
        $time=$_POST['apptime'];
        $userstatus=1;
        $docstatus=1;

        $query=mysqli_query($con,"insert into appointment(doctorSpecialization,doctorId,locationId,userId,consultancyFees,appointmentDate,appointmentTime,userStatus,doctorStatus) values('$specilization','$doctorid','$locationid','$userid','$fees','$appdate','$time','$userstatus','$docstatus')");
        if($query > 0)
        {

            // $getUser=mysqli_query($con,"select * from users where id='$userid'");
            // $rowUser=mysqli_fetch_row($getUser);
            include ('include/send-mail.php');

            $from = 'satspandanawellness@gmail.com';
            $subject = 'Welcome to SatSpandana Wellness';
			$message = '<h1>Your appointment successfully booked</h1>';
            $message .= '<p>Dear User,</p>';
            $message .= '<p>Your appointment details are given below : </p>';
            $message .= '<p>Category : ' .$specilization. '</p>';
            $message .= '<p>Date : ' .$appdate. '</p>';
            $message .= '<p>Time : ' .$time. '</p>';
            
            if(sendEmail($from, $email, $subject, $message)) {

                $message = 'Your appointment successfully booked and email sent to your registered email address.';
                $type = 'success';
                echo "<script>console.log('Email Sent ...');</script>";
            } else {
                $message = 'Your appointment successfully booked but email sending failed.';
                $type = 'success';
                echo "<script>console.log('Email Sending Failed ...');</script>";
            }


			// $message = 'Your appointment successfully booked';
			// $type = 'success';
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

<body class="login">

    <?php if (isset($message) && !empty($message)): ?>
        <div id="toast"><?php echo $message; ?></div>
        <?php 
            include ('include/toast-script.php'); 
        ?>
    <?php endif; ?>

    <!-- ################# Header Starts Here#######################---> 
    <!-- <?php include_once('include/website-header.php') ?> -->

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
                                        onChange="getfee(this.value); getAvailableSlots(this.value);" required="required">
                                        <option value="">Select Doctor</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="consultancyfees">
                                        Consultation Fees
                                    </label>
                                    <select name="fees" class="form-control" id="fees" readonly></select>
                                </div>

                                <div class="form-group">
                                    <label for="location">
                                        Location
                                    </label>
                                    <select name="location" id="location" class="form-control" required="true" onChange="getAvailableSlots(this.value);">
                                        <option value="">Select Location</option>
                                        <?php
                                        $resLoc=mysqli_query($con,"select * from locations where status = 1");
                                        while($row=mysqli_fetch_array($resLoc))
                                        {
                                        ?>
                                        <option
                                            value="<?php echo htmlentities($row['id']);?>">
                                            <?php echo htmlentities($row['location_name']);?>
                                        </option>
                                        <?php } ?>
                                    </select>
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
									<select id="apptime" name="apptime" class="form-control" required="true">
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
					var selectedLoc = $("#location").val();
					var selectedDate = $("#appdate").val();

					$('#apptime').html('<option value="">Loading...</option>');

					$.get('include/book_slot.php', { date: selectedDate, doc: selectedDoc, loc: selectedLoc }, function (data) {
                        
                        // if(data.status == 'error') {
                            // $('#apptime').html('<option value="">No Slots Available</option>');
                            // $('#block-submit').attr('disabled', true);
                            // $('#submission-error').html(data.message).show();
                        // } else {
                            $('#block-submit').attr('disabled', false);
                            $('#submission-error').html(data.message).hide();
                            $('#apptime').html('<option value="">Select a Slot</option>');
                            var slots = JSON.parse(data);
                            
                            if (slots.length > 0) {
                                slots.forEach(function (slot) {
                                    $('#apptime').append('<option value="' + slot + '">' + slot + '</option>');
                                });
                            } else {
                                $('#apptime').html('<option value="">No Slots Available</option>');
                            }
                        // }
					});
				}
            </script>
            <script type="text/javascript">
            	$('#timepicker1').timepicker();
            </script>
            <!-- end: JavaScript Event Handlers for this page -->
            <!-- end: CLIP-TWO JAVASCRIPTS -->

            <!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script> -->
</body>

</html>