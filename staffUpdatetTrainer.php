<?php

include("db/dbconn.php");

$updateID = $_POST['updateID'];
$name = $_POST['fname'];
$description = $_POST['description'];
$number = $_POST['number'];

try {
    
    $sql = "UPDATE trainer SET Name = ?, description = ?, number = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
  
        mysqli_stmt_bind_param($stmt, "sssi", $name, $description, $number, $updateID);

 
        if (mysqli_stmt_execute($stmt)) {
        
            header("Location: staffShowtrainers.php");
            exit;
        } else {
            echo "Error updating record: " . mysqli_stmt_error($stmt);
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Error preparing statement: " . mysqli_error($conn);
    }
} catch (Exception $e) {
    echo "Exception caught: " . $e->getMessage();
}


mysqli_close($conn);

?>
