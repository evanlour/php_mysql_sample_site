<?php
session_start();
include 'connect.php';
$allowed_referer = "employees.php";
if (isset($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'], $allowed_referer) !== false) {
} else {
    header("Location: ../login.php");
    exit();
}

$post_employee_name = $_POST['empRem'] ?? '';

$sql1 = "DELETE FROM Employee WHERE E_name=?;";
$sql2 = "UPDATE Department d, Employee e SET D_num_of_emp = D_num_of_emp - 1 WHERE e.E_name = ? AND e.E_cur_dep_ID=D_ID;";
$stmt1 = $conn->prepare($sql1);
$stmt2 = $conn->prepare($sql2);
$stmt1->bind_param("s", $post_employee_name);
$stmt2->bind_param("s", $post_employee_name);

if($stmt1->execute() && $stmt2->execute()){
    echo json_encode(['success' => true, 'message' => 'Employee removed successfully.']);
}else{
    echo json_encode(['success' => false, 'message' => 'Server error. Please try again later.']);
}

$conn->close();
?>
