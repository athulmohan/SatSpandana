<?php
session_start();
// error_reporting(0);
include('include/config.php');
if(strlen($_SESSION['id']==0)) {
    header('location:logout.php');
} else {
    $msg = '';
    $errMsg = '';

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
        // echo "<script>
        //     const myTimeout = setTimeout(reRoute, 2000);
        //     function reRoute() {
        //         window.location.href ='manage-slots.php'
        //     }
        //     </script>";
    }

    if(isset($_POST['submit']))
    {	
        $appdate=$_POST['appdate'];
        $apptime = $_POST['apptime'];

        $sql=mysqli_query($con,"insert into booking_slots(booking_date,slot_time) values('$appdate','$apptime')");
        if($sql)
        {
            $msg="Slot Addedd successfully";
            // echo "<script>
            // const myTimeout = setTimeout(reRoute, 2000);
            // function reRoute() {
            //     window.location.href ='manage-slots.php'
            // }
            // </script>";
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
                                                        <label for="time">
                                                            Time
                                                        </label>
                                                        <input class="form-control" name="apptime" id="timepicker1" required="required">
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
                                                    class="text-bold">Slots</span>
                                            </h5>
                                            <p style="color:red;"><?php echo htmlentities($_SESSION['msg']);?>
                                                <?php echo htmlentities($_SESSION['msg']="");?></p>

                                            <!-- Search by Date -->
                                            <div class="mb-3">
                                                <div class="col-md-3">
                                                <input class="form-control datepicker" id="searchDate" name="searchDate" required="required"
                                                data-date-format="yyyy-mm-dd">
                                                </div>
                                                <div class="col-md-4">
                                                    <button class="btn btn-primary" onclick="searchSlots()">Search</button>
                                                </div>
                                            </div>

                                            <table class="table table-hover" id="sample-table-1">
                                                <thead>
                                                    <tr>
                                                        <th class="center">#</th>
                                                        <th>Date</th>
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
                                                            <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
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

        // Delete Slot AJAX
        $(".delete-btn").click(function () {
            let slotId = $(this).data("id");

            $.post("delete_slot.php", { id: slotId }, function (response) {
                alert(response);
                $("#row-" + slotId).fadeOut(); // Remove row from table
            });
        });

        // Search by Date
        function searchSlots() {
            let selectedDate = $("#searchDate").val();
            loadSlots(1, selectedDate);
        }

        // Initial Load
        $(document).ready(function () {
            loadSlots();
        });

        // Function to load slots with pagination
        function loadSlots(page = 1, date = '') {
            $.ajax({
                url: "fetch_slots.php",
                method: "GET",
                data: { page: page, date: date },
                success: function (response) {
                    let data = JSON.parse(response);
                    $("#slotsTable").html(data.table);
                    $("#pagination").html(data.pagination);
                }
            });
        }
    </script>

    </body>
</html>
<?php } ?>