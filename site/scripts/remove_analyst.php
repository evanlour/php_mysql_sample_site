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

$sql1 = "DELETE FROM Analyst WHERE '$analystID'=A_ID;";
$sql2 = "DELETE FROM Analyzes_for WHERE '$analystID'=Analyst_ID;";

if(mysqli_query($conn, $sql1) && mysqli_query($conn, $sql2)){
    echo json_encode(['success' => true, 'message' => 'Registeration successful.']);
}else{
    echo json_encode(['success' => false, 'message' => 'Server error. Please try again later.']);
}

$conn->close();
?>
