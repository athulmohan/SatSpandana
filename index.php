<?php
include_once('hms/include/config.php');

// Submit testimonial
if(isset($_POST['testimony_submit'])) {
    $witnessName = $_POST['witness_name'];
    $witnessDesignation = $_POST['witness_designation'];
    $testimony = $_POST['testimony'];
    $rating = $_POST['rating'];

    $errorFileUpload = '';
	if (isset($_FILES['witness_image']['name']) && $_FILES['witness_image']['name'] != '') {
		$uploadDir = "assets/images/testimony/"; // Directory to save the file
	
		// Ensure the upload directory exists
		if (!is_dir($uploadDir)) {
			mkdir($uploadDir, 0777, true);
		}
	
		// Check for errors
		if ($_FILES['witness_image']['error'] !== UPLOAD_ERR_OK) {
			// die("Error during file upload: " . $_FILES['witness_image']['error']);
		}
	
		// Validate file type using MIME types
		$allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
		$fileMimeType = mime_content_type($_FILES['witness_image']['tmp_name']);
		if (!in_array($fileMimeType, $allowedMimeTypes)) {
			// die("Invalid file type. Only JPG, PNG, GIF, and WEBP images are allowed.");
		}
	
		// Validate file extension (optional, adds an extra layer of security)
		$allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
		$fileExtension = strtolower(pathinfo($_FILES['witness_image']['name'], PATHINFO_EXTENSION));
		if (!in_array($fileExtension, $allowedExtensions)) {
			// die("Invalid file extension. Only JPG, PNG, GIF, and WEBP are allowed.");
            $errorFileUpload = "Invalid file extension. Only JPG, PNG, GIF, and WEBP are allowed."; 
		}
	
		// Validate file size (optional, e.g., max 2MB)
		$maxFileSize = 2 * 1024 * 1024; // 2MB
		if ($_FILES['witness_image']['size'] > $maxFileSize) {
			// die("File size exceeds the maximum allowed size of 2MB.");
            $errorFileUpload = "File size exceeds the maximum allowed size of 2MB."; 
		}
	
		// Move the uploaded file to the target directory
		$uploadFile = $uploadDir . basename($_FILES['witness_image']['name']);
		if (move_uploaded_file($_FILES['witness_image']['tmp_name'], $uploadFile)) {
            $filename = basename($_FILES['witness_image']['name']);
			// echo "File successfully uploaded to: " . htmlspecialchars($uploadFile);
		} else {
            $errorFileUpload = "File upload failed."; 
		}
	} else {
        $errorFileUpload = "No file was uploaded."; 
        $filename = '';
	}

    $query=mysqli_query($con,"insert into testimony(image,witness_name,witness_designation,testimony,rating) value('$filename','$witnessName','$witnessDesignation','$testimony','$rating')");

    if($query) {
        $contactMsg = "Testmonial Updated Successfully. ".$errorFileUpload;
        echo "<script>
        const myTimeout = setTimeout(reRoute, 3000);
        function reRoute() {
            window.location.href ='index.php'
        }
        </script>";
    }
}

// Submit Queries
if(isset($_POST['submit']))
{
    $name=$_POST['fullname'];
    $email=$_POST['emailid'];
    $mobileno=$_POST['mobileno'];
    $dscrption=$_POST['description'];
    $query=mysqli_query($con,"insert into tblcontactus(fullname,email,contactno,message) value('$name','$email','$mobileno','$dscrption')");

    if($query) {
        include ('hms/include/send-mail.php');

        // $from = 'satspandanawellness@gmail.com';
        $from = 'admin@satspandana.com';
        $subject = 'Welcome to SatSpandana Wellness';
        $message = '<h1>Thank you for contacting us!</h1>';
        $message .= '<p>We are happy to have you.Your information succesfully submitted. We will get touch with you shortly.</p>';
        $message .= '<p><i>"' . $dscrption . '"</i></p>';

        $submitMsg = "Your information successfully submitted.";

        if(sendEmail($from, $email, $subject, $message)) {
            $contactMsg = "Your information successfully submitted and email sent to you.";
            // echo "<script>console.log('Email Sent ...');</script>";
            echo "<script>
            const myTimeout = setTimeout(reRoute, 2000);
            function reRoute() {
                window.location.href ='index.php'
            }
            </script>";
        } else {
            $contactMsg = "Your information successfully submitted but email not sent.";
            // echo "<script>console.log('Email Not Sent ...');</script>";
            echo "<script>
            const myTimeout = setTimeout(reRoute, 2000);
            function reRoute() {
                window.location.href ='index.php'
            }
            </script>";
        }
    }
} ?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> SatSpandana </title>

    <link rel="shortcut icon" href="assets/images/fav.jpg">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/fontawsom-all.min.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/testimony-style.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/new-testimony-style.css" />
