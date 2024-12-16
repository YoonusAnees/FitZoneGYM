<?php
include("db/dbconn.php");
// session_start();
// if(!isset($_SESSION['email']) && !isset($_SESSION['password'])){
//     header("location:userlogin.php");
// }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fitness Fitzone</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="style/main.css">

</head>
<body>

<?php
$sqlp = "SELECT * FROM product";
$resultp = $conn->query($sqlp);
$sqlt = "SELECT * FROM trainer";
$resultt = $conn->query($sqlt);
$sqlc = "SELECT * FROM gym_classes";
$resultc = $conn->query($sqlc);

?>



<header>

    <nav>
        <div class="logo">Fit Zone</div>
        <!-- Toggle button for mobile menu -->
        <i class="fas fa-bars menu-toggle" onclick="toggleMenu()"></i>
        <ul class="nav-links">
            <li><a href="#Home">Home</a></li>
            <li><a href="#product">Products</a></li>
            <li><a href="#classes">Classes</a></li>
            <li><a href="#trainer">Trainers</a></li>
            <li><a href="admindashboard.php">Back</a></li>
            <li><li>
 
</li>
</li>
           
            </li>
        </ul>
      
    </nav>
</header>

<!-- Products Section -->
<section id="product" class="section-container">
  <h2>Products</h2>
  <div class="card-container">
    <?php while ($row = mysqli_fetch_assoc($resultp)) { ?>
      <div class="card">
        <img src="itemimages/<?php echo htmlspecialchars($row['product_image']); ?>" alt="<?php echo htmlspecialchars($row['product_name']); ?>" onerror="this.src='default-image.jpg';">
        <div class="content">
          <p class="product_name"><?php echo htmlspecialchars($row["product_name"]); ?></p>
          <p class="category">Flavor: <?php echo htmlspecialchars($row["product_catagory"]); ?></p>
          <p class="price">LKR: <?php echo htmlspecialchars(number_format($row["price"], 2)); ?></p>
          <p class="quantity">Available: <?php echo htmlspecialchars($row["quantity"]); ?></p>
          <?php if ($row['quantity'] > 0): ?>
            <form action="add_to_cart.php" method="POST">
              <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
            

              <div class="buttons">
                            <a href="ADMINupdateproductGUI.php?id=<?php echo $row['id']; ?>" class="buy-now">Update</a>
                            <form action="admindeleteProduct.php" method="GET" style="display:inline;">
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                <button type="submit" class="btn delete buy-now ">Delete</button>
                            </form>
                        </div>

            </form>
          <?php else: ?>
            <p class="out-of-stock">Out of Stock</p>
          <?php endif; ?>
        </div>
      </div>
    <?php } ?>
  </div>
</section> 

<section>
        <?php if ($resultp && mysqli_num_rows($resultp) > 0): ?>
            <?php while ($row = mysqli_fetch_assoc($resultp)): ?>
                <div class="card">
                    <img src="itemimages/<?php echo htmlspecialchars($row['product_image']); ?>" alt="<?php echo htmlspecialchars($row['product_name']); ?>" onerror="this.src='default-image.jpg';">
                    <div class="content">
                        <p class="product_name"><?php echo htmlspecialchars($row["product_name"]); ?></p>
                        <p class="category">Flavor: <?php echo htmlspecialchars($row["product_catagory"]); ?></p>
                        <p class="price">Price: $<?php echo htmlspecialchars(number_format($row["price"], 2)); ?></p>
                        <p class="quantity">Available: <?php echo htmlspecialchars($row["quantity"]); ?></p>
                        <div class="buttons">
                            <a href="ADMINupdateproductGUI.php?id=<?php echo $row['id']; ?>" class="btn">Update</a>
                            <form action="admindeleteProduct.php" method="GET" style="display:inline;">
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                <button type="submit" class="btn delete">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No products found.</p>
        <?php endif; ?>
    </section>


<!-- <div class="buttons">
                            <a href="ADMINupdateproductGUI.php?id=<?php echo $row['id']; ?>" class="btn">Update</a>
                            <form action="admindeleteProduct.php" method="GET" style="display:inline;">
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                <button type="submit" class="btn delete">Delete</button>
                            </form>
                        </div> -->

<!-- Trainers Section -->
<section id="trainer" class="section-container">
  <h2>Trainers</h2>
  <div class="card-container">
    <?php while ($row = mysqli_fetch_assoc($resultt)) { ?>
      <div class="card">
        <img src="traineerimages/<?php echo htmlspecialchars($row['image']); ?>" alt="<?php echo htmlspecialchars($row['Name']); ?>" onerror="this.src='default-image.jpg';">
        <div class="content">
          <p class="product_name">Name: <?php echo htmlspecialchars($row["Name"]); ?></p>
          <p class="category">About: <?php echo htmlspecialchars($row["description"]); ?></p>
          <p class="quantity">Number: <?php echo htmlspecialchars($row["number"]); ?></p>
        </div>
      </div>
    <?php } ?>
  </div>
</section>

<!-- Classes Section -->
<section id="classes" class="section-container">
  <h2>Our Classes</h2>
  <div class="card-container">
    <?php while ($row = mysqli_fetch_assoc($resultc)) { ?>
      <div class="card">
        <img src="classimages/<?php echo htmlspecialchars($row['Image']); ?>" alt="<?php echo htmlspecialchars($row['ClassName']); ?>" onerror="this.src='default-image.jpg';">
        <div class="content">
          <h3 class="product_name"><?php echo htmlspecialchars($row["ClassName"]); ?></h3>
          <p class="description"><?php echo htmlspecialchars($row["Description"]); ?></p>
          <p class="duration"><strong>Duration:</strong> <?php echo htmlspecialchars($row["Duration"]); ?></p>
          <p class="schedule"><strong>Schedule:</strong> <?php echo htmlspecialchars($row["Schedule"]); ?></p>
          <p class="price"><strong>Price:</strong> LKR <?php echo htmlspecialchars(number_format($row["Price"], 2)); ?></p>
          <form action="book_class.php" method="POST">
            <input type="hidden" name="class_id" value="<?php echo $row['id']; ?>">
            <button type="submit" class="buy-now">Book Now</button>
          </form>
        </div>
      </div>
    <?php } ?>
  </div>
</section>


<!-- Footer Section -->
<footer class="footer">
  <div class="footer-top">
    <p>&copy; 2023 Fitness Fitzone. All rights reserved.</p>
    <ul class="social-list">
      <li><a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a></li>
      <li><a href="#" class="social-link"><i class="fab fa-twitter"></i></a></li>
      <li><a href="#" class="social-link"><i class="fab fa-instagram"></i></a></li>
    </ul>
  </div>
  <div class="footer-bottom">
    Designed by Fitness Fitzone Team
  </div>
</footer>

<script>
// Toggle menu visibility for mobile view
function toggleMenu() {
    const navLinks = document.querySelector('.nav-links');
    navLinks.classList.toggle('active');
}

// Close menu when a link is clicked
document.querySelectorAll('.nav-links a').forEach(link => {
    link.addEventListener('click', () => {
        const navLinks = document.querySelector('.nav-links');
        if (navLinks.classList.contains('active')) {
            navLinks.classList.remove('active');
        }
    });
});
</script>



</body>
</html>
