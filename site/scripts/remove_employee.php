<?php
session_start();
include 'connect.php';
$allowed_referer = "employees.php";
if (isset($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'], $allowed_referer) !== false) {
} else {
    header("Location: ../login.php");
    exit();
}

$postEmployeeName = $_POST['empRem'];

$sql1 = "DELETE FROM Employee WHERE '$postEmployeeName'=E_name;";
$sql2 = "UPDATE Department d, Employee e SET D_num_of_emp = D_num_of_emp - 1 WHERE e.E_name = '$postEmployeeName' AND e.E_cur_dep_ID=D_ID;";

if(mysqli_query($conn, $sql2) && mysqli_query($conn, $sql1)){
    echo json_encode(['success' => true, 'message' => 'Employee removed.']);
}else{
    echo json_encode(['success' => false, 'message' => 'Server error. Please try again later.']);
}

$conn->close();
?>
