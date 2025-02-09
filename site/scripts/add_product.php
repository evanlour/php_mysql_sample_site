<?php
session_start();
include 'connect.php';
$allowed_referer = "products.php";
if (isset($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'], $allowed_referer) !== false) {
} else {
    header("Location: ../login.php");
    exit();
}

$postProductName = $_POST['prodAddName'];
$postProductID = $_POST['prodAddID'];
$postProductQuantity = $_POST['prodAddQuan'];
$postProductPrice = $_POST['prodAddPrice'];

$sql = "INSERT INTO Product (P_name, P_ID, P_quantity, P_price) VALUES ('$postProductName', '$postProductID', '$postProductQuantity', '$postProductPrice');";

if(mysqli_query($conn, $sql)){
    echo json_encode(['success' => true, 'message' => 'Product added successfully.']);
}else{
    echo json_encode(['success' => false, 'message' => 'Server error. Please try again later.']);
}

$conn->close();
?>
