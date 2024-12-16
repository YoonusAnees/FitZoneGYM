<?php
include("db/dbconn.php");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['submit'])) {
    $className = $_POST['class_name'];
    $description = $_POST['description'];
    $classDuration = $_POST['duration'];
    $classSchedule = $_POST['schedule'];
    $price = $_POST['price'];

    // Image upload handling
    $fileName = $_FILES["filetoUpload"]["name"];
    $tempfilename = $_FILES["filetoUpload"]["tmp_name"];
    $target_file = "classimages/" . basename($fileName);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    if ($tempfilename) {
        $check = getimagesize($tempfilename);
        if ($check === false) {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }

    if (file_exists($target_file)) {
        echo "File already exists.";
        $uploadOk = 0;
    }

    if ($_FILES["filetoUpload"]["size"] > 10000000) {
        echo "File too large.";
        $uploadOk = 0;
    }

    if (!in_array($imageFileType, ["jpg", "png", "jpeg", "gif"])) {
        echo "Invalid file type.";
        $uploadOk = 0;
    }

    if ($uploadOk == 1 && move_uploaded_file($tempfilename, $target_file)) {
        // Insert gym class information
        try {
            $sql = "INSERT INTO gym_classes (ClassName, Description, Duration, Schedule, Price, Image)
                    VALUES ('$className', '$description', '$classDuration', '$classSchedule', '$price', '$fileName')";

            if (mysqli_query($conn, $sql)) {
                header("location:ADMINshowclasses.php");
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        } catch (Exception $e) {
            echo "Message: " . $e->getMessage();
        }
    } else {
        echo "File upload failed.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fit Zone - Add Gym Class</title>
    <style>
        /* Base Styling */
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
        .cta {
            background: #ff4b2b;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            color: #fff;
            text-decoration: none;
            transition: background 0.3s;
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
        #upload_container input[type="text"],
        #upload_container input[type="number"],
        #upload_container input[type="email"],
        #upload_container input[type="time"] {
            width: 100%;
            padding: 0.9rem;
            margin-bottom: 1.2rem;
            border-radius: 10px;
            border: 1px solid #ddd;
            outline: none;
            transition: border-color 0.3s;
        }
        
        /* Styling for "Choose Image" button */
        #choose {
            width: 100%;
            padding: 1rem;
            border-radius: 8px;
            border: 1px solid #ddd;
            background-color: #ff4b2b;
            color: #fff;
            font-size: 1rem;
            cursor: pointer;
            margin-bottom: 1.2rem;
            transition: background-color 0.3s, color 0.3s;
        }

        #choose:hover {
            background-color: #ff6a4d;
            color: #fff;
            border-color: #ff6a4d;
        }

        /* Styling for Submit button */
        input[type="submit"] {
            width: 100%;
            padding: 1rem;
            border-radius: 8px;
            border: none;
            background-color: #333;
            color: #fff;
            font-size: 1rem;
            cursor: pointer;
            transition: background 0.3s, color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #555;
        }
    </style>
</head>
<body>

    <header>
        <nav>
            <div class="logo">Fit Zone</div>
            <a href="staffdashboard.php" class="cta">Back To Staff Panel</a>
        </nav>
    </header>

    <section id="upload_container">
        <h2>Add Gym Class</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <input type="text" name="class_name" id="class_name" placeholder="Class Name" required>
            <input type="text" name="description" id="description" placeholder="Description" required>
            <input type="time" name="duration" id="duration" placeholder="Class Duration (HH:MM)" required>
            <input type="text" name="schedule" id="schedule" placeholder="Class Schedule (e.g., Mon-Fri)" required>
            <input type="number" name="price" id="price" placeholder="Price" required>
            <input type="file" name="filetoUpload" id="imageUpload" required hidden>
            <button type="button" id="choose" onclick="upload()">Choose Image</button>
            <input type="submit" value="Upload" name="submit">
        </form>
    </section>

    <script>
        var choose = document.getElementById("choose");
        var uploadImage = document.getElementById("imageUpload");

        function upload() {
            uploadImage.click();
        }

        uploadImage.addEventListener("change", function() {
            var file = this.files[0];
            if (file) {
                choose.innerHTML = "Selected: " + file.name;
            }
        });
    </script>

</body>
</html>
