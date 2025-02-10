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
$product_ID = $_POST['productID'] ?? '';

$sql = "DELETE FROM Provides WHERE Supplier_name=? AND Product_ID=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $supplier_name, $product_ID);
if($stmt->execute()){
    echo json_encode(['success' => true, 'message' => 'Connection Removed.']);
}else{
    echo json_encode(['success' => false, 'message' => 'Server error. Please try again later.']);
}

$conn->close();
?>
