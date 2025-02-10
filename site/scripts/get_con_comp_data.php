<?php
session_start();
include "connect.php";

$get_con_comp_email = $_POST['conCompEmail'] ?? '';
$con_comp_data = [];
$analyst_data = [];

//$sql1 = "SELECT C_name, C_email, C_location FROM Consulting_company WHERE C_email = '$getConCompEmail'";
//$sql2 = "SELECT A_name, A_ID FROM Analyzes_for, Analyst WHERE '$getConCompEmail' = Com_email AND Analyst_ID=A_ID";
$sql1 = "SELECT C_name, C_email, C_location FROM Consulting_company WHERE C_email = ?";
$sql2 = "SELECT A_name, A_ID FROM Analyzes_for, Analyst WHERE Com_email = ? AND Analyst_ID=A_ID";
$stmt1 = $conn->prepare($sql1);
$stmt2 = $conn->prepare($sql2);
$stmt1->bind_param("s", $get_con_comp_email);
$stmt2->bind_param("s", $get_con_comp_email);
$stmt1->execute();
$result1 = $stmt1->get_result();
$stmt2->execute();
$result2 = $stmt2->get_result();
// $data1 = $result1->fetch_assoc();
// $data2 = $result2->fetch_assoc();

while($row = $result1->fetch_assoc()){
    $con_comp_data[] = $row;
}
while($row = $result2->fetch_assoc()){
    $analyst_data[] = $row;
}

if($con_comp_data){
    echo json_encode(["conCompData"=> $con_comp_data, "analystData"=> $analyst_data]);
}else{
    echo json_encode(['success' => false, 'message' => 'Server error. Please try again later.']);
}

$conn->close();
?>
