<?php
session_start();
include 'connect.php';
$allowed_referer = "consultants.php";
if (isset($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'], $allowed_referer) !== false) {
} else {
    header("Location: ../login.php");
    exit();
}

$department_ID = $_POST['departmentID'] ?? '';
$company_email = $_POST['companyEmail'] ?? '';

$sql = "DELETE FROM Consults WHERE Department_ID=? AND Company_email=?;";
$stmt = $conn->prepare($sql);
$stmt->bind_param("is", $department_ID, $company_email);
if($stmt->execute()){
    echo json_encode(['success' => true, 'message' => 'Connection removed.']);
}else{
    echo json_encode(['success' => false, 'message' => 'Server error. Please try again later.']);
}

$conn->close();
?>
