<?php
session_start();
include 'connect.php';

$allowed_referer = "employees.php";
if (isset($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'], $allowed_referer) !== false) {
} else {
    header("Location: ../login.php");
    exit();
}

$postEmployeeName = $_POST['empAddName'];
$postEmployeeID = $_POST['empAddID'];
$postEmployeeSalary = $_POST['empAddSalary'];
$postEmployeeDep = $_POST['empAddDep'];

$sql1 = "INSERT INTO Employee (E_name, E_ID, E_salary, E_cur_dep_ID) VALUES ('$postEmployeeName', '$postEmployeeID', '$postEmployeeSalary', '$postEmployeeDep');";
$sql2 = "UPDATE Department SET D_num_of_emp = D_num_of_emp + 1 WHERE D_ID = '$postEmployeeDep'";

if(mysqli_query($conn, $sql1) && mysqli_query($conn, $sql2)){
    echo json_encode(['success' => true, 'message' => 'Employee Added successful.']);
}else{
    echo json_encode(['success' => false, 'message' => 'Server error. Please try again later.']);
}

$conn->close();
?>
