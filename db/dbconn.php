<?php

$servername="localhost";
$username="root";
$password="";
$dbname="gym";
try{
    $conn = new mysqli($servername,$username,$password,$dbname);
    if($conn->connect_error){
        die("Connection failed".$conn->connect_error);    /* making die the connection*/
    }
    
    else{
        // echo "Connected";
    }

}

catch(Exception $e){
  echo"Message: ".$e->getMessage();
}




?>
