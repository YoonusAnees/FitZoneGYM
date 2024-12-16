<?php
include("db/dbconn.php");
if(isset($_GET['id'])){

$delete = $_GET['id'];
// echo $delete;
}


$sql = "delete from product where id=$delete";
$result = mysqli_query($conn, $sql);

if($result){
    header("location:showproducts.php");
}

else{
    echo "Error deleting record: " .$sql. "<br>". mysqli_error($conn);
}









?>