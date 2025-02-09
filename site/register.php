<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <!-- BootStrap  CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<script src="scripts/redirect_index.js"></script>
<body class="d-flex align-items-center py-4 bg-body-tertiary">
    <!-- BootStrap  Javascript and icons -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <main class="position-absolute top-50 start-50 translate-middle"></s>
        <form>
            <div class="form-group">
                <h1>Register</h1><br>
                <label for="emailLabel" class="form-label">Email address</label>
                <div class="mb-3">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="bi bi-envelope-fill"></i></span> 
                        </div>
                        <input type="email" class="form-control" id="emailLabel">
                    </div>
                </div>
                <label for="realNameLabel" class="form-label">Your real name</label>
                <div class="mb-3">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="bi bi-card-list"></i></span> 
                        </div>
                        <input type="text" class="form-control" id="realNameLabel">
                    </div>
                </div>
                <label for="surnameLabel" class="form-label">Your surname</label>
                <div class="mb-3">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="bi bi-card-list"></i></span> 
                        </div>
                        <input type="text" class="form-control" id="surnameLabel">
                    </div>
                </div>
                <label for="usernameLabel" class="form-label">Username</label>
                <div class="mb-3">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="bi bi-person"></i></span> 
                        </div>
                        <input type="text" class="form-control" id="usernameLabel">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="passwordLabel" class="form-label">Password</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="bi bi-eye", id="passwordIcon"></i></span> 
                        </div>
                        <input type="password" class="form-control" id="passwordLabel">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="repeatPasswordLabel" class="form-label">Repeat password</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="bi bi-eye", id="repeatPasswordIcon"></i></span> 
                        </div>
                        <input type="password" class="form-control" id="repeatPasswordLabel">
                    </div>
                </div>
                <div>
                    <p>Already have an account? Login <a href="login.php">here</a></p>
                </div>
                <button type="submit" class="btn btn-primary" id="registerButton">Submit</button>
            </div>
        </form>
    </main>
    <script src = "scripts/register.js"></script>
    <script src ="scripts/input_checker.js"></script>
</body>
</html>
