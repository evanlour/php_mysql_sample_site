<?php
session_start();
include 'connect.php';
$allowed_referer = "departments.php";
if (isset($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'], $allowed_referer) !== false) {
} else {
    header("Location: ../login.php");
    exit();
}
$post_department_name = $_POST['depAddName'] ?? '';
$post_department_ID = $_POST['depAddID'] ?? '';
$post_department_num = $_POST['depNum'] ?? '';

$sql = "INSERT INTO Department (D_name, D_ID, D_num_of_emp) VALUES (?, ?, ?);";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sii", $post_department_name, $post_department_ID, $post_department_num);

if($stmt->execute()){
    echo json_encode(['success' => true, 'message' => 'Added.']);
}else{
    echo json_encode(['success' => false, 'message' => 'Server error. Please try again later.']);
}

$conn->close();
?>
