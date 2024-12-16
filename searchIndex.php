<?php
include("db/dbconn.php");

if (isset($_GET['query'])) {
  $query = $_GET['query'];

  if (!empty($query)) {
      $search_term = '%' . $query . '%';
      $sql_search = "SELECT * FROM product WHERE product_name LIKE '$search_term' OR product_catagory LIKE '$search_term'";
      $result = mysqli_query($conn, $sql_search);
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Search Results</title>
  <link rel="stylesheet" href="style/main.css">
</head>
<body>
<section class="section-container">
  <h2>Search Results for "<?php echo htmlspecialchars($query); ?>"</h2>
  <div class="card-container">
    <?php if ($result->num_rows > 0): ?>
      <?php while ($row = $result->fetch_assoc()): ?>
        <div class="card">
          <img src="itemimages/<?php echo htmlspecialchars($row['product_image']); ?>" alt="<?php echo htmlspecialchars($row['product_name']); ?>">
          <div class="content">
            <p class="product_name"><?php echo htmlspecialchars($row["product_name"]); ?></p>
            <p class="category">Category: <?php echo htmlspecialchars($row["product_catagory"]); ?></p>
            <p class="price">Price: LKR <?php echo htmlspecialchars(number_format($row["price"], 2)); ?></p>
            <p class="quantity">Available: <?php echo htmlspecialchars($row["quantity"]); ?></p>
                    </div>
        </div>
      <?php endwhile; ?>
    <?php else: ?>
      <p>No products found matching your search.</p>
    <?php endif; ?>
  </div>
</section>
</body>
</html>
