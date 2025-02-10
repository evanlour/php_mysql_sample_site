<?php
session_start();
include 'connect.php';

$allowed_referer = "departments.php";
if (isset($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'], $allowed_referer) !== false) {
} else {
    header("Location: ../login.php");
    exit();
}

$get_department = $_POST['depOption'] ?? '';

$sql = "SELECT D_name, D_ID, D_num_of_emp FROM Department WHERE D_name = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $get_department);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();
if($data){
    echo json_encode($data);
}else{
    echo json_encode(['success' => false, 'message' => 'Server error. Please try again later.']);
}

$conn->close();
?>
