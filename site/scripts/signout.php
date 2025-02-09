<?php
session_start();
include 'connect.php';
// Remove token from database
if (isset($_SESSION['user_id'])) {
    $query = "UPDATE SiteUsers SET token=NULL, token_expiry=NULL WHERE S_username=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $_SESSION['user_id']);
    $stmt->execute();
}

// Destroy session
session_unset();
session_destroy();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logging Out...</title>
    <script>
        localStorage.clear();
        window.location.href = "../login.php";
    </script>
</head>
<body>
    <p>Logging out...</p>
</body>
</html>