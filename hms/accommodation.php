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

    <div id="our-homestays" class="container mt-5">
        <div class="inner-title mb-0">
            <h2 class="left"><span>HOMESTAYS</span></h2>
            <h2 class="right"><span>Our Homestays: Your Retreat to Serenity</span></h2>
        </div>
        <?php
            $ret=mysqli_query($con,"select * from  accommodations");
            while ($row=mysqli_fetch_array($ret)) {
            $unSerilazedImages = json_decode(str_replace("'", '"', $row['images']));
            $rephraseName = str_replace(' ', '_', $row['name']);
            
            $folder = "../assets/images/accommodations/"; // Specify your folder path
            $prefix = $rephraseName . "_"; // Specify the prefix
            $getFiles = glob($folder . $prefix . "*"); // Get files matching the pattern
        ?>
            <div class="profile-card">
                <!-- Left Section: Text -->
                <div class="<?php (isset($unSerilazedImages) && isset($getFiles) && !empty($getFiles)) ? 'col-md-6' : 'col-md-12' ?> profile-details">
                    <h1 class="profile-title"><?php echo $row['name']; ?></h1>
                    <h2 class="profile-subtitle"><?php echo $row['caption']; ?></h2>
                    <p class="profile-description">
                        <?php echo $row['feature']; ?>
                    </p>
                    <p class="profile-description">
                        <?php echo $row['description']; ?>
                    </p>
                </div>

                <!-- Right Section: Image -->
                <?php if(isset($unSerilazedImages) && isset($getFiles) && !empty($getFiles)) { ?>
                    <div class="slider-detail col-md-6 position-relative ">
                        <div class="carouselSliderChanges" id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                            <div class="row">
                                <?php
                                    foreach ($unSerilazedImages as $index => $image) {
                                    ?>
                                        <div class="accommodation_img_list gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter">
                                            <img src="<?php echo '../assets/images/accommodations/'.$image; ?>" class="accommodation_img gallery_img img-responsive <?php echo ($index > 6) ? 'd-none' : ''; ?>" onclick="openModal(<?php echo $index; ?>)">
                                        </div>
                                    <?php
                                    } 
                                ?>
                                <!-- <ol class="carousel-indicators">
                                    <?php 
                                    // foreach ($unSerilazedImages as $i => $image) { 
                                    //     $activeClass = ($i === 0) ? "active" : "";
                                        ?>
                                        <li data-target="#carouselExampleIndicators" data-slide-to="<?php //echo $i; ?>" class="<?php //echo $activeClass; ?>"></li>
                                    <?php //} ?>
                                </ol>
                                <div class="carousel-inner">
                                    <?php 
                                        // foreach ($unSerilazedImages as $i => $image) { 
                                        //     $activeClass = ($i === 0) ? "active" : "";
                                        ?>
                                        <div class="carousel-item <?php //echo $activeClass; ?>">
                                            <a href="<?php //echo '../assets/images/accommodations/' . $image; ?>" target="_blank">
                                                <img class="d-block w-100" src="<?php //echo '../assets/images/accommodations/' . $image; ?>" alt="<?php //echo 'Slide-'. $i; ?>">
                                                <div class="carousel-cover"></div>
                                            </a>
                                        </div>
                                    <?php //} ?>
                                </div>
                                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a> -->
                            </div>
                        </div>
                    </div>
                <?php } ?>
                
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
<script src="../assets/js/script.js"></script>

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