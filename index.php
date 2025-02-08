<?php
include_once('hms/include/config.php');
if(isset($_POST['submit']))
{
    $name=$_POST['fullname'];
    $email=$_POST['emailid'];
    $mobileno=$_POST['mobileno'];
    $dscrption=$_POST['description'];
    $query=mysqli_query($con,"insert into tblcontactus(fullname,email,contactno,message) value('$name','$email','$mobileno','$dscrption')");
    echo "<script>alert('Your information succesfully submitted');</script>";
    echo "<script>window.location.href ='index.php'</script>";

} ?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> Sat Spandana </title>

    <link rel="shortcut icon" href="assets/images/fav.jpg">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/fontawsom-all.min.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css" />
</head>

<body id="main-page">

    <!-- ################# Header Starts Here#######################--->

    <header id="menu-jk">
        <div id="nav-head" class="header-nav">
            <div class="container">
                <div class="row">
                    <div class="col-lg-2 col-md-3 col-sm-12">
                        <a href="javascript:void(0);">
                            <img src="assets/images/satspandana-logo-png.png" alt="SAT SPANDANA">
                            <!-- <div class="col-lg-2 col-md-3  col-sm-12" style="color:#000;font-weight:bold; font-size:42px; margin-top: 1% !important;">SPANDANA
                            <a data-toggle="collapse" data-target="#menu" href="#menu" ><i class="fas d-block d-md-none small-menu fa-bars"></i></a>
                            </div> -->
                        </a>
                    </div>
                    <div id="menu" class="col-lg-8 col-md-9 d-none d-md-block nav-item">
                        <ul>
                            <li><a href="#">Home</a></li>
                            <li><a href="#services">Services</a></li>
                            <li><a href="#about_us">About Us</a></li>
                            <li><a href="#gallery">Gallery</a></li>
                            <li><a href="#contact_us">Contact Us</a></li>
                            <!-- <li><a href="#">Packages</a></li> -->
                            <!-- <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                    aria-expanded="false">Logins <span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="hms/user-login.php">Patient Login</a></li>
                                    <li><a href="hms/doctor">Doctors Login</a></li>
                                    <li><a href="hms/admin">Admin Login</a></li>
                                </ul>
                            </li> -->
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

    <!-- ################# Slider Starts Here#######################--->

    <div class="slider-detail">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="1" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>

            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="assets/images/slider/slider_1.jpg" alt="First slide">
                    <div class="carousel-cover"></div>
                    <div class="carousel-caption vdg-cur d-none d-md-block service-list">
                        <span class="animated bounceInDown text-uppercase service-item">WELLNESS</span>
                        <span class="animated bounceInDown text-uppercase service-item">PHYSIOTHERAPY</span>
                        <span class="animated bounceInDown text-uppercase service-item">YOGA</span>
                        <span class="animated bounceInDown text-uppercase service-item">AYURVEDA</span>
                    </div>
                </div>

                <div class="carousel-item">
                    <img class="d-block w-100" src="assets/images/slider/slider_2.jpg" alt="Second slide">
                    <div class="carousel-cover"></div>
                    <div class="carousel-caption vdg-cur d-none d-md-block service-list">
                        <span class="animated bounceInDown text-uppercase service-item">WELLNESS</span>
                        <span class="animated bounceInDown text-uppercase service-item">PHYSIOTHERAPY</span>
                        <span class="animated bounceInDown text-uppercase service-item">YOGA</span>
                        <span class="animated bounceInDown text-uppercase service-item">AYURVEDA</span>
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
    </div>

    <!--  ************************* Logins ************************** -->


    <section id="logins" class="d-none our-blog container-fluid">
        <div class="container">
            <div class="inner-title">
                <h2>Logins</h2>
            </div>
            <div class="col-sm-12 blog-cont">
                <div class="row no-margin">
                    <div class="col-sm-4 blog-smk">
                        <div class="blog-single">
                            <img src="assets/images/patient.jpg" alt="">
                            <div class="blog-single-det">
                                <h6>Patient Login</h6>
                                <a href="hms/user-login.php" target="_blank">
                                    <button class="btn btn-success btn-sm">Click Here</button>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 blog-smk">
                        <div class="blog-single">

                            <img src="assets/images/doctor.jpg" alt="">

                            <div class="blog-single-det">
                                <h6>Doctors login</h6>
                                <a href="hms/doctor" target="_blank">
                                    <button class="btn btn-success btn-sm">Click Here</button>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4 blog-smk">
                        <div class="blog-single">

                            <img src="assets/images/admin.jpg" alt="">

                            <div class="blog-single-det">
                                <h6>Admin Login</h6>

                                <a href="hms/admin" target="_blank">
                                    <button class="btn btn-success btn-sm">Click Here</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>


    <!-- ################# Our Departments Starts Here#######################--->

    <section id="services" class="key-features department">
        <div class="container-fluid">
            <div class="inner-title">

                <h2>Our Key Features</h2>
                <p>Take a look at some of our key features</p>
            </div>

            <div class="row">
                <a href="hms/packages.php?param=<?php echo bin2hex('physiotherapy'); ?>" class="img-container col-lg-4 col-md-6">
                    <img src="assets/images/features/physio.jpg" alt="Physiotherapy" class="image" style="width:100%">
                    <div class="middle">
                        <div class="text">Physiotherapy</div>
                    </div>
                </a>

                <a href="hms/packages.php?param=<?php echo bin2hex('ayurveda'); ?>" class="img-container col-lg-4 col-md-6">
                    <img src="assets/images/features/ayurveda.jpeg" alt="Ayurveda" class="image" style="width:100%">
                    <div class="middle">
                        <div class="text">Ayurveda</div>
                    </div>
                </a>

                <a href="hms/packages.php?param=<?php echo bin2hex('fitness'); ?>" class="img-container col-lg-4 col-md-6">
                    <img src="assets/images/features/fitness.jpeg" alt="Fitness" class="image" style="width:100%">
                    <div class="middle">
                        <div class="text">Fitness</div>
                    </div>
                </a>

                <a href="hms/packages.php?param=<?php echo bin2hex('int-wellness'); ?>" class="img-container col-lg-4 col-md-6">
                    <img src="assets/images/features/integrated-wellness.jpg" alt="Integrated Wellness" class="image" style="width:100%">
                    <div class="middle">
                        <div class="text">Integrated Wellness</div>
                    </div>
                </a>

                <a href="hms/packages.php?param=<?php echo bin2hex('corp-wellness'); ?>" class="img-container col-lg-4 col-md-6">
                    <img src="assets/images/features/corporate-wellness.jpeg" alt="Corporate Wellness" class="image" style="width:100%">
                    <div class="middle">
                        <div class="text">Corporate Wellness</div>
                    </div>
                </a>

                <a href="hms/packages.php?param=<?php echo bin2hex('yoga'); ?>" class="img-container col-lg-4 col-md-6">
                    <img src="assets/images/features/yoga.jfif" alt="Yoga" class="image" style="width:100%">
                    <div class="middle">
                        <div class="text">Yoga</div>
                    </div>
                </a>

                <!-- <div class="background-img-physio img-responsive col-lg-4 col-md-6">
                    <div class="single-key">
                        <i class="fas fa-cannabis"></i>
                        <h5>Physiotherapy</h5>
                    </div>
                </div> -->

                <!-- <div class="background-img-ayur img-responsive col-lg-4 col-md-6">
                    <div class="single-key">
                        <i class="fas fa-mortar-pestle"></i>
                        <h5>Ayurveda</h5>
                    </div>
                </div>

                <div class="background-img img-responsive col-lg-4 col-md-6">
                    <div class="single-key">
                        <i class="fas fa-heart"></i>
                        <h5>Fitness</h5>
                    </div>
                </div>

                <div class="background-img img-responsive col-lg-4 col-md-6">
                    <div class="single-key">
                        <i class="fas fa-spa"></i>
                        <h5>Integrated Wellness</h5>
                    </div>
                </div>

                <div class="background-img img-responsive col-lg-4 col-md-6">
                    <div class="single-key">
                        <i class="fas fa-prescription-bottle-alt"></i>
                        <h5>Corporate Wellness</h5>
                    </div>
                </div>
                <div class="background-img img-responsive col-lg-4 col-md-6">
                    <div class="single-key">
                        <i class="far fa-thumbs-up"></i>
                        <h5>Yoga</h5>
                    </div>
                </div> -->
            </div>
        </div>
    </section>

    <!--  ************************* About Us Starts Here ************************** -->

    <section id="about_us" class="about-us">
        <div class="row no-margin">
            <div class="col-sm-6"> <!-- image-bg no-padding -->
                <img src="assets/images/aboutUs-03.jpg" class="img-responsive">
            </div>
            <div class="col-sm-6 abut-yoiu">
                <h3>About Us</h3>
                <?php
                    $ret=mysqli_query($con,"select * from tblpage where PageType='aboutus' ");
                    while ($row=mysqli_fetch_array($ret)) {
                    ?>
                <p><?php  echo $row['PageDescription'];?>.</p><?php } ?>
            </div>
        </div>
    </section>


    <!--  ************************* Gallery Starts Here ************************** -->
    <div id="gallery" class="gallery">
        <div class="container">
            <div class="inner-title">

                <h2>Our Gallery</h2>
                <p>View Our Gallery</p>
            </div>
            <div class="row">
                <!-- <div class="gallery-filter d-none d-sm-block">
                    <button class="btn btn-default filter-button" data-filter="all">All</button>
                    <button class="btn btn-default filter-button" data-filter="ayur">Ayurveda</button>
                    <button class="btn btn-default filter-button d-none" data-filter="corpWell">Corporate Wellness</button>
                    <button class="btn btn-default filter-button d-none" data-filter="cosWell">Integrated Wellness</button>
                    <button class="btn btn-default filter-button d-none" data-filter="fitness">Fitness</button>
                    <button class="btn btn-default filter-button" data-filter="physio">Physiotherapy</button>
                    <button class="btn btn-default filter-button" data-filter="yoga">Yoga</button>
                    <button class="btn btn-default filter-button" data-filter="events">Events</button>
                </div> 
                <br /> -->
                <?php
                    $galleryImages = glob('assets/images/gallery/*.{jpg,jpeg,png,gif,bmp,webp}', GLOB_BRACE);
                    $totalGalleryImgCount = count($galleryImages);
                    foreach ($galleryImages as $index => $image) {
                    ?>
                        <div class="gallery_product col-lg-2 col-md-4 col-sm-4 col-xs-6 filter">
                            <img src="<?php echo $image; ?>" class="gallery_img img-responsive <?php echo ($index > 17) ? 'd-none' : ''; ?>" onclick="openModal(<?php echo $index; ?>)">
                        </div>
                    <?php
                    } 
                ?>
            </div>
        </div>
    </div>
    <!-- Modal for Viewing Image with Navigation -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content content-modal">
                <div class="modal-body text-center position-relative">
                    <button class="modal-nav prev" onclick="changeImage(-1)">&#10094;</button>
                    <img id="modalImage" src="" class="img-fluid">
                    <button class="modal-nav next" onclick="changeImage(1)">&#10095;</button>
                </div>
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="closeModel()">Close</button>
                </div> -->
            </div>
        </div>
    </div>
    <!-- ######## Gallery End ####### -->


    <!--  ************************* Contact Us Starts Here ************************** -->

    <section id="contact_us" class="contact-us-single container">
        <div class="row no-margin">
            <div class="col-sm-12 cop-ck px-0">
                <form method="post">
                    <h2>Contact Form</h2>
                    <div class="row cf-ro">
                        <div class="col-sm-3"><label>Enter Name :</label></div>
                        <div class="col-sm-8"><input type="text" placeholder="Enter Name" name="fullname"
                                class="form-control input-sm" required></div>
                    </div>
                    <div class="row cf-ro">
                        <div class="col-sm-3"><label>Email Address :</label></div>
                        <div class="col-sm-8"><input type="text" name="emailid" placeholder="Enter Email Address"
                                class="form-control input-sm" required></div>
                    </div>
                    <div class="row cf-ro">
                        <div class="col-sm-3"><label>Mobile Number:</label></div>
                        <div class="col-sm-8"><input type="text" name="mobileno" placeholder="Enter Mobile Number"
                                class="form-control input-sm" required></div>
                    </div>
                    <div class="row cf-ro">
                        <div class="col-sm-3"><label>Enter Message:</label></div>
                        <div class="col-sm-8">
                            <textarea rows="5" placeholder="Enter Your Message" class="form-control input-sm"
                                name="description" required></textarea>
                        </div>
                    </div>
                    <div class="row cf-ro">
                        <div class="col-sm-3"><label></label></div>
                        <div class="col-sm-8">
                            <button class="btn btn-success btn-sm" type="submit" name="submit">Send Message</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </section>
    <!-- ################# Footer Starts Here#######################--->
    <footer class="footer mt-5">
        <div class="container">
            <div class="row">

                <div class="col-md-6 col-sm-12">
                    <div class="quickLinks">
                        <h2>Quick Links</h2>
                        <ul class="list-unstyled link-list">
                            <li><a ui-sref="about_us" href="#about_us">About us</a><i class="fa fa-angle-right"></i></li>
                            <li><a ui-sref="services" href="#services">Services</a><i class="fa fa-angle-right"></i></li>
                            <li><a ui-sref="gallery" href="#gallery">Gallery</a><i class="fa fa-angle-right"></i></li>
                            <li><a ui-sref="contact_us" href="#contact_us">Contact us</a><i class="fa fa-angle-right"></i></li>
                        </ul>
                    </div>
                    <div class="getInTouch">
                        <h2>Quick Links</h2>
                        <ul class="list-unstyled link-list">
                            <li><a ui-sref="about_us" href="#about_us">About us</a><i class="fa fa-angle-right"></i></li>
                            <li><a ui-sref="services" href="#services">Services</a><i class="fa fa-angle-right"></i></li>
                            <li><a ui-sref="gallery" href="#gallery">Gallery</a><i class="fa fa-angle-right"></i></li>
                            <li><a ui-sref="contact_us" href="#contact_us">Contact us</a><i class="fa fa-angle-right"></i></li>
                        </ul>
                    </div>
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

