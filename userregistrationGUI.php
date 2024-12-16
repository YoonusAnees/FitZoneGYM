<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
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

        #register-container {
            max-width: 600px;
            margin: 4rem auto;
            padding: 2.5rem;
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        #register-container h2 {
            color: #333;
            margin-bottom: 1.5rem;
            font-size: 1.8rem;
        }

        #register-container label {
            display: block;
            text-align: left;
            margin-bottom: 0.5rem;
            color: #555;
            font-weight: bold;
        }

        #register-container input[type="email"],
        #register-container input[type="text"],
        #register-container input[type="password"] {
            width: 100%;
            padding: 0.9rem;
            margin-bottom: 1.2rem;
            border-radius: 10px;
            border: 1px solid #ddd;
            outline: none;
            transition: border-color 0.3s;
        }

        #register-container input[type="email"]:focus,
        #register-container input[type="text"]:focus,
        #register-container input[type="password"]:focus {
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

        /* Responsive Styles */
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

            #register-container {
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
        <ul class="nav-links"></ul>
    </nav>
</header>

<section id="register-container">
    <form action="userregistration.php" method="POST">
        <h2>Register</h2>
        <label for="username">User Name</label>
        <input type="text" name="username" id="username" placeholder="Enter your name" required>
        
        <label for="password">Password</label>
        <input type="password" name="password" id="password" placeholder="Enter your password" required>
        
        <label for="email">Email</label>
        <input type="email" name="email" id="email" placeholder="Enter your email" required>
        
        <label for="number">Phone Number</label>
        <input type="text" name="number" id="number" placeholder="Enter your phone number" required>
        
        <div class="button-group">
            <input type="submit" value="Submit" name="submit">
            <input type="reset" value="Reset" name="rst">
        </div>
        
        
        <div class="login">
            <a href="userlogin.php">Already have an account? Sign in</a>
        </div>
    </form>
</section>

</body>
</html>
