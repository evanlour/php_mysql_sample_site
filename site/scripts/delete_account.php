<?php
session_start();
include 'connect.php';
$allowed_referer = "profile.php";
if (isset($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'], $allowed_referer) !== false) {
} else {
    header("Location: ../login.php");
    exit();
}
$currentUser = $_SESSION["user_id"];
$sql = "DELETE FROM SiteUsers WHERE S_username = '$currentUser'";

if(mysqli_query($conn, $sql)){
    session_unset(); // Unset all session variables
    session_destroy(); // Destroy the session
    $conn->close();
    header("Location: ../login.php"); // Redirect to login page
    exit();
}
?>
