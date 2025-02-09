<?php
session_start();
include 'connect.php';
$allowed_referer = "departments.php";
if (isset($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'], $allowed_referer) !== false) {
} else {
    header("Location: ../login.php");
    exit();
}
$postDepartmentName = $_POST['depAddName'];
$postDepartmentID = $_POST['depAddID'];
$postDepartmentNum = $_POST['depNum'];

$sql = "INSERT INTO Department (D_name, D_ID, D_num_of_emp) VALUES ('$postDepartmentName', '$postDepartmentID', '$postDepartmentNum');";

if(mysqli_query($conn, $sql)){
    echo json_encode(['success' => true, 'message' => 'Department Added.']);
}else{
    echo json_encode(['success' => false, 'message' => 'Server error. Please try again later.']);
}

$conn->close();
?>
