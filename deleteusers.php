<?php
include("db/dbconn.php");

if(isset($_GET['id'])){
    $Delete = $_GET['id'];

    // Delete user from the userregistration table by user ID
    $deleteusers = "DELETE FROM userregistration WHERE id=$Delete";
    mysqli_query($conn, $deleteusers);

    // Delete the corresponding cart record using the same ID
    $sql = "DELETE FROM cart WHERE user_id =$Delete";  // Assuming `user_id` is the column in cart that links to userregistration table
    $result = mysqli_query($conn, $sql);

    if($result){
        header("location:admindashboard.php");
    } else {
        echo "Error deleting record: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>
