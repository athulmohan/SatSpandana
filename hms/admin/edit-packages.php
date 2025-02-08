<?php
session_start();
error_reporting(0);
include('include/config.php');
if(strlen($_SESSION['id']==0)) {
	header('location:logout.php');
} else {

$did=intval($_GET['id']);// get package id
if(isset($_POST['submit']))
{
	$specialization = $_POST['specialization'];
    $treatmentName = $_POST['treatmentName'];
    $description = $_POST['description'];
    $packageNames = $_POST['packageNames'];
    $days = $_POST['days'];
    $without = $_POST['without'];
    $singleOccupancy = $_POST['singleOccupancy'];
    $doubleOccupancy = $_POST['doubleOccupancy'];

    $packageSql=mysqli_query($con,"Update packages set specialization='$specialization',treatmentName='$treatmentName',description='$description' where id='$did'");
	if($packageSql > 0) {
		$deletePackageSql=mysqli_query($con,"DELETE FROM `packagedetails` WHERE package_id='$did'");
        
		if($deletePackageSql > 0) {
			foreach ($packageNames as $i => $name) {
				
				$sql=mysqli_query($con,'insert into packagedetails(package_id,packageName,days,without,singleOccupancy,doubleOccupancy) 
				values("'.$did.'","'.$packageNames[$i].'","'.(int) $days[$i].'","'.$without[$i].'","'.$singleOccupancy[$i].'","'.$doubleOccupancy[$i].'")');
				
				if($sql > 0)
				{
					$msg = "Package Updated successfully";
					echo "<script>
					const myTimeout = setTimeout(reRoute, 2000);
					function reRoute() {
						window.location.href ='manage-packages.php'
					}
					</script>";
				}
			}
		}
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin | Edit Package Details</title>

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


</head>

<body>
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
                                <h1 class="mainTitle">Admin | Edit Package Details</h1>
                            </div>
                            <ol class="breadcrumb">
                                <li>
                                    <span>Admin</span>
                                </li>
                                <li class="active">
                                    <span>Edit Package Details</span>
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
                                                <h5 class="panel-title">Edit Package info</h5>
                                            </div>
                                            <div class="panel-body">
                                                <?php 
												$sql=mysqli_query($con,"select * from packages where id='$did'");
												$detailsSql=mysqli_query($con,"select * from packagedetails where package_id='$did'");
												
												while($data=mysqli_fetch_array($sql))
												{
												?>
                                                <h4><?php echo htmlentities($data['treatmentName']);?></h4>
                                                <p><b>Reg. Date:</b>
													<?php echo htmlentities($data['creationDate']);?>
												</p>
                                                <?php if($data['updationDate']){?>
                                                <p><b>Last Updation Date:
                                                    </b><?php echo htmlentities($data['updationDate']);?></p>
                                                <?php } ?>
                                                <hr />
                                                <form role="form" name="editPackages" method="post" onSubmit="return valid();"
                                                    enctype="multipart/form-data">
                                                    <div id="editPackageList">
                                                        <div class="mb-3 accommodationList packageList">
                                                            <div class="form-group">
                                                                <label for="specialization">
                                                                    Specialization
                                                                </label>
                                                                <select name="specialization" class="form-control"
                                                                    required="true">
                                                                    <!-- <option value="<?php //echo htmlentities($data['specilization']);?>">
																		<?php //echo htmlentities($data['specilization']);?>
																	</option> -->
                                                                    <?php $ret=mysqli_query($con,"select * from doctorspecilization");
                                                                    while($row=mysqli_fetch_array($ret))
                                                                    {
                                                                    ?>
                                                                    <option value="<?php echo htmlentities($row['specilization']);?>"
																		<?php echo (htmlentities($data['specilization']) === htmlentities($row['specilization'])) ? 'selected' : '' ?>>
                                                                        <?php echo htmlentities($row['specilization']);?>
                                                                    </option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="treatmentName">
                                                                    Treatment Name
                                                                </label>
                                                                <input type="text" name="treatmentName" id="treatmentName" class="form-control"
																value="<?php echo htmlentities($data['treatmentName']);?>" placeholder="Enter Treatment Name" required="true">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="description">
                                                                    Description
                                                                </label>
                                                                <textarea class="form-control" name="description" id="description"
                                                                rows="12"><?php echo htmlentities($data['description']);?></textarea>
                                                            </div>
															
																<?php
																$i = 0;
																while($details=mysqli_fetch_array($detailsSql)) { ?>
																<div id="accommodationList_<?php echo $i; ?>">
																	<?php
																		if($i > 0) { ?>
																			<div class="close-option">
																				<span class="remove-btn" onclick="removePackage('accommodationList_<?php echo $i; ?>')">X</span>
																			</div>
																		<?php }
																	?>
																	<div class="accommodationList">
																		<div class="form-group">
																			<label for="packageNames[]">
																				Package Name
																			</label>
																			<input type="text" name="packageNames[]" id="packageNames" class="form-control"
																			value="<?php echo htmlentities($details['packageName']);?>" placeholder="Enter Package Name" required="true">
																		</div>
																		<div class="form-group">
																			<label for="days[]">
																				No. Of Days
																			</label>
																			<input type="number" name="days[]" id="days" class="form-control"
																			value="<?php echo htmlentities($details['days']);?>" placeholder="Enter No. Of Days">
																		</div>
																		<div class="form-group">
																			<label for="without[]">
																				Without Accommodation
																			</label>
																			<input type="text" class="form-control" name="without[]" id="without" class="form-control"
																			value="<?php echo htmlentities($details['without']);?>" placeholder="Without Accommodation Rates">
																		</div>
																		<div class="form-group">
																			<label for="singleOccupancy[]">
																				Single Occupancy
																			</label>
																			<input type="text" class="form-control" name="singleOccupancy[]" id="singleOccupancy" class="form-control"
																			value="<?php echo htmlentities($details['singleOccupancy']);?>" placeholder="Single Occupancy Rates">
																		</div>
																		<div class="form-group">
																			<label for="doubleOccupancy[]">
																				Double Occupancy
																			</label>
																			<input type="text" class="form-control" name="doubleOccupancy[]" id="doubleOccupancy" class="form-control"
																			value="<?php echo htmlentities($details['doubleOccupancy']);?>" placeholder="Double Occupancy Rates">
																		</div>
																		<!-- <div class="form-group">
																			<label for="files[]">
																				Upload Images
																			</label>
																			<input type="file" name="files[]" class="form-control"
																				placeholder="Upload Profile Pic" accept="image/*" multiple>
																		</div> -->
																	</div>
																</div>
															<?php 
																$i++;
															} 
															?>
															
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="submit" name="submit" id="submit"
                                                            class="btn btn-o btn-primary">
                                                            Submit
                                                        </button>
                                                        <!-- Add Button -->
                                                        <button type="button" id="addMore" class="btn btn-success mb-3 addMore">
                                                            Add More
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
		<script>
        let index = 1; // To track the index for dynamic rows
        document.getElementById('addMore').addEventListener('click', function () {
            // Create a new row for the profile
            const newRow = document.createElement('div');
            newRow.classList.add('mb-3', 'packageList');

            // Add HTML for new input fields
            newRow.innerHTML = `
                    <div class="close-option">
                        <span class="remove-btn">X</span>
                    </div>
                    <div class="form-group">
                        <label for="packageNames[]">
                            Package Name
                        </label>
                        <input type="text" name="packageNames[]" id="packageNames" class="form-control"
                            placeholder="Enter Package Name" required="true">
                    </div>
                    <div class="form-group">
                        <label for="days[]">
                            No. Of Days
                        </label>
                        <input type="number" name="days[]" id="days" class="form-control"
                            placeholder="Enter No. Of Days">
                    </div>
                    <div class="form-group">
                        <label for="without[]">
                            Without Accommodation
                        </label>
                        <input type="text" class="form-control" name="without[]" id="without" class="form-control"
                        placeholder="Without Accommodation Rates">
                    </div>
                    <div class="form-group">
                        <label for="singleOccupancy[]">
                            Single Occupancy
                        </label>
                        <input type="text" class="form-control" name="singleOccupancy[]" id="singleOccupancy" class="form-control"
                        placeholder="Single Occupancy Rates">
                    </div>
                    <div class="form-group">
                        <label for="doubleOccupancy[]">
                            Double Occupancy
                        </label>
                        <input type="text" class="form-control" name="doubleOccupancy[]" id="doubleOccupancy" class="form-control"
                        placeholder="Double Occupancy Rates">
                    </div>
            `;

            // Add the new row to the form
            document.getElementById('editPackageList').appendChild(newRow);

            // Add event listener for the remove button
            newRow.querySelector('.remove-btn').addEventListener('click', function () {
                newRow.remove();
            });
            index++; // Increment the index for the next row
        });

        // Add remove functionality for the first row
        document.querySelectorAll('.remove-btn').forEach(button => {
            button.addEventListener('click', function () {
                this.closest('.packageList').remove();
            });
        });

		function removePackage(elementId) {
			var element = document.getElementById(elementId);
            element.remove(); // Removes the current package
        }
    </script>
</body>

</html>
<?php } ?>