<?php
session_start();
include 'connect.php';
$allowed_referer = "consultants.php";
if (isset($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'], $allowed_referer) !== false) {
} else {
    header("Location: ../login.php");
    exit();
}

$analystID = $_POST['analystID'];
$companyEmail = $_POST['companyEmail'];

$sql = "DELETE FROM Analyzes_for WHERE '$analystID'=Analyst_ID AND '$companyEmail'=Com_email;";

if(mysqli_query($conn, $sql)){
    echo json_encode(['success' => true, 'message' => 'Analyst connected to company.']);
}else{
    echo json_encode(['success' => false, 'message' => 'Server error. Please try again later.']);
}

$conn->close();
?>
