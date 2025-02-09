<?php
session_start();
include 'scripts/connect.php';
$response = [];
$sql1 = "SELECT COUNT(*) AS ct FROM Department";
$sql2 = "SELECT COUNT(*) AS ct FROM Employee";
$sql3 = "SELECT COUNT(*) AS ct FROM Product";
$sql4 = "SELECT AVG(E_salary) AS avg FROM Employee";
$sql5 = "SELECT MAX(E_salary) AS max FROM Employee";
$sql6 = "SELECT AVG(P_price) AS avg FROM Product";
$sql7 = "SELECT MAX(P_price) AS max FROM Product";
$sql8 = "SELECT MAX(P_quantity) AS max FROM Product";
$sql9 = "SELECT d.D_name AS DEP_NAME, SUM(e.E_salary) AS TOTAL_COST FROM Employee e JOIN Department d ON d.D_ID = e.E_cur_dep_id GROUP BY d.D_ID ORDER BY total_cost DESC LIMIT 1;";

$result1 = $conn->query($sql1);
$result2 = $conn->query($sql2);
$result3 = $conn->query($sql3);
$result4 = $conn->query($sql4);
$result5 = $conn->query($sql5);
$result6 = $conn->query($sql6);
$result7 = $conn->query($sql7);
$result8 = $conn->query($sql8);
$result9 = $conn->query($sql9);

$response[] = $result1->fetch_assoc();
$response[] = $result2->fetch_assoc();
$response[] = $result3->fetch_assoc();
$response[] = $result4->fetch_assoc();
$response[] = $result5->fetch_assoc();
$response[] = $result6->fetch_assoc();
$response[] = $result7->fetch_assoc();
$response[] = $result8->fetch_assoc();
$response[] = $result9->fetch_assoc();

json_encode($response);
$conn->close();
?>
<!-- <!DOCTYPE html> -->
<html lang="en" data-bs-theme="dark">
<head>
    <style>
        .vertical-divider {
            width: 40px;
            background-color:rgb(26, 23, 23); /* Adjust the color as needed */
            height: auto; /* Adjust height as needed */
        }
        body, main{
            height: 100vh;
        }
        table, th, td {
            border: 1px solid black;
        }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <!-- BootStrap  CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<script src="scripts/redirect_login.js"></script>
<script src="scripts/auth_buttons.js"></script>
<body>
    <main class = "d-flex flex-nowrap h-100">
        <!-- BootStrap  Javascript and icons -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <div class="d-flex flex-column flex-shrink-0 p-3 text-bg-dark" style="width: 280px;">
            <a href="index.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
            <svg class="bi pe-none me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
            <span class="fs-4"><i class="bi bi-house" style="font-size: 3rem"></i></span>
            </a>
            <hr>
            <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item">
                <a href="index.php" class="nav-link active" aria-current="page">
                <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#home"></use></svg>
                Home
                </a>
            </li>
            <li>
                <a href="departments.php" class="nav-link text-white">
                <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#speedometer2"></use></svg>
                Departments
                </a>
            </li>
            <li>
                <a href="employees.php" class="nav-link text-white">
                <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#table"></use></svg>
                Employees
                </a>
            </li>
            <li>
                <a href="products.php" class="nav-link text-white">
                <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#grid"></use></svg>
                Products
                </a>
            </li>
            <li>
                <a href="suppliers.php" class="nav-link text-white">
                <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#people-circle"></use></svg>
                Suppliers
                </a>
            </li>
            <li>
                <a href="consultants.php" class="nav-link text-white">
                <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#people-circle"></use></svg>
                Consultants
                </a>
            </li>
            </ul>
            <hr>
            <div class="dropdown">
            <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-info-circle-fill h1" style="padding-right: 20px"></i>
                <strong><?php echo htmlspecialchars(ltrim($_SESSION['user_id'], '$'))?></strong>
            </a>
            <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                <li><a class="dropdown-item" href="profile.php">My profile</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="scripts/signout.php">Sign out</a></li>
            </ul>
            </div>
        </div>
        <div class="vertical-divider"></div>
        <div class="container text-center my-5">
            <h1>Welcome back</h1>
            <p>Here are some stats from your database</p>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>Field</th>
                            <th>Data</th>
                        </tr>
                    </thead>
                    <tbody id="indexBody"></tbody>
                </table>
            </div>
        </div>
        <script>
            const indexData = <?php echo json_encode($response);?>;
        </script>
        <script src="scripts/index.js"></script>
        <script src ="scripts/input_checker.js"></script>
    </main>
</body>
</html>
