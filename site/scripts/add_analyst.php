<?php
session_start();
include 'connect.php';
$allowed_referer = "consultants.php";
if (isset($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'], $allowed_referer) !== false) {
} else {
    header("Location: ../login.php");
    exit();
}

$analyst_name = $_POST['analystName'] ?? '';
$analyst_ID = $_POST['analystID'] ?? '';

$sql = "INSERT INTO Analyst (A_name, A_ID) VALUES (?, ?);";

$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $analyst_name, $analyst_ID);

if($stmt->execute()){
    echo json_encode(['success' => true, 'message' => 'Added.']);
}else{
    echo json_encode(['success' => false, 'message' => 'Server error. Please try again later.']);
}

$conn->close();
?>
