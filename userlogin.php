<?php
include('db/dbconn.php');
session_start();

$adminUsername = "admin@gmail.com";
$adminPassword = "admin123";

try {
    if (isset($_POST['Submit'])) {
        $Email = $_POST['email'];
        $password = $_POST['password'];

        if (empty($Email) || empty($password)) {
            echo "Please fill in all fields.";
            header("location:userlogin.php");
            exit();
        }

        if ($Email === $adminUsername && $password === $adminPassword) {
            $_SESSION['role'] = 'admin';
            header("location:admindashboard.php");
            exit();
        }

        $staffQuery = "SELECT * FROM staff WHERE Email='$Email' AND Password='$password'";
        $staffResult = mysqli_query($conn, $staffQuery);

        if ($staffResult && $staffResult->num_rows > 0) {
            $staffRow = $staffResult->fetch_assoc();
            $_SESSION['role'] = 'staff';
            $_SESSION['FirstName'] = $staffRow['FirstName'];
            $_SESSION['email'] = $staffRow['Email'];
            $_SESSION['mnumber'] = $staffRow['MobileNumber'];

            header("location:staffdashboard.php");
            exit();
        }
        

        $userQuery = "SELECT * FROM userregistration WHERE email='$Email' AND password='$password'";
        $userResult = mysqli_query($conn, $userQuery);

   if ($userResult && $userResult->num_rows > 0) {
    $userRow = $userResult->fetch_assoc();
    $_SESSION['role'] = 'user';
    $_SESSION['email'] = $userRow['email'];
    $_SESSION['password'] = $userRow['password'];
    $_SESSION['username'] = $userRow['username'];
    $_SESSION['user_id'] = $userRow['id'];  
    header("location:main.php");
    exit();
}


        header("location:userlogin.php");
        exit();
    }
} catch (Exception $e) {
    echo "Message: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fit Zone Login</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #f0f2f5;
            color: #333;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
        }

        header {
            width: 100%;
            max-width: 1200px;
            padding: 1rem;
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        header h1 {
            font-size: 2rem;
            color: #ff4b2b;
        }

        nav {
            width: 100%;
            max-width: 1200px;
            background-color: #333;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1rem 2rem;
            border-radius: 5px;
            margin-bottom: 10px;
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

        .cta {
            background: #ff4b2b;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            color: #fff;
            text-decoration: none;
            transition: background 0.3s;
        }

        .cta:hover {
            background: #e6392f;
        }

        #upload_container {
            max-width: 600px;
            margin: 4rem auto;
            padding: 2.5rem;
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        #upload_container h2 {
            color: #333;
            margin-bottom: 1.5rem;
            font-size: 1.8rem;
        }

        #upload_container input[type="email"],
        #upload_container input[type="text"],
        #upload_container input[type="password"] {
            width: 100%;
            padding: 0.9rem;
            margin-bottom: 1.2rem;
            border-radius: 10px;
            border: 1px solid #ddd;
            outline: none;
            transition: border-color 0.3s;
        }

        #upload_container input[type="email"]:focus,
        #upload_container input[type="text"]:focus,
        #upload_container input[type="password"]:focus {
            border-color: #ff4b2b;
        }

        .button-group {
            display: flex;
            gap: 10px;
            justify-content: center;
            margin-top: 1.2rem;
        }

        .button-group input[type="submit"],
        .button-group input[type="reset"] {
            flex: 1;
            padding: 1rem;
            border-radius: 8px;
            border: none;
            font-size: 1rem;
            cursor: pointer;
            transition: background 0.3s, transform 0.2s;
            width: 45%;
        }

        input[type="submit"] {
            background: #333;
            color: #fff;
        }

        input[type="submit"]:hover {
            background: #555;
            transform: translateY(-2px);
        }

        input[type="reset"] {
            background: #ff4b2b;
            color: #fff;
        }

        input[type="reset"]:hover {
            background: #e6392f;
            transform: translateY(-2px);
        }

        .login {
            margin-top: 1.5rem;
            font-size: 1rem;
        }

        .login a {
            color: #ff4b2b;
            text-decoration: none;
            transition: color 0.3s;
        }

        .login a:hover {
            color: #e6392f;
        }

        @media (max-width: 768px) {
            nav {
                flex-direction: column;
                align-items: flex-start;
            }

            .nav-links {
                flex-direction: column;
                width: 100%;
                gap: 1rem;
                padding: 1rem 0;
            }

            #upload_container {
                padding: 2rem 1rem;
                width: 90%;
            }

            .logo, .nav-links a, .cta {
                font-size: 1.2rem;
            }
        }
    </style>
</head>
<body>

    <header>
        <nav>
            <div class="logo">Fit Zone</div>
        </nav>
    </header>

    <section id="upload_container">
        <h2>Login</h2>
        <form action="" method="POST">
            <input type="email" name="email" id="email" placeholder="Email" required>
            <input type="password" name="password" id="password" placeholder="Password" required>

            <div class="button-group">
                <input type="submit" value="Login" name="Submit">
                <input type="reset" value="Reset" name="rst">
            </div>

            <div class="login">
                <a href="userregistrationGUI.php">New User? Register Here</a>
            </div>
        </form>
    </section>

</body>
</html>
