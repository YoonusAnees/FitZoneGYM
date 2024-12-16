<?php
include("db/dbconn.php");
$updateID=$_POST['updateID'];
$product_Name = $_POST['product_name'];
$product_catagory = $_POST['category'];
$Price = $_POST['price'];
$Quantity = $_POST['quantity'];


try{
    $sql = "UPDATE product set id ='$updateID' ,product_name='$product_Name',product_catagory='$product_catagory',price='$Price',quantity='$Quantity' 
    where id='$updateID'";

// echo "<br>" ,$sql;

if(mysqli_query($conn,$sql)){
    header("location:ADMINshowproducts.php");
}
else{
    echo "Error".$sql."<br>".mysqli_error($conn);
}

}
catch(Exception $e){
    echo"Message: ".$e->getMessage();
}

?>