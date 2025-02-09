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

$sql1 = "DELETE FROM Supplier WHERE S_name='$supplierName';";
$sql2 = "DELETE FROM Cooperates WHERE Sup_name='$supplierName';";
$sql3 = "DELETE FROM Provides WHERE Supplier_name='$supplierName';";

if(mysqli_query($conn, $sql1) && mysqli_query($conn, $sql2) && mysqli_query($conn, $sql3)){
    echo json_encode(['success' => true, 'message' => 'Supplier added successfully.']);
}else{
    echo json_encode(['success' => false, 'message' => 'Server error. Please try again later.']);
}

$conn->close();
?>
