<?php
session_start();
include 'scripts/connect.php';

$supplierData = [];
$sSQL = "SELECT S_name, S_is_temp FROM Supplier";
$supplierRes = $conn->query($sSQL);
if($supplierRes->num_rows > 0){
    while($row = $supplierRes->fetch_assoc()){
        $supplierData[] = $row;
    }
}
$productData = [];
$pSQL = "SELECT P_name, P_ID FROM Product";
$productRes = $conn->query($pSQL);
if($productRes->num_rows > 0){
    while($row = $productRes->fetch_assoc()){
        $productData[] = $row;
    }
}
$departmentData = [];
$dSQL = "SELECT D_name, D_ID FROM Department";
$departmentRes = $conn->query($dSQL);
if($departmentRes->num_rows > 0){
    while($row = $departmentRes->fetch_assoc()){
        $departmentData[] = $row;
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
    <title>Suppliers</title>
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
                <a href="suppliers.php" class="nav-link active" aria-current="page">
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
            <h1>Supplier section</h1>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>Supplier Name</th>
                            <th>Main Supplier</th>
                        </tr>
                    </thead>
                    <tbody id="supDataBody"></tbody>
                </table>
            </div>
            <h2>Add or remove Suppliers</h2>
            <div class = "form-group">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Name</i></span> 
                    </div>
                    <input type="form-text" class="form-control" id="addSupplierNameLabel">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Seasonality</i></span> 
                    </div>
                    <select id="addSupplierSeasonalityOption">
                        <option value="yes">The Supplier is seasonal</option>
                        <option value="no">The Supplier is not seasonal</option>
                    </select>
                    <button type="button" class="btn btn btn-primary" id="addSupplierButton">Add Supplier</button>
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Connect Supplier with product</i></span> 
                    </div>
                    <select id="connectProdOption">
                        <option value="">Select a product</option>
                    </select>
                    <select id="connectSupplierProdOption">
                        <option value="">Select a Supplier</option>
                    </select>
                    <button type="button" class="btn btn btn-primary" id="connectProductButton">Create connection</button>     
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Connect Supplier with department</i></span> 
                    </div>
                    <select id="connectDepOption">
                        <option value="">Select a Department</option>
                    </select>
                    <select id="connectSupplierDepOption">
                        <option value="">Select a Supplier</option>
                    </select>
                    <button type="button" class="btn btn btn-primary" id="connectDepButton">Create connection</button>     
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Disconnect supplier from product</i></span> 
                    </div>
                    <select id="disconnectProdOption">
                        <option value="">Select a product</option>
                    </select>
                    <select id="disconnectSupplierProdOption">
                        <option value="">Select a supplier</option>
                    </select>
                    <button type="button" class="btn btn btn-primary" id="disconnectProductButton">Delete connection</button>     
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Disconnect supplier from department</i></span> 
                    </div>
                    <select id="disconnectDepOption">
                        <option value="">Select a department</option>
                    </select>
                    <select id="disconnectSupplierDepOption">
                        <option value="">Select a supplier</option>
                    </select>
                    <button type="button" class="btn btn btn-primary" id="disconnectDepButton">Delete connection</button>     
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Remove a Supplier</i></span> 
                    </div>
                    <select id="removeSupplierOption">
                        <option value="">Select a supplier</option>
                    </select>
                    <button type="button" class="btn btn btn-primary" id="removeSupplierButton">Remove supplier</button>     
                </div>
            </div>
        </div>
        <script>const supplierData = <?php echo json_encode($supplierData);?></script>
        <script>const productData = <?php echo json_encode($productData);?></script>
        <script>const departmentData = <?php echo json_encode($departmentData);?></script>
        <script src ="scripts/suppliers.js"></script>
        <script src ="scripts/input_checker.js"></script>
    </main>
</body>
</html>