</head>

<body id="main-page">

    <?php if (isset($contactMsg) && !empty($contactMsg)): ?>
        <div id="toast"><?php echo $contactMsg; ?></div>
        <?php 
            include ('hms/include/toast-script.php'); 
        ?>
    <?php endif; ?>
    <!-- <div id="loader" style="display: none;"></div> -->
    <!-- ################# Header Starts Here#######################--->
    <?php include_once('hms/include/website-header.php') ?>

    <!-- ################# Slider Starts Here#######################--->
    <div class="slider-detail">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <div class="d-none d-md-block carousel-marker">
                "HEALTH AND WELLNESS"
            </div>
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="1" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
            </ol>

            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-none d-md-block w-100" src="assets/images/slider/slider_1.jpg" alt="First slide">
                    <img class="d-md-none d-block w-100" src="assets/images/slider/small-screen/slider_1.jpg" alt="First slide">
                    <!-- <div class="carousel-cover"></div> -->
                    <div class="carousel-caption vdg-cur d-none d-md-block service-list">
                        <?php include('hms/include/banner-text.php'); ?>
                    </div>
                </div>

                <div class="carousel-item">
                    <img class="d-none d-md-block w-100" src="assets/images/slider/slider_2.jpg" alt="Second slide">
                    <img class="d-md-none d-block w-100" src="assets/images/slider/small-screen/slider_2.jpg" alt="Second slide">
                    <!-- <div class="carousel-cover"></div> -->
                    <div class="carousel-caption vdg-cur d-none d-md-block service-list">
                        <?php include('hms/include/banner-text.php'); ?>
                    </div>
                </div>

                <div class="carousel-item">
                    <img class="d-none d-md-block w-100" src="assets/images/slider/slider_3.jpg" alt="Third slide">
                    <img class="d-md-none d-block w-100" src="assets/images/slider/small-screen/slider_3.jpg" alt="Third slide">
                    <!-- <div class="carousel-cover"></div> -->
                    <div class="carousel-caption vdg-cur d-none d-md-block service-list">
                        <?php include('hms/include/banner-text.php'); ?>
                    </div>
                </div>

                <div class="carousel-item">
                    <img class="d-none d-md-block w-100" src="assets/images/slider/slider_4.jpg" alt="Fourth slide">
                    <img class="d-md-none d-block w-100" src="assets/images/slider/small-screen/slider_4.jpg" alt="Fourth slide">
                    <!-- <div class="carousel-cover"></div> -->
                    <div class="carousel-caption vdg-cur d-none d-md-block service-list">
                        <?php include('hms/include/banner-text.php'); ?>
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
                <h2>Our Services</h2>
                <p>Our Expertise at a Glance</p>
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

                <a href="hms/packages.php?param=<?php echo bin2hex('Integrated Wellness'); ?>" class="img-container col-lg-4 col-md-6">
                    <img src="assets/images/features/integrated-wellness.jpg" alt="Integrated Wellness" class="image" style="width:100%">
                    <div class="middle">
                        <div class="text">Integrated Wellness</div>
                    </div>
                </a>

                <a href="hms/packages.php?param=<?php echo bin2hex('Corporate Wellness'); ?>" class="img-container col-lg-4 col-md-6">
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
                <img src="assets/images/teams/3.jpeg" class="img-responsive">
            </div>
            <div class="col-sm-6 abut-yoiu">
                <div class="inner-title mb-0">
                    <h2>About Us</h2>
                </div>
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
                        <div class="gallery_product col-lg-2 col-md-4 col-sm-4 col-xs-6 filter <?php echo ($index > 17) ? 'd-none' : ''; ?>">
                            <img src="<?php echo $image; ?>" class="gallery_img img-responsive" onclick="openModal(<?php echo $index; ?>)">
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


    <!--  ************************* Testimony Starts Here ************************** -->

    <!-- view modal for testimonial -->
    <?php include_once('hms/include/view-testimony-modal.php'); ?>

    <section id="testimony" class="mb-5 testimony container">
        <div class="new-testimonial-change">
            <?php 
                $testimonySql=mysqli_query($con,"SELECT * from testimony where status=1"); 
                $testimonyCount=mysqli_num_rows($testimonySql);
                $itemsPerSlide = 3;
                $totalSlides = ceil($testimonyCount / $itemsPerSlide);
            ?>
            <div class="testimonial-section">
                <div class="testimonial-header">
                    <h2>Clients <br> <span>Testimonials</span></h2>
                    <p>
                    SatSpandana beckons the infirm to a haven of profound healing. For those adrift in life's relentless tide, it offers a sacred harbor for the rekindling of body, mind, and spirit.
                    </p>
                    <div class="<?php echo ($testimonyCount > 2) ? 'testimonial-nav' : 'disabled-link testimonial-nav'; ?>">
                        <button id="prevBtn">&#8592;</button>
                        <button id="nextBtn">&#8594;</button>
                    </div>
                    <!-- <a href="#" class="view-more">View More</a> -->
                    <button class="btn btn-secondary addTestimony btn-success" data-toggle="modal" data-target="#addTestimonyModal">Add Testimonials</button>
                    <div class="modal fade" id="addTestimonyModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="addTestimony" aria-hidden="true">
                        <?php include_once('hms/include/add-testimony-modal.php'); ?>
                    </div>
                </div>

                <div class="testimonial-carousel-wrapper">
                    <?php if($testimonyCount > 0) { ?>
                        <div class="testimonial-carousel" id="testimonialCarousel">
                            <!-- Testimonial Item -->
                            <?php
                            $i = 0;
                            while($row=mysqli_fetch_array($testimonySql)) {
                                $i++;
                                $item_additional_style = (($i % 2) == 0) ? 'testimonial-item-even' : 'testimonial-item-odd';
                                $testimonyID = $row['id'];
                                $witnessImage = (isset($row['image']) && $row['image']!=='') ? $row['image'] : 'default-pic.png';
                                $witnessName = $row['witness_name'];
                                $witnessDesignation = $row['witness_designation'];
                                $testimony = $row['testimony'];
                                $rating = $row['rating'];
                                $testimonyImgPath = "assets/images/testimony/".$witnessImage;

                                $displayTestimonial = (strlen(strip_tags($testimony)) > 100) 
                                                ? substr(strip_tags($testimony), 0, 100) . '...' 
                                                : strip_tags($testimony);

                                ?>
                                <div class="testimonial-item <?php echo $item_additional_style; ?>" 
                                    data-name="<?php echo htmlspecialchars($witnessName); ?>"
                                    data-designation="<?php echo htmlspecialchars($witnessDesignation); ?>"
                                    data-testimony="<?php echo htmlspecialchars($testimony); ?>"
                                    data-image="<?php echo $testimonyImgPath; ?>"
                                    data-rating="<?php echo $rating; ?>">
                                        <img src="<?php echo $testimonyImgPath; ?>" alt="<?php echo $witnessName; ?>">
                                        <h3><?php echo $witnessName; ?></h3>
                                        <p class="title"><?php echo $witnessDesignation; ?></p>
                                        <h5 style="color: #555;">Rating: <span style="color: #00ab9f;" id="stars-<?php echo $testimonyID; ?>"></span></h5>
                                        <p style="text-align: justify;"><?php echo $displayTestimonial; ?></p>
                                </div>
                            <?php } ?>

                        </div>
                        <?php } else { ?>
                            <div class="testimonial-notFound">
                                <h4>No Testimonial Found...</h3>
                            </div>
                        <?php } ?>
                </div>
            </div>
        </div>
        <!-- BELOW: OLD TESTIMONIAL SECTION COMMENTED OUT -->
        <div class="d-none">
            <div class="inner-title mb-0">
                <h2>Testimonials</h2>
                <!-- <p>What Others Think About Us.</p> -->
                <p>Words from Our Clients.</p>
            </div>
            
            <?php 
                $testimonySql=mysqli_query($con,"SELECT * from testimony where status=1"); 
                $testimonyCount=mysqli_num_rows($testimonySql);
                $itemsPerSlide = 3;
                $totalSlides = ceil($testimonyCount / $itemsPerSlide);
            ?>

            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                <!-- <button class="btn btn-secondary addTestimony" data-toggle="modal" data-target="#addTestimonyModal">+ Add Testimonials</button>
                <div class="modal fade" id="addTestimonyModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="addTestimony" aria-hidden="true">
                    <?php //include_once('hms/include/add-testimony-modal.php'); ?>
                </div> -->
                <?php if($testimonyCount > 0) { ?>
                    <div id="testimonyCarousel">    
                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                            <?php
                            for($i = 1; $i <= $totalSlides; $i++) {
                            ?>
                                <li data-target="#carousel-example-generic" data-slide-to="<?php echo $i; ?>" class="<?php echo ($i == 1) ? 'active' : '' ?>"></li>
                                <!-- <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                                <li data-target="#carousel-example-generic" data-slide-to="3"></li> -->
                            <?php } ?>
                        </ol>

                        <!-- Wrapper for slides -->
                        <div class="col-md-12 carousel-inner testimony-carousel-inner" role="listbox">
                            <?php 
                                // $result = mysqli_fetch_assoc($testimonySql);
                                // echo "<pre>"; print_r($result);
                                // foreach ($result as $row) { 
                                $j = 0;
                                $counter = 0;
                                echo '<div class="carousel-item active"><div class="row">';
                                while($row=mysqli_fetch_array($testimonySql)) {
                                    $j++;
                                    $testimonyID = $row['id'];
                                    $witnessImage = (isset($row['image']) && $row['image']!=='') ? $row['image'] : 'default-pic.png';
                                    $witnessName = $row['witness_name'];
                                    $witnessDesignation = $row['witness_designation'];
                                    $testimony = $row['testimony'];
                                    $rating = $row['rating'];

                                    $testimonyImgPath = "assets/images/testimony/".$witnessImage;
                                    // $testimonyImgPath = isImagePath($testimonyImgPath) 
                                    // ? $testimonyImgPath 
                                    // : 'assets/images/testimony/default-pic.png';

                                    if ($counter > 0 && $counter % 3 == 0) { // 3 items per slide
                                        echo '</div></div><div class="carousel-item"><div class="row">';
                                    }
                                ?>

                                    <!-- <div class="col-md-4 carousel-item <?php //echo ($j == 1) ? 'active' : '' ?>" id="item-<?php //echo $testimonyID; ?>"> -->
                                        <!-- <button class="btn btn-light delete-button" onclick="deleteTestimony(<?php //echo $testimonyID; ?>)">X</button> -->
                                        <div class="col-md-4 carousel-tiles">
                                            <div class="imgBox animated bounceInRight mb-3" style="animation-delay: 1s">
                                                <img src="<?php echo $testimonyImgPath; ?>" alt="<?php echo $witnessImage; ?>">
                                            </div>
                                            <div class="carousel-caption animated bounceInLeft"  style="animation-delay: 2s">
                                                <input type="hidden" class="id" value="<?php echo $testimonyID; ?>" id="testimonyID-<?php echo $testimonyID; ?>" name="tbl_testimony_id">
                                                <h5 style="color: #555;">Rating: <span id="stars-<?php echo $testimonyID; ?>"></span></h5>
                                                <h5 class="testimony-alter-style"><?php echo $witnessName; ?></h5>
                                                <h5 style="color: #555;"><?php echo $witnessDesignation; ?></h5>
                                                <p class="testimony-alter-style"><i>&#x275D <?php echo $testimony; ?> &#x275E</i></p>
                                            </div>
                                        </div>
                                    <!-- </div> -->

                                    <script>
                                        var rating = <?php echo $rating; ?>;
                                        var starsContainer = document.getElementById('stars-<?php echo $testimonyID; ?>');
                                        var stars = '';

                                        for (var i = 0; i < rating; i++) {
                                            stars += '&#9733;';
                                        }
                                        starsContainer.innerHTML = stars;
                                    </script>
                                    <?php 
                                    $counter++;
                                } 
                            echo '</div></div>'; // Close last slide
                            ?>
                        </div>

                        <!-- Controls -->
                        <a class="carousel-control-prev left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
    <!-- ######## Testimony End ####### -->

    <!--  ************************* Contact Us Starts Here ************************** -->
    <section id="contact_us" class="contact-us-single container">
        <div class="row no-margin">
            <div class="col-sm-12 cop-ck px-0">
                <div class="inner-title mb-0">
                    <h2>Contact Form</h2>
                </div>
                <form method="post">
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
                    <!-- <div class="getInTouch">
                        <h2>Quick Links</h2>
                        <ul class="list-unstyled link-list">
                            <li><a ui-sref="about_us" href="#about_us">About us</a><i class="fa fa-angle-right"></i></li>
                            <li><a ui-sref="services" href="#services">Services</a><i class="fa fa-angle-right"></i></li>
                            <li><a ui-sref="gallery" href="#gallery">Gallery</a><i class="fa fa-angle-right"></i></li>
                            <li><a ui-sref="contact_us" href="#contact_us">Contact us</a><i class="fa fa-angle-right"></i></li>
                        </ul>
                    </div> -->
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
            SatSpandana
        </div>
    </div>
</body>

<script src="assets/js/jquery-3.2.1.min.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/plugins/scroll-nav/js/jquery.easing.min.js"></script>
<script src="assets/plugins/scroll-nav/js/scrolling-nav.js"></script>
<script src="assets/plugins/scroll-fixed/jquery-scrolltofixed-min.js"></script>
<script src="https://cdn.tiny.cloud/1/d2v0midup7lpvowewkee6om89twgjbeveofkrrpwsc5z7gm7/tinymce/6/tinymce.min.js"></script>
<script src="assets/js/script.js"></script>
<script src="assets/js/testimony-script.js"></script>
<script src="assets/js/new-testimony-script.js"></script>

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