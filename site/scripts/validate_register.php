<?php
session_start();
include 'connect.php';
$allowed_referer = "register.php";
if (isset($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'], $allowed_referer) !== false) {
} else {
    header("Location: ../register.php");
    exit();
}
// Retrieve POST data
$post_email = $_POST['S_email'] ?? '';
$post_name = $_POST['S_name'] ?? '';
$post_surname = $_POST['S_surname'] ?? '';
$post_username = $_POST['S_username'] ?? '';
$post_password = $_POST['S_password'] ?? '';
$post_hashed_password = password_hash($post_password, PASSWORD_DEFAULT);

$sql = "SELECT * from SiteUsers WHERE S_email=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $post_email);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
if($user){
    echo json_encode(['success' => false, 'message' => 'This email already exists']);
    exit();
}

$sql = "INSERT INTO SiteUsers (S_email, S_name, S_surname, S_username, S_password) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssss",$post_email, $post_name, $post_surname, $post_username, $post_hashed_password);
if($stmt->execute()){
    echo json_encode(['success' => true, 'message' => 'Registeration successful.']);
}else{
    echo json_encode(['success' => false, 'message' => 'Server error. Please try again later.']);
}

$conn->close();
?>
