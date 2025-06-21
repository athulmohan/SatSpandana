<?php
    include_once('include/config.php');
    $packageParam = '';
    if(isset($_GET['param']) && $_GET['param'] !== '') {
        
        $packageParam = isHexadecimal($_GET['param']) ? hex2bin($_GET['param']) : 'Invalid';
    }
    function isHexadecimal($string) {
        return !empty($string) && ctype_xdigit($string) && strlen($string) % 2 === 0;
    }

    $list = ['ayurveda', 'fitness', 'physiotherapy'];

    if(isset($_POST) && isset($_POST['enquiry_submit']))
{	
    // print_r($_POST);
    $name = $_POST['name'];
	$email = $_POST['email'];
	$contact_no = $_POST['contact_no'];
	$enquiry_on_package = $_POST['enquiry_on_package'];
	$enquiry_note = $_POST['enquiry_note'];
	
	$sql=mysqli_query($con,"insert into package_enquiry(name,email,contact_no,enquiry_on_package,enquiry_note) values('$name','$email','$contact_no','$enquiry_on_package','$enquiry_note')");
	if($sql)
	{
        include ('include/send-mail.php');

        $to = 'admin@satspandana.com';
        $subject = 'Welcome to SatSpandana Wellness';
        $message = '<h1>Thank you for contacting us!</h1>';
        $message .= '<p>We are happy to have you.Your query is succesfully submitted. We will get touch with you shortly.</p><br />';
        $message .= '<h3>Package Enquiry</h3>';
        $message .= '<p><i>"' . $enquiry_note . '"</i></p>';

        $enquiryMsg = "Your query successfully submitted.";

        if(sendEmail($email, $to, $subject, $message)) {
            $enquiryMsg = "Enquiry submitted successfully. We will get back to you soon.";
        } else {
            $enquiryMsg = "Enquiry submitted, but failed to send email notification.";
        }
		// echo "<script>
        // const myTimeout = setTimeout(reRoute, 2000);
        // function reRoute() {
        //     window.location.href ='index.php'
        // }
        // </script>";
	}
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> Sat Spandana </title>

    <link rel="shortcut icon" href="../assets/images/fav.jpg">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/fontawsom-all.min.css">
    <link rel="stylesheet" href="../assets/css/animate.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/datatables.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css" />
</head>

<body>
    <?php if (isset($enquiryMsg) && !empty($enquiryMsg)): ?>
        <div id="toast"><?php echo $enquiryMsg; ?></div>
        <?php 
            include ('include/toast-script.php'); 
        ?>
    <?php endif; ?>
    <!-- ################# Header Starts Here#######################--->
    <?php include_once('include/website-header.php') ?>

    <!-- ################# Slider Starts Here#######################--->
    <!-- Removed slider section from the packages page ... -->


    <!-- ################# Packages Starts Here #######################--->
    <div id="packages" class="container-fluid">
        <!-- <div class="inner-title mb-0">
            <h2 class="left"><span>SERVICES</span></h2>
            <h2 class="right">
                <section >
                    <a href="packages.php?param=<?php //echo bin2hex('all'); ?>" class="ball bubble" title="Click Me to view All Packages...">
                        All
                    </a>
                </section>
            </h2>
        </div> -->
        <?php
        if($packageParam === 'all' || $packageParam !== '') {
        ?>
            <section class="package-section-body">
                <div id="physio-package" class="physio-package pt-5">
                    <div class="container-fluid">
                        <?php include_once('package-details.php'); ?>
                    </div>
                </div>
            <section>
        <?php }?>
    </div>

    <!-- ################# Footer Starts Here#######################--->
    <footer class="footer pt-5">
        <div class="container">
            <div class="row">

                <div class="col-md-6 col-sm-12">
                    <h2>Useful Links</h2>
                    <ul class="list-unstyled link-list">
                        <li><a ui-sref="about" href="#about">About us</a><i class="fa fa-angle-right"></i></li>
                        <li><a ui-sref="portfolio" href="#services">Services</a><i class="fa fa-angle-right"></i></li>
                        <li><a ui-sref="products" href="#logins">Logins</a><i class="fa fa-angle-right"></i></li>
                        <li><a ui-sref="gallery" href="#gallery">Gallery</a><i class="fa fa-angle-right"></i></li>
                        <li><a ui-sref="contact" href="#contact">Contact us</a><i class="fa fa-angle-right"></i></li>
                    </ul>
                </div>
                <div class="col-md-6 col-sm-12 map-img">
                    <h2>Contact Us</h2>
                    <address class="md-margin-bottom-40">

                        <?php
                                $ret=mysqli_query($con,"select * from tblpage where PageType='contactus' ");
                                while ($row=mysqli_fetch_array($ret)) {
                            ?>
                        <?php  echo $row['PageDescription'];?> <br>
                        Phone: <?php  echo $row['MobileNumber'];?> <br>
                        Email: <a href="mailto:<?php  echo $row['Email'];?>"
                            class=""><?php  echo $row['Email'];?></a><br>
                        Timing: <?php  echo $row['OpenningTime'];?>
                    </address>
                    <?php } ?>
                </div>
            </div>
        </div>
    </footer>
    <div class="copy">
        <div class="container">
            Satspandana
        </div>
    </div>

    <!-- Enquiry Floating Icon -->
    <button id="enquiryBtn" class="btn btn-success rounded-circle shadow" data-toggle="modal" data-target="#packageEnquiryModal" title="Enquiry">
        <!-- <i class="bi bi-chat-dots-fill"></i> -->
        <i class="fas fa-comments"></i>
    </button>
    <!-- Enquiry Modal -->
    <div class="modal fade" id="packageEnquiryModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="submitPackageEnquiry" aria-hidden="true">
        <?php include_once('include/package-enquiry-modal.php'); ?>
    </div>
</body>

<script src="../assets/js/jquery-3.2.1.min.js"></script>
<script src="../assets/js/popper.min.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>
<script src="../assets/plugins/scroll-nav/js/jquery.easing.min.js"></script>
<script src="../assets/plugins/scroll-nav/js/scrolling-nav.js"></script>
<script src="../assets/plugins/scroll-fixed/jquery-scrolltofixed-min.js"></script>
<script src="../assets/js/datatables.min.js"></script>
<script src="../assets/js/script.js"></script>
<script>
$(document).ready(function() {
    $('.ayurveda-dataTable').DataTable();
});
</script>

</html>