<?php
    include_once('include/config.php');
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
    <!-- ################# Header Starts Here#######################--->
    <header id="menu-jk">
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
                            <li><a href="../index.php">Home</a></li>
                            <li><a href="../index.php#services">Services</a></li>
                            <li><a href="../index.php#about_us">About Us</a></li>
                            <li><a href="../index.php#gallery">Gallery</a></li>
                            <li><a href="../index.php#contact_us">Contact Us</a></li>
                            <!-- <li><a href="#">Packages</a></li> -->
                            <li class="nav-item dropdown">
                                <a class="dropdown-toggle" href="#" id="navbarDropdown2" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Logins
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown2">
                                    <a class="dropdown-item" href="user-login.php">Patient Login</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="doctor">Doctors Login</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="admin">Admin Login</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="dropdown-toggle" href="#" id="navbarDropdown3" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    More
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown3">
                                    <a class="dropdown-item" href="our-teams.php">Our Team</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="accommodation.php">Our Home Stay</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="col-sm-2 d-none d-lg-block appoint">
                        <a class="btn btn-success" href="guest-book-appointment.php">Book an Appointment</a>
                    </div>
                </div>

            </div>
        </div>
    </header>

    <div id="our-teams" class="container my-5">
        <div class="inner-title mb-0">
            <h2 class="left"><span>OUR TEAMS</span></h2>
            <h2 class="right"><span>Say Hello to Our Team Members</span></h2>
        </div>
        <?php
            $ret=mysqli_query($con,"select * from  doctors");
            while ($row=mysqli_fetch_array($ret)) {
        ?>
            <div class="profile-card">
                <!-- Left Section: Text -->
                <div class="col-md-9 profile-details">
                    <h1 class="profile-title"><?php echo $row['doctorName']; ?></h1>
                    <h2 class="profile-subtitle"><?php echo $row['role']; ?></h2>
                    <p class="profile-description">
                        <?php echo $row['about_doctor']; ?>
                    </p>
                </div>

                <!-- Right Section: Image -->
                <div class="col-md-3 profile-picture">
                    <div class="position-relative">
                        <?php if(isset($row['profile_pic']) && $row['profile_pic'] !== '') { ?>
                            <img src="<?php echo '../assets/images/teams/doctors/' . $row['profile_pic']; ?>" alt="<?php echo $row['doctorName']; ?>">
                        <?php } else { ?>
                            <img src="<?php echo '../assets/images/teams/doctors/default-pic.png'; ?>" alt="<?php echo $row['doctorName']; ?>">
                        <?php } ?>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>

    <!-- ################# Footer Starts Here#######################--->
    <footer class="footer mt-5">
        <div class="container">
            <div class="row">

                <div class="col-md-6 col-sm-12">
                    <h2>Useful Links</h2>
                    <ul class="list-unstyled link-list">
                        <li><a ui-sref="about" href="../index.php#about_us">About us</a><i class="fa fa-angle-right"></i></li>
                        <li><a ui-sref="portfolio" href="../index.php#services">Services</a><i class="fa fa-angle-right"></i></li>
                        <!-- <li><a ui-sref="products" href="../index.php#logins">Logins</a><i class="fa fa-angle-right"></i></li> -->
                        <li><a ui-sref="gallery" href="../index.php#gallery">Gallery</a><i class="fa fa-angle-right"></i></li>
                        <li><a ui-sref="contact" href="../index.php#contact_us">Contact us</a><i class="fa fa-angle-right"></i></li>
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
            Sat Spandana
        </div>
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