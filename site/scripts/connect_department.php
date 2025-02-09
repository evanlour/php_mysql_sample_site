<?php
session_start();
include 'connect.php';
$allowed_referer = "suppliers.php";
if (isset($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'], $allowed_referer) !== false) {
} else {
    header("Location: ../login.php");
    exit();
}

$supplierName = $_POST['supplierName'];
$departmentID = $_POST['departmentID'];

$sql = "INSERT INTO Cooperates (Sup_name, DEP_ID) VALUES ('$supplierName', '$departmentID');";

if(mysqli_query($conn, $sql)){
    echo json_encode(['success' => true, 'message' => 'Connection Succesful.']);
}else{
    echo json_encode(['success' => false, 'message' => 'Server error. Please try again later.']);
}

$conn->close();
?>
