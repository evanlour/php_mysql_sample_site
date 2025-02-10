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

$sql1 = "DELETE FROM Analyst WHERE A_ID=?;";
$sql2 = "DELETE FROM Analyzes_for WHERE Analyst_ID=?;";

$stmt1 = $conn->prepare($sql1);
$stmt2 = $conn->prepare($sql2);
$stmt1->bind_param("i", $analyst_ID);
$stmt2->bind_param("i", $analyst_ID);

if($stmt1->execute() && $stmt2->execute()){
    echo json_encode(['success' => true, 'message' => 'Analyst removed successfully.']);
}else{
    echo json_encode(['success' => false, 'message' => 'Server error. Please try again later.']);
}

$conn->close();
?>
