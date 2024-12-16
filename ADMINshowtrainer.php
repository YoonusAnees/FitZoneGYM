<?php
include("db/dbconn.php");

// Check for database connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch product data
$sql = "SELECT * FROM trainer";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fit Zone Traineer</title>
    <link rel="stylesheet" href="style/main.css">
    <style>
        /* Base Styling */
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

        /* Navigation Styling */
        nav {
            width: 100%;
            max-width: 1200px;
            background-color: #333;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1rem 2rem;
            border-radius: 5px;
            margin-bottom: 20px;
            color: #fff;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: bold;
            color: #ff4b2b;
        }

        .nav-links {
            list-style: none;
            display: flex;
        }

        .nav-links li {
            margin: 0 1rem;
        }

        .nav-links a {
            color: #fff;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
        }

        .nav-links a:hover {
            color: #ff4b2b;
        }

        /* Header Styling */
        header {
            text-align: center;
            margin-bottom: 20px;
        }

        header h1 {
            font-size: 2rem;
            color: #ff4b2b;
        }

        /* Card Grid Layout */
        section {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .card {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            text-align: center;
            transition: transform 0.2s;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card img {
            width: 100%;
            height: 400px; 
            object-fit: cover; 
            object-position: center; 
        }

        .content {
            padding: 1rem;
            flex-grow: 1; 
            background: #fafafa;
            border-top: 1px solid #ddd; 
        }

        .content p {
            margin: 0.5rem 0;
            font-size: 1rem; 
            line-height: 1.5; 
            color: #444; 
        }

        .content p:first-child {
            font-weight: bold; 
        }

        /* Button Styles */
        .buttons {
            margin-top: 10px;
        }

        .btn {
            background-color: #ff4b2b;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 15px;
            cursor: pointer;
            transition: background-color 0.3s;
            text-decoration: none; 
        }

        .btn:hover {
            background-color: #ff1f00;
        }

        .btn.delete {
            background-color: #e74c3c; 
        }

        .btn.delete:hover {
            background-color: #c0392b;
        }

    </style>
</head>
<body>

    <!-- Navigation -->
    <nav>
        <div class="logo">Fit Zone</div>
        <ul class="nav-links">
            <li><a href="admindashboard.php" class="cta">Back To Admin Panel</a></li>
        </ul>
    </nav>

    <!-- Header Section -->
    <header>
        <h1>Trainer</h1>
    </header>

    <!-- Products Section -->
    <section>
       
            <?php while ($row = mysqli_fetch_assoc($result)){?>
                <div class="card">
                    <img src="traineerimages/<?php echo htmlspecialchars($row['image']); ?>" alt="<?php echo htmlspecialchars($row['Name']); ?>" onerror="this.src='default-image.jpg';">
                    <div class="content">
                        <p class="product_name">Name:<?php echo htmlspecialchars($row["Name"]); ?></p>
                        <p class="category">About: <?php echo htmlspecialchars($row["description"]); ?></p>
                        <p class="quantity">Number: <?php echo htmlspecialchars($row["number"]); ?></p>
                        <div class="buttons">
                            <a href="adminUpdateTrainerGUI.php?id=<?php echo $row['id']; ?>" class="btn">Update</a>
                            <form action="Admindeletetrainers.php" method="GET" style="display:inline;">
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                <button type="submit" class="btn delete">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php } ?>
       
    </section>

</body>
</html>
