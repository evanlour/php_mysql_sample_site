<?php
session_start();
include 'connect.php';
$allowed_referer = "departments.php";
if (isset($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'], $allowed_referer) !== false) {
} else {
    header("Location: ../login.php");
    exit();
}
$postDepartmentName = $_POST['depRem'];

$sql = "DELETE FROM Department WHERE '$postDepartmentName'=D_name;";

if(mysqli_query($conn, $sql)){
    echo json_encode(['success' => true, 'message' => 'Registeration successful.']);
}else{
    echo json_encode(['success' => false, 'message' => 'Server error. Please try again later.']);
}

$conn->close();
?>
