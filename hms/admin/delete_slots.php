<?php
session_start();
// error_reporting(0);
include('include/config.php');
if(strlen($_SESSION['id']==0)) {
    header('location:logout.php');
} else {

    // $limit = 15;
    // $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    // $start = ($page - 1) * $limit;
    $ids = isset($_POST['id']) && !empty($_POST['id']) ? $_POST['id'] : '';
    // $idList = implode(',', $ids);
    $msg = "";
    $deleteSql = mysqli_query($con, "DELETE FROM booking_slots WHERE id IN ($ids)");
    if ($deleteSql) {
        $msg = "Success";
    } else {
        $msg = "Error";
    }

    // Send JSON response
    echo $msg;
} ?>