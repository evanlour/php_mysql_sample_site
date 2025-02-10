<?php
session_start();
include 'connect.php';
$allowed_referer = "suppliers.php";
if (isset($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'], $allowed_referer) !== false) {
} else {
    header("Location: ../login.php");
    exit();
}

$supplier_name = $_POST['supplierName'] ?? '';

$sql1 = "DELETE FROM Supplier WHERE S_name=?;";
$sql2 = "DELETE FROM Cooperates WHERE Sup_name=?;";
$sql3 = "DELETE FROM Provides WHERE Supplier_name=?;";
$stmt1 = $conn->prepare($sql1);
$stmt2 = $conn->prepare($sql2);
$stmt3 = $conn->prepare($sql3);
$stmt1->bind_param("s", $supplier_name);
$stmt2->bind_param("s", $supplier_name);
$stmt3->bind_param("s", $supplier_name);
if($stmt1->execute() && $stmt2->execute() && $stmt3->execute()){
    echo json_encode(['success' => true, 'message' => 'Supplier removed successfully.']);
}else{
    echo json_encode(value: ['success' => false, 'message' => 'Server error. Please try again later.']);
}

$conn->close();
?>
