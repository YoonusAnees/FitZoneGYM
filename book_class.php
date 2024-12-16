<?php
include("db/dbconn.php");
session_start();

// Check if the user is logged in
if (!isset($_SESSION['email']) && !isset($_SESSION['password'])) {
  header("location:userlogin.php");
  exit;
}

// Ensure that class_id is set and valid
if (isset($_POST['class_id'])) {
  $class_id = $_POST['class_id'];
  $user_id = $_SESSION['user_id']; // Assuming the user ID is stored in the session

  // Insert booking into the database
  $sql = "INSERT INTO class_bookings (user_id, class_id) VALUES (?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ii", $user_id, $class_id);

  if ($stmt->execute()) {
    // Retrieve user and class information for display
    $user_sql = "SELECT username, email FROM userregistration WHERE id = ?";
    $class_sql = "SELECT ClassName, Description, Schedule, Price FROM gym_classes WHERE id = ?";
    
    $user_stmt = $conn->prepare($user_sql);
    $user_stmt->bind_param("i", $user_id);
    $user_stmt->execute();
    $user_result = $user_stmt->get_result();
    $user_info = $user_result->fetch_assoc();
    
    $class_stmt = $conn->prepare($class_sql);
    $class_stmt->bind_param("i", $class_id);
    $class_stmt->execute();
    $class_result = $class_stmt->get_result();
    $class_info = $class_result->fetch_assoc();
    
    // Close statements
    $user_stmt->close();
    $class_stmt->close();
  } else {
    echo "Error booking class.";
  }
  $stmt->close();
} else {
  echo "Invalid request.";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation</title>
    <link rel="stylesheet" href="style/main.css">
    <style>
     
        /* Section Styling */
        section {
            max-width: 600px;
            margin: 40px auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h2 {
            font-size: 26px;
            color: #333;
            margin-bottom: 20px;
            text-align: center;
        }
        p {
            font-size: 16px;
            margin-bottom: 10px;
        }
        .confirmation-details {
            margin-bottom: 20px;
            font-size: 18px;
        }

        .logged-user{
          color: white;
        }
       
    </style>
</head>
<body>
<header>
  <nav>
    <div class="logo">Fit Zone</div>
    <ul class="nav-links">
      <li><a href="index.php">Home</a></li>
      <li><a href="index.php#product">Products</a></li>
      <li><a href="index.php#classes">Classes</a></li>
      <li><a href="index.php#trainer">Trainers</a></li>
      <li><a href="index.php#contact">Contact</a></li>
      <li><a href="index.php#about">About</a></li>
    </ul>
    <div class="user-options">
      <?php if (isset($user_info['username'])): ?>
        <span class="logged-user">Hello, <?php echo htmlspecialchars($user_info['username']); ?></span>
      <?php endif; ?>
      <a href="main.php" class="cta">Back</a>
    </div>
  </nav>
</header>

<section>
  <h2>Booking Confirmation</h2>
  <?php if (isset($class_info) && isset($user_info)): ?>
    <div class="confirmation-details">
      <p><strong>User Name:</strong> <?php echo htmlspecialchars($user_info['username']); ?></p>
      <p><strong>Email:</strong> <?php echo htmlspecialchars($user_info['email']); ?></p>
      <p><strong>Class Name:</strong> <?php echo htmlspecialchars($class_info['ClassName']); ?></p>
      <p><strong>Description:</strong> <?php echo htmlspecialchars($class_info['Description']); ?></p>
      <p><strong>Schedule:</strong> <?php echo htmlspecialchars($class_info['Schedule']); ?></p>
      <p><strong>Price:</strong> LKR <?php echo htmlspecialchars(number_format($class_info['Price'], 2)); ?></p>
      <p>Class booked successfully!</p>
    </div>
  <?php else: ?>
    <p>Booking details are unavailable. Please try again.</p>
  <?php endif; ?>
</section>

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
</body>
</html>
