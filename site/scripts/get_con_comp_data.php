<?php
session_start();
include "connect.php";

$getConCompEmail = $_POST['conCompEmail'];
$conCompData = [];
$analystData = [];

$sql1 = "SELECT C_name, C_email, C_location FROM Consulting_company WHERE C_email = '$getConCompEmail'";
$sql2 = "SELECT A_name, A_ID FROM Analyzes_for, Analyst WHERE '$getConCompEmail' = Com_email AND Analyst_ID=A_ID";
$result1 = $conn->query($sql1);
$result2 = $conn->query($sql2);
if($result1->num_rows > 0){
    while($row = $result1->fetch_assoc()){
        $conCompData[] = $row;
    }
    while($row = $result2->fetch_assoc()){
        $analystData[] = $row;
    }
}

echo json_encode(["conCompData"=> $conCompData, "analystData"=> $analystData]);
$conn->close();
?>