<script src="assets/js/jquery-3.2.1.min.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/plugins/scroll-nav/js/jquery.easing.min.js"></script>
<script src="assets/plugins/scroll-nav/js/scrolling-nav.js"></script>
<script src="assets/plugins/scroll-fixed/jquery-scrolltofixed-min.js"></script>

<script src="assets/js/script.js"></script>

<script>
    let currentIndex = 0;
    let images = [];

    $(document).ready(function () {
        var galleryPdtList = document.getElementsByClassName('gallery_img');
        for (i = 0; i < galleryPdtList.length; i++) {
            images.push(galleryPdtList[i].getAttribute("src"));
        }
    });

    function openModal(index) {
        currentIndex = index;
        document.getElementById('modalImage').src = images[currentIndex];
        var myModal = new bootstrap.Modal(document.getElementById('imageModal'));
        myModal.show();
    }
    function closeModel() {
        // var modalEl = document.getElementById("imageModal");
        // var modalInstance = bootstrap.Modal.getInstance(modalEl);
        // modalInstance.hide();
        var myModal = new bootstrap.Modal(document.getElementById('imageModal'));
        myModal.hide();
    }

    function changeImage(direction) {
        currentIndex += direction;
        if (currentIndex < 0) {
            currentIndex = images.length - 1;
        } else if (currentIndex >= images.length) {
            currentIndex = 0;
        }
        document.getElementById('modalImage').src = images[currentIndex];
    }
</script>

</html>