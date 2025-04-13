<?php
session_start();
// error_reporting(0);
include('include/config.php');
if(strlen($_SESSION['id']==0)) {
    header('location:logout.php');
} else {

    $limit = 15;
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $start = ($page - 1) * $limit;
    $dateFilter = isset($_GET['date']) && !empty($_GET['date']) ? $_GET['date'] : '';
    $doctorFilter = isset($_GET['doctor']) && !empty($_GET['doctor']) ? $_GET['doctor'] : '';
    $locationFilter = isset($_GET['location']) && !empty($_GET['location']) ? $_GET['location'] : '';

    $whereClause = "";
    $conditions = [];

    if (isset($dateFilter) && $dateFilter !== '') {
        $conditions[] = "bs.booking_date = '$dateFilter'";
    }

    if (isset($doctorFilter) && $doctorFilter) {
        $conditions[] = "bs.doctor_id = '$doctorFilter'";
    }

    if (isset($locationFilter) && $locationFilter) {
        $conditions[] = "bs.location_id = '$locationFilter'";
    }

    if (!empty($conditions)) {
        $whereClause = "WHERE " . implode(" AND ", $conditions);
    }

    // print_r($whereClause);

    // Fetch paginated slots with optional date filter
    $query = "SELECT bs.*, d.doctorName, l.location_name FROM booking_slots as bs 
    LEFT JOIN doctors as d ON bs.doctor_id = d.id 
    LEFT JOIN locations as l ON bs.location_id = l.id 
    $whereClause 
    -- GROUP BY bs.booking_date, d.doctorName, l.location_name
    ORDER BY bs.booking_date, bs.slot_time 
    LIMIT $start, $limit";
    $result = mysqli_query($con, $query);

    // Count total records for pagination
    $totalRecords = mysqli_query($con, "SELECT COUNT(*) AS total FROM booking_slots as bs $whereClause")->fetch_assoc()['total'];
    $totalPages = ceil($totalRecords / $limit);

    // Prepare response
    $tableData = "";
    $cnt=1;
    while ($row = $result->fetch_assoc()) {
        $confirmText = "Are you sure you want to delete?";
        $tableData .= "<a onclick='loadTime(".$row['booking_date'].", ".$row['doctor_id'].", ".$row['location_id'].")'>
                        <tr>
                            <td class='center'>".$cnt."</td>
                            <td>{$row['booking_date']}</td>
                            <td>{$row['doctorName']}</td>
                            <td data-toggle='popover' data-trigger='hover' data-content='{$row['location_name']}'>".substr($row['location_name'],0,100)." ...
                            </td>
                            <td>{$row['slot_time']}</td>
                            <td>
                            <a href='manage-slots.php?id={$row['id']}&del=delete'
                                                                        onClick='return confirm('Are you sure you want to delete?')'
                                                                        class='btn btn-transparent btn-xs tooltips'
                                                                        tooltip-placement='top' tooltip='Remove'><i
                                                                            class='fa fa-times fa fa-white'></i></a>
                            </td>
                            
                        </tr>
                    </a>";
        $cnt=$cnt+1;
    }

    // Generate pagination links
    $paginationLinks = "";
    for ($i = 1; $i <= $totalPages; $i++) {
        $paginationLinks .= "<li class='page-item " . ($page == $i ? "active" : "") . "'>
                                <a class='page-link' onclick='loadSlots($i)' data-page='$i'>$i</a>
                            </li>";
    }

    // Send JSON response
    echo json_encode(["table" => $tableData, "pagination" => $paginationLinks]);
} ?>