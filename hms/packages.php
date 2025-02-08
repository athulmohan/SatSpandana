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

    <!-- ################# Slider Starts Here#######################--->

    <!-- <div class="slider-detail">

            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="1" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>

                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="d-block w-100" src="../assets/images/slider/slider_1.jpg" alt="First slide">
                        <div class="carousel-cover"></div>
                        <div class="carousel-caption vdg-cur d-none d-md-block">
                            <h5 class="animated bounceInDown text-uppercase">Sat Spandana</h5>
                        </div>
                    </div>

                    <div class="carousel-item">
                        <img class="d-block w-100" src="../assets/images/slider/slider_2.jpg" alt="Second slide">
                        <div class="carousel-cover"></div>
                        <div class="carousel-caption vdg-cur d-none d-md-block">
                            <h5 class="animated bounceInDown text-uppercase">Sat Spandana</h5>
                        </div>
                    </div>

                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>


        </div> -->


    <!-- ################# Packages Starts Here #######################--->
    <div id="packages" class="container-fluid py-5">
        <div class="inner-title mb-0">
            <section class="stage">
                <a href="packages.php?param=<?php echo bin2hex('all'); ?>" class="ball bubble" title="Click Me to view All Packages...">
                    All
                </a>
            </section>
            <h2 class="left"><span>SERVICES</span></h2>
            <h2 class="right"><span>Take a look at some</span></h2>
        </div>
        <?php
        if($packageParam === 'all' || $packageParam !== '') {
        ?>
            <section id="physio-package" class="physio-package mt-5">
                <div class="container-fluid">
                    <?php include_once('package-details.php'); ?>
                </div>
            </section>
        <?php }?>
    </div>

    <!-- ################# Footer Starts Here#######################--->
    <footer class="footer mt-5">
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