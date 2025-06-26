<?php
session_start();
// error_reporting(0);
include('include/config.php');
if(strlen($_SESSION['id']==0)) {
 header('location:logout.php');
  } else{

$id=intval($_GET['id']);// get stay id
if(isset($_POST['submit']))
{
	$name=$_POST['stayNames'];
    $caption=$_POST['captions'];
    $feature=mysqli_real_escape_string($con, $_POST['features']);
    $description=mysqli_real_escape_string($con, $_POST['descriptions']);
    $successCount = 0;
    $errorCount = 0;
    $serilalizedImageList = [];

    if (isset($_FILES['files']['name']) && count($_FILES['files']['name']) > 0) {

        for ($i = 0; $i < count($_FILES['files']['name']); $i++) {
            $fileName = $_FILES['files']['name'][$i];
            $fileTmpName = $_FILES['files']['tmp_name'][$i];
            $fileError = $_FILES['files']['error'][$i];

            if ($fileError === 0) {
                $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
                $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];

                if (in_array(strtolower($fileExtension), $allowedExtensions)) {
                    $rephaseName = str_replace(' ', '_', $name);
                    $newFileName = uniqid($rephaseName.'_', true) . '.' . $fileExtension;
                    $fileDestination = '../../assets/images/accommodations/' . $newFileName;

                    // Ensure the uploads folder exists
                    if (!is_dir('../../assets/images/accommodations')) {
                        mkdir('../../assets/images/accommodations', 0777, true);
                    }

                    // Move file to the destination
                    if (move_uploaded_file($fileTmpName, $fileDestination)) {
                        // Save file info into a list and serializing
                        array_push($serilalizedImageList, $newFileName);
                        $successCount++;
                    } else {
                        $msg = "<p>Failed to upload {$fileName}.</p>";
                        $errorCount++;
                    }
                } else {
                    $msg = "<p>{$fileName} has an invalid file type.</p>";
                    $errorCount++;
                }
            } else {
                $msg = "<p>Error uploading {$fileName}.</p>";
                $errorCount++;
            }
        }
        $serializedData = str_replace('"', "'", json_encode($serilalizedImageList));
    } else {
        $serializedData = $_POST['oldImages'];
    }
    
    $sql=mysqli_query($con,
        'UPDATE `accommodations` SET `name`="'.$name.'",`caption`="'.$caption.'",`feature`="'.$feature.'",`description`="'.$description.'", `images`="'.$serializedData.'" WHERE `id`="'.$id.'"'
    );
    if($sql) {
        $msg = " Accommodation Updated successfully";
        echo "<script>
        const myTimeout = setTimeout(reRoute, 2000);
        function reRoute() {
            window.location.href ='manage-accommodations.php'
        }
        </script>";
    } else {
        $errorCount++;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin | Edit Accommodation Details</title>

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
    <!-- <script type="text/javascript">
		bkLib.onDomLoaded(nicEditors.allTextAreas);
	</script> -->

</head>

<body>
    <?php if (isset($msg) && !empty($msg)): ?>
        <div id="toast"><?php echo $msg; ?></div>
        <?php 
            include ('../include/toast-script.php'); 
        ?>
    <?php endif; ?>
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
                                <h1 class="mainTitle">Admin | Edit Accommodation Details</h1>
                            </div>
                            <ol class="breadcrumb">
                                <li>
                                    <span>Admin</span>
                                </li>
                                <li class="active">
                                    <span>Edit Accommodation Details</span>
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
                                                <h5 class="panel-title">Edit Accommodation info</h5>
                                            </div>
                                            <div class="panel-body">
                                                <?php $sql=mysqli_query($con,"select * from accommodations where id='$id'");
												while($data=mysqli_fetch_array($sql))
												{
                                                    $unSerilazedImages = json_decode(str_replace("'", '"', $data['images']));
												?>
													<h4><?php echo htmlentities($data['name']);?>'s Details</h4>
													<p><b>Accommodation Reg. Date:
														</b><?php echo htmlentities($data['creationDate']);?></p>
													<?php if($data['updationDate']){?>
													<p><b>Accommodation Last Updation Date:
														</b><?php echo htmlentities($data['updationDate']);?></p>
													<?php } ?>
													<hr />
													<form role="form" name="editStay" method="post" onSubmit="return valid();"
                                                    enctype="multipart/form-data">
                                                    <div id="editAccommodationList">
                                                        <div class="mb-3 accommodationList">
                                                            <div class="form-group">
                                                                <label for="stayNames">
                                                                    Accommodation Name
                                                                </label>
                                                                <input type="text" name="stayNames" id="stayNames" class="form-control"
                                                                    placeholder="Enter Accommodation Name" required="true" value="<?php echo htmlentities($data['name']);?>">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="captions">
                                                                    Captions
                                                                </label>
                                                                <input type="text" name="captions" id="captions" class="form-control"
                                                                    placeholder="Enter Caption Statement" value="<?php echo htmlentities($data['caption']);?>">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="features">
                                                                    Features
                                                                </label>
                                                                <textarea class="form-control" name="features" id="features"
                                                                rows="12"><?php echo htmlentities($data['feature']); ?></textarea>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="descriptions">
                                                                    Descriptions
                                                                </label>
                                                                <textarea name="descriptions" class="form-control" id="descriptions"
                                                                    placeholder="Enter Description" rows="3"><?php echo htmlentities($data['description']); ?></textarea>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="files[]">
                                                                    Upload Images
                                                                </label>
                                                                <input type="file" name="files[]" class="form-control"
                                                                    placeholder="Upload Profile Pic" accept="image/*" multiple>
                                                                <input type="hidden" name="oldImages" value="<?php echo htmlentities($data['images']);?>">
                                                            </div>
                                                            <?php
                                                            if(isset($unSerilazedImages) && sizeof($unSerilazedImages) > 0) { ?>
                                                                <div class="form-group">
                                                                    <button class="btn btn-primary w-100 text-start" type="button" data-toggle="collapse" data-target="#toggleItem1" aria-expanded="false" aria-controls="toggleItem1">
                                                                            View Uploaded Images
                                                                    </button>
                                                                    <div class="collapse mt-2" id="toggleItem1">
                                                                        <ol class="card card-body img-list">
                                                                        <?php 
                                                                        foreach ($unSerilazedImages as $i => $image) { ?>
                                                                            <li class="stay-img-list mt-3">
                                                                                <a href="<?php echo '../../assets/images/accommodations/' . $image; ?>" target="_blank">Image <?php echo $i+1; ?></a>
                                                                            </li>
                                                                        <?php } ?>
                                                                        </ol>
                                                                    </div>
                                                                </div>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="submit" name="submit" id="submit"
                                                            class="btn btn-o btn-primary">
                                                            Submit
                                                        </button>
                                                    </div>
                                                </form>
                                                <?php } ?>
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
        <script src="../assets/js/tinymce/tinymce.min.js"></script>
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