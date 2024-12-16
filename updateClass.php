<?php
include("db/dbconn.php");
$updateID=$_POST['updateID'];
$className = $_POST['class_name'];
$description = $_POST['description'];
$classDuration = $_POST['duration'];
$classSchedule = $_POST['schedule'];
$price = $_POST['price'];


try{
    $sql = "UPDATE gym_classes set id ='$updateID' ,ClassName='$className',Description='$description',Duration='$classDuration',Schedule='$classSchedule',Price='$price' where id='$updateID'";

// echo "<br>" ,$sql;

if(mysqli_query($conn,$sql)){
    header("location:ADMINshowClasses.php");
}
else{
    echo "Error".$sql."<br>".mysqli_error($conn);
}

}
catch(Exception $e){
    echo"Message: ".$e->getMessage();
}

?>