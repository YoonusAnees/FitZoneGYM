<?php
include("db/dbconn.php");
if(isset($_GET['id'])){
    $Delete = $_GET['id'];
    
    // First, delete records from class_bookings that reference this class_id
    $deleteBookings = "DELETE FROM class_bookings WHERE class_id=$Delete";
    mysqli_query($conn, $deleteBookings);

    // Then, delete the class from gym_classes
    $sql = "DELETE FROM gym_classes WHERE id=$Delete";
    $result = mysqli_query($conn, $sql);

    if($result){
        header("location:admindashboard.php");
    } else {
        echo "Error deleting record: " .$sql. "<br>". mysqli_error($conn);
    }
}

?>