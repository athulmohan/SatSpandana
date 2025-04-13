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
        $selectedLoc = $_GET['loc'];

        // $checkkSql = "SELECT count(*) as count FROM appointment WHERE appointmentDate = '$date' AND doctorId = '$selectedDoc' AND locationId = '$selectedLoc' AND userStatus = 1 AND doctorStatus = 1";
        // $checkResult = $con->query($checkkSql);
        // $row = mysqli_fetch_assoc($checkResult);

        // if (isset($row['count']) && $row['count'] > 0) {
        //    echo json_encode(['status' => 'error', 'message' => 'Already booked']);
        //     exit; 
        // } else {
            $sql = "SELECT slot_time FROM booking_slots 
                WHERE booking_date = '$date' AND doctor_id = '$selectedDoc' AND location_id = '$selectedLoc'
                AND slot_time NOT IN (SELECT appointmentTime FROM appointment WHERE appointmentDate = '$date' AND doctorId = '$selectedDoc' AND locationId = '$selectedLoc' AND userStatus = 1 AND doctorStatus = 1)";
            $result = $con->query($sql);
            $slots = [];

            while ($row = $result->fetch_assoc()) {
                $slots[] = $row['slot_time'];
            }
            echo json_encode($slots);
            exit;
        // }
    }
// }
?>