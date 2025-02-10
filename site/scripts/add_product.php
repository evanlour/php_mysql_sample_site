<?php
session_start();
include 'connect.php';
$allowed_referer = "products.php";
if (isset($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'], $allowed_referer) !== false) {
} else {
    header("Location: ../login.php");
    exit();
}

$post_product_name = $_POST['prodAddName'] ?? '';
$post_product_ID = $_POST['prodAddID'] ?? '';
$post_product_quantity = $_POST['prodAddQuan'] ?? '';
$post_product_price = $_POST['prodAddPrice'] ?? '';

$sql = "INSERT INTO Product (P_name, P_ID, P_quantity, P_price) VALUES (?, ?, ?, ?);";

$stmt = $conn->prepare($sql);
$stmt->bind_param("siid", $post_product_name, $post_product_ID, $post_product_quantity, $post_product_price);

if($stmt->execute()){
    echo json_encode(['success' => true, 'message' => 'Added.']);
}else{
    echo json_encode(['success' => false, 'message' => 'Server error. Please try again later.']);
}

$conn->close();
?>
