<?php
include("db/dbconn.php");
if(isset($_GET['id'])){
    $updateID=$_GET['id'];
}

$sql = "SELECT * FROM userregistration WHERE id = $updateID";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
    <style>
     /* Base Styling */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Arial', sans-serif;
}

/* Body Styling */
body {
    background-color: #f7f8fa;
    color: #333;
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 30px 0;
}

/* Navigation Bar Styling */
header {
    width: 100%;
    max-width: 1200px;
    padding: 1rem;
    text-align: center;
    color: #333;
    margin-bottom: 40px;
}

nav {
    width: 100%;
    max-width: 1200px;
    background-color: #333;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 1rem 2rem;
    border-radius: 8px;
    color: #fff;
}

.logo {
    font-size: 1.8rem;
    font-weight: bold;
    color: #ff4b2b;
}

.cta {
    background: #ff4b2b;
    padding: 0.5rem 1rem;
    border-radius: 5px;
    color: #fff;
    text-decoration: none;
    transition: background 0.3s ease;
}

.cta:hover {
    background: #e6392f;
}

/* Form Container Styling */
#upload_container {
    max-width: 600px;
    width: 100%;
    padding: 2.5rem 2rem;
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 5px 12px rgba(0, 0, 0, 0.1);
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

#upload_container h2 {
    color: #333;
    margin-bottom: 1.5rem;
    font-size: 2rem;
    text-align: center;
}

/* Form Fields */
.form-group {
    display: flex;
    flex-direction: column;
    gap: 0.7rem;
}

.form-group label {
    font-weight: bold;
    color: #555;
    font-size: 1rem;
}

.form-group input[type="text"],
.form-group input[type="email"] {
    padding: 0.8rem;
    border-radius: 8px;
    border: 1px solid #ddd;
    outline: none;
    transition: border-color 0.3s, box-shadow 0.3s;
    font-size: 1rem;
}

.form-group input[type="text"]:focus,
.form-group input[type="email"]:focus {
    border-color: #ff4b2b;
    box-shadow: 0 0 6px rgba(255, 75, 43, 0.3);
}

/* Buttons */
.button-group {
    display: flex;
    gap: 1.2rem;
    justify-content: center;
    margin-top: 1.5rem;
}

input[type="submit"],
input[type="reset"] {
    padding: 0.9rem 2rem;
    border-radius: 8px;
    border: none;
    color: #fff;
    font-size: 1rem;
    cursor: pointer;
    transition: background 0.3s, transform 0.2s;
}

input[type="submit"] {
    background: #333;
}

input[type="reset"] {
    background: #ff4b2b;
}

input[type="submit"]:hover {
    background: #555;
    transform: translateY(-2px);
}

input[type="reset"]:hover {
    background: #e6392f;
    transform: translateY(-2px);
}

/* Responsive Styles */
@media (max-width: 768px) {
    #upload_container {
        padding: 2rem 1.5rem;
    }

    .form-group input[type="text"],
    .form-group input[type="email"] {
        font-size: 0.95rem;
    }

    input[type="submit"],
    input[type="reset"] {
        padding: 0.8rem 1.6rem;
        font-size: 0.95rem;
    }
}

    </style>
</head>
<body>

<header>
    <nav>
        <div class="logo">Fit Zone</div>
        <a href="admindashboard.php" class="cta">Back To Admin Panel</a>
    </nav>
</header>

<div id="upload_container">
    <h2>Update User</h2>
    <form action="update_users.php" method="POST">
        <input type="hidden" name="updateID" value="<?php echo htmlspecialchars($row['id']); ?>">

        <div class="form-group">
            <label for="fname"> Name</label>
            <input type="text" name="class_name" id="ClassName" value="<?php echo htmlspecialchars($row['username']); ?>" required>
        </div>

        <div class="form-group">
            <label for="lname">Password</label>
            <input type="text" name="description" id="description" value="<?php echo htmlspecialchars($row['password']); ?>" required>
        </div>

        <div class="form-group">
            <label for="mnumber">email</label>
            <input type="email" name="duration" id="duration" value="<?php echo htmlspecialchars($row['email']); ?>" required>
        </div>

        <div class="form-group">
            <label for="UserAddress">Number</label>
            <input type="text" name="schedule" id="schedule" value="<?php echo htmlspecialchars($row['number']); ?>" required>
        </div>

 


       
      
        <div class="button-group">
            <input type="submit" value="Update" name="ADD">
            <input type="reset" value="Reset" name="rst">
        </div>
    </form>
</div>

</body>
</html>
