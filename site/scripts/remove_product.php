<?php
session_start();
include 'connect.php';
$allowed_referer = "products.php";
if (isset($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'], $allowed_referer) !== false) {
} else {
    header("Location: ../login.php");
    exit();
}

$post_product_ID = $_POST['prodRem'] ?? '';

$sql = "DELETE FROM Product WHERE P_ID=?;";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $post_product_ID);

if($stmt->execute()){
    echo json_encode(['success' => true, 'message' => 'Product removed successfully.']);
}else{
    echo json_encode(['success' => false, 'message' => 'Server error. Please try again later.']);
}

$conn->close();
?>
