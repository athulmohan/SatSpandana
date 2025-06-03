<?php
session_start();
// error_reporting(0);
include('include/config.php');
if(strlen($_SESSION['id']==0)) {
    header('location:logout.php');
} else {
    $msg = '';
    $errMsg = '';

    // Get Doctor and Location data
    $resDoc=mysqli_query($con,"select * from doctors");
    $resLoc=mysqli_query($con,"select * from locations where status = 1");

    $limit = 15; // Number of records per page
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $start = ($page - 1) * $limit;
    // Fetch all slots
    $result = mysqli_query($con, "SELECT * FROM booking_slots ORDER BY booking_date, slot_time LIMIT $start, $limit");

    // Count total records for pagination
    $totalRecords = mysqli_query($con, "SELECT COUNT(*) AS total FROM booking_slots")->fetch_assoc()['total'];
    $totalPages = ceil($totalRecords / $limit);

    if(isset($_GET['del']) && isset( $_GET["id"])) {
        $id = $_GET["id"];
    
        mysqli_query($con, "DELETE FROM booking_slots WHERE id ='$id'");
        $msg = "Slot deleted successfully!";
        // $errMsg = "Error deleting slot.";
        echo "<script>
            const myTimeout = setTimeout(reRoute, 2000);
            function reRoute() {
                window.location.href ='manage-slots.php'
            }
            </script>";
    }

    if(isset($_POST['submit']))
    {	
        $no_of_days=(isset($_POST['no_of_days']) && $_POST['no_of_days'] !== '') ? $_POST['no_of_days'] : 0;  // use no_of_days to add slots for multiple days
        $appdate=$_POST['appdate'];
        $isholiday = isset($_POST['isholiday']) ? $_POST['isholiday'] : 0;
        $appfromtime = ($isholiday == 0) ? $_POST['appfromtime'] : 0;
        $apptotime = ($isholiday == 0) ? $_POST['apptotime'] : 0;
        $apptime = 0;
        $time_interval=($isholiday == 0) ? $_POST['time_interval'] : 0;
        $doctor_id = $_POST['doctor'];
        $location_id = $_POST['location'];

// echo $no_of_days;die;
        for ($i = 0; $i <= $no_of_days; $i++) {
// echo $no_of_days;die;
            $start_time = strtotime($appfromtime);
            $end_time = strtotime($apptotime);

            if($isholiday == 1) {
                $sql=mysqli_query($con,"insert into booking_slots(doctor_id, location_id, booking_date, is_holiday, time_interval, slot_time) values('$doctor_id', '$location_id', '$appdate', '$isholiday', '$time_interval', '$apptime')");
            } else {
                while ($start_time < $end_time) {
                    $apptime = date("h:i A", $start_time);
                    $sql=mysqli_query($con,"insert into booking_slots(doctor_id, location_id, booking_date, is_holiday, time_interval, slot_time) values('$doctor_id', '$location_id', '$appdate', '$isholiday', '$time_interval', '$apptime')");
            
                    $start_time = strtotime($time_interval, $start_time);
                }
            }

            $appdate = date('Y-m-d', strtotime($appdate . ' +1 day'));
        }

        if(isset($sql) && $sql) {
            $msg="Slot Addedd successfully";
            echo "<script>
            const myTimeout = setTimeout(reRoute, 2000);
            function reRoute() {
                window.location.href ='manage-slots.php'
            }
            </script>";
        } else {
            $errMsg="Error adding slot.";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin | Add Slots</title>

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
            <!-- end: TOP NAVBAR -->
            <div class="main-content">
                <div class="wrap-content container" id="container">
                <!-- start: PAGE TITLE -->
                <section id="page-title">
                    <div class="row">
                        <div class="col-sm-8">
                            <h1 class="mainTitle">Admin | Add Slots</h1>
                        </div>
                        <ol class="breadcrumb">
                            <li>
                                <span>Admin</span>
                            </li>
                            <li class="active">
                                <span>Add Slots</span>
                            </li>
                        </ol>
                    </div>
                </section>
                <!-- end: PAGE TITLE -->
                <!-- Add Slot Form -->
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
                                                <h5 class="panel-title">Add Slots</h5>
                                            </div>
                                            <div class="panel-body">
                                                <form role="form" name="addGallery" method="post"
                                                    onSubmit="return valid();" enctype="multipart/form-data">
                                                    <div class="form-group">
                                                        <label for="date">
                                                            Date
                                                        </label>
                                                        <input class="form-control datepicker" id="date" name="appdate" required="required"
                                        data-date-format="yyyy-mm-dd">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="date">
                                                           Days with same slots
                                                        </label>
                                                        <input type="number" class="form-control" id="date" name="no_of_days" placeholder="Enter number of days">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="time">
                                                            Is Holiday ?
                                                        </label>
                                                        <input type="checkbox" class="form-control checkbox-form-control" name="isholiday" id="isholiday" value="1">
                                                    </div>
                                                    <div id="timeSlotDiv">
                                                        <div class="form-group">
                                                            <label for="appfromtime">
                                                                From Time
                                                            </label>
                                                            <input class="form-control" name="appfromtime" id="timepicker1" required="required">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="apptotime">
                                                                To Time
                                                            </label>
                                                            <input class="form-control" name="apptotime" id="timepicker2" required="required">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="time_interval">
                                                                Time Interval
                                                            </label>
                                                            <select name="time_interval" class="form-control" required="true">
                                                                <!-- <option value="">Select Interval</option> -->
                                                                <option value="+15 minutes">15 min</option>
                                                                <option value="+30 minutes">30 min</option>
                                                                <option value="+60 minutes">1 hour</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="doctors">
                                                            Doctor
                                                        </label>
                                                        <select name="doctor" class="form-control" required="required">
                                                            <option value="">Select Doctor</option>
                                                            <?php
                                                            while($row=mysqli_fetch_array($resDoc))
                                                            {
                                                            ?>
                                                            <option
                                                                value="<?php echo htmlentities($row['id']);?>">
                                                                <?php echo htmlentities($row['doctorName']);?>
                                                            </option>
                                                            <?php } ?>

                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="location">
                                                            Location
                                                        </label>
                                                        <!-- <textarea name="clinicaddress" class="form-control"
                                                            placeholder="Enter Doctor Clinic Address"></textarea> -->
                                                        <select name="location" class="form-control" required="true">
                                                            <option value="">Select Location</option>
                                                            <?php
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
                            <div class="col-md-12" id="delete_error" style="float: left;"></div>
                            <div class="col-md-12" id="delete_success" style="float: left;"></div>
                            <div class="col-lg-12 col-md-12">
                                <div class="panel panel-white">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h5 class="over-title margin-bottom-15 padding-15">Manage <span
                                                    class="text-bold">Slots</span>
                                            </h5>
                                            <p style="color:red;"><?php echo htmlentities($_SESSION['msg']);?>
                                                <?php echo htmlentities($_SESSION['msg']="");?>
                                            </p>
                                            <div class="col-md-12 row">
                                                <div class="col-md-10 mb-3">
                                                    <!-- Search by Date -->
                                                    <div class="col-md-3">
                                                        <input class="form-control datepicker" id="searchDate" name="searchDate" required="required" 
                                                        data-date-format="yyyy-mm-dd" placeholder="Search by Date">
                                                    </div>

                                                    <!-- Search by Doctor -->
                                                    <div class="col-md-3">
                                                        <select name="searchDoctor" class="form-control" id="searchDoctor">
                                                            <option value="">Select Doctor</option>
                                                            <?php
                                                            $resDoc=mysqli_query($con,"select * from doctors");
                                                            while($row1=mysqli_fetch_array($resDoc))
                                                            {
                                                            ?>
                                                            <option
                                                                value="<?php echo htmlentities($row1['id']);?>">
                                                                <?php echo htmlentities($row1['doctorName']);?>
                                                            </option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <!-- Search by Location -->
                                                    <div class="col-md-3">
                                                        <select name="searchLocation" class="form-control" id="searchLocation">
                                                            <option value="">Select Location</option>
                                                            <?php
                                                            $resLoc=mysqli_query($con,"select * from locations where status = 1"); 
                                                            while($row2=mysqli_fetch_array($resLoc))
                                                            {
                                                            ?>
                                                            <option
                                                                value="<?php echo htmlentities($row2['id']);?>">
                                                                <?php echo htmlentities($row2['location_name']);?>
                                                            </option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <button class="btn btn-primary" onclick="searchSlots()">Search</button>
                                                    </div>
                                                </div>

                                                <div class="col-md-2 mb-3">
                                                    <button class="btn btn-danger d-none" id="deleteAllBtn" style="float: right; display: none;">Delete Selected</button>
                                                    <input type="hidden" id="selected_slots" name="selected_slots" value="">
                                                </div>
                                            </div>
                                            <table class="table table-hover" id="sample-table-1">
                                                <thead>
                                                    <tr>
                                                        <th class="center"><input type="checkbox" name="delete_all" id="delete_all" onclick="selectAll('All')"></th>
                                                        <th class="center">#</th>
                                                        <th>Date</th>
                                                        <th>Doctor</th>
                                                        <th>Location</th>
                                                        <th>Time</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="slotsTable">
                                                </tbody>
                                            </table>
                                            <!-- Pagination -->
                                            <nav class="col-md-12">
                                                <ul class="pagination justify-content-center" id="pagination">
                                                    <?php for ($i = 1; $i <= $totalPages; $i++) { ?>
                                                        <li class="page-item <?php echo ($page == $i) ? 'active' : ''; ?>">
                                                            <a class="page-link" onclick="loadSlots(<?php echo $i; ?>)"><?php echo $i; ?></a>
                                                        </li>
                                                    <?php } ?>
                                                </ul>
                                            </nav>
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
        $('#timepicker1').timepicker();
        $('#timepicker2').timepicker();
    </script>
    <script>
        // Add Slot AJAX
        $("#addSlotForm").submit(function (e) {
            e.preventDefault();
            $.post("add_slot.php", $(this).serialize(), function (response) {
                alert(response);
                location.reload(); // Refresh table
            });
        });


        // Search by Date
        function searchSlots() {
            let selectedDate = $("#searchDate").val();
            let selectedDoctor = $("#searchDoctor").val();
            let selectedLocation = $("#searchLocation").val();
            loadSlots(1, selectedDate, selectedDoctor, selectedLocation);
        }

        // Initial Load
        $(document).ready(function () {
            loadSlots();
        });

        // Function to load slots with pagination
        // function loadSlots(page = 1, date = '', doctor = '', location = '') {
        //     // let date = $("#searchDate").val();
        //     $.ajax({
        //         url: "fetch_slots.php",
        //         method: "GET",
        //         data: { page: page, date: date, doctor: doctor, location: location },
        //         success: function (response) {
        //             let data = JSON.parse(response);
        //             $("#slotsTable").html(data.table);
        //             $("#pagination").html(data.pagination);
        //         }
        //     });
        // }

        function loadSlots(page = 1, date = '', doctor = '', location = '') {

            var main_checkbox = document.getElementById('delete_all');
            main_checkbox.checked = false; // Uncheck the main checkbox

            date = $("#searchDate").val();
            doctor = $("#searchDoctor").val();
            location = $("#searchLocation").val();
            $.ajax({
                url: "fetch_slots.php",
                method: "GET",
                data: { page: page, date: date, doctor: doctor, location: location },
                success: function (response) {
                    // Parse the JSON response
                    let data = JSON.parse(response);
                    $("#slotsTable").html(data.table);
                    $("#pagination").html(data.pagination);
                }
            });
        }

        $('#isholiday').click(function(){
            if($(this).is(':checked')){
                $('#timeSlotDiv').hide();
            } else {
                $('#timeSlotDiv').show();
            }
        });

        function selectAll(param = '') {
            var rowList = [];
            var checkboxes = document.getElementsByName('slot_multi_delete');
            var selectAllCheckbox = document.getElementsByName('delete_all')[0];
            for (var i = 0; i < checkboxes.length; i++) {
                if(param == 'All') {
                    checkboxes[i].checked = selectAllCheckbox.checked;
                }

                if(checkboxes[i].checked) {
                    rowList.push(checkboxes[i].value);
                } else {
                    rowList = rowList.filter(item => item !== checkboxes[i].value);
                }
            }
            console.log('rowList', rowList);
            $('#selected_slots').val(rowList.join(',')); // Store selected IDs in a hidden input field
            if(rowList.length > 0) {
                $('#deleteAllBtn').show();
            } else {
                $('#deleteAllBtn').hide();
            }
        }

        // Delete Slot AJAX
        $("#deleteAllBtn").click(function () {
            // var delSuccessMsg = "";
            // var delErrMsg = "";
            let rowList = $("#selected_slots").val();
            if(rowList.length > 0) {
                if (confirm("Are you sure want to delete the selected slots?")) {
                    $.ajax({
                        url: "delete_slots.php",
                        method: "POST",
                        data: { id: rowList },
                        success: function (response) {
                            // let data = JSON.parse(response);
                            response = response.trim();
                            rowList = [];
                            $('#deleteAllBtn').hide();
                            if(response == "Success") {
                                const delSuccessMsg = "<span style='color: green; font-size:18px;'>Slots deleted successfully!</span>";
                                const delErrMsg = "";
                                // const myTimeout = setTimeout(reRoute, 2000);
                                // function reRoute() {
                                    loadSlots(); // Refresh the table after deletion
                                // }
                                $("#delete_error").html(delErrMsg).fadeIn().delay(3000).fadeOut();
                                $("#delete_success").html(delSuccessMsg).fadeIn().delay(3000).fadeOut();
                            } else {
                                const delSuccessMsg = "";
                                const delErrMsg = "<span style='color: red; font-size:18px;'>Error deleting slots.</span>";
                                $("#delete_error").html(delErrMsg).fadeIn().delay(3000).fadeOut();
                                $("#delete_success").html(delSuccessMsg).fadeIn().delay(3000).fadeOut();
                            }
                        },
                        error: function () {
                            const delSuccessMsg = "";
                            const delErrMsg = "<span style='color: red; font-size:18px;'>Something went wrong while deleting.</span>";
                            $("#delete_error").html(delErrMsg).fadeIn().delay(3000).fadeOut();
                            $("#delete_success").html(delSuccessMsg).fadeIn().delay(3000).fadeOut();
                        }
                    });
                } else {
                    const delSuccessMsg = "";
                    const delErrMsg = "<span style='color: red; font-size:18px;'>Deletion cancelled.</span>";
                    $("#delete_error").html(delErrMsg).fadeIn().delay(3000).fadeOut();
                    $("#delete_success").html(delSuccessMsg).fadeIn().delay(3000).fadeOut();
                }
            } else {
                const delSuccessMsg = "";
                const delErrMsg = "<span style='color: red; font-size:18px;'>Please select at least one slot to delete.</span>";
                $("#delete_error").html(delErrMsg).fadeIn().delay(3000).fadeOut();
                $("#delete_success").html(delSuccessMsg).fadeIn().delay(3000).fadeOut();
            }
        });

        // function multiSelect(id) {
        //     var rowList = [];
        //     var checkboxes = document.getElementsByName('slot_multi_delete');
        //     for (var i = 0; i < checkboxes.length; i++) {
        //         if(checkboxes[i].checked) {
        //             rowList.push(checkboxes[i].value);
        //         } else {
        //             rowList = rowList.filter(item => item !== checkboxes[i].value);
        //         }
        //     }
        //     console.log('rowList', rowList);
        // }
    </script>

    </body>
</html>
<?php } ?>