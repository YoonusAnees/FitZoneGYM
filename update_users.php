<?php
include("db/dbconn.php");

// Check if the form was submitted with the ID
if (isset($_POST['updateID'])) {
    // Get the form values
    $updateID = $_POST['updateID'];
    $username = $_POST['class_name'];
    $password = $_POST['description'];
    $email = $_POST['duration'];
    $number = $_POST['schedule'];

    // Prepare the update query with placeholders to prevent SQL injection
    try {
        $sql = "UPDATE userregistration 
                SET username = ?, password = ?, email = ?, number = ? 
                WHERE id = ?";
        
        // Prepare the statement
        $stmt = mysqli_prepare($conn, $sql);
        
        // Bind parameters (s = string, i = integer)
        mysqli_stmt_bind_param($stmt, "ssssi", $username, $password, $email, $number, $updateID);
        
        // Execute the statement
        if (mysqli_stmt_execute($stmt)) {
            header("Location: admindashboard.php"); // Redirect after successful update
        } else {
            echo "Error: " . mysqli_error($conn); // Output error if update fails
        }

        // Close the prepared statement
        mysqli_stmt_close($stmt);
    } catch (Exception $e) {
        echo "Message: " . $e->getMessage();
    }
} else {
    echo "Invalid request.";
}

// Close the connection
mysqli_close($conn);
?>
