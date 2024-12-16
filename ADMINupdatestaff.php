<?php
include("db/dbconn.php");
$updateID=$_POST['updateID'];
$firstName=$_POST['fname'];
$lastName=$_POST['lname'];
$MobileNumber=$_POST['mnumber'];
$UserAddrees=$_POST['UserAddress'];
$Email=$_POST['email'];
$password=$_POST['password'];


try{
    $sql = "UPDATE staff set id ='$updateID' ,FirstName='$firstName',LastName='$lastName',Mobilenumber='$MobileNumber',UserAddress='$UserAddrees',Email='$Email',Password='$password' where id='$updateID'";

// echo "<br>" ,$sql;

if(mysqli_query($conn,$sql)){
    header("location:ADMINshowstaff.php");
}
else{
    echo "Error".$sql."<br>".mysqli_error($conn);
}

}
catch(Exception $e){
    echo"Message: ".$e->getMessage();
}

?>