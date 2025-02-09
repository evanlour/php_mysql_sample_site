<?php
session_start();
include 'connect.php';
$allowed_referer = "consultants.php";
if (isset($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'], $allowed_referer) !== false) {
} else {
    header("Location: ../login.php");
    exit();
}

$postName = $_POST['conCompName'];
$postEmail = $_POST['conCompEmail'];
$postLocation = $_POST['conCompLocation'];

$sql = "INSERT INTO Consulting_company (C_name, C_email, C_location) VALUES ('$postName', '$postEmail', '$postLocation');";

if(mysqli_query($conn, $sql)){
    echo json_encode(['success' => true, 'message' => 'Registeration successful.']);
}else{
    echo json_encode(['success' => false, 'message' => 'Server error. Please try again later.']);
}

$conn->close();
?>
