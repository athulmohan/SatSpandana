
<?php
session_start();
// error_reporting(0);
include('include/config.php');
if(strlen($_SESSION['id']==0)) {
    header('location:logout.php');
} else {
    $id = (int) $_POST['id'];
    $value = (int) $_POST['value'];

    if ($id > 0) {
        if($value == 3) {
            $query = "DELETE FROM testimony WHERE id ='$id'";
        } else {
            $query = "UPDATE testimony SET status='$value' WHERE id ='$id'";
        }
        $sql = mysqli_query($con, $query);
        if ($sql) {
            echo ($value == 3) ? "Deleted" : "Updated";
        } else {
            echo "error";
        }
    }
} ?>