<?php
session_start();
header('Content-Type: application/json');
include 'connect.php';
$allowed_referer = "login.php";
$allowed_referer2 = "register.php";
if (isset($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'], $allowed_referer) !== false || isset($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'], $allowed_referer2) !== false) {
} else {
    header("Location: ../login.php");
    exit();
}
// Retrieve POST data
$post_email = $_POST['S_email'] ?? '';
$post_password = $_POST['S_password'] ?? '';

// Prepare and execute query
$query = "SELECT S_email, S_password, S_username FROM SiteUsers WHERE S_email = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $post_email);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($user && password_verify($post_password, $user['S_password'])) {
    $token = bin2hex(random_bytes(32));
    $expires = time() + (60 * 60 * 24); // Token valid for 1 day
    $user_IP = $_SERVER['REMOTE_ADDR'];
    $user_agent = $_SERVER['HTTP_USER_AGENT'];

    // Store token in database
    $update_query = "UPDATE SiteUsers SET token=?, token_expiry=?, ip_address=?, user_agent=? WHERE S_email=?";
    $update_stmt = $conn->prepare($update_query);
    $update_stmt->bind_param("sisss", $token, $expires, $user_IP, $user_agent, $post_email);
    $update_stmt->execute();

    $_SESSION["user_id"] = $user['S_username'];
    echo json_encode(['success' => true, 'token' => $token, 'message' => 'Login successful.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid credentials.']);
}

// Close connections
$stmt->close();
$conn->close();
?>