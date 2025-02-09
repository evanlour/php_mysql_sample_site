<?php
session_start();
include 'connect.php';

// $allowed_referer = "departments.php";
// if (isset($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'], $allowed_referer) !== false) {
// } else {
//     header("Location: ../login.php");
//     exit();
// }

$getDepartment = $_POST['depOption'];
$sql = "SELECT D_name, D_ID, D_num_of_emp FROM Department WHERE D_name = '$getDepartment'";
$result = $conn->query($sql);
$data = [];
if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
    $data[] = $row;
    }
}
echo json_encode($data);
$conn->close();
?>
