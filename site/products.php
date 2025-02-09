<?php
session_start();
include 'scripts/connect.php';

$prodOptionData = [];
$optionsSQL = "SELECT P_name, P_ID, P_quantity, P_price FROM Product";
$resultDepartmentOptions = $conn->query($optionsSQL);
if($resultDepartmentOptions->num_rows > 0){
    while($row = $resultDepartmentOptions->fetch_assoc()){
        $prodOptionData[] = $row;
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
            max-height: 500px; /* Adjust this height as needed */
            overflow-y: auto;
            border: 1px solid darkslategray;
        }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
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
                <a href="products.php" class="nav-link active" aria-current="page">
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
            <h1>Product section</h1>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>Product Name</th>
                            <th>Product ID</th>
                            <th>Product Quantity</th>
                            <th>Product Price</th>
                        </tr>
                    </thead>
                    <tbody id="prodDataBody"></tbody>
                </table>
            </div>
            <div class="container text-center my-5">
                <div class = "form-group">
                    <h2>Add or remove a Product</h2>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Name</i></span> 
                        </div>
                        <input type="form-text" class="form-control" id="addProductNameLabel">
                        <div class="input-group-prepend">
                            <span class="input-group-text">ID</i></span> 
                        </div>
                        <input type="form-text" class="form-control" id="addProductIDLabel">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Quantity</i></span> 
                        </div>
                        <input type="form-text" class="form-control" id="addProductQuantityLabel">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Price</i></span> 
                        </div>
                        <input type="form-text" class="form-control" id="addProductPriceLabel">
                        <button type="button" class="btn btn btn-primary" id="addProductButton">Add product</button>
                    </div>
                    <br>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Remove a product</i></span> 
                        </div>
                        <select id="removeProductOption">
                            <option value="">Select a Product</option>
                        </select>
                        <button type="button" class="btn btn btn-primary" id="removeProductButton">Remove Product</button>     
                    </div>
                </div>
            </div>
        </div>
        <script>
            const productOptionData = <?php echo json_encode($prodOptionData);?>
        </script>
        <script src ="scripts/products.js"></script>
        <script src ="scripts/input_checker.js"></script>
    </main>
</body>
</html>
