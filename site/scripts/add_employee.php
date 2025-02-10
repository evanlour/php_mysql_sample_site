<?php
session_start();
include 'connect.php';

$allowed_referer = "employees.php";
if (isset($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'], $allowed_referer) !== false) {
} else {
    header("Location: ../login.php");
    exit();
}

$post_employee_name = $_POST['empAddName'] ?? '';
$post_employee_ID = $_POST['empAddID'] ?? '';
$post_employee_salary = $_POST['empAddSalary'] ?? '';
$post_employee_dep = $_POST['empAddDep'] ?? '';

$sql1 = "INSERT INTO Employee (E_name, E_ID, E_salary, E_cur_dep_ID) VALUES (?, ?, ?, ?);";
$sql2 = "UPDATE Department SET D_num_of_emp = D_num_of_emp + 1 WHERE D_ID = ?";

$stmt1 = $conn->prepare($sql1);
$stmt2 = $conn->prepare($sql2);
$stmt1->bind_param("siii", $post_employee_name, $post_employee_ID, $post_employee_salary, $post_employee_dep);
$stmt2->bind_param("i", $post_employee_dep);

if($stmt1->execute()){
    if($stmt2->execute()){
        echo json_encode(['success' => true, 'message' => 'Added.']);
    }
}else{
    echo json_encode(['success' => false, 'message' => 'Server error. Please try again later.']);
}

$conn->close();
?>
