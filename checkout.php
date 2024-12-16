<?php
session_start();
include("db/dbconn.php");

if (!isset($_SESSION['user_id'])) {
  header("Location: userlogin.php");
  exit;
}

$user_id = $_SESSION['user_id'];
$sql_clear_cart = "DELETE FROM cart WHERE user_id = ?";
$stmt_clear = $conn->prepare($sql_clear_cart);
$stmt_clear->bind_param("i", $user_id);
$stmt_clear->execute();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You - Fit Zone</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #0c1437;
            color: #333;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
        }

        /* Header and Navigation */
        header {
            width: 100%;
            max-width: 1200px;
            margin-bottom: 20px;
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #333;
            padding: 1rem 2rem;
            border-radius: 5px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .logo {
            font-size: 2rem;
            font-weight: bold;
            color: #ff4b2b;
        }

        .nav-links {
            list-style: none;
            display: flex;
            gap: 1.5rem;
        }

        .nav-links a {
            color: #f7f8fc;
            text-decoration: none;
            font-weight: 500;
            font-size: 1rem;
        }

        .nav-links a:hover {
            color: #ff4b2b;
        }

        .cta {
            background: #ff4b2b;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            color: #fff;
            margin-left: 1rem;
            text-decoration: none;
        }

        .cta:hover {
            background-color: #e6392f;
        }

        /* Home Section */
        .home-section {
            width: 100%;
            height: 80vh;
            background-image: url('images/home-bg.jpg');
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: white;
            padding: 2rem;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .home-content {
            max-width: 500px;
        }

        .start-button {
            background-color: #ff4b2b;
            color: white;
            padding: 0.75rem 2rem;
            border-radius: 5px;
            text-decoration: none;
        }

        .start-button:hover {
            background-color: #e6392f;
        }

        /* Card Section */
        .card-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
            margin-top: 30px;
        }

        .card {
            width: 250px;
            background-color: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card img {
            width: 100%;
            height: auto;
            object-fit: cover;
        }

        .content {
            padding: 1rem;
            text-align: center;
        }

        /* Footer */
        footer {
            width: 100%;
            max-width: 1200px;
            padding: 1.5rem 2rem;
            text-align: center;
            background-color: #333;
            color: #fff;
            margin-top: 281px;
        }

        .social-list {
            list-style: none;
            display: flex;
            gap: 1rem;
            justify-content: center;
            padding-top: 1rem;
        }

        .social-list a {
            color: #f7f8fc;
            font-size: 1.5rem;
        }

        .footer-bottom {
            font-size: 0.9em;
            margin-top: 1rem;
        }

        /* Purchase Confirmation */
        .confirmation-message {
            text-align: center;
            margin-top: 50px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            max-width: 600px;
        }

        .confirmation-message p {
            font-size: 1.2em;
            margin-bottom: 20px;
            
        }

        .confirmation-message a {
            color: #ff4b2b;
            font-weight: bold;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            border: 2px solid #ff4b2b;
        }

        .confirmation-message a:hover {
            background-color: #ff4b2b;
            color: #fff;
        }
    </style>
</head>
<body>

<header>
    <nav>
        <div class="logo">Fit Zone</div>
      
        <a href="main.php" class="cta">Home</a>
    </nav>
</header>

<section class="confirmation-message">
    <p>Thank you for your purchase! Your order has been confirmed.</p>
   
</section>

<footer>
    <p>Fit Zone © 2024. All rights reserved.</p>
    <ul class="social-list">
        <li><a href="#"><i class="fab fa-facebook"></i></a></li>
        <li><a href="#"><i class="fab fa-twitter"></i></a></li>
        <li><a href="#"><i class="fab fa-instagram"></i></a></li>
    </ul>
    <div class="footer-bottom">Powered by Fit Zone</div>
</footer>

</body>
</html>
