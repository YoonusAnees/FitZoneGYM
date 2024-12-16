<!DOCTYPE html> 
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Fitness Fitzone</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="style/main.css">

  <style>
    /* Feedback Section Styling */
    .feedback-section {
      padding: 20px;
      background-color: #f8f8f8;
      text-align: center;
      margin: 20px 0;
    }

    .feedback-form {
      max-width: 600px;
      margin: auto;
    }

    .feedback-form label {
      display: block;
      margin: 10px 0 5px;
    }

    .feedback-form input,
    .feedback-form textarea {
      width: 100%;
      padding: 10px;
      margin-bottom: 10px;
    }

    .feedback-form button {
      background-color: #ff4b2b;
      color: white;
      padding: 10px 20px;
      border: none;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    .feedback-form button:hover {
      background-color: #45a049;
    }

    /* Vision and Mission Styling */
    .about-section {
      background-color: #e9f5f2;
      padding: 40px 20px;
      text-align: center;
    }

    .about-section h2 {
      color: #2d6a4f;
      font-size: 2.2em;
      margin-bottom: 10px;
      text-transform: uppercase;
      border-bottom: 3px solid #2d6a4f;
      display: inline-block;
      padding-bottom: 5px;
    }

    .about-section p {
      font-size: 1.1em;
      color: #333;
      max-width: 800px;
      margin: auto;
      line-height: 1.6;
      padding: 10px 0;
    }

    .about-section p:not(:last-of-type) {
      border-bottom: 1px solid #ddd;
      padding-bottom: 20px;
      margin-bottom: 20px;
    }

    /* Smooth Scroll */
    html {
      scroll-behavior: smooth;
    }
  </style>
</head>
<body>

<?php
include("db/dbconn.php");






$sql_count = "SELECT COUNT(*) AS cart_count FROM cart WHERE user_id = ?";
$stmt_count = $conn->prepare($sql_count);
$stmt_count->bind_param("i", $user_id);
$stmt_count->execute();
$count_result = $stmt_count->get_result();
$count_row = $count_result->fetch_assoc();
$cart_count = $count_row['cart_count']; // Assign cart count value
?>

<!-- Header Section -->
<header>
  <nav>
    <div class="logo">Fit Zone</div>
    <i class="fas fa-bars menu-toggle" onclick="toggleMenu()"></i>
    <ul class="nav-links">
      <li><a href="index.php">Home</a></li>
      <li><a href="index.php">Products</a></li>
      <li><a href="index.php">Classes</a></li>
      <li><a href="index.php">Trainers</a></li>
      <li><a href="#footer">Contact</a></li>
      <li><a href="aboutforindex.php">About</a></li>
  
    </ul>

    <div style="color:white">
    <a href="userregistrationGUI.php" class="cta">Register</a>
     <a href="userlogin.php" class="cta">Login</a>
    </div>
  </nav>
</header>

<!-- Vision and Mission Section -->
<section id="about" class="about-section">
  <h2>Our Vision</h2>
  <p>At Fitzone Fitness, we aim to inspire and empower individuals to lead healthier and more active lives. Our vision is to create a supportive community where everyone can achieve their fitness goals and transform their lives.</p>

  <h2>Our Mission</h2>
  <p>Our mission is to provide top-quality fitness programs, world-class trainers, and a state-of-the-art facility to help you become the best version of yourself. We are dedicated to helping you reach your personal health and fitness milestones in a safe, encouraging, and positive environment.</p>
</section>

<!-- Feedback Form Section -->
<section id="feedback" class="feedback-section">
  <h2>We Value Your Feedback</h2>
  <p>Your feedback helps us improve our services. Please let us know about your experience at Fitzone Fitness.</p>

  <form action="submit_feedback.php" method="POST" class="feedback-form">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>

    <label for="feedback">Your Feedback:</label>
    <textarea id="feedback" name="feedback" rows="5" required></textarea>

    <button type="submit">Submit Feedback</button>
  </form>
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
