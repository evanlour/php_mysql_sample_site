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

$sql = "INSERT INTO Provides (Supplier_name, Product_ID) VALUES (?, ?);";
$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $supplier_name, $product_ID);

if($stmt->execute()){
    echo json_encode(['success' => true, 'message' => 'Added.']);
}else{
    echo json_encode(['success' => false, 'message' => 'Server error. Please try again later.']);
}

$conn->close();
?>
