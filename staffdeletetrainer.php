<?php
include("db/dbconn.php");
if(isset($_GET['id'])){

$Delete = $_GET['id'];
echo $Delete;
}


$sql = "delete from trainer where id=$Delete";
$result = mysqli_query($conn, $sql);

if($result){
    header("location:staffShowtrainers.php");
}

else{
    echo "Error deleting record: " .$sql. "<br>". mysqli_error($conn);
}









?>