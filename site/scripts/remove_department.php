<?php
session_start();
include 'connect.php';
$allowed_referer = "departments.php";
if (isset($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'], $allowed_referer) !== false) {
} else {
    header("Location: ../login.php");
    exit();
}
$post_department_name = $_POST['depRem'] ?? '';

$sql = "DELETE FROM Department WHERE D_name=?;";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $post_department_name);

if($stmt->execute()){
    echo json_encode(['success' => true, 'message' => 'Department removed successfully.']);
}else{
    echo json_encode(['success' => false, 'message' => 'Server error. Please try again later.']);
}

$conn->close();
?>
