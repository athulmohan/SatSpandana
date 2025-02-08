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

    $whereClause = $dateFilter ? "WHERE booking_date = '$dateFilter'" : "";

    // Fetch paginated slots with optional date filter
    $query = "SELECT * FROM booking_slots $whereClause ORDER BY booking_date, slot_time LIMIT $start, $limit";
    $result = mysqli_query($con, $query);

    // Count total records for pagination
    $totalRecords = mysqli_query($con, "SELECT COUNT(*) AS total FROM booking_slots $whereClause")->fetch_assoc()['total'];
    $totalPages = ceil($totalRecords / $limit);

    // Prepare response
    $tableData = "";
    $cnt=1;
    while ($row = $result->fetch_assoc()) {
        $confirmText = "Are you sure you want to delete?";
        $tableData .= "<tr>
                        <td class='center'>".$cnt."</td>
                        <td>{$row['booking_date']}</td>
                        <td>{$row['slot_time']}</td>
                        <td>
                        <a href='manage-slots.php?id={$row['id']}&del=delete'
                                                                    onClick='return confirm('Are you sure you want to delete?')'
                                                                    class='btn btn-transparent btn-xs tooltips'
                                                                    tooltip-placement='top' tooltip='Remove'><i
                                                                        class='fa fa-times fa fa-white'></i></a>
                        </td>
                    </tr>";
        $cnt=$cnt+1;
    }

    // Generate pagination links
    $paginationLinks = "";
    for ($i = 1; $i <= $totalPages; $i++) {
        $paginationLinks .= "<li class='page-item " . ($page == $i ? "active" : "") . "'>
                                <a class='page-link' href='#' data-page='$i'>$i</a>
                            </li>";
    }

    // Send JSON response
    echo json_encode(["table" => $tableData, "pagination" => $paginationLinks]);
} ?>