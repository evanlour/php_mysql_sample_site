<?php
session_start();
include 'connect.php';
$allowed_referer = "consultants.php";
if (isset($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'], $allowed_referer) !== false) {
} else {
    header("Location: ../login.php");
    exit();
}

$con_comp_email = $_POST['conCompEmail'] ?? '';

$sql1 = "DELETE FROM Consulting_company WHERE C_email=?;";
$sql2 = "DELETE FROM Analyzes_for WHERE Com_email=?;";
$sql3 = "DELETE FROM Consults WHERE Company_email=?;";
$stmt1 = $conn->prepare($sql1);
$stmt2 = $conn->prepare($sql2);
$stmt3 = $conn->prepare($sql3);
$stmt1->bind_param("s", $con_comp_email);
$stmt2->bind_param("s", $con_comp_email);
$stmt3->bind_param("s", $con_comp_email);

if($stmt1->execute() && $stmt2->execute() && $stmt3->execute()){
    echo json_encode(['success' => true, 'message' => 'Consulting Company removed successfully.']);
}else{
    echo json_encode(['success' => false, 'message' => 'Server error. Please try again later.']);
}

$conn->close();
?>
