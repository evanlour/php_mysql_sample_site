<?php
session_start();
include 'connect.php';
$allowed_referer = "consultants.php";
if (isset($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'], $allowed_referer) !== false) {
} else {
    header("Location: ../login.php");
    exit();
}

$conCompEmail = $_POST['conCompEmail'];

$sql1 = "DELETE FROM Consulting_company WHERE '$conCompEmail'=C_email;";
$sql2 = "DELETE FROM Analyzes_for WHERE '$conCompEmail'=Com_email;";
$sql3 = "DELETE FROM Consults WHERE '$conCompEmail'=Company_email;";

if(mysqli_query($conn, $sql1) && mysqli_query($conn, $sql2) && mysqli_query($conn, $sql3)){
    echo json_encode(['success' => true, 'message' => 'Registeration successful.']);
}else{
    echo json_encode(['success' => false, 'message' => 'Server error. Please try again later.']);
}

$conn->close();
?>
