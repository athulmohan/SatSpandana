<?php
session_start();
// error_reporting(0);
include('include/config.php');
if(strlen($_SESSION['id']==0)) {
 header('location:logout.php');
} else {

if(isset($_GET['del']) && isset($_GET['img']))
{
	$docid=$_GET['id'];
    $imageToDelete = base64_decode($_GET['img']);

    if (file_exists($imageToDelete)) {
        unlink($imageToDelete);
        $msg= "Image deleted successfully!";
    } else {
        $errMsg= "Image not found";
    }

    echo "<script>
    const myTimeout = setTimeout(reRoute, 3000);
    function reRoute() {
        window.location.href ='manage-gallery.php'
    }
    </script>";
}

if(isset($_POST['submit']))
{
    $successCount = 0;
    $errorCount = 0;
    $errMsg1 = '';
    $errMsg2 = '';
    $errMsg3 = '';
    if (isset($_FILES['files']['name'])) {

        for ($i = 0; $i < count($_FILES['files']['name']); $i++) {
            $fileName = $_FILES['files']['name'][$i];
            $fileTmpName = $_FILES['files']['tmp_name'][$i];
            $fileError = $_FILES['files']['error'][$i];

            if ($fileError === 0) {
                $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
                $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

                if (in_array(strtolower($fileExtension), $allowedExtensions)) {
                    // $newFileName = uniqid('gallery_', true) . '.' . $fileExtension;
                    $fileDestination = '../../assets/images/gallery/' . basename($fileName);

                    // Ensure the uploads folder exists
                    if (!is_dir('../../assets/images/gallery')) {
                        mkdir('../../assets/images/gallery', 0777, true);
                    }

                    // Move file to the destination
                    if (move_uploaded_file($fileTmpName, $fileDestination)) {
                        $successCount++;
                    } else {
                        $errMsg1 = "\n. <p style='font-size: 14px'>Reason: Failed to upload {$fileName}.</p>";
                        $errorCount++;
                    }
                } else {
                    $errMsg2 = "\n. <p style='font-size: 14px'>Reason: {$fileName} has an invalid file type.</p>";
                    $errorCount++;
                }
            } else {
                $errMsg3 = "\n. <p style='font-size: 14px'>Reason: Error uploading {$fileName}.</p>";
                $errorCount++;
            }
        }
    }

    $msg = $successCount . " Images Added to Gallery.";
    $errMsg = nl2br($errorCount . " Images failed to Add. ".$errMsg1.$errMsg2.$errMsg3);
    echo "<script>
    const myTimeout = setTimeout(reRoute, 3000);
    function reRoute() {
        window.location.href ='manage-gallery.php'
    }
    </script>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin | Add Gallery</title>

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
                                <h1 class="mainTitle">Admin | Add Gallery</h1>
                            </div>
                            <ol class="breadcrumb">
                                <li>
                                    <span>Admin</span>
                                </li>
                                <li class="active">
                                    <span>Add Gallery</span>
                                </li>
                            </ol>
                        </div>
                    </section>
                    <!-- end: PAGE TITLE -->
                    <!-- start: BASIC EXAMPLE -->
                    <div class="container-fluid container-fullw bg-white">
                        <div class="row">
                            <div class="col-md-12">
                                <?php if($msg) { ?>
                                    <h5 style="color: green; font-size:16px; ">
                                        <?php if($msg) { echo ($msg);}?>
                                    </h5>
                                <?php } ?>
                                <?php if($errMsg) { ?>
                                    <h5 style="color: red; font-size:16px; ">
                                        <?php if($errMsg) { echo ($errMsg);}?>
                                    </h5>
                                <?php } ?>
                                <div class="row margin-top-30">
                                    <div class="col-lg-8 col-md-12">
                                        <div class="panel panel-white">
                                            <div class="panel-heading">
                                                <h5 class="panel-title">Add Gallery</h5>
                                            </div>
                                            <div class="panel-body">
                                                <form role="form" name="addGallery" method="post"
                                                    onSubmit="return valid();" enctype="multipart/form-data">
                                                    <div class="form-group">
                                                        <label for="files[]">
                                                            Upload Images
                                                        </label>
                                                        <input type="file" name="files[]" class="form-control"
                                                            placeholder="Upload Gallery Pics" accept="image/*" multiple>
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="submit" name="submit" id="submit"
                                                            class="btn btn-o btn-primary">
                                                            Submit
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="panel panel-white">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h5 class="over-title margin-bottom-15 padding-15">Manage <span
                                                    class="text-bold">Gallery</span>
                                            </h5>
                                            <p style="color:red;"><?php echo htmlentities($_SESSION['msg']);?>
                                                <?php echo htmlentities($_SESSION['msg']="");?></p>
                                            <table class="table table-hover" id="sample-table-1">
                                                <thead>
                                                    <tr>
                                                        <th class="center">#</th>
                                                        <th>Images</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $galleryImages = glob('../../assets/images/gallery/*.{jpg,jpeg,png,gif,bmp,webp}', GLOB_BRACE);
                                                    $cnt=1;
                                                    foreach ($galleryImages as $index => $image) {
                                                    ?>
                                                    <tr>
                                                        <td class="center"><?php echo $cnt;?>.</td>
                                                        <td>
                                                            <a data-toggle="collapse" data-target="#collapse_<?php echo $index;?>" role="button" aria-expanded="false" aria-controls="collapseExample"
                                                            href="javascript:void(0);" id="gallery_img_<?php echo $index; ?>" class="gallery_img img-responsive">
                                                                IMAGE-<?php echo $cnt;?>
                                                            </a>
                                                            <div class="collapse" id="collapse_<?php echo $index;?>" style="text-align: center;">
                                                                <img src="<?php echo $image; ?>" height="auto" width="150px">
                                                                <input type="hidden" name="selected_img" value="<?php echo $image; ?>">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="visible-md visible-lg visible-sm visible-xs">
                                                                <a href="manage-gallery.php?id=<?php echo $cnt; ?>&del=delete&img=<?php echo base64_encode($image); ?>"
                                                                    onClick="return confirm('Are you sure you want to delete?')"
                                                                    class="btn btn-transparent btn-xs tooltips"
                                                                    tooltip-placement="top" tooltip="Remove"><i
                                                                        class="fa fa-times fa fa-white"></i></a>
                                                            </div>
                                                            <div class="hidden-xs hidden-sm hidden-md hidden-lg">
                                                                <div class="btn-group" dropdown is-open="status.isopen">
                                                                    <button type="button"
                                                                        class="btn btn-primary btn-o btn-sm dropdown-toggle"
                                                                        dropdown-toggle>
                                                                        <i class="fa fa-cog"></i>&nbsp;<span
                                                                            class="caret"></span>
                                                                    </button>
                                                                    <ul class="dropdown-menu pull-right dropdown-light"
                                                                        role="menu">
                                                                        <!-- <li>
                                                                <a href="#">
                                                                    Edit
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="#">
                                                                    Share
                                                                </a>
                                                            </li> -->
                                                                        <li>
                                                                            <a href="#">
                                                                                Remove
                                                                            </a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <?php 
                                                        $cnt=$cnt+1;
											        }?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
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
    <script src="../../assets/js/bootstrap.min.js"></script>
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