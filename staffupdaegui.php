<?php
include("db/dbconn.php");
if (isset($_GET['id'])) {
    $update = $_GET['id'];
}

$sql = "SELECT * FROM product WHERE id = $update";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fit Zone Product Upload</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        /* Body Styling */
        body {
            background-color: #f0f2f5;
            color: #333;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
        }

        /* Header Styling */
        header {
            width: 100%;
            max-width: 1200px;
            padding: 1rem;
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        header h1 {
            font-size: 2rem;
            color: #ff4b2b;
        }

        /* Navigation Bar Styling */
        nav {
            width: 100%;
            max-width: 1200px;
            background-color: #333;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1rem 2rem;
            border-radius: 5px;
            margin-bottom: 10px;
            color: #fff;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: bold;
            color: #ff4b2b;
        }

        .cta {
            background: #ff4b2b;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            color: #fff;
            text-decoration: none;
            transition: background 0.3s;
        }

        .cta:hover {
            background: #e6392f;
        }

        /* Upload Container Styling */
        #upload_container {
            max-width: 600px;
            margin: 2rem auto;
            padding: 2.5rem;
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        #upload_container h2 {
            color: #333;
            margin-bottom: 1.5rem;
            font-size: 1.8rem;
        }

        .form-group {
            text-align: left;
            margin-bottom: 1.5rem;
        }

        .form-group label {
            font-size: 1rem;
            color: #333;
            display: block;
            margin-bottom: 0.5rem;
        }

        .form-group input[type="text"],
        .form-group input[type="number"],
        .form-group select {
            width: 100%;
            padding: 0.9rem;
            border-radius: 10px;
            border: 1px solid #ddd;
            outline: none;
            transition: border-color 0.3s;
            font-size: 1rem;
        }

        .form-group input[type="text"]:focus,
        .form-group input[type="number"]:focus,
        .form-group select:focus {
            border-color: #ff4b2b;
        }

        .button-group {
            display: flex;
            gap: 1rem;
        }

        input[type="submit"],
        input[type="reset"] {
            width: 100%;
            padding: 1rem;
            border-radius: 8px;
            border: none;
            background: #333;
            color: #fff;
            font-size: 1rem;
            cursor: pointer;
            transition: background 0.3s, transform 0.2s;
        }

        input[type="submit"]:hover,
        input[type="reset"]:hover {
            background: #555;
            transform: translateY(-2px);
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            nav {
                flex-direction: column;
                align-items: flex-start;
            }

            #upload_container {
                padding: 2rem 1rem;
                width: 90%;
            }
        }
    </style>
</head>
<body>

    <!-- Navigation Bar -->
    <header>
        <nav>
            <div class="logo">Fit Zone</div>
            <a href="staffupdateproduct.php" class="cta">Back To Staff Panel</a>
        </nav>
    </header>

    <!-- Product Upload Section -->
    <div id="upload_container">
        <h2>Update Product</h2>
        <form action="ADMINupdateproduct.php" method="POST">
            <input type="hidden" name="updateID" value="<?php echo htmlspecialchars($row['id']); ?>">

            <div class="form-group">
                <label for="product_name">Product Name</label>
                <input type="text" name="product_name" id="product_name" value="<?php echo htmlspecialchars($row['product_name']); ?>">
            </div>

            <div class="form-group">
                <label for="category">Category</label>
                <select name="category" id="category">
                    <option value="">Select the Flavour</option>
                    <option value="Strawberry" <?php echo ($row['product_catagory'] == 'Strawberry') ? 'selected' : ''; ?>>Strawberry</option>
                    <option value="Chocolate" <?php echo ($row['product_catagory'] == 'Chocolate') ? 'selected' : ''; ?>>Chocolate</option>
                    <option value="Vanilla" <?php echo ($row['product_catagory'] == 'Vanilla') ? 'selected' : ''; ?>>Vanilla</option>
                </select>
            </div>

            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" name="price" id="price" value="<?php echo htmlspecialchars($row['price']); ?>">
            </div>

            
            <div class="form-group">
                <label for="price">Quantity</label>
                <input type="number" name="quantity" id="quantity" value="<?php echo htmlspecialchars($row['quantity']); ?>">
            </div>

            <div class="button-group">
                <input type="submit" value="Update" name="ADD">
                <input type="reset" value="Reset" name="rst">
            </div>
        </form>
    </div>
</body>
</html>
