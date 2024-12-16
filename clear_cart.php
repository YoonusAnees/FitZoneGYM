<?php
include("db/dbconn.php");
session_start();

// Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    header("location:userlogin.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Retrieve all items in the cart for the user
$sql = "SELECT product_id, quantity FROM cart WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Loop through each item in the cart and update product quantities
while ($row = $result->fetch_assoc()) {
    $product_id = $row['product_id'];
    $cart_quantity = $row['quantity'];

    // Update the product quantity back to its original stock level
    $sql_update = "UPDATE product SET quantity = quantity + ? WHERE id = ?";
    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->bind_param("ii", $cart_quantity, $product_id);
    $stmt_update->execute();
}

// Clear all items in the cart for the user
$sql_clear = "DELETE FROM cart WHERE user_id = ?";
$stmt_clear = $conn->prepare($sql_clear);
$stmt_clear->bind_param("i", $user_id);
$stmt_clear->execute();

// Redirect back to the cart page
header("location:cart.php");
exit;
?>
