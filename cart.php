<?php
include("db/dbconn.php");
session_start();

// Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    header("location:userlogin.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Retrieve the cart count for the user
$sql_count = "SELECT COUNT(*) AS cart_count FROM cart WHERE user_id = ?";
$stmt_count = $conn->prepare($sql_count);
$stmt_count->bind_param("i", $user_id);
$stmt_count->execute();
$count_result = $stmt_count->get_result();
$count_row = $count_result->fetch_assoc();
$cart_count = $count_row['cart_count']; 
$sql = "SELECT product.product_name, product.price, SUM(cart.quantity) AS total_quantity 
        FROM cart 
        JOIN product ON cart.product_id = product.id 
        WHERE cart.user_id = ? 
        GROUP BY cart.product_id";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$total = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart - Fit Zone</title>
    <link rel="stylesheet" href="style/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .cart-page {
            max-width: 800px;
            margin: 50px auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .cart-page h2 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 1.8em;
            color: #3a3f51;
        }
        .cart-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .cart-table th, .cart-table td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        .cart-table th {
            background: #3a3f51;
            color: #fff;
        }
        .cart-table tr:hover {
            background-color: #f1f1f1;
        }
        .cart-page .total {
            font-size: 1.2em;
            font-weight: bold;
            text-align: right;
            margin-top: 20px;
            color: #3a3f51;
        }
        .empty-message {
            text-align: center;
            font-size: 1.2em;
            color: #888;
            padding: 30px;
        }
        .checkout-button, .clear-cart-button {
            text-align: center;
            margin-top: 20px;
        }
        
    </style>
</head>
<body>

<header>
  <nav>
    <div class="logo">Fit Zone</div>
    <div class="user-options">
      <?php if (isset($user['username'])): ?>
        <span class="logged-user">Hello, <?php echo htmlspecialchars($user['username']); ?></span>
      <?php endif; ?>
      <a href="cart.php" class="cart-icon">
        <i class="fas fa-shopping-cart"></i>
        <span class="cart-count"><?php echo $cart_count; ?></span>
      </a>
      <a href="main.php" class="cta">Back</a>
    </div>
  </nav>
</header>

<main class="cart-page">
    <h2>Your Cart</h2>
    <?php if ($result->num_rows > 0): ?>
        <table class="cart-table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): 
                    $subtotal = $row['price'] * $row['total_quantity'];
                    $total += $subtotal;
                ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['product_name']); ?></td>
                        <td>LKR <?php echo htmlspecialchars(number_format($row['price'], 2)); ?></td>
                        <td><?php echo htmlspecialchars($row['total_quantity']); ?></td>
                        <td>LKR <?php echo htmlspecialchars(number_format($subtotal, 2)); ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <div class="total">
            Total: LKR <?php echo number_format($total, 2); ?>
        </div>
        <div class="checkout-button">   
            <a href="checkout.php" class="cta">Proceed to Checkout</a>
        </div>
        <div class="clear-cart-button">
            <form action="clear_cart.php" method="post">
                <button type="submit" class="cta">Clear Cart</button>
            </form>
        </div>
    <?php else: ?>
        <p class="empty-message">Your cart is empty.</p>
    <?php endif; ?>
</main>

</body>
</html>
