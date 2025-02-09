<?php
session_start();
include 'connect.php';
$allowed_referer = "consultants.php";
if (isset($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'], $allowed_referer) !== false) {
} else {
    header("Location: ../login.php");
    exit();
}

$analystName = $_POST['analystName'];
$analystID = $_POST['analystID'];

$sql = "INSERT INTO Analyst (A_name, A_ID) VALUES ('$analystName', '$analystID');";

if(mysqli_query($conn, $sql)){
    echo json_encode(['success' => true, 'message' => 'Registeration successful.']);
}else{
    echo json_encode(['success' => false, 'message' => 'Server error. Please try again later.']);
}

$conn->close();
?>
