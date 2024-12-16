<!DOCTYPE html> 
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Fitness Fitzone</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="style/main.css">


  <style>
    /* Search Form Styling */
.search-form {
  display: flex;
  align-items: center;
  margin-left: 10px;
}

.search-form input {
  padding: 5px 10px;
  border: 1px solid #ccc;
  border-radius: 20px;
  outline: none;
  font-size: 14px;
}

.search-form button {
  background: none;
  border: none;
  color: white;
  margin-left: 5px;
  cursor: pointer;
  font-size: 16px;
}

.search-form button:hover {
  color: #ff4b2b;
}

  </style>

</head>
<body>

<?php
include("db/dbconn.php");
session_start();

$sqlp = "SELECT * FROM product";
$resultp = $conn->query($sqlp);
$sqlt = "SELECT * FROM trainer";
$resultt = $conn->query($sqlt);
$sqlc = "SELECT * FROM gym_classes";
$resultc = $conn->query($sqlc);



$sql_count = "SELECT COUNT(*) AS cart_count FROM cart WHERE user_id = ?";
$stmt_count = $conn->prepare($sql_count);
$stmt_count->bind_param("i", $user_id);
$stmt_count->execute();
$count_result = $stmt_count->get_result();
$count_row = $count_result->fetch_assoc();
$cart_count = $count_row['cart_count']; 
?>

<header>
  <nav>
    <div class="logo">Fit Zone</div>
    <i class="fas fa-bars menu-toggle" onclick="toggleMenu()"></i>
    <ul class="nav-links">
      <li><a href="#home">Home</a></li>
      <li><a href="#product">Products</a></li>
      <li><a href="#classes">Classes</a></li>
      <li><a href="#trainer">Trainers</a></li>
      <li><a href="#footer">Contact</a></li>
      <li><a href="aboutforindex.php">About</a></li>
      <li>
        <form action="searchIndex.php" method="GET" class="search-form">
          <input type="text" name="query" placeholder="Search products..." required>
          <button type="submit"><i class="fas fa-search"></i></button>
        </form>
      </li>
  
    </ul>

    <div style="color:white">
    <a href="userregistrationGUI.php" class="cta">Register</a>
     <a href="userlogin.php" class="cta">Login</a>
    </div>
  </nav>
</header>

<section id="home" class="home-section"> 
    <div class="home-content">
        <h1>Welcome to Fit Zone</h1>
        <p>Your journey to fitness begins here. Join us and transform your life!</p>
        <a href="#classes" class="start-button">Let's Start</a>
    </div>
</section>


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
          <a href="userlogin.php"><button type="submit" class="buy-now">Buy Now</button>
          </a>            
          <?php else: ?>
            <p class="out-of-stock">Out of Stock</p>
          <?php endif; ?>
        </div>
      </div>
    <?php } ?>
  </div>
</section>


<!-- Trainers Section -->
<section id="trainer" class="section-container">
  <h2>Trainers</h2>
  <div class="card-container">
    <?php while ($row = mysqli_fetch_assoc($resultt)) { ?>
      <div class="card">
        <img src="traineerimages/<?php echo htmlspecialchars($row['image']); ?>" alt="<?php echo htmlspecialchars($row['Name']); ?>" onerror="this.src='default-image.jpg';">
        <div class="content">
          <p class="trainer_name">Name: <?php echo htmlspecialchars($row["Name"]); ?></p>
          <p class="description">About: <?php echo htmlspecialchars($row["description"]); ?></p>
          <p class="number">Number: <?php echo htmlspecialchars($row["number"]); ?></p>
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
          <h3 class="ClassName"><?php echo htmlspecialchars($row["ClassName"]); ?></h3>
          <p class="description"><?php echo htmlspecialchars($row["Description"]); ?></p>
          <p class="duration"><strong>Duration:</strong> <?php echo htmlspecialchars($row["Duration"]); ?></p>
          <p class="schedule"><strong>Schedule:</strong> <?php echo htmlspecialchars($row["Schedule"]); ?></p>
          <p class="price"><strong>Price:</strong> LKR <?php echo htmlspecialchars(number_format($row["Price"], 2)); ?></p>
      
          <a href="userlogin.php"><button type="submit" class="book-Now">Book Now</button>
          </a>        
        
        </div>
      </div>
    <?php } ?>
  </div>
</section>


<!-- Footer Section -->
<footer class="footer" id="footer">
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
