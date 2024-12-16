<?php
include("db/dbconn.php");
$username=$_POST['username'];
$password=$_POST['password'];
$email=$_POST['email'];
$number=$_POST['number'];

try{
    $sql = "insert into userregistration(username,password,email,number)
values('$username','$password','$email','$number')";

// echo "<br>" ,$sql;

if(mysqli_query($conn,$sql)){
    header("location:main.php");
}
else{
    echo "Error".$sql."<br>".mysqli_error($conn);
    header("location:userregistrationGUI.php");
}

}
catch(Exception $e){
    echo"Message: ".$e->getMessage();
}

?>


<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Register</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap');
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #ff7e5f, #feb47b);
            background-size: 400% 400%;
            animation: gradientBG 10s ease infinite;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        @keyframes gradientBG {
            0% {background-position: 0% 50%;}
            50% {background-position: 100% 50%;}
            100% {background-position: 0% 50%;}
        }

        form {
            background-color: #fff;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            width: 350px;
            position: relative;
            animation: fadeIn 1s ease-in-out;
        }

        form h2 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 24px;
            font-weight: 600;
            color: #333;
        }

        form label {
            display: block;
            margin-bottom: 6px;
            color: #555;
            font-size: 14px;
            font-weight: 500;
        }

        form input[type="text"],
        form input[type="email"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
            transition: border-color 0.3s;
        }

        form input[type="text"]:focus,
        form input[type="email"]:focus {
            border-color: #ff7e5f;
            box-shadow: 0 0 5px rgba(255, 126, 95, 0.5);
        }

        form input[type="submit"],
        form input[type="reset"] {
            width: 48%;
            padding: 12px;
            border: none;
            border-radius: 8px;
            background-color: #ff7e5f;
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        form input[type="reset"] {
            background-color: #ff3d6b;
        }

        form input[type="submit"]:hover {
            background-color: #e34e5d;
        }

        form input[type="reset"]:hover {
            background-color: #d02a52;
        }

        form input[type="submit"]:active,
        form input[type="reset"]:active {
            transform: scale(0.98);
        }

        .sign {
            text-align: center;
            margin-top: 20px;
        }

        .sign a {
            color: #ff7e5f;
            text-decoration: none;
            font-size: 14px;
        }

        .sign a:hover {
            text-decoration: underline;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>

<form action="" method="POST">
    <h2>Register</h2>
    <label for="username">User Name</label>
    <input type="text" name="username" id="username" placeholder="Enter your name" required>
    
    <label for="password">Password</label>
    <input type="text" name="password" id="password" placeholder="Enter your password" required>
    
    <label for="email">Email</label>
    <input type="email" name="email" id="email" placeholder="Enter your email" required>
    
    <label for="number">Number</label>
    <input type="text" name="number" id="number" placeholder="Enter your number" required>
    
    <div style="display: flex; justify-content: space-between;">
        <input type="submit" value="Submit" name="submit">
        <input type="reset" value="Reset" name="rst">
    </div>
    
    <div class="sign">
        <a href="signinGUI.php">Already have an account? Sign in</a>
    </div>
</form>

</body>
</html> -->
