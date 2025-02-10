<?php
session_start();
include 'connect.php';
$allowed_referer = "consultants.php";
if (isset($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'], $allowed_referer) !== false) {
} else {
    header("Location: ../login.php");
    exit();
}

$company_email = $_POST['companyEmail'] ?? '';
$department_ID = $_POST['departmentID'] ?? '';

$sql = "INSERT INTO Consults (Company_email, Department_ID) VALUES (?, ?);";

$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $company_email, $department_ID);

if($stmt->execute()){
    echo json_encode(['success' => true, 'message' => 'Added.']);
}else{
    echo json_encode(['success' => false, 'message' => 'Server error. Please try again later.']);
}

$conn->close();
?>
