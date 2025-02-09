<?php
session_start();
include 'scripts/connect.php';

$conCompData = [];
$optionsSQL = "SELECT C_name, C_email, C_location FROM Consulting_company";
$conCompRes = $conn->query($optionsSQL);
if($conCompRes->num_rows > 0){
    while($row = $conCompRes->fetch_assoc()){
        $conCompData[] = $row;
    }
}

$aData = [];
$aSQL = "SELECT A_name, A_ID FROM Analyst";
$aRes = $conn->query($aSQL);
if($aRes->num_rows > 0){
    while($row = $aRes->fetch_assoc()){
        $aData[] = $row;
    }
}

$depData = [];
$depSQL = "SELECT D_name, D_ID FROM Department";
$depRes = $conn->query($depSQL);
if($depRes->num_rows > 0){
    while($row = $depRes->fetch_assoc()){
        $depData[] = $row;
    }
}

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
        .table-responsive {
            max-height: 300px; /* Adjust this height as needed */
            overflow-y: auto;
            border: 1px solid darkslategray;
        }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultants</title>
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
                <a href="index.php" class="nav-link text-white">
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
                <a href="employees.php" class="nav-link active" aria-current="page">
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
            <h1>Consulting section</h1>
            <p>Please select a Company to display info about it</p>
            <select id="conCompOption">
                <option value="">Select a Consulting Company to display info</option>
            </select>
            <div class="row">
                <div class="col">
                    <h1>Consulting Company</h1>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tbody id="conCompBody"></tbody>
                        </table>
                    </div>
                </div>
                <div class="col md-6">
                    <h1>Members</h1>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th>Analyst Name</th>
                                    <th>Analyst ID</th>
                                </tr>
                            </thead>
                            <tbody id="conAnaBody"></tbody>
                        </table>
                    </div>
                </div>
                <div class = "form-group">
                    <h2>Add or remove companies and analysts</h2>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Name</i></span> 
                        </div>
                        <input type="form-text" class="form-control" id="addConCompNameLabel">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Email</i></span> 
                        </div>
                        <input type="form-text" class="form-control" id="addConCompEmailLabel">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Location</i></span> 
                        </div>
                        <input type="form-text" class="form-control" id="addConCompLocationLabel">
                        <button type="button" class="btn btn btn-primary" id="addConCompButton">Add Consulting Company</button>
                    </div>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Name</i></span> 
                        </div>
                        <input type="form-text" class="form-control" id="addAnalystNameLabel">
                        <div class="input-group-prepend">
                            <span class="input-group-text">ID</i></span> 
                        </div>
                        <input type="form-text" class="form-control" id="addAnalystIDLabel">
                        <button type="button" class="btn btn btn-primary" id="addAnalystButton">Add Analyst</button>
                    </div>
                    <br>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Connect analyst with company</i></span> 
                        </div>
                        <select id="connectCompOption">
                            <option value="">Select a Company</option>
                        </select>
                        <select id="connectAnalystOption">
                            <option value="">Select an Analyst</option>
                        </select>
                        <button type="button" class="btn btn btn-primary" id="connectCompButton">Create connection</button>     
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Connect company with Department</i></span> 
                        </div>
                        <select id="connectComComOption">
                            <option value="">Select a Company</option>
                        </select>
                        <select id="connectComDepOption">
                            <option value="">Select a Department</option>
                        </select>
                        <button type="button" class="btn btn btn-primary" id="connectDepButton">Create connection</button>     
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Disconnect analyst with company</i></span> 
                        </div>
                        <select id="disconnectCompOption">
                            <option value="">Select a Company</option>
                        </select>
                        <select id="disconnectAnalystOption">
                            <option value="">Select an Analyst</option>
                        </select>
                        <button type="button" class="btn btn btn-primary" id="disconnectCompButton">Delete connection</button>     
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Disconnect company with Department</i></span> 
                        </div>
                        <select id="disconnectComComOption">
                            <option value="">Select a Company</option>
                        </select>
                        <select id="disconnectComDepOption">
                            <option value="">Select a Department</option>
                        </select>
                        <button type="button" class="btn btn btn-primary" id="disconnectDepButton">Delete connection</button>     
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Remove a Consulting Company</i></span> 
                        </div>
                        <select id="removeConCompOption">
                            <option value="">Select a Company</option>
                        </select>
                        <button type="button" class="btn btn btn-primary" id="removeConCompButton">Remove Company</button>     
                    </div>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Remove an Analyst</i></span> 
                        </div>
                        <select id="removeAnalystOption">
                            <option value="">Select an Analyst</option>
                        </select>
                        <button type="button" class="btn btn btn-primary" id="removeAnalystButton">Remove Analyst</button>     
                    </div>
                </div>
            </div>
        </div>
        <script>const conCompData = <?php echo json_encode($conCompData);?></script>
        <script>const analystData = <?php echo json_encode($aData);?></script>
        <script>const departmentData = <?php echo json_encode($depData);?></script>
        <script src ="scripts/consultants.js"></script>
        <script src ="scripts/input_checker.js"></script>
    </main>
</body>
</html>
