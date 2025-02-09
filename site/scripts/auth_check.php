<?php
header('Content-Type: application/json');
include 'connect.php';

$headers = getallheaders();
$token = $_POST['token'] ?? '';
$user_IP = $_SERVER['REMOTE_ADDR'];
$user_agent = $_SERVER['HTTP_USER_AGENT'];

if (empty($token)) {
    echo json_encode(['success' => false, 'message' => 'No token provided.']);
    exit();
}

// Validate token
$query = "SELECT S_username, token_expiry, ip_address, user_agent, token FROM SiteUsers WHERE token = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $token);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user || $user['token_expiry'] < time()) {
    echo json_encode(['success' => false, 'message' => 'Invalid or expired token.']);
    exit();
}

// Prevent session hijacking by checking the IP and User-Agent
if ($user['ip_address'] !== $user_IP || $user['user_agent'] !== $user_agent) {
    echo json_encode(['success' => false, 'message' => 'Session hijacking detected.']);
    exit();
}

// If the token doesn't match, redirect to login
if ($user['token'] !== $token) {
    echo json_encode(['success' => false, 'message' => 'Token mismatch detected.']);
    exit();
}

// If everything is okay, return success message
// echo json_encode(['success' => true, 'message' => 'Token identification successful!']);
echo json_encode(['success' => true, 'message1' => $token, 'message2' => $user['token']]);

$username = $user['S_username'];
exit();
?>