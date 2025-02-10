<?php
session_start();
include 'connect.php';
$allowed_referer = "profile.php";
if (isset($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'], $allowed_referer) !== false) {
} else {
    header("Location: ../login.php");
    exit();
}
$current_user = $_SESSION["user_id"] ?? '';
$sql = "DELETE FROM SiteUsers WHERE S_username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $current_user);

if($stmt->execute()){
    session_unset(); // Unset all session variables
    session_destroy(); // Destroy the session
    $conn->close();
    header("Location: ../login.php"); // Redirect to login page
    exit();
}
?>
