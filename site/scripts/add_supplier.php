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
$supplierSeasonality = $_POST['supplierSeasonality'];

$sql = "INSERT INTO Supplier (S_name, S_is_temp) VALUES ('$supplierName', '$supplierSeasonality');";

if(mysqli_query($conn, $sql)){
    echo json_encode(['success' => true, 'message' => 'Supplier added successfully.']);
}else{
    echo json_encode(['success' => false, 'message' => 'Server error. Please try again later.']);
}

$conn->close();
?>
