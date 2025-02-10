<?php
session_start();
include 'connect.php';
$allowed_referer = "consultants.php";
if (isset($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'], $allowed_referer) !== false) {
} else {
    header("Location: ../login.php");
    exit();
}

$post_name = $_POST['conCompName'] ?? '';
$post_email = $_POST['conCompEmail'] ?? '';
$post_location = $_POST['conCompLocation'] ?? '';

$sql = "INSERT INTO Consulting_company (C_name, C_email, C_location) VALUES (?, ?, ?);";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $post_name, $post_email, $post_location);

if($stmt->execute()){
    echo json_encode(['success' => true, 'message' => 'Added.']);
}else{
    echo json_encode(['success' => false, 'message' => 'Server error. Please try again later.']);
}

$conn->close();
?>
