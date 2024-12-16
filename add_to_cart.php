<!-- <?php
session_start();
include("db/dbconn.php");

if (isset($_POST['product_id']) && isset($_SESSION['user_id'])) {
    $product_id = $_POST['product_id'];
    $user_id = $_SESSION['user_id'];

    $stmt = $conn->prepare("INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, 1) ON DUPLICATE KEY UPDATE quantity = quantity + 1");
    $stmt->bind_param("ii", $user_id, $product_id);
    $stmt->execute();

    $update_quantity_stmt = $conn->prepare("UPDATE product SET quantity = quantity - 1 WHERE id = ? AND quantity > 0");
    $update_quantity_stmt->bind_param("i", $product_id);
    $update_quantity_stmt->execute();

    header("Location: main.php");
    exit;
}
?> -->
