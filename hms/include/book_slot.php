<?php
    session_start();
    // error_reporting(0);
    include('config.php');
// if(strlen($_SESSION['id']==0)) {
//     header('location:logout.php');
// } else {
    // Fetch available slots based on selected date
    if (isset($_GET['date'])) {
        $date = $_GET['date'];
        $selectedDoc = $_GET['doc'];
        $sql = "SELECT slot_time FROM booking_slots 
            WHERE booking_date = '$date' 
            AND slot_time NOT IN (SELECT appointmentTime FROM appointment WHERE appointmentDate = '$date' AND doctorId = '$selectedDoc' AND userStatus = 1 AND doctorStatus = 1)";
        $result = $con->query($sql);
        $slots = [];

        while ($row = $result->fetch_assoc()) {
            $slots[] = $row['slot_time'];
        }
        echo json_encode($slots);
        exit;
    }
// }
?>