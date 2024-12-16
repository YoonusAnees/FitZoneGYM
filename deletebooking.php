<?php
include("db/dbconn.php");

// Check for database connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if 'id' is set in the URL
if (isset($_GET['id'])) {
    $booking_id = $_GET['id'];

    // Prepare SQL query to delete the booking record
    $sql_delete = "DELETE FROM class_bookings WHERE id = ?";
    
    // Prepare the statement
    $stmt = mysqli_prepare($conn, $sql_delete);
    
    // Bind the parameter
    mysqli_stmt_bind_param($stmt, "i", $booking_id);
    
    // Execute the query
    if (mysqli_stmt_execute($stmt)) {
        // Redirect to the dashboard or the same page after deletion
        header("Location: admindashboard.php?message=Booking deleted successfully");
    } else {
        echo "Error deleting booking: " . mysqli_error($conn);
    }

    // Close the prepared statement
    mysqli_stmt_close($stmt);
} else {
    echo "Booking ID not provided.";
}

// Close the database connection
mysqli_close($conn);
?>
