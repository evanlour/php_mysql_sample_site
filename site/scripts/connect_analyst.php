<?php
session_start();
include 'connect.php';
$allowed_referer = "consultants.php";
if (isset($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'], $allowed_referer) !== false) {
} else {
    header("Location: ../login.php");
    exit();
}

$analyst_ID = $_POST['analystID'] ?? '';
$company_email = $_POST['companyEmail'] ?? '';

$sql = "INSERT INTO Analyzes_for (Analyst_ID, com_email) VALUES (?, ?);";

$stmt = $conn->prepare($sql);
$stmt->bind_param("is", $analyst_ID, $company_email);

if($stmt->execute()){
    echo json_encode(['success' => true, 'message' => 'Added.']);
}else{
    echo json_encode(['success' => false, 'message' => 'Server error. Please try again later.']);
}

$conn->close();
?>
